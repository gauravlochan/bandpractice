<?php

/**
 * This class provides helper methods around Mongo
 */
class MongoDb {

  /*****************************************************************************
   *
   * These functions provide the unique identifiers that your app users.  These
   * have been pre-populated for you, but you may need to change them at some
   * point.  They are currently being stored in 'Environment Variables'.  To
   * learn more about these, visit
   *   'http://php.net/manual/en/function.getenv.php'
   *
   ****************************************************************************/

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
    $mongo_url = mongoUrl();
    $dbname = str_replace("/", "", $mongo_url["path"]);

    $m = getConn();
    return $m->$dbname;
  }

  public static function getCollection($name) {
    $db = getDb();
    return $db->$name;
  }

  public static function printCollection($name) {
    $col = getCollection($name);

    # print all existing documents
    $data = $col->find();
    foreach($data as $visit) {
      echo "<li>" . $visit["ip"] . "</li>";
    }

}

?>
