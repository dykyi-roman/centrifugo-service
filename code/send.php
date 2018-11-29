<?php

require_once 'vendor/autoload.php';

$client = new \Dykyi\Client\CentrifugoClient('http://localhost:8000','');
$client->publish('public', ['messageCount' => 1]);
?>

<html>
<title>Centrifugal PHP</title>
<body>
<form method="POST">
    <input type="submit" value="Send from PHP">
</form>
</body>
</html>
