<?php

require_once 'vendor/autoload.php';

$client = new \Dykyi\Client\CentrifugoClient('http://192.168.1.140:8000', 'my-api-key');
$client->publish('public', ['messageCount' => 1]);

echo 'Send from PHP';
