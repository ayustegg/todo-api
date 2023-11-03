require('dotenv').config()

const express = require('express')
const app = express()
const port = process.env.PORT || 3000

const cors = require('cors')

const v1TodoRouter = require('./v1/routes/todoRoutes.js')
const authRoutes = require('./v1/routes/authRoutes.js');
const dashboadRoutes = require('./v1/routes/dashboard.js');
const verifyToken = require('./v1/routes/validateTokenRoutes.js');

const mongoose = require('mongoose')
const uri = `mongodb+srv://${process.env.USER}:${process.env.PASSWORD}@cluster0.ncdk5.mongodb.net/${process.env.DBNAME}?retryWrites=true&w=majority`;
const dbURI = `mongodb+srv://${process.env.X_USER}:${process.env.X_PASSWORD}@ayustegg.pee5oql.mongodb.net/?retryWrites=true&w=majority`
const mongo = `mongodb+srv://ayuste:rootayuste@ayustegg.pee5oql.mongodb.net/?retryWrites=true&w=majority`
console.log(process.env)
app.use(cors())
app.use(express.json())

// routesapp.use(cors());
app.use('/api/v1/toDo', v1TodoRouter)

app.get('/prueba', (req, res) => {
  res.json({ 
      estado: true,
      mensaje: 'funciona!'
  })
});
app.use('/api/user', authRoutes); 
app.use('/api/dashboard', verifyToken, dashboadRoutes);



mongoose.connect(dbURI)
  .then(() => {
    console.log('Connected to MongoDB')
    app.listen(port, function () {
      console.log('Node server running on http://localhost:' + port + '/api/v1/toDo')
    })
  })
  .catch((err) => {
    console.error('Error connecting to MongoDB: ' + err)
  })
