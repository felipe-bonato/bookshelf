exports.index = (req, res) => {
	res.render('home/index', {
		name: 'John',
		tab_title: 'Home',
		color_scheme: 'light',
		books: [
			{
				title: 'Book1',
				author: 'Felipe',
				cover_img: 'foto.png',
			},
			{
				title: 'Book2',
				author: 'Luiza',
				cover_img: 'foto5.png',
			},
			{
				title: 'Book3',
				author: 'Joãozinho',
				cover_img: 'foto3.png',
			},
		],
	});
	require('./../util/log').logConnection(req)
	//console.log(req.client.parser.incoming.originalUrl)
};