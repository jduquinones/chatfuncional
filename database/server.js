const express = require("express");
const http = require("http");
const { Server } = require("socket.io");
const mysql = require("mysql2");
const path = require("path");
const fs = require("fs").promises;
require("dotenv").config();

const UPLOAD_DIR = path.join(__dirname, "..", "uploads");
fs.mkdir(UPLOAD_DIR, { recursive: true }).catch(console.error);

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
          callback(results.length > 0 ? results[0].id : null);
        }
      );
    };

    getOrCreateRoom((chatRoomId) => {
      if (chatRoomId) {
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
      }
    });
  });

  socket.on("send_file", async (fileData) => {
    const { from, to, name, type, size, data } = fileData;

    const getOrCreateRoomForFile = (callback) => {
      const identifier = [from, to].sort().join("_");
      db.query(
        "SELECT id FROM chat_rooms WHERE room_identifier = ?",
        [identifier],
        (err, results) => {
          if (err) return console.error(err);
          callback(results.length > 0 ? results[0].id : null);
        }
      );
    };

    getOrCreateRoomForFile(async (chatRoomId) => {
      if (chatRoomId) {
        const fileName = `${Date.now()}_${name.replace(/\s+/g, "_")}`;
        const filePath = path.join(UPLOAD_DIR, fileName);
        const archivoRuta = `uploads/${fileName}`;

        try {
          // Convertir el ArrayBuffer a Buffer para escribir el archivo
          const buffer = Buffer.from(data);
          await fs.writeFile(filePath, buffer);
          console.log(`Archivo guardado en: ${filePath}`);

          db.query(
            "INSERT INTO messages (chat_room_id, user_id, archivo_nombre, archivo_ruta, archivo_tipo) VALUES (?, ?, ?, ?, ?)",
            [chatRoomId, from, name, archivoRuta, type],
            (err) => {
              if (err)
                return console.error("Error al guardar info del archivo:", err);

              const receiverSocketId = onlineUsers[to];
              if (receiverSocketId) {
                io.to(receiverSocketId).emit("receive_file", {
                  from,
                  name,
                  type,
                  size,
                  ruta: archivoRuta, // Enviamos la ruta del archivo guardado
                });
                console.log(
                  `Info de archivo guardada en DB y ruta enviada a ${to}: ${name}`
                );
              }
            }
          );
        } catch (error) {
          console.error("Error al guardar el archivo:", error);
          // Podrías emitir un error al cliente si lo deseas
        }
      } else {
        console.error("No se encontró la sala de chat para el archivo.");
      }
    });
  });

  socket.on("send_audio", async (audioData) => {
    const { from, to, audioData: base64Audio, mimeType } = audioData;

    const getOrCreateRoomForAudio = (callback) => {
      const identifier = [from, to].sort().join("_");
      db.query(
        "SELECT id FROM chat_rooms WHERE room_identifier = ?",
        [identifier],
        (err, results) => {
          if (err) return console.error(err);
          callback(results.length > 0 ? results[0].id : null);
        }
      );
    };

    getOrCreateRoomForAudio(async (chatRoomId) => {
      if (chatRoomId) {
        const fileName = `audio_${Date.now()}.webm`;
        const filePath = path.join(UPLOAD_DIR, fileName);
        const archivoRuta = `uploads/${fileName}`;
        const archivoNombre = fileName;
        const archivoTipo = mimeType;
        const audioBuffer = Buffer.from(base64Audio, "base64");

        try {
          await fs.writeFile(filePath, audioBuffer);
          console.log(`Audio guardado en: ${filePath}`);

          db.query(
            "INSERT INTO messages (chat_room_id, user_id, contenido, archivo_nombre, archivo_ruta, archivo_tipo) VALUES (?, ?, ?, ?, ?, ?)",
            [chatRoomId, from, null, archivoNombre, archivoRuta, archivoTipo],
            (err) => {
              if (err)
                return console.error("Error al guardar info del audio:", err);

              const receiverSocketId = onlineUsers[to];
              if (receiverSocketId) {
                io.to(receiverSocketId).emit("receive_audio_url", {
                  from,
                  ruta: archivoRuta,
                  mimeType,
                });
                console.log(
                  `Info de audio guardada en DB y URL enviada a ${to}`
                );
              }
            }
          );
        } catch (error) {
          console.error("Error al guardar el audio:", error);
        }
      } else {
        console.error("No se encontró la sala de chat para el audio.");
      }
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
