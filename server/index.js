const express = require('express')
//const session = require('express-session')
const fileUpload = require('express-fileupload')

const routes = require('./app/routes')
const utils = require('./app/util')

const app = express()

app.use(express.static('public'))

// Form file uploads
app.use(fileUpload())
app.use(express.urlencoded({ extended: true })) // To allow post method

/*
// Sessions
app.set('trust proxy', 1) // Nedded for cookies
app.use(session({
    'secret': 'BvC$xHi%LWDG8KC',
    'resave': true,
    'saveUninitialized': true,
}))
*/

// Logs connections
app.use((req, res, next) => {
    utils.logConnection(req)
    next()
})

// For allowing the api to work
app.use(function (req, res, next) {
    res.setHeader('Access-Control-Allow-Origin', 'http://localhost:8001') // Website you wish to allow to connect
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE') // Request methods you wish to allow
    res.setHeader('Access-Control-Allow-Headers', 'X-Requested-With,content-type') // Request headers you wish to allow
    res.setHeader('Access-Control-Allow-Credentials', true) // Set to true if you need the website to include cookies in the requests sent to the API (e.g. in case you use sessions)
    next();
});

/*
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
*/

app.get('/api/home', routes.home)

/*
app.get(['/', '/home'], routes.home) // Random sortment of books to buy
app.get('/sell', routes.sell) // Page with a camera app so you can sell
app.get('/search', routes.search) // Results from query
app.get('/login', routes.login) // Login page
app.get('/profile', routes.profile) // User profile
app.get('/register', routes.register) // Registration page

app.get('/book/:bookId', routes.book) // Page with book details, and a button to buy

app.get('/api/logout', routes.api.logout)
app.post('/api/register', routes.api.register)
app.post('/api/login', routes.api.login)
app.post('/api/sell', routes.api.sell)
*/
// app.get('/admin/users', routes.admin.users)

app.listen(8080, () => console.log('[SETUP] Server started'))
