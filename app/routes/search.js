exports.index = (req, res) => {
	res.render('search/index', {
		tab_title: '<book-name>',
		color_scheme: 'light',
	});
    require('./../util/log').logConnection(req)
};