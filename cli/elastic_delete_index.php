<?php
include_once '../bootstrap.php';

use Elasticsearch\ClientBuilder;


$client = ClientBuilder::create()->build();
$response = $client->indices()->delete([
    'index' => 'old_database'
]);
print_r($response);