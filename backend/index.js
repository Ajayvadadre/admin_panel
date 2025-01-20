const express = require("express");
const { connectDB, db } = require("./Database/dbConnection");

// const usersData = require("./Database/chatSchema");
const cors = require("cors");
const http = require("http");
const { Server } = require("socket.io");
const app = express();
const server = http.createServer(app);
const port = 3000;
app.use(cors());
app.get("/", (req, res) => {
  res.send("Connected");
});
const io = new Server(server, {
  cors: {
    origin: "http://localhost:8080",
    credentials: true,
  },
});

// let db = await connectDB;

const start = async () => {
  try {
    let db = await connectDB();
    //Server connection
    server.listen(3000, () => {
      console.log("listening on *:3000");
    });

    //Socket connection
    let registerUserId = [];
    io.on("connection", (socket) => {
      // register user
      socket.on("register", (sender) => {
        registerUserId[sender] = socket.id;
        console.log(registerUserId);
      });
      socket.on("join", ({ sender, reciver }) => {
        let room = [sender, reciver].sort().join();
        console.log(room + ":" + "joined");
        socket.join(room);
      });

      // Socket send message
      socket.on("sendMessage", (message, sender, reciver) => {
        console.log(
          "This is the message from: " + sender + "," + message + "," + reciver
        );
        io.to("room1").emit("roomOneMessage", message, reciver);
      });

      // Private chat room
      socket.on("privateMessage", ({ message, reciver, sender }) => {
        let room = [sender, reciver].sort().join();
        userData = {
          sender,
          reciver,
          message,
          Date,
        };

        db.collection("userMessage").insertOne(userData);
        console.log(
          "private message: " + sender + "," + message + "," + reciver
        );
        socket.emit("recievedMessage", message, reciver);
        socket.to(registerUserId[reciver]).emit("private message", {
          message,
          from: sender,
        });
        io.to(room).emit("roomMessage", message, reciver);
      });

      // Socket room create
      socket.on("joinRoom", (userId) => {
        console.log(userId);
        socket.join(userId);
      });
    });
  } catch (error) {
    console.log("Connection error: " + error);
  }
};

start();
