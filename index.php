<?php
require_once __DIR__ . '/inc/global.inc.php';

// Add to header of your file
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

use FacebookAds\Api;
use FacebookAds\Http\Exception\RequestException;
use FacebookAds\Object\Campaign;
use FacebookAds\Object\Fields\CampaignFields;
use FacebookAds\Object\Values\CampaignObjectiveValues;

use FacebookAds\Object\AdSet;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\AdAccountFields;
use FacebookAds\Object\Fields\AdSetFields;

use FacebookAds\Object\Values\InsightsOperators;

use FacebookAds\Logger\CurlLogger;

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
//Api::init(
//  $_SESSION['config']['app_id'], // App ID
//  $_SESSION['config']['app_secret'],
//  $_SESSION['facebook_access_token'] // Your user access token
//);
//$api = Api::instance();
$api = initialize_api($_SESSION['config']['app_id'], $_SESSION['config']['app_secret'], $_SESSION['facebook_access_token']);
//use FacebookAds\Logger\CurlLogger;
//$api->setLogger(new CurlLogger());

echo "<br>";
echo '<strong>ACCESS TOKEN</strong>: ' . $_SESSION['config']['access_token'];
echo "<br>";
echo "<br>";
echo '<strong>ACCESS TOKEN (ARRAY)</strong>: ';
var_dump($_SESSION['config']['access_token_array']);

$fields = array(
  AdAccountFields::ID,
  AdAccountFields::NAME,
 );

//$account = (new AdAccount($_SESSION['config']['app_id']))->getSelf($fields);

/* $account = (new AdAccount($_SESSION['config']['app_id']))->getSelf();

echo "<br>";
echo "<br>";
echo '<strong>ADS ACCOUNT using ' .$_SESSION['config']['app_id'] .' (Application ID)</strong>: ';
var_dump($account);
echo "<br>";
echo "<br>";
echo '<strong>APPLICATION NAME</strong>: ' . $account->name; */

//$account2 = (new AdAccount($_SESSION['config']['app_id']))->read($fields);

//echo "<br>";
//echo "\n<strong>Using this Application ID</strong>: ";
//echo $account2->id."\n";

/* $adAccount = new AdAccount($_SESSION['config']['ad_act']);
echo "<br>";
echo "<br>";
echo '<strong>ADS ACCOUNT using ' . $_SESSION['config']['ad_act'] . ' (act_[Account ID])</strong>: ';
var_dump($adAccount); */

echo "<br>";
echo "<br>";
echo '<strong>APP SECRET PROOF</strong>: ' . get_appsecret_proof($_SESSION['facebook_access_token'], $_SESSION['config']['app_secret']);

/* $fb = $_SESSION['config']['fb_api'];

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get(
    '/' . $_SESSION['config']['ad_act'] . '/campaigns',
    $_SESSION['facebook_access_token']
  );
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
$getGraphEdge = $response->getGraphEdge();
 */
?>

<form action="" name="new campaign" method="post">
	<label>Campaign Name: <input type="text" name="campaign_name" id="campaign_name"></label>
	<input type="submit" value="Submit">
</form>

<?php  

if (isset($_POST["campaign_name"]) && trim($_POST["campaign_name"]) != "") {
    echo "Yes, campaign name is set";
	echo "<br>";
	echo "<br>";
	$campaign = add_campaign($_SESSION['config']['ad_act'], $_SESSION['facebook_access_token'], $_SESSION['config']['fb_api'], $_POST["campaign_name"]);
	var_dump($campaign->getBody());
} else {    
    echo "No, campaign name is not set";
}


$campaigns = get_campaigns($_SESSION['config']['ad_act'], $_SESSION['facebook_access_token'], $_SESSION['config']['fb_api']);

echo "<br>";
echo "<br>";
echo '<strong>LIST CAMPAIGNS</strong>:';
echo "<br>";
var_dump($campaigns->getBody());
//echo "<br>";
//echo "<br>";
//var_dump($getGraphEdge);

?>