var MCP9808_1 = new require('./x18.js');
var MCP9808_2 = new require('./x19.js');

var http = require('http'),
    fs = require('fs'),
    index = fs.readFileSync(__dirname + '/index.html');

var app = http.createServer(function(req, res) {
    res.writeHead(200, {'Content-Type': 'text/html'});
    res.end(index);
});

var io = require('socket.io').listen(app);

MCP9808_1.Initialize(function() {});

MCP9808_2.Initialize(function() {});

function sendData() {
   //io.emit('time', { time: new Date().toJSON() });
   //console.log( new Date().toJSON() );
	var temp1 = MCP9808_1.AmbientTemperature(function(error,data) {
	  if (data != undefined) {
	    console.log(data.toFixed(2));
	    io.emit('temp1', { temp1: data.toFixed(2) });
	  } else {
	    console.log("error sensor 1");
	    io.emit('temp1', { temp1: "--.--" });
	  }		
	});
	var temp2 = MCP9808_2.AmbientTemperature(function(error,data) {
	  if (data != undefined) {
	    console.log(data.toFixed(2));
	    io.emit('temp2', { temp2: data.toFixed(2) });
	  } else {
	    console.log("error sensor 2");
	    io.emit('temp2', { temp2: "--.--" });
	  }		
	});
}

setInterval(sendData, 10000);

io.on('connection', function(socket) {
    socket.emit('welcome', { message: 'Welcome!', id: socket.id });
    socket.on('client', console.log);
});

app.listen(3001);