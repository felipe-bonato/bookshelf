var React = require('react');

function LoginButton(props) {
	return (
		<a href="/login" onClick={ props.onClick }>Log in</a>
	);
}
  
function LogoutButton(props) {
	return (
		<a href="/logout" onClick={ props.onClick }>Log out</a>
	);
}

module.exports = class LoginControl extends React.Component {
	constructor(props) {
		super(props)
		this.handleLoginClick = this.handleLoginClick.bind(this)
		this.handleLogoutClick = this.handleLogoutClick.bind(this)
		this.state = { isLoggedIn: false }
	}

	handleLoginClick() {
		console.log("I'm in login")
		this.setState({isLoggedIn: true})
	}

	handleLogoutClick() {	
		console.log("I'm in logout")
		this.setState({isLoggedIn: false})
	}

	render() {
		if (this.state.isLoggedIn) {
			return <LogoutButton onClick={this.handleLogoutClick} />
		} else {
			return <LoginButton onClick={this.handleLoginClick} />
		}
	}
}