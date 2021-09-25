const dbBook = require('./../models/book')

exports.index = async (req, res) => {
	const book = await dbBook.getBookFromId(req.params.bookId)
	res.render('book/index', {
		'book': book,
	})
}
