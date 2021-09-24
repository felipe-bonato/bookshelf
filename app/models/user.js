//mongod --dbpath=\data

const db = require('./db')

module.exports = new (class {
    constructor() {
        this.db = db.fetchDbConn('users')
    }

    async _init() {
        this.db = await this.db
    }

    async getPasswordFromEmail(email) {
        await this._init()
        const entry = await this.db.findOne({ 'email': email })
        return entry ? entry['password'] : null
    }

    async insert(email, password) {
        await this._init()
        this.db.insertOne({
            'email': String(email),
            'password': String(password),
        })
    }

    async getAll() {
        await this._init()
        return this.db.find({}).toArray()
    }

    async deleteAll() {
        await this._init()
        this.db.deleteMany({})
    }
})


//exports.user = new User()
