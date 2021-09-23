exports.index = (req, res) => {
	res.render('sell/index', {
		tab_title: '<book-name-tab>',
		color_scheme: 'light',
	});
    require('./../util/log').logConnection(req)
};