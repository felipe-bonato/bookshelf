//mongod --dbpath=\data

const db = require('./db')

exports.User = class User {
    constructor() {
        this.db = db.fetchDbConn('users')
    }

    async _init() {
        this.db = await this.db
    }

    async getPasswordFromEmail(email) {
        await this._init()
        const entry = await this.db.findOne({ 'email': email })
        return entry.password
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
}