var React = require('react')
var LoginControl = require('./loginControl')
var NavBarItem = require('./navBarItem')

module.exports = function NavBar(props) {
	return (
		<nav id="NavBar_con">
            <NavBarItem>
                <a href="/home">Home</a>
            </NavBarItem>
            <NavBarItem>
                <a href="/sell">Sell</a>
            </NavBarItem>
            <NavBarItem>
                <a href="/search">Search</a>
            </NavBarItem>
            <NavBarItem>
                <LoginControl />
            </NavBarItem>
		</nav>
	)
}
