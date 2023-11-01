const Todos = require('../database/ToDos')
const { v4: uuidv4 } = require('uuid')

// el servicio es el que nos permite interactuar con la base de datos

const getAllTodos = () => {
  return Todos.getAllTodos()
}
const getOneTodoById = (id) => {
  return Todos.getOneTodoById(id)
}

const createNewTodo = (todo) => {
  return Todos.createNewTodo({
    ...todo,
    id: uuidv4(),
    completed: false
  })
}
const deleteOneTodoById = (id) => {
  return Todos.deleteOneTodoById(id)
}

const updateOneTodoById = (todo) => {
  return Todos.updateOneTodoById(todo)
}

module.exports = { getAllTodos, getOneTodoById, createNewTodo, deleteOneTodoById, updateOneTodoById }
