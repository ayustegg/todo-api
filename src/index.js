const port = process.env.PORT || 3000
const app = require('./app.js')
const { connectDB } = require('./db.js')

connectDB()
app.listen(port, function () {
  console.log('Node server running on http://localhost:' + port + '/api/v1/toDo')
})
