var React = require('react')
var Base  = require('../layouts/default')
var Title = require('../layouts/title')

module.exports = function Sell(props) {
	return (
		<Base title="Sell" hasPageTitle={true} showNavBar={true}>
			<form>
				<fieldset>
					<label>Image</label>
					<input type="file" name="image" />
				</fieldset>
				<fieldset>
					<label>Name</label>
					<input type="text" name="name" />
				</fieldset>
				<fieldset>
					<label>Author</label>
					<input type="text" name="name" />
				</fieldset>
				<fieldset>
					<button type="submit" value="Submit">Sell</button>
				</fieldset>
			</form>
		</Base>
	)
}
