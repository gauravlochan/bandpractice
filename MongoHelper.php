<?php

/**
 * This class provides helper methods around Mongo
 */
class MongoHelper {

  /**
   * @return the mongo URI for this app
   */
  public static function mongoUrl() {
    return parse_url(getenv("MONGOLAB_URI"));
  }

  /**
   * @return the mongo connection
   */
  public static function getConn() {
    # connect
    return new Mongo(getenv("MONGOLAB_URI"));
  }


  public static function disconn($m) {
    $m->close();
  }
  

  /**
   * @return the db
   */
  public static function getDb () {
    $mongo_url = MongoHelper::mongoUrl();
    $dbname = str_replace("/", "", $mongo_url["path"]);

    $m = MongoHelper::getConn();
    return $m->$dbname;
  }



  public static function getCollection($name) {
    $db = MongoHelper::getDb();
    return $db->$name;
  }



  public static function printCollection($name) {
    $col = MongoHelper::getCollection($name);

    # print all existing documents
    $data = $col->find();
    foreach($data as $visit) {
      echo "<li>" . $visit["ip"] . "</li>";
    }
  }
}

?>
