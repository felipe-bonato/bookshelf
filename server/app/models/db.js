//mongod --dbpath=\data

const fs = require('fs/promises')
const mongodb = require('mongodb')

exports.ObjectId = mongodb.ObjectId

exports.fetchDbConn = async (collection, configFilePath='config/dbConfig.json') => {
	const config = await getDbConfig(configFilePath)
	const conn = await mongodb.MongoClient.connect(config.url)
	return conn.db(config.name).collection(collection)
}

async function getDbConfig(path){
	const configFile = await fs.readFile(path)
	return JSON.parse(configFile)
}
