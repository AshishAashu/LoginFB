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

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/LoginFB/fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
?>