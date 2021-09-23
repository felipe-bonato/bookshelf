var React = require('react')
var Base  = require('../layouts/default')
var Title = require('../layouts/title')

module.exports = class Sell extends React.Component {
	render() {
		return (
			<Base title={ this.props.tab_title } color_scheme={ this.props.color_scheme }>
				<Title main="Sell" />
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
}
