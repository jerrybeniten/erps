<?php

	class States 
	{
		
		private static $table = 'states';
	
		// Get List of States
		public static function read()
		{
			$result = DB::table( self::$table )->get();
			return $result;
		}
	}