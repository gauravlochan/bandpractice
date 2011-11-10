<?php
  # get the mongo db name out of the env
  $mongo_url = parse_url(getenv("MONGOLAB_URI"));
  $dbname = str_replace("/", "", $mongo_url["path"]);

  # connect
  $m   = new Mongo(getenv("MONGOLAB_URI"));
  $db  = $m->$dbname;
  $col = $db->users;

  echo "<li> DB name " . $db . "</li>";
  
  # print all existing documents
  $data = $col->find();
  foreach($data as $visit) {
    echo "<li>" . $visit["id"] . "</li>";
  }

  # disconnect
  $m->close(); 	
?>