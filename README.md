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

# JS Client

`to be continue...`

# PHP Client

`to be continue...`

## Author
[Dykyi Roman](https://www.linkedin.com/in/roman-dykyi-43428543/), e-mail: [mr.dukuy@gmail.com](mailto:mr.dukuy@gmail.com)
