const dbBook = require('../../app/models/book')

exports.home = async (req, res) => {
    res.json({
        'books': await dbBook.getAll()
    })
}