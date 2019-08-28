<?php
	use FacebookAds\Api;
	use FacebookAds\Object\Campaign;
	use FacebookAds\Object\Fields\CampaignFields;
	use FacebookAds\Object\Values\CampaignObjectiveValues;
	
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