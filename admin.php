<?php
//FB sdk
require 'facebook.php';

// Provides access to app specific values such as your app id and app secret.
require_once('AppInfo.php');

require_once('MongoHelper.php');

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => AppInfo::appID(),
  'secret' => AppInfo::appSecret(),
));

// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

$collection = MongoHelper::getCollection('users');

// query to see if a records in the 'users' collection matches the current users id
$query = array( "id" => $user_profile['id'] );
$cursor = $collection->find( $query );

$user_exists = 0;
while( $cursor->hasNext() ) {
    var_dump( $cursor->getNext() );
    $user_exists = 1;
    echo "user " .$user_profile['id']. " exists in mongo";
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
  $friends = $facebook->api('/me/friends');
} else {
  $loginUrl = $facebook->getLoginUrl();
}

// This call will always work since we are fetching public data.
$naitik = $facebook->api('/naitik');
?>


<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>Nathaniel Show Admin Page</title>
  </head>

  <body>
    <h1>Admin Page</h1>

    <?php if ($user): ?>
      <a href="<?php echo $logoutUrl; ?>">Logout</a>
    <?php else: ?>
      <div>
        Login using OAuth 2.0 handled by the PHP SDK:
        <a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
      </div>
    <?php endif ?>

    <h3>PHP Session</h3>
    <pre><?php print_r($_SESSION); ?></pre>

    <?php if ($user): ?>
      <h3>You</h3>
      <img src="https://graph.facebook.com/<?php echo $user; ?>/picture">

      <h3>Your User Object (/me)</h3>
      <pre><?php print_r($user_profile); ?></pre>
    <?php else: ?>
      <strong><em>You are not Connected.</em></strong>
    <?php endif ?>
    
    <?php
    if ($user):
      $data = $friends['data'];
      echo count($data) . ' Friends';
      echo '<hr />';
      echo '<ul id="friends">';
      foreach ($data as $key=>$value) {
        echo '<li><img src="https://graph.facebook.com/' . $value['id'] . '/picture" title="' . $value['name'] . '"/></li>';
      }
      echo '</ul>';
    endif
    ?>

    <h3>Public profile of Naitik</h3>
    <img src="https://graph.facebook.com/naitik/picture">
    <?php echo $naitik['name']; ?>
  </body>
</html>