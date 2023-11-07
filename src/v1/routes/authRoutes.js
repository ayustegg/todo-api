const express = require('express')
const router = express.Router()

const registerController = require('../../controllers/authController')

router
  .post('/register', registerController.register)
  .post('/login', registerController.login)
module.exports = router
