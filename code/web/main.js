function connect() {
    centrifuge.connect();
}

function disconnect() {
    centrifuge.disconnect();
}

function send() {
    subscription.publish({"messageCount": 1}).then(function () {
        // success ack from Centrifugo received
    }, function (err) {
        console.log(err);
    });
}
