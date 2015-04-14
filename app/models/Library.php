<?php

	class Library {

		public static function ip_details() 
		{
			// Get the current client public IP address
			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				$ip_address = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
				$ip_address = $_SERVER['REMOTE_ADDR'];
			}
			
			if( $ip_address == '127.0.0.1')
			{
				$ip_address = '49.148.66.42'; // Default to the Philippines if localhost
			}
			
			$json 		 = file_get_contents("http://ipinfo.io/".$ip_address);
			$details 	 = json_decode($json);			
			return $details;
		}
	}