exports.login = (req, res) => {
	res.render('auth/login', {
		tab_title: 'Home',
		color_scheme: 'light',
	});
	require('./../util/log').logConnection(req)
};

exports.logout = (req, res) => {
	res.render('auth/logout', {
		tab_title: 'Home',
		color_scheme: 'light',
	});
	require('./../util/log').logConnection(req)
};
