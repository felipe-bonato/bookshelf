exports.index = (req, res) => {
	res.render('book/index', {
		tab_title: '<book-name>',
		color_scheme: 'light',
	});
    require('./../util/log').logConnection(req)
};
