<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/inc/config.inc';

use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

// Init PHP Sessions
session_start();

$fb = new Facebook([
  'app_id' => '525243791549096',
  'app_secret' => '57bcb17d93cca10a5e600c0558aacfbf',
  'default_graph_version' => 'v4.0',
]);

$helper = $fb->getRedirectLoginHelper();

if (!isset($_SESSION['facebook_access_token'])) {
  $_SESSION['facebook_access_token'] = null;
}

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

// Program to display URL of current page. 
  
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
    $link = "https"; 
else
    $link = "http"; 
  
// Here append the common URL characters. 
$link .= "://"; 
  
// Append the host(domain name, ip) to the URL. 
$link .= $_SERVER['HTTP_HOST']; 

if ($_SESSION['facebook_access_token']) {
  echo "You are logged in!";
} else {
  $permissions = ['ads_management', 'ads_read', 'manage_pages', 'read_insights'];
  $loginUrl = $helper->getLoginUrl($link . '/fbappdemomkt', $permissions);
  echo '<a href="' . $loginUrl . '">Log in with Facebook</a>';
}
?>