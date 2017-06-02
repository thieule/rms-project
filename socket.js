var app = require('http').createServer(handler);
var io = require('socket.io')(app);

var Redis = require('ioredis');
var redis = new Redis();

app.listen(6001, function() {
    console.log('Server is running!');
});
function handler(req, res) {
    res.writeHead(200);
    res.end('');
}
io.on('connection', function(socket) {
//
    console.log('New Connection!');

});
io.on('disconnect',function(socket){
    console.log('Connection Dropped!');
});

redis.psubscribe('*', function(err, count) {
//
});
redis.on('pmessage', function(subscribed, channel, message) {
    console.log(channel);
    console.log(message);
    message = JSON.parse(message);
    io.emit(channel, message.data);
});