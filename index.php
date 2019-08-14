<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/inc/config.inc';

// Add to header of your file
use FacebookAds\Api;
//use FacebookAds\Object\AdUser;

session_start();

if (!isset($_GET["code"])) {
	header("Location: access.php");
} else {
	$code = $_GET["code"];
	echo('<strong>CODE</strong>: ' . $code . '<BR>');	
	
	echo 'REQUEST_URI: ' . $_SERVER['REQUEST_URI'];
	echo "<br>";
	echo 'PHP_SELF: ' . $_SERVER['PHP_SELF'];
	echo "<br>";
	echo 'SERVER_NAME: ' . $_SERVER['SERVER_NAME'];
	echo "<br>";
	echo 'HTTP_HOST: ' . $_SERVER['HTTP_HOST'];
	echo "<br>";
	echo 'HTTP_REFERER: ' . $_SERVER['HTTP_REFERER'];
	echo "<br>";
	echo 'HTTP_USER_AGENT: ' . $_SERVER['HTTP_USER_AGENT'];
	echo "<br>";
	echo 'SCRIPT_NAME: ' . $_SERVER['SCRIPT_NAME'];
	
	echo "<br>";
	echo "<br>";
	$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
	echo $url;
}



// Add after echo "You are logged in "

// Initialize a new Session and instantiate an API object
Api::init(
  '525243791549096', // App ID
  '57bcb17d93cca10a5e600c0558aacfbf',
  $_SESSION['facebook_access_token'] // Your user access token
);

print_r($_SESSION['facebook_access_token']);

// Add after Api::init()
//$me = new AdUser('me');
//$my_adaccount = $me->getAdAccounts()->current();

//print_r($my_adaccount->getData());
?>