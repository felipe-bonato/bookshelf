var React = require('react')
var Base  = require('../layouts/default')
var Title = require('../layouts/title')

module.exports = function Sell(props) {
	return (
		<Base title="Sell" hasPageTitle={true} showNavBar={true}>
			<form action="/api/sell" method="POST" className="bsForm">
				<fieldset>
					<label htmlFor="image">Image</label>
					<input id="image" type="file" name="image" />
				</fieldset>
				<fieldset>
					<label htmlFor="name">Name</label>
					<input id="name" type="text" name="name" />
				</fieldset>
				<fieldset>
					<label htmlFor="author">Author</label>
					<input id="author" type="text" name="author" />
				</fieldset>
				<fieldset>
					<label htmlFor="price">Price</label>
					<input id="price" type="number" name="price" />
				</fieldset>
				<fieldset>
					<button type="submit" value="Submit">Sell</button>
				</fieldset>
			</form>
		</Base>
	)
}
