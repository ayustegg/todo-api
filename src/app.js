require('dotenv').config()

const express = require('express')
const app = express()
const cors = require('cors')

const v1TodoRouter = require('./v1/routes/todoRoutes.js')
const authRoutes = require('./v1/routes/authRoutes.js');
const dashboadRoutes = require('./v1/routes/dashboard.js');
const verifyToken = require('./v1/routes/validateTokenRoutes.js');


app.use(cors())
app.use(express.json())

app.use('/api/v1/toDo', v1TodoRouter)
app.use('/api/user', authRoutes); 
app.use('/api/dashboard', verifyToken, dashboadRoutes);

module.exports =  app;
