<?php
include_once '../bootstrap.php';

use Elasticsearch\ClientBuilder;
use jdlc\citest\elasticsearch\Document;
use jdlc\citest\elasticsearch\Response;

$client = ClientBuilder::create()->build();
$document = new Document("old_database", "old_table", "I come in peace");
$response = new Response($client->get($document->getter()));
print_r($response->getId()."\n");
print_r($response->getSource());