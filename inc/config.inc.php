<?php
	function config(){
		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
			$link = "https"; 
		else
			$link = "http"; 
		$link .= "://"; 
		$link .= $_SERVER['HTTP_HOST']; 

		$array = array(
		  'app_id' => '525243791549096',
		  'app_secret' => '57bcb17d93cca10a5e600c0558aacfbf',
		  'authorization_code' => '',
		  'access_token' => '',
		  'default_graph_version' => 'v4.0',
		  'business_id' => '',
		  'act_id' => '',
		  'act_timezone' => '',
		  'page_id' => '',
		  'login_url' => $link . '/fbappdemomkt',
		  'app_url' => '',
		  'instagram_actor_id' => '',
		  'skip_if' => array(
			'no_business_manager' => true,
			'no_payment_method' => true,
			'no_partner_categories' => true,
			'no_video_upload' => true,
			'no_reach_and_frequency_whitelist' => true,
			'no_async_jobs' => true,
			'no_instagram' => true,
		  ),
		  'graph_base_domain' => 'https://graph.facebook.com/',
		  'skip_ssl_verification' => false,
		  'curl_logger' => '',
		  'secondary_business_id' => '',
		  'secondary_account_id' => '',
		  'secondary_page_id' => '',
		  'secondary_app_id' => '',
		);		
		return $array;
	}