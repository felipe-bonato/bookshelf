var React = require('react')
var Base  = require('../layouts/default')

module.exports = function Login(props) {
	return (
		<Base title="Login" hasPageTitle={true} showNavBar={false}>
			<form action="/api/login" method="POST" className="bsForm">
				<fieldset>
					<label htmlFor="email">Email</label>
					<input id="email" type="email" name="email"></input>
				</fieldset>
				<fieldset>
					<label htmlFor="password">Password</label>
					<input id="password" type="password" name="password"></input>
				</fieldset>
				<fieldset>
					<button type="submit">Login</button>
				</fieldset>
			</form>
			<div>Don't have an account? <a href="/register">Try registring</a></div>
		</Base>
	)
}
