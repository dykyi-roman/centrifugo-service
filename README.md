# Centrifugo service

![image](https://github.com/dykyi-roman/centrifugo-service/blob/master/docs/image.png)

Centrifugo this is a real-time messaging server and its friends. Centrifugal organization provides a set of tools to add real-time features to your web/mobile/desktop application. It brings together several repositories linked by a common purpose – give you a complete and ready to use solution when you want to add real-time events into your application.

This is a documentation for Centrifugo v1 - see its [documentation](https://centrifugal.github.io/centrifugo/) and [full documentation](https://fzambia.gitbooks.io/centrifugal/content/index.html)  
Current version of Centrifugo is v2 - see its [documentation](https://github.com/oleh-ozimok/php-centrifugo)  
My view of this documentation - [note](https://github.com/dykyi-roman/centrifugo-service/blob/master/docs/my_note.md)

# Server

The server runs in the docker container. To start it you need run next command:

* `sudo docker-compose up`
* open in your browser [localhost:8000](http://localhost:8000)

### Configuration

     - CENTRIFUGO_SECRET=my-secret-token
     - CENTRIFUGO_ADMIN_PASSWORD=admin
     - CENTRIFUGO_ADMIN_SECRET=admin

OR use a [container](https://hub.docker.com/r/centrifugo/centrifugo/) form the officially website.


# JWT 

Script for generate JWT token:

* [jwt](https://jwt.io/)
* [codepen.io](https://codepen.io/anon/pen/BGRmye)

# SSL

You may have a SSL [certificate issue](https://stackoverflow.com/questions/29891619/intermittent-err-ssl-protocol-error-error-for-cross-domain-request/29996698#29996698). The connection point rule can be summarized as:

* `wss` connects on `https only`

* `ws` connects `on http`


# JS Client

```
var centrifuge = new Centrifuge('ws://localhost:8000/connection/websocket');
centrifuge.subscribe('public', function (message) { 
    console.log(message); 
}); 
centrifuge.connect(); 
```

After success connect to centrifuge you will be see:

![image](https://github.com/dykyi-roman/centrifugo-service/blob/master/docs/example.png)

In order have a more detail [read](https://github.com/centrifugal/centrifuge-js) 

# PHP Client

```
$client = new \phpcent\Client("http://localhost:8000");
$client->setSecret("secret key from Centrifugo");
$client->publish("public", ["message" => "Hello!"]);
$history = $client->history("public");
```

In order have a more detail [read](https://github.com/centrifugal/phpcent) 

## Author
[Dykyi Roman](https://www.linkedin.com/in/roman-dykyi-43428543/), e-mail: [mr.dukuy@gmail.com](mailto:mr.dukuy@gmail.com)
