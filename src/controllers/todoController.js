const todoService = require('../services/todoService')
// el controlador es el que se encarga de manejar la logica de la peticion

// metodo que se ejecuta cuando se hace una peticion get a la ruta /api/v1/toDo
const getAllTodo = async (req, res) => {
  const userId = req.user.id
  try {
    const todos = await todoService.getAllTodo(userId)
    res.json(todos)
  } catch (error) {
    res.status(500).json({ error: 'Error al obtener elementos "todo"' })
  }
}
const getTodoById = async (req, res) => {
  const todoId = req.params.id // Obtiene el _id del elemento desde la ruta
  try {
    const todo = await todoService.getTodoById(todoId)
    if (!todo) {
      res.status(404).json({ error: 'El elemento "todo" no se encontró en la base de datos' })
    } else {
      res.json(todo)
    }
  } catch (error) {
    res.status(500).json({ error: 'Error al buscar el elemento "todo"' })
  }
}

const deleteTodo = async (req, res) => {
  const todoId = req.params.id // Obtiene el _id del elemento desde la ruta
  try {
    const deletedTodo = await todoService.deleteTodoById(todoId)
    if (!deletedTodo) {
      res.status(404).json({ error: 'El elemento "todo" no se encontró en la base de datos' })
    } else {
      res.json(deletedTodo)
    }
  } catch (error) {
    res.status(500).json({ error: 'Error al eliminar el elemento "todo"' })
  }
}

const updateTodoTitle = async (req, res) => {
  const todoId = req.params.id // Obtiene el _id del elemento desde la ruta
  const newTitle = req.body.title // Obtiene el nuevo título desde el cuerpo de la solicitud
  try {
    const updatedTodo = await todoService.updateTodoTitleById(todoId, newTitle)
    if (!updatedTodo) {
      res.status(404).json({ error: 'El elemento "todo" no se encontró en la base de datos' })
    } else {
      res.json(updatedTodo)
    }
  } catch (error) {
    res.status(500).json({ error: 'Error al actualizar el título del elemento "todo"' })
  }
}

const createTodo = async (req, res) => {
  const todoData = req.body
  const userId = req.user.id
  todoData.user = userId
  console.log(todoData)
  try {
    const createdTodo = await todoService.createTodo(todoData)
    res.json(createdTodo)
  } catch (error) {
    res.status(500).json({ error: 'Error al crear el elemento "todo"' })
  }
}

module.exports = { getAllTodo, getTodoById, deleteTodo, updateTodoTitle, createTodo }
