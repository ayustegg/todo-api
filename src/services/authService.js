const bcrypt = require('bcrypt')
const User = require('./../models/user.js')
const jwt = require('jsonwebtoken')
async function registerUser (userData) {
  const isEmailExist = await User.findOne({ email: userData.email })

  if (isEmailExist) {
    throw new Error('Email ya registrado')
  }

  const salt = await bcrypt.genSalt(10)
  const password = await bcrypt.hash(userData.password, salt)
  const user = new User({
    name: userData.name,
    email: userData.email,
    password
  })
  try {
    const savedUser = await user.save()
    return savedUser
  } catch (error) {
    throw new Error(error)
  }
}

async function loginUser (userData) {
  const user = await User.findOne({ email: userData.email })
  if (!user) {
    throw new Error('Usuario no encontrado')
  }
  const validPassword = await bcrypt.compare(userData.password, user.password)
  if (!validPassword) {
    throw new Error('Contraseña no válida')
  }
  const token = jwt.sign({
    name: user.name,
    id: user._id
  }, process.env.TOKEN_SECRET)
  return token
}

module.exports = {
  registerUser, loginUser
}
