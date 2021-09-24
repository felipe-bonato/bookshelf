exports.index = (req, res) => {
	res.render('home/index', {
		name: 'John',
		tab_title: 'Home',
		color_scheme: 'light',
		books: [
			{
				title: 'Book1',
				author: 'Felipe',
				coverImg: 'foto.png',
			},
			{
				title: 'Book2',
				author: 'Luiza',
				coverImg: 'foto5.png',
			},
			{
				title: 'Book3',
				author: 'Joãozinho',
				coverImg: 'foto3.png',
			},
		],
	})
	//console.log(req.client.parser.incoming.originalUrl)
}