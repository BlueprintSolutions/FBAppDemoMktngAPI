<?php
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