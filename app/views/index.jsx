var React = require('react');
var Base    = require('./layouts/default');
var MainCon = require('./layouts/main_c');

function HelloMessage(props) {
  return (
    <Base title={props.title} color_scheme={ props.color_scheme }>
      <MainCon>
        <div>Hello {props.name}</div>
      </MainCon>
    </Base>
  );
}

module.exports = HelloMessage;
