<?php
include_once '../bootstrap.php';

use Elasticsearch\ClientBuilder;
use jdlc\citest\elasticsearch\Searcher;

$client = ClientBuilder::create()->build();
$searcher = new Searcher("old_database", "old_table");
$searchParams = $searcher->getSearchInBodyParams("español", "paz");

$response = $client->search($searchParams);
print_r($response);