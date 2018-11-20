# My Note
Centrifugo is a language-agnostic real-time messaging server. Language-agnostic means that it does not matter which programming language your application uses on frontend or backend sides - Centrifugo can work in conjunction with any. There are several main transports Centrifugo supports at moment: Websocket (JSON or binary Protobuf) SockJS (library that tries to establish Websocket connection first and then falls back to HTTP transports automatically in case of problems with Websocket connection)

Centrifugo server is written in Go language. It's an open-source software, the source code is available on Github. Centrifugo is built around centrifuge library for Go language.


# Common Commands:
`centrifugo -h        		        = help information for Centrifugo` 

`centrifugo genconfig 		        = requires configuration file with secret key` 

`centrifugo --config=config.json         = run Centrifugo instance` 

`centrifugo --config=config.json --admin = use insecure admin mode` 

`centrifugo --admin --admin_insecure     = use insecure admin mode – no auth required for admin socket` 


Read: https://centrifugal.github.io/centrifugo/server/admin/#admin-web-interface

# Simple run:

centrifugo genconfig

centrifugo --config=config.json --admin

And then open http://localhost:8000/ in browser.

Read: https://github.com/centrifugal/web

It generates secret key automatically and creates configuration file config.json in current directory. Centrifugo expects JSON, TOML or YAML as format of configuration file.
Read more detail about config params: https://centrifugal.github.io/centrifugo/server/configuration/

# Channel

Channel - is a route for publication messages. Clients can subscribe to channel to receive events related to this channel – new publications, join/leave events etc. Also client must be subscribed on channel to get channel presence or history information. Follow to channel name rules. Read: https://centrifugal.github.io/centrifugo/server/channels/#channel-name-rules

# Authentication

Authentication - When you are using centrifuge library from Go language you can implement any user authentication using middleware. At moment the only supported JWT algorithm is HS256 - i.e. HMAC SHA-256. This can be extended later. Centrifugo uses the following claims in JWT: sub, exp, info and b64info.

# Engines

Engines - By default Centrifugo uses Memory engine. There is also Redis engine available. The difference between them - with Memory engine you can start only one node of Centrifugo, while Redis engine allows to run several nodes on different machines and they will be connected via Redis

# API

Server API works on /api endpoint. It's very simple to use: you just have to send POST request with JSON command to this endpoint.
This API key must be set in request Authorization header. Example: Authorization: apikey <KEY>. It's possible to disable API key check on Centrifugo side using api_insecure configuration option. Read: https://centrifugal.github.io/centrifugo/server/api/

# Message recovery
One of the most interesting features of Centrifugo is message recovery after short network disconnects. This mechanism allows client to automatically get missed message on successful resubscribe to channel after being disconnected for a while. To enable recovery mechanism for channels set history_recover boolean configuration option to true on configuration top level or for channel namespace.
