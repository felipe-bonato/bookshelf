const express = require('express')
const session = require('express-session')
const express_react_views = require('express-react-views')
const routes = require('./app/routes')
const utils = require('./app/util')

const app = express()

app.set('views', __dirname + '/app/views')
app.set('view engine', 'jsx')
app.engine('jsx', express_react_views.createEngine())

app.use(express.static('public'))
app.use(express.urlencoded({ extended: true })) // To allow post method
app.use(session({
    'secret': 'BvC$xHi%LWDG8KC',
    'resave': true,
    'saveUninitialized': true,
}))

// Logs connections
app.use((req, res, next) => {
    utils.logConnection(req)
    next()
})

// Checks if user is logged in
app.use((req, res, next) => {
    //console.log(req.session)
    if(
        req.session['user']
        || utils.getReqUrlPath(req) === '/login'
        || utils.getReqUrlPath(req) === '/api/login'
        || utils.getReqUrlPath(req) === '/register'
        || utils.getReqUrlPath(req) === '/api/register'
    ){
        next()
    } else {
        res.redirect('/login')
    }
})

app.get(['/', '/home'], routes.home) // Random sortment of books to buy
app.get('/sell', routes.sell) // Page with a camera app so you can sell
app.get('/book', routes.book) // Page with book details, and a button to buy
app.get('/search', routes.search) // Results from query
app.get('/login', routes.login) // Login page
app.get('/logout', routes.logout) // Results from query
app.get('/register', routes.register) // Registration page

app.get('/api/logout', routes.api.logout)
app.post('/api/register', routes.api.register)
//app.post('/api/login', routes.api.login)
app.post('/api/login', routes.api.login)

app.get('/admin/users', routes.admin.users)

app.listen(8080, () => console.log('[SETUP] Server started'))
