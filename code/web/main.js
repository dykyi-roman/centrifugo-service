// var centrifuge = new Centrifuge('http://localhost:8000/connection/websocket', {
var centrifuge = new Centrifuge('http://localhost:8000/connection/sockjs');
console.log(signature);
centrifuge.setToken(signature);

centrifuge.subscribe('public', function (message) {
    console.log(message);
});
centrifuge.connect();

console.log(centrifuge.isConnected()); // false
console.log(centrifuge.lastError, centrifuge.error); // undefined
