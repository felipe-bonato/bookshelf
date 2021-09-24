const React = require('react')
const Base  = require('../layouts/default')

module.exports = function Profile(props) {
	return (
		<Base title="Profile" hasPageTitle={true} showNavBar={true}>
			<div>Hey, let's logout</div>
		</Base>
	)
}
