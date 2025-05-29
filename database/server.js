const express = require("express");
const http = require("http");
const { Server } = require("socket.io");
const mysql = require("mysql2");
require("dotenv").config(); // Cargar variables de entorno

const db = mysql.createConnection({
  host: process.env.DB_HOST,
  user: process.env.DB_USER,
  password: process.env.DB_PASS,
  database: process.env.DB_NAME,
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
                const chatRoomId = result.insertId;

                // Insertar también en chat_room_user
                db.query(
                  "INSERT INTO chat_room_user (chat_room_id, user_id) VALUES (?, ?), (?, ?)",
                  [chatRoomId, from, chatRoomId, to],
                  (err) => {
                    if (err)
                      return console.error("Error en chat_room_user:", err);
                    callback(chatRoomId);
                  }
                );
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
