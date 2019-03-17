<?php
include_once '../bootstrap.php';

use Elasticsearch\ClientBuilder;
use jdlc\citest\elasticsearch\Index;

$client = ClientBuilder::create()->build();
$index = new Index("old_database");
$response = $client->indices()->create($index->getCreateParams());
print_r($response);