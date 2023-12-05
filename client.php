<?php

require_once 'vendor/autoload.php';

use Bolt\Bolt;
use Bolt\helpers\Auth;

// Create connection class and specify target host and port

$conn = new \Bolt\connection\Socket('neo4j', 7687);

// Create new Bolt instance and provide connection object

$bolt = new \Bolt\Bolt($conn);

// Build and get protocol version instance which creates connection and executes handshake

$protocol = $bolt->build();

// Login to database with credentials

$protocol->hello(\Bolt\helpers\Auth::basic('neo4j', '12345678'));

// Execute query with parameters

$stats = $protocol->run('MATCH path = (:Question {questionNumber: 1}) -[:Answer*]-> ()
WITH collect(path) as paths
CALL apoc.convert.toTree(paths) yield value
RETURN value;');

// Pull records from last executed query

$rows = $protocol->pull();


foreach ($protocol->getResponses() as $response) {
    if ($response->getSignature() == \Bolt\protocol\Response::SIGNATURE_RECORD) {
      $neo4j = $response->getContent()[0];
      //$resp = var_dump($neo4j);
    }
}

$string = var_export($neo4j, true);
echo $string;
$json = json_encode($string, JSON_UNESCAPED_UNICODE);
echo $json;

//var_dump($rows);
//var_dump($stats);