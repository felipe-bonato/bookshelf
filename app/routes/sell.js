exports.index = (req, res) => {
	res.render('sell/index');
    require('./../util/log').logConnection(req)
};