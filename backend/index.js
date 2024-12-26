const express = require("express");
const connectDB = require("./Database/dbConnection");

const app = express();
const port = 3000;
app.get("/", (res, req) => {
  res.send("Connected");
});

const start = async () => {
  try {
    await connectDB();
    app.listen(port, () => {
      console.log("Listening on:" + port);
    });
  } catch (error) {
    console.log("Connection error: " + error);
  }
};

start();
