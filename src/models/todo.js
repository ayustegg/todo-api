const mongoose = require('mongoose')
const Schema = mongoose.Schema

const todoSchema = new Schema({
  title: { type: String }
})

module.exports = mongoose.model('Todo', todoSchema)
