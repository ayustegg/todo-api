const express = require('express')
const router = express.Router()
const todoController = require('../../controllers/todoController')

// metodos http sobre la ruta /api/v1/toDo
// llama al controller dependiendo del metodo http
router
  .get('/', todoController.getAllTodo)
  .get('/:id', todoController.getOneTodo)
  .post('/', todoController.createNewTodo)
  .patch('/:id', todoController.updateOneTodo)
  .delete('/:id', todoController.deleteOneTodo)

module.exports = router
