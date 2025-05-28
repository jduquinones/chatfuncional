const express = require("express");
const http = require("http");
const { Server } = require("socket.io");
const mysql = require("mysql2");

// Configurar base de datos
const db = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "", // Cambia si tu XAMPP tiene contraseña
  database: "classon",
});

db.connect((err) => {
  if (err) throw err;
  console.log("Conectado a MySQL");
});

const app = express();
const server = http.createServer(app);
const io = new Server(server, {
  cors: {
    origin: "*",
  },
});

// Guardar usuarios conectados
let onlineUsers = {};

io.on("connection", (socket) => {
  console.log("Cliente conectado");

  socket.on("join", (userId) => {
    socket.userId = userId;
    onlineUsers[userId] = socket.id;
    console.log(`Usuario ${userId} se unió con socket ${socket.id}`);
  });

  socket.on("send_message", (data) => {
    const { from, to, message } = data;

    // Obtener o crear chat_room
    const getOrCreateRoom = (callback) => {
      const identifier = [from, to].sort().join("_");

      db.query(
        "SELECT id FROM chat_rooms WHERE room_identifier = ?",
        [identifier],
        (err, results) => {
          if (err) return console.error(err);

          if (results.length > 0) {
            callback(results[0].id);
          } else {
            db.query(
              "INSERT INTO chat_rooms (room_identifier, user1_id, user2_id) VALUES (?, ?, ?)",
              [identifier, from, to],
              (err, result) => {
                if (err) return console.error(err);
                callback(result.insertId);
              }
            );
          }
        }
      );
    };

    getOrCreateRoom((chatRoomId) => {
      db.query(
        "INSERT INTO messages (chat_room_id, user_id, contenido) VALUES (?, ?, ?)",
        [chatRoomId, from, message],
        (err) => {
          if (err) return console.error("Error al guardar mensaje:", err);

          const receiverSocketId = onlineUsers[to];
          if (receiverSocketId) {
            io.to(receiverSocketId).emit("receive_message", {
              from,
              message,
            });
          }
        }
      );
    });
  });

  socket.on("disconnect", () => {
    if (socket.userId) {
      delete onlineUsers[socket.userId];
      console.log(`Usuario ${socket.userId} desconectado`);
    }
  });
});

server.listen(3001, () => {
  console.log("Servidor de chat escuchando en puerto 3001");
});
