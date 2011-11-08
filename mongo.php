<?php
  # get the mongo db name out of the env
  $mongo_url = parse_url(getenv("MONGOLAB_URI"));
  $dbname = str_replace("/", "", $mongo_url["path"]);

  # connect
  $m   = new Mongo(getenv("MONGOLAB_URI"));
  $db  = $m->$dbname;
  $col = $db->access;

  echo "<li> DB name " . $db . "</li>";
  
  # insert a document
  $visit = array( "ip" => $_SERVER["HTTP_X_FORWARDED_FOR"] );
  $col->insert($visit);

  # print all existing documents
  $data = $col->find();
  foreach($data as $visit) {
    echo "<li>" . $visit["ip"] . "</li>";
  }

  # disconnect
  $m->close();
?>