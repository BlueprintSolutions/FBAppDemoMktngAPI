<?php
require_once __DIR__ . '/inc/global.inc.php';

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

// Init PHP Sessions
session_start();

//echo '<strong>ACCESS TOKEN</strong>: ' . $_SESSION['facebook_access_token'];
//echo "<br>";

if (!isset($_SESSION['facebook_access_token'])) {
	$_SESSION['facebook_access_token'] = null;
	$_SESSION['config'] = config();
}

$fb = new Facebook([
  'app_id' => $_SESSION['config']['app_id'],
  'app_secret' => $_SESSION['config']['app_secret'],
  'default_graph_version' => $_SESSION['config']['default_graph_version'],
]);

$helper = $fb->getRedirectLoginHelper();

if (!$_SESSION['facebook_access_token']) {
  $helper = $fb->getRedirectLoginHelper();
  try {
    $_SESSION['facebook_access_token'] = (string) $helper->getAccessToken();
  } catch(FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
}

if ($_SESSION['facebook_access_token']) {
	//echo "You are logged in!";
	header("Location: index.php?message=You are logged in");
} else {
  $permissions = ['ads_management', 'ads_read', 'manage_pages', 'read_insights'];
  $loginUrl = $helper->getLoginUrl($_SESSION['config']['login_url'], $permissions);
  echo '<a href="' . $loginUrl . '">Log in with Facebook</a>';
}

?>