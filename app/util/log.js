exports.logConnection = req => console.log('[INFO] User connected on `' + req.client.parser.incoming.originalUrl + '` from ' + req.connection.remoteAddress + ':' + req.connection.remotePort)
