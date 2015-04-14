<?php

	class Countries {

		private static $table  = 'countries';
		
		// get all data
		public static function read()
		{
			$result = DB::table(self::$table.' as c')	
				->select(
					DB::raw('
						country_iso_code,
						country_name
						')
					)
				->orderBy('country_name', 'ASC')
				->get();
			return $result;
		}
	}