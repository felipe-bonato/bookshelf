exports.login = (req, res) => {
	res.render('auth/login')
}

exports.logout = (req, res) => {
	res.render('auth/logout')
}

exports.register = (req, res) => {
	res.render('auth/register')
}
