<?php
require_once __DIR__ . '/vendor/autoload.php';

// Add to header of your file
use FacebookAds\Api;
//use FacebookAds\Object\AdUser;

session_start();

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