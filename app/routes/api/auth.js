const dbUser = require('../../models/user')

exports.login = async (req, res) => {
    const user = req.body
    const correctPassword = await dbUser.getPasswordFromEmail(user.email)

    console.log(`[INFO][api/auth/login]${user.password} == ${correctPassword} ? ${user.password === correctPassword}`)
    if(user.password === correctPassword) {
        req.session['user'] = user.email
    }

    res.redirect('/')
}

exports.logout = (req, res) => {
    req.session.destroy()
    res.redirect('/login')
}

exports.register = (req, res) => {
    // Validates data
    const user = req.body
    if(!isValidEmail(user.email) || !isValidPassword(user.password, user.confirmPassword)){
        res.redirect('/register') /** Error envalid password **/
        return
    }
    
    dbUser.insert(user.email, user.password) /** Error could not inser user **/

    res.redirect('/login')
}

function isValidEmail(email) {
    const re = RegExp(/\S+@\S+\.\S+/)
    return re.test(email)
}

function isValidPassword(pass, passConfimation) {
    return pass === passConfimation
}
