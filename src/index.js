const express = require('express')
const v1TodoRouter = require('./v1/routes/todoRoutes.js')
const app = express()
const mongoose = require('mongoose')
const cors = require('cors')

const port = process.env.PORT || 3000
const dbURI = 'mongodb+srv://ayuste:rootayuste@ayustegg.pee5oql.mongodb.net/?retryWrites=true&w=majority'

const corsOptions = {
  origin: 'http://35.181.53.241'
}

app.use(cors(corsOptions))

app.use(express.json())

// routesapp.use(cors());
app.use('/api/v1/toDo', v1TodoRouter)

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
