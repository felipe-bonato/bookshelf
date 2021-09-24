const db = require('./../../models/user')

exports.index = async (req, res) => {
    const users = await db.getAll()
	res.render('admin/users', {
		'users': users,
	});
    require('../../util').logConnection(req)
};
