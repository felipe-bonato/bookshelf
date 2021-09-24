var React = require('react')
var Base  = require('../layouts/default')

module.exports = function Users(props) {
    return (
        <Base title={ "Users" } hasPageTitle={true}>
            <ul>{ props.users.map(user => <li key={ user._id} >{ user.email }</li>) }</ul>
        </Base>
    )
}
