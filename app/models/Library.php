<?php

	class Library {

		public static function ip_details($ip) 
		{
			
				$json = file_get_contents("http://ipinfo.io/".$ip);
			
				$details = json_decode($json);
			
			return $details;
		}
	}