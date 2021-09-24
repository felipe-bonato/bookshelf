var React = require('react')
var Base  = require('../layouts/default')
var Title = require('../layouts/title')

module.exports = function Logout(props) {
	const title = "Logout"
	return (
		<Base title={ title } hasPageTitle={true}>
			<div>Hey, i'm logout</div>
		</Base>
	)
}
