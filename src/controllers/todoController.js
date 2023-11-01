const todoService = require('../services/todoService')
// el controlador es el que se encarga de manejar la logica de la peticion

// metodo que se ejecuta cuando se hace una peticion get a la ruta /api/v1/toDo
const getAllTodo = (req, res) => {
  res.send({ todos: todoService.getAllTodos() })
}
const getOneTodo = (req, res) => {
  const { id } = req.params
  const todo = todoService.getOneTodoById(id)
  if (!todo) {
    return res.status(404).send({ status: 'ERROR', message: 'Todo not found' })
  }
  res.send({ status: 'OK', data: todo })
}

const createNewTodo = (req, res) => {
  const { body } = req
  if (!body.title) {
    return res.status(400).send({ status: 'ERROR', message: 'Missing title' })
  }
  const todo = {
    title: body.title
  }

  const newTodo = todoService.createNewTodo(todo)
  if (!newTodo) {
    return res.status(500).send({ status: 'ERROR', message: 'Internal server error' })
  }
  res.send({ status: 'OK', data: newTodo })
}

const deleteOneTodo = (req, res) => {
  const { id } = req.params
  console.log(id)
  const todoEliminated = todoService.deleteOneTodoById(id)
  if (!todoEliminated) {
    return res.status(500).send({ status: 'ERROR', message: 'Todo not found' })
  }
  res.send({ status: 'OK', message: `Deleted todo with id ${id}` })
}

const updateOneTodo = (req, res) => {
  const id = req.params.id
  const { body } = req
  if (!body.title) {
    return res.status(404).send({ status: 'ERROR', message: 'Title is not Found' })
  }
  const todo = {
    id,
    title: body.title
  }
  const todoUpdated = todoService.updateOneTodoById(todo)
  if (!todoUpdated) {
    return res.status(404).send({ status: 'ERROR', message: 'Todo not found' })
  }
  res.send({ status: 'OK', data: todoUpdated })
}

module.exports = { getAllTodo, getOneTodo, createNewTodo, deleteOneTodo, updateOneTodo }
