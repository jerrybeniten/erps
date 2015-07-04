<?php

	class Companies 
	{
	
		private static $table 			= 'companies';
		private static $has_many_first 	= 'states';
	
		public static function insert( $post_data )
		{
			DB::table( self::$table )
				->insert(
					array(
						'company_name' 	=> (string) $post_data['company_name'],
						'street_number' => (string) $post_data['street_number'],
						'street' 		=> (string) $post_data['street'],
						'city' 			=> (string) $post_data['city'],
						'state_id' 		=> (int) 	$post_data['state_id'],
						'postcode' 		=> (string) $post_data['postcode'],
						'country_id'	=> (int) 	$post_data['country_id'],
						'mobile'		=> (string) $post_data['mobile'],
						'phone'			=> (string) $post_data['phone'],
						'created_at'	=> (string) date('Y-m-d')
					)				
				);				
				
			// Get the inserted id			
			$co_id = DB::getPdo()->lastInsertId();	

			if( $co_id ) 
			{
				$hash = Security::encr( $co_id );
				DB::table( self::$table )
					->where( 'id', '=', (int) $co_id )
					->update(
						array(					
							'hash'	=> (string) $hash
						)
					);
			}
			
			return $hash;
		}
		
		public static function read()
		{
			$result = DB::table( self::$table.' as c' )
				->leftJoin( self::$has_many_first.' as s', 'c.state_id', '=', 's.id')
				->select(
					'c.company_name', 
					'c.hash',
					'c.street',
					'c.street_number',
					'c.city',
					'c.phone',
					'c.mobile',
					's.state_code'
				)
				->get();
			return $result;
		}
	}