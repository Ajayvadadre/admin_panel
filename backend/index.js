const express = require("express");
const connectDB = require("./Database/dbConnection");
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

const start = async () => {
  try {
    await connectDB();
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
        console.log( registerUserId);
      });
      socket.join("room1");

      // Socket send message
      socket.on("sendMessage", (message, sender, reciver) => {
        console.log(
          "This is the message from: " + sender + "," + message + "," + reciver
        );
        io.emit("recievedMessage", message, reciver);
        io.to("room1").emit("roomOneMessage", message, reciver);
      });

      // Private chat room
      socket.on("privateMessage", ({ message, reciver, sender }) => {
        console.log(
          "private message: " + sender + "," + message + "," + reciver
        );
        socket.to(registerUserId[reciver]).emit("private message", {
          message,
          from: sender,
        });
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
