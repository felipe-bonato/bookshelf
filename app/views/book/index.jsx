var React = require('react')
var Base  = require('../layouts/default')
var Title = require('../layouts/title')

module.exports = function Book(props) {
	return (
		<Base title={ props.name }>
			<div>Hey, i'm book</div>
		</Base>
	)
}
