<?php
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
	
	function initialize_fb($app_id, $app_secret, $graph_version){
		return (new Facebook(['app_id' => $app_id, 'app_secret' => $app_secret, 'default_graph_version' => $graph_version,]));
	}
	
	function get_access_token($graph_base_domain, $graph_version, $client_id, $redirect_uri, $client_secret, $code){
		$ch = curl_init();

		$graph_url = $graph_base_domain . $graph_version . "/oauth/access_token?client_id=" . $client_id . "&redirect_uri=" . $redirect_uri . "&client_secret=" . $client_secret . "&code=" . $code;

		curl_setopt($ch, CURLOPT_URL, $graph_url);		
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		//curl_setopt($ch, CURLOPT_POST, FALSE);
		//curl_setopt($ch,CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		
		$response = curl_exec($ch);
		
		curl_close($ch);
		
		return json_decode( $response, TRUE );
	}
	
	function initialize_api($app_id, $app_secret, $access_token){
		try{
			Api::init(
				$app_id, // App ID
				$app_secret,
				$access_token // Your user access token
			);
			
			return Api::instance();		
		}
		catch (Exception $e) {
			echo 'Error message: ' .$e->getMessage() ."\n" . "<br/>";
			echo 'Error Code: ' .$e->getCode() ."<br/>";
		}
	}

	function get_appsecret_proof($app_secret, $access_token){
		return $appsecret_proof= hash_hmac('sha256', $access_token, $app_secret); 	
	}	
	
	function get_campaigns($ad_act, $access_token, $fb_api){
		$fb = $fb_api;

		try {
		  // Returns a `Facebook\FacebookResponse` object
		  $response = $fb->get(
			'/' . $ad_act . '/campaigns',
			$access_token
		  );
		  
		  return $response;
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}
		$getGraphEdge = $response->getGraphEdge();		
	}
	
	function add_campaign($ad_act, $access_token, $fb_api, $campaign_name){
		$fb = $fb_api;
		
		try {
		  // Returns a `Facebook\FacebookResponse` object
		  $response = $fb->post(
			'/' . $ad_act . '/campaigns',
			array (
			  'name' => $campaign_name,
			  'objective' => 'LINK_CLICKS',
			  'status' => 'PAUSED',
			),
			$access_token
		  );
		  
		  return $response;
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}		
	}