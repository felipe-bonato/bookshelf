var React = require('react')
var Base  = require('../layouts/default')

module.exports = function Book(props) {
	return (
		<Base title={ props.book.name } hasPageTitle={true} showNavBar={true}>
			<div>Hey, i'm book</div>
			<ul>
				
				<li>{ props.book.name }</li>
				<li>{ props.book.author }</li>
				<li>{ props.book.price }</li>
				<li>{ props.book.image }</li>


			</ul>
		</Base>
	)
}
