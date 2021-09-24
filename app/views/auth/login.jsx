var React = require('react')
var Base  = require('../layouts/default')
var Title = require('../layouts/title')

module.exports = function Login(props) {
    const title = "Login"
    return (
        <Base title={ title } hasPageTitle={true}>
            <form >
                <fieldset method="POST">
                    <label>E-Mail</label>
                    <input type="email"></input>
                </fieldset>
                <fieldset>
                    <label>Password</label>
                    <input type="password"></input>
                </fieldset>
                <fieldset>
                    <button type="submit">Log In</button>
                </fieldset>
            </form>
            <div>Don't have an account? <a href="/register">Try registring</a></div>
        </Base>
    )
}
