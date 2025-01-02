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
    io.on("connection", (socket) => {
      // console.log("a user connected");
      socket.join("room1")
      io.to('room1').emit('hi')
      socket.on("sendMessage", (message,username) => {
        console.log("This is the message: " + message);
        io.emit('backendMessage',message)
      });
    
      socket.on('joinRoom', (userId) => {
        console.log(userId)
        socket.join(userId);
      });

    
    });
  } catch (error) {
    console.log("Connection error: " + error);
  }
};

start();
