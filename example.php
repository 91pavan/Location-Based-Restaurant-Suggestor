<?php
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */
error_reporting(NULL);
require 'src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '199946840078173',
  'secret' => 'ccf21a59eb7ba60187994a6390ce2472',
));
session_start();
// Get User ID
$user = $facebook->getUser();
$user_profile="";
// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me?fields=name,email,picture');
    $_SESSION['fbid'] = $user_profile['id'];
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl(array(
   'scope' => 'email, user_activities '
 ));
}
$fbid = $user_profile['id'];
$result = mysql_query("select * from users where fbid = '$fbid'");

if(mysql_num_rows($result)==0)
{
// This call will always work since we are fetching public data.
if($user_profile)
{
$link = mysql_connect('localhost', 'takeijok_ayana', 'root123'); //changet the configuration in required
	if (!$link) {
    die('Could not connect: ' . mysql_error());
	}
	mysql_select_db('takeijok_Ayana');

$name = $user_profile['name'];
$email = $user_profile['email'];
$photo = $user_profile['picture'];


$query = "insert into users(fbid,name,email,photo) values ($fbid, '$name', '$email', '$photo');";
mysql_query($query) or die(mysql_error());

$user_profile1=$facebook->api('me/friends');

/*if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me/friends');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl();
}


$db = mysql_connect('localhost','root','');
mysql_select_db('ayana');
$fbid = $user_profile['id'];
$name = $user_profile['name'];
$email = $user_profile['email'];
$photo = $user_profile['picture'];
*/
echo "------------------";
$query = "select fbid from users";
$result = mysql_query($query) or die(mysql_error());
while($row = mysql_fetch_array($result))
{
    for($i=0;$i<sizeof($user_profile1['data']);$i++)
        if($row['fbid'] == $user_profile1['data'][$i]['id'])
           $friends = $friends.$row['fbid'].",";
}
echo $friends;
$query2 = "update users set friends = '$friends' where fbid = '$fbid'";

mysql_query($query2) or die(mysql_error());


?>
<a href="form.html">Redirect man!</a>

<?php

}
}
else
{
    ?>
	<a href="done.html">Done</a>
	<?php
}


?>


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
