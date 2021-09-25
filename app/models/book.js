//mongod --dbpath=\data

const db = require('./db')

module.exports = new (class {
    constructor() {
        this.db = db.fetchDbConn('books')
    }

    async _init() {
        this.db = await this.db
    }

    async getBookFromId(id) {
        await this._init()
        const entry = await this.db.findOne({ '_id': db.ObjectId(id) })
        return entry || null
    }

    async insert(book) {
        await this._init()
        if(book) {
            const ack = await this.db.insertOne({
                'name': String(book.name),
                'author': String(book.author),
                'price': Number(book.price),
                'image': String(book.image),
            })
            return ack.acknowledged ? ack.insertedId.toString() : null
        } else {
            return null
        }
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
