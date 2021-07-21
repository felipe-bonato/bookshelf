var React = require('react');

module.exports = function MainCon(props) {
	return (
		<main class="s-main-con">
			{ props.children }
		</main>
	);
}
