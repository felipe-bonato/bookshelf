exports.index = (req, res) => {
	res.render('search/index');
    require('./../util/log').logConnection(req)
};