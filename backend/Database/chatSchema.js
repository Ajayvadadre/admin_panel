const mongoose = require("mongoose")

const chatSchema = new mongoose.Schema({
    users: { type: Object, required: true },
    message: { type: Array, required: true },
})

const userData = mongoose.model("adminChat", chatSchema)

module.exports = userData;