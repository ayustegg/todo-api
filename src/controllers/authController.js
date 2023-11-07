const { schemaRegister, schemaLogin } = require('../schemas/auth.shema.js')
const authService = require('../services/authService.js')

const register = async (req, res) => {
  const { error } = schemaRegister.validate(req.body)
  if (error) {
    return res.status(400).json({
      error: error.details[0].message
    })
  }
  try {
    const savedUser = await authService.registerUser(req.body)
    res.json({
      error: null,
      data: savedUser
    })
  } catch (error) {
    res.status(400).json({
      error: error.message
    })
  }
}

const login = async (req, res) => {
  const { error } = schemaLogin.validate(req.body)
  console.log('hola')
  if (error) {
    return res.status(400).json({
      error: error.details[0].message
    })
  }

  try {
    const token = await authService.loginUser(req.body)
    res.json({
      error: null,
      data: { token }
    })
  } catch (error) {
    res.status(400).json({
      error: error.message
    })
  }
}
module.exports = { register, login }
