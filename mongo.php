<?php

$mongo_uri = getenv('MONGOLAB_URI');
$m = new Mongo(); // connect
$db = $m->selectDB("example");

?>