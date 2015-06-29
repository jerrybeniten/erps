<?php

	class Countries {

		private static $table  = 'countries';
		
		// get all data
		public static function read()
		{
			$result = DB::table(self::$table.' as c')	
				->select(
					DB::raw('
						geoname_id,
						country_iso_code,
						country_name
						')
					)
				->orderBy('country_name', 'ASC')
				->get();
			return $result;
		}
	}