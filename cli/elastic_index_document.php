<?php
include_once '../bootstrap.php';

use Elasticsearch\ClientBuilder;
use jdlc\citest\elasticsearch\Document;
use jdlc\citest\model\Definition;


$client = ClientBuilder::create()->build();
$document = new Document("old_database", "old_table", "I come in peace");
$definition = new Definition("I come in peace", [
        Definition::ESPANOL => "Vengo en son de paz",
        Definition::KLINGON => "qo' vIvan!"
    ]);
$document->setBody($definition->export());

$result = $client->index($document->export());
var_dump($result);
