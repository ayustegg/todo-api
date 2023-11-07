const express = require('express')
const router = express.Router()
const todoController = require('../../controllers/todoController')
const verifyToken = require('../../middlewares/validateTokenRoutes')
// metodos http sobre la ruta /api/v1/toDo
// llama al controller dependiendo del metodo http
router
  .get('/', verifyToken, todoController.getAllTodo)
  .get('/:id', todoController.getTodoById)
  .post('/', verifyToken, todoController.createTodo)
  .patch('/:id', todoController.updateTodoTitle)
  .delete('/:id', todoController.deleteTodo)

module.exports = router
