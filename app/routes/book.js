exports.index = (req, res) => {
	res.render('book/index', {
		bookName: '<book-name>',
	});
    require('./../util/log').logConnection(req)
};
