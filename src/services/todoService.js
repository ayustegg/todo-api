const Todo = require('../models/todo') // Importa el modelo

// el servicio es el que nos permite interactuar con la base de datos

const updateTodoTitleById = async (todoId, newTitle) => {
  try {
    const updatedTodo = await Todo.findByIdAndUpdate(todoId, { title: newTitle }, { new: true })
    return updatedTodo
  } catch (error) {
    throw new Error('Error al actualizar el título del elemento "todo" en la base de datos')
  }
}

const createTodo = async (todoData) => {
  try {
    const newTodo = new Todo(todoData)
    const createdTodo = await newTodo.save()
    return createdTodo
  } catch (error) {
    throw new Error('Error al crear el elemento "todo"')
  }
}

const getAllTodo = async () => {
  try {
    const todos = await Todo.find()
    return todos
  } catch (error) {
    throw new Error('Error al obtener elementos "todo" desde la base de datos')
  }
}

const deleteTodoById = async (todoId) => {
  try {
    const deletedTodo = await Todo.findByIdAndDelete(todoId)
    if (!deletedTodo) {
      throw new Error('El elemento "todo" no se encontró en la base de datos')
    }
    return deletedTodo
  } catch (error) {
    console.error(error) // Registra el error en la consola
    throw new Error('Error al eliminar el elemento "todo" desde la base de datos')
  }
}

const getTodoById = async (todoId) => {
  try {
    const todo = await Todo.findById(todoId)
    return todo
  } catch (error) {
    throw new Error('Error al buscar el elemento "todo" en la base de datos')
  }
}

module.exports = { getAllTodo, getTodoById, deleteTodoById, updateTodoTitleById, createTodo }
