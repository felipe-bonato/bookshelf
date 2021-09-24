const dbUser = require('../../models/user')

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