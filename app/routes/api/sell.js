const dbBook = require('../../models/book')

exports.index = async (req, res) => {
    const book = req.body
    const id = await dbBook.insert({
        'name': book.name,
        'author': book.author,
        'price': book.price,
        'image': book.image,
    })
    res.redirect(`/book/${id}`)
}