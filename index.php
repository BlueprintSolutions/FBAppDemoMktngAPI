<?php
require_once __DIR__ . '/vendor/autoload.php';
include __DIR__ . '/inc/config.inc';

// Add to header of your file
use FacebookAds\Api;
//use FacebookAds\Object\AdUser;

session_start();

if (!isset($_GET["code"])) {
	header("Location: access.php");
} else {
	$code = $_GET["code"];
	echo('<strong>CODE</strong>: ' . $code . '<BR>');	
	
	echo '<strong>CLIENT ID</strong>: ' . $_SESSION['config']['app_id'];
	echo "<br>";
	echo '<strong>REDIRECT URI</strong>: ' . $_SESSION['config']['login_url'];
	echo "<br>";
	echo '<strong>CLIENT SECRET</strong>: ' . $_SESSION['config']['app_secret'];
	echo "<br>";
}



// Add after echo "You are logged in "

// Initialize a new Session and instantiate an API object
Api::init(
  $_SESSION['config']['app_id'], // App ID
  $_SESSION['config']['app_secret'],
  $_SESSION['facebook_access_token'] // Your user access token
);

print_r($_SESSION['facebook_access_token']);

// Add after Api::init()
//$me = new AdUser('me');
//$my_adaccount = $me->getAdAccounts()->current();

//print_r($my_adaccount->getData());
?>