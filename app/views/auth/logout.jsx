var React = require('react')
var Base  = require('../layouts/default')
var Title = require('../layouts/title')

module.exports = function Logout(props) {
  return (
    <Base title={ props.tab_title } color_scheme={ props.color_scheme }>
        <Title main="Logout" />
        <div>Hey, i'm logout</div>
    </Base>
  )
}
