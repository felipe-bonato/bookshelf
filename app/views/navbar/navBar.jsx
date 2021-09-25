var React = require('react')
var LoginControl = require('./loginControl')
var NavBarItem = require('./navBarItem')

module.exports = function NavBar(props) {
	return (
		<nav id="NavBar_con">
            <NavBarItem>
                <a href="/profile">Profile</a>
            </NavBarItem>
            <NavBarItem>
                <a href="/search">Search</a>
            </NavBarItem>
            <NavBarItem>
                <a href="/sell">Sell</a>
            </NavBarItem>
            <NavBarItem>
                <a href="/home"><img height="100%" src="imgs/app/navbar/home_unselected.svg" alt="Home"/></a>
            </NavBarItem>
		</nav>
	)
}
