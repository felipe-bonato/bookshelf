exports.login = (req, res) => {
	res.render('auth/login');
	require('./../util/log').logConnection(req)
};

exports.logout = (req, res) => {
	res.render('auth/logout');
	require('./../util/log').logConnection(req)
};

exports.register = (req, res) => {
	res.render('auth/register');
	require('./../util/log').logConnection(req)
};
