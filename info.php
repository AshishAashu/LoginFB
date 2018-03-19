<?php

if(!session_id()) {
    session_start();
}
require_once 'Facebook/autoload.php';
$fb = new Facebook\Facebook([
  'app_id' => '351276868705190', // Replace {app-id} with your app id
  'app_secret' => '157afe86fd8ec31e75bd39f5f1c46124',
  'default_graph_version' => 'v2.2',
  ]);

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,first_name,middle_name,last_name,birthday,address,email', $_SESSION['fb_access_token']);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();

echo 'id: ' . $user['id'] ."<br>";
echo 'First Name: ' . $user['first_name'] ."<br>";
echo 'Last Name: ' . $user['last_name'] ."<br>";
echo 'Middle Name: ' . $user['middle_name'] ."<br>";
echo 'email: ' . $user['email'] ."<br>";


// OR
// echo 'Name: ' . $user->getName();
?>