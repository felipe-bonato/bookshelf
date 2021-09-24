const express = require('express')
const routes = require('./app/routes')
const express_react_views = require('express-react-views')

const app = express()

app.set('views', __dirname + '/app/views')
app.set('view engine', 'jsx')
app.engine('jsx', express_react_views.createEngine())

app.use(express.static('public'))
app.use(express.urlencoded({ extended: true }))

app.get(['/', '/home'], routes.home) // Random sortment of books to buy
app.get('/sell', routes.sell) // Page with a camera app so you can sell
app.get('/book', routes.book) // Page with book details, and a button to buy
app.get('/search', routes.search) // Results from query
app.get('/login', routes.login) // Login page
app.get('/logout', routes.logout) // Results from query
app.get('/register', routes.register) // Registration page

app.post('/api/register', routes.api.register)

app.listen(8080, () => console.log('[SETUP] Server started'))
