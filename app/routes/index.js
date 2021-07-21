exports.index = (req, res) => {
	res.render('home/home', {
		name: 'John',
		title: 'Home',
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
	console.log('Index Request Handled');
};
  