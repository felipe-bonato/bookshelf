var React = require('react');
var NavBar = require('../navbar/navBar');

module.exports = function Base(props) {
	return (
		<html lang="en">
			<head>
				<meta charSet="UTF-8" />
				<meta name="viewport" content="width=device-width, initial-scale=1.0" />
				<link rel="stylesheet" href="css/styles.css" />
				<link rel="stylesheet" href="css/navbar.css" />
				<link rel="shorchut icon" href={ "imgs/app/favicon/" + props.color_scheme + ".png" } />
				<title>{ props.title } • Bookshelf!</title>
			</head>
			<body>
				<main className="s-main-con">
					{ props.children }
				</main>
				<NavBar />
			</body>
		</html>
	);
}
// { "/imgs/app/logo/logo_" + props.color_scheme + ".png" }
