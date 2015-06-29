<?php

	class States 
	{
		// Get List of States
		public static function read()
		{
			$result = DB::table('states')->get();
			return $result;
		}
	}