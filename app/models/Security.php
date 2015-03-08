<?php

	class Security 
	{
		private static $key = 'm1 ult1m0 4dy0s p4tr14 4d0r4d4 r3h1y0n d3l s0l k3r1d4';
	
		// Simple encryption
		// Usage: $encrypted = Security::encr($string); 
		public static function encr( $post_data )
		{
			$result = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5(self::$key), $post_data, MCRYPT_MODE_CBC, md5(md5(self::$key))));
			return $result;
		}
		
		// Simple decryption
		// Usage: $decrypted = Security::encr($encrypted);
		public static function decr( $post_data )
		{
			$result = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(self::$key), base64_decode($post_data), MCRYPT_MODE_CBC, md5(md5(self::$key))), "\0");
			return $result;
		}
	}