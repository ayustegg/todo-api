const DB = require('./todo.json')
const { saveToDatabase } = require('./utils')
const nameDB = 'todo'

const getAllTodos = () => {
  return DB.todos
}

const getOneTodoById = (id) => {
  const todo = DB.todos.find((todo) => todo.id == id)
  if (!todo) {
    return
  }
  return todo
}

const createNewTodo = (newTodo) => {
  DB.todos.push(newTodo)
  saveToDatabase(DB, nameDB)
  return newTodo
}
const deleteOneTodoById = (id) => {
  const todoIndex = DB.todos.findIndex((todo) => todo.id == id)
  if (todoIndex !== -1) {
    DB.todos.splice(todoIndex, 1)
    saveToDatabase(DB, nameDB)
    return true
  }
}

const updateOneTodoById = (todo) => {
  const { id, title } = todo
  const todoToModify = DB.todos.find((todo) => todo.id === id)
  if (todoToModify) {
    todoToModify.title = title
    saveToDatabase(DB, nameDB)
    return todoToModify
  }
}

module.exports = { getAllTodos, getOneTodoById, createNewTodo, deleteOneTodoById, updateOneTodoById }
