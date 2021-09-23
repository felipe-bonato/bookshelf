var React = require('react')
var Base  = require('../layouts/default')
var Title = require('../layouts/title')

module.exports = function Book(props) {
	return (
		<Base title={ props.tab_title } color_scheme={ props.color_scheme }>
			<Title main="Book" />
			<div>Hey, i'm book</div>
		</Base>
	)
}
