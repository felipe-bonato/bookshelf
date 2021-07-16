const express = require('express');
const app = express();

app.set('views', __dirname + '/views');
app.set('view engine', 'jsx');
app.engine('jsx', require('express-react-views').createEngine());

app.use(express.static('public'));

app.get('/', require('./routes').index);

app.listen(8080, () => console.log('Server started!'));