require('dotenv').config()

const morgan = require('morgan')
const express = require('express')
const app = express()
const cors = require('cors')

const v1TodoRouter = require('./v1/routes/todoRoutes.js')
const authRoutes = require('./v1/routes/authRoutes.js')
const dashboadRoutes = require('./v1/routes/dashboard.js')

app.use(cors())
app.use(express.json())
app.use(morgan('dev'))

app.use('/api/v1/toDo', v1TodoRouter)
app.use('/api/user', authRoutes)
app.use('/api/dashboard', dashboadRoutes)

module.exports = app
