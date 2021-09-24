var React = require('react')
var Base  = require('../layouts/default')
var Title = require('../layouts/title')

module.exports = function Search(props) {
	return (
		<Base title="Search" hasPageTitle={true} showNavBar={true}>
			<div>Hey, i'm search</div>
		</Base>
	)
}
