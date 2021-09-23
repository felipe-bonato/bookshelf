var React = require('react')
var Base  = require('../layouts/default')
var Title = require('../layouts/title')

module.exports = function Search(props) {
	return (
		<Base title={ props.tab_title } color_scheme={ props.color_scheme }>
			<Title main="Search" />
			<div>Hey, i'm search</div>
		</Base>
	)
}
