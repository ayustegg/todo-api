const fs = require('fs')

const saveToDatabase = (DB, nameDB) => {
  fs.writeFileSync(`./src/database/${nameDB}.json`, JSON.stringify(DB, null, 2), { encoding: 'utf8' })
}

module.exports = { saveToDatabase }
