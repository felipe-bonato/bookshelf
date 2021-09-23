var React = require('react')
var Base  = require('../layouts/default')
var Title = require('../layouts/title')

module.exports = function Login(props) {
  return (
    <Base title={ props.tab_title } color_scheme={ props.color_scheme }>
        <Title main="Login" />
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
    </Base>
  )
}
