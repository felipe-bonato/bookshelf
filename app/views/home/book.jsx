var React = require('react');

module.exports = function Book(props) {
  return (
	<div>
		<h1>{ props.title }</h1>
		<h3>{ props.author }</h3>
		<span>{ props.coverImg }</span>
	</div>
  );
};
