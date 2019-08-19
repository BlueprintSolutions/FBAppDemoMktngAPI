<?php
require_once __DIR__ . '/inc/global.inc.php';

// Add to header of your file
use FacebookAds\Api;

session_start();

if (is_null($_SESSION['config']['access_token'])) { 
	if (!isset($_GET["code"])) {
		header("Location: access.php");
	}else{
		$_SESSION['config']['authorization_code'] = $_GET["code"];
		$code = $_GET["code"];
		echo '<strong>CODE</strong>: ' . $_SESSION['config']['authorization_code'];	
		echo "<br>";
		echo '<strong>CLIENT ID</strong>: ' . $_SESSION['config']['app_id'];
		echo "<br>";
		echo '<strong>REDIRECT URI</strong>: ' . $_SESSION['config']['login_url'];
		echo "<br>";
		echo '<strong>CLIENT SECRET</strong>: ' . $_SESSION['config']['app_secret'];
		echo "<br>";
		echo '<strong>GRAPH VERSION</strong>: ' . $_SESSION['config']['default_graph_version'];
		echo "<br>";
		
		$access = get_access_token($_SESSION['config']['graph_base_domain'], $_SESSION['config']['default_graph_version'], $_SESSION['config']['app_id'], $_SESSION['config']['login_url'], $_SESSION['config']['app_secret'], $_SESSION['config']['authorization_code']);
		$_SESSION['config']['access_token_array'] = $access;
		//var_dump($access);
		$_SESSION['facebook_access_token'] = $access['access_token'];
		$_SESSION['config']['access_token'] = $access['access_token'];
	}
} else {
	echo '<strong>CODE</strong>: ' . $_SESSION['config']['authorization_code'];	
	echo "<br>";
	echo '<strong>CLIENT ID</strong>: ' . $_SESSION['config']['app_id'];
	echo "<br>";
	echo '<strong>REDIRECT URI</strong>: ' . $_SESSION['config']['login_url'];
	echo "<br>";
	echo '<strong>CLIENT SECRET</strong>: ' . $_SESSION['config']['app_secret'];
	echo "<br>";
	echo '<strong>GRAPH VERSION</strong>: ' . $_SESSION['config']['default_graph_version'];
	echo "<br>";

	$_SESSION['facebook_access_token'] = $_SESSION['config']['access_token'];
}

// Add after echo "You are logged in "

// Initialize a new Session and instantiate an API object
Api::init(
  $_SESSION['config']['app_id'], // App ID
  $_SESSION['config']['app_secret'],
  $_SESSION['facebook_access_token'] // Your user access token
);

echo "<br>";
echo '<strong>ACCESS TOKEN</strong>: ' . $_SESSION['config']['access_token'];
echo "<br>";
echo "<br>";
echo '<strong>ACCESS TOKEN (ARRAY)</strong>: ';
var_dump($_SESSION['config']['access_token_array']);

use FacebookAds\Object\AdAccount;

$account = (new AdAccount($_SESSION['config']['app_id']))->getSelf();
echo "<br>";
echo "<br>";
echo '<strong>GET FACEBOOK ADS ACCOUNT</strong>: ';
var_dump($account);

?>