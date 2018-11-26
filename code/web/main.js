const centrifuge = new Centrifuge('ws://localhost:8000/connection/websocket');
centrifuge.setToken($('.token').data('token'));

centrifuge.on('connect', function () {
    $('.status').html('Connect: ' + centrifuge.isConnected());
});

centrifuge.on('disconnect', function (context) {
    console.log(context);
    $('.status').html('Connect: ' + centrifuge.isConnected());
});

centrifuge.on('error', function (e) {
    console.log(e);
});

var subscription = centrifuge.subscribe("public", function (message) {
    console.log(message)
});

function connect() {
    centrifuge.connect();
}

function disconnect() {
    centrifuge.disconnect();
}

function send() {
    subscription.publish({"input": "hello!"}).then(function() {
        // success ack from Centrifugo received
    }, function(err) {
        console.log(err);
    });
}
