var React = require('react');
var Base    = require('../layouts/default');
var Book    = require('./book');

module.exports = function Home(props) {
  return (
    <Base title={ props.tab_title } color_scheme={ props.color_scheme }>
      <div>Hey { props.name }, i'm home</div>
      <div>{ props.books.map((book, idx) => <Book title={ book.title } author={ book.author } cover_img={ book.cover_img } key={ idx }/> ) }</div>
    </Base>
  );
};
