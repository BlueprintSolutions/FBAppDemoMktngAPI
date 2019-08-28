<?php
	class settings{
		
	}
	
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
		  'sandbox_app_id' => '474530250048926',
		  'authorization_code' => '',
		  'access_token' => NULL,
		  'fb_api' => NULL,
		  'default_graph_version' => 'v4.0',
		  'business_id' => '',
		  'act_id' => '467851350703545',
		  'ad_act' => 'act_467851350703545',
		  'act_timezone' => '',
		  'page_id' => '',
		  'login_url' => $link . '/fbappdemomkt',
		  'app_url' => '',
		  'instagram_actor_id' => '',
		  'access_token_array' => array(),
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