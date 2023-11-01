const express = require('express')
const v1TodoRouter = require('./v1/routes/todoRoutes.js')
const app = express()
const cors = require('cors')
const port = process.env.PORT || 3000

app.use(cors())

app.use(express.json())
app.use(cors())
// routesapp.use(cors());
app.use('/api/v1/toDo', v1TodoRouter)

// start server
app.listen(port, () => console.log('http://localhost:' + port))
