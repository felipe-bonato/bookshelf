
exports.getReqUrlPath = req => req.client.parser.incoming.originalUrl
exports.getReqAddress = req => req.connection.remoteAddress
exports.getReqPorts = req => req.connection.remotePort
exports.logConnection = req => console.log(`[INFO] User connected on ${this.getReqUrlPath(req)} from ${this.getReqAddress(req)}:${this.getReqPorts(req)}`)
