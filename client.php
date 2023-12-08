<?php

require_once 'vendor/autoload.php';

use Bolt\Bolt;
use Bolt\helpers\Auth;

// Create connection class and specify target host and port

$conn = new \Bolt\connection\StreamSocket('<URI DO AURA DB: EX: 349654a8.databases.neo4j.io');
// enable SSL
$conn->setSslContextOptions([
    'verify_peer' => true
]);

// Create new Bolt instance and provide connection object

$bolt = new \Bolt\Bolt($conn);

// Build and get protocol version instance which creates connection and executes handshake

$protocol = $bolt->build();

// Login to database with credentials

$protocol->hello(\Bolt\helpers\Auth::basic('neo4j', '<SUA SENHA AQUI>'));

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
      $json = json_encode($neo4j, JSON_UNESCAPED_UNICODE);
      echo $json;
    }
}

//var_dump($rows);
//var_dump($stats);