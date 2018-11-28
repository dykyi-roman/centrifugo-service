<?php

require_once 'vendor/autoload.php';

$client = new \Dykyi\Client\CentrifugoClient('http://192.168.1.140:8000','');
$client->publish('public', ['messageCount' => 1]);
?>

<html>
<body>
<form action="/" method="POST">
    <input type="submit" value="Send">
</form>
</body>
</html>