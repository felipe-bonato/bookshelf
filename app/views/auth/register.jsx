var React = require('react')
var Base  = require('../layouts/default')

module.exports = class Register extends React.Component {
	constructor(props) {
		super(props)
		this.state = {value: ''}
	
		this.handleChange = this.handleChange.bind(this)
		this.handleSubmit = this.handleSubmit.bind(this)
	}

	handleChange(event) {
		this.setState({value: event.target.value})
	}
	
	handleSubmit(event) {
		console.log('A name was submitted: ' + this.state.value)
		event.preventDefault()
	}
	
	render() {
		return (
			<Base title="Register" hasPageTitle={true} showNavBar={true}>
				<form onSubmit={ this.handleSubmit } action="/api/register" method="POST">
					<fieldset>
						<label htmlFor="email">Email</label>
						<input id="email" type="email" name="email"></input>
					</fieldset>
					<fieldset>
						<label htmlFor="password">Password</label>
						<input id="password" type="password" name="password"></input>
					</fieldset>
					<fieldset>
						<label htmlFor="confirmPassword">Confirm Password</label>
						<input id="confirmPassword" type="password" name="confirmPassword"></input>
					</fieldset>
					<fieldset>
						<button type="submit">Register</button>
					</fieldset>
				</form>
			</Base>
		);
	}
}
