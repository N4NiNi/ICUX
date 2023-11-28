<?php
use \Laudis\Neo4j\DriverFactory;
use \Laudis\Neo4j\Authentication\Authenticate;

$auth = Authenticate::basic('neo4j', 'test');

$boltDriver = DriverFactory::create('bolt://neo4j:test@localhost');
$neo4jDriver = DriverFactory::create('neo4j://core1:7777', null, $auth);
$httpDriver = DriverFactory::create('https://localhost:7473');

?>