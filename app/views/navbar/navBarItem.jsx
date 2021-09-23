var React = require('react')

module.exports = function NavBarItem(props) {
	return (
        <div className="NavBar_item">
            { props.children }
        </div>
	)
}
