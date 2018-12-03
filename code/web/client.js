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
    var messageObj = $('.messageCount');
    var count = parseInt(messageObj.data('count')) + message.data.messageCount;

    messageObj.data('count', count);
    messageObj.html('messageCount: ' + count);
});