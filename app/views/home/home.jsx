var React = require('react');
var Base    = require('./../layouts/default');
var MainCon = require('./../layouts/main_c');
var Book    = require('./book');

module.exports = function Home(props) {
  return (
    <Base title={props.title} color_scheme={ props.color_scheme }>
      <MainCon>
		<div>Hey {props.name}, i'm home</div>
		<div>{ props.books.map(book => <Book title={ book.title } author={ book.author } cover_img={ book.cover_img }/> ) }</div>
      </MainCon>
    </Base>
  );
};
