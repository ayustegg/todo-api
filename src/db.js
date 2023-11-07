const mongoose = require('mongoose')
const dbURI = `mongodb+srv://${process.env.X_USER}:${process.env.X_PASSWORD}@ayustegg.pee5oql.mongodb.net/?retryWrites=true&w=majority`

const connectDB = async () => {
    try {
        await mongoose.connect(dbURI)
        console.log('>>> DB connection done');
    } catch (error) {
        console.error('Mongoose connection error:', error);
    }
};

module.exports = {connectDB}