<?php
include_once '../bootstrap.php';

use Elasticsearch\ClientBuilder;


$client = ClientBuilder::create()->build();

$params = [
    "body" => [
        "english" => "I come in peace",
        "spanish" => "Vengo en son de paz",
        "klingon" => "qo' vIvan!"
    ],
    "index" => "old_database",
    "type" => "old_table",
    "id" => "1"
];

$result = $client->index($params);

var_dump($result);