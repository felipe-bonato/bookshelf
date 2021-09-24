var React = require('react');
var Base    = require('../layouts/default');
var Book    = require('./book');

module.exports = function Home(props) {
  return (
    <Base title="Home">
      <div>Hey { props.name }, i'm home</div>
      <div>{ props.books.map((book, idx) => <Book title={ book.title } author={ book.author } coverImg={ book.coverImg } key={ idx }/> ) }</div>
    </Base>
  );
};