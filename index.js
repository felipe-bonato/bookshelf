const express = require('express');
const routes = require('./app/routes');
const express_react_views = require('express-react-views');

const app = express();

app.set('views', __dirname + '/app/views');
app.set('view engine', 'jsx');
app.engine('jsx', express_react_views.createEngine());

app.use(express.static('public'));

app.get('/', require('./app/routes').index);
app.get(['/', '/home'], routes.home); // Random sortment of books to buy

app.listen(8080, () => console.log('[SETUP] Server started'));
