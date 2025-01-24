const express = require("express");
const { connectDB } = require("./Database/dbConnection");
const { Server } = require("socket.io");
const { MongoClient } = require("mongodb");
const bodyParser = require("body-parser");
const cors = require("cors");
const app = express();
const http = require("http");
const server = http.createServer(app);
const port = 3000;
app.use(cors());
app.use(bodyParser.json());
app.get("/", (req, res) => {
  res.send("Connected");
});
const io = new Server(server, {
  cors: {
    origin: "http://localhost:8080",
    credentials: true,
  },
});

const uri =
  "mongodb+srv://ajayvadadre:ajayvadadre1234@nodemongocluster.1y5lp.mongodb.net/";
const client = new MongoClient(uri);
let db;

//Connection to mongoDB
async function connectToMongo() {
  try {
    await client.connect();
    db = client.db("chatApp");
    console.log("Connected to MongoDB");
  } catch (err) {
    console.error("Failed to connect to MongoDB", err);
  }
}
connectToMongo().catch((err) => {
  console.error("Failed to connect to MongoDB", err);
});

// const start = async () => {
try {
  // let db = await connectDB();
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

    //fetch from mongo
    socket.on("joinRoom", async ({ sender, receiver }) => {
      const room = [sender, receiver].join("_");
      console.log(`${sender} joined room ${room}`);
      socket.join(room);

      try {
        const messages = await db
          .collection("messages")
          .find({
            $or: [
              { sender, receiver },
              { sender: receiver, receiver: sender },
            ],
          })
          .sort({ timestamp: 1 })
          .toArray();
        console.log(messages);
        socket.emit("previousMessages", messages);
      } catch (err) {
        console.error("Error fetching messages:", err);
      }
    });

    //join room
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
        timestamp: new Date(),
      };

      // Insert the message data into the database
      db.collection("messages").insertOne(userData, (err, result) => {
        if (err) {
          console.error("Error inserting message into database:", err);
        } else {
          console.log("Message inserted into database:", result);
        }
      });

      // Emit the message to the recipient
      socket.emit("recievedMessage", message, reciver);
      socket.to(registerUserId[reciver]).emit("private message", {
        message,
        from: sender,
      });
      io.to(room).emit("roomMessage", message, reciver);
    });

    // Socket room create
    // socket.on("joinRoom", (userId) => {
    //   console.log(userId);
    //   socket.join(userId);
    // });
  });
} catch (error) {
  console.log("Connection error: " + error);
}
// };

// start();
