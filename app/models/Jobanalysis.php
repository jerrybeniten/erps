<?php

	class Jobanalysis {

		private static $table 				= 'job_analysis';
		private static $has_many_status 	= 'status';
		private static $has_many_companies 	= 'companies';
		
		// insert a row of data
		public static function insert( $post_data )
		{		
			$company_id = Security::decr( $post_data['company_id'] );		
		
			DB::table( self::$table )
				->insert(
					array(					
						'created_at'	=> (string) date( 'Y-m-d H:i:s' ),
						'description'	=> (string) $post_data['description'],
						'status'		=> (int) 	$post_data['status'],
						'title' 		=> (string) $post_data['title'],
						'company_id'  	=> (int) 	$company_id
					)
				);
			
			// Get the inserted id			
			$ja_id = DB::getPdo()->lastInsertId();	

			if( $ja_id ) 
			{
				$hash = Security::encr( $ja_id );
				DB::table( self::$table )
					->where( 'id', '=', (int) $ja_id )
					->update(
						array(					
							'hash'	=> (string) $hash
						)
				);
			}
			
			return $hash;
		}
		
		// get all data
		public static function read()
		{
			$result = DB::table(self::$table.' as ja')
				->orderBy('ja.id', 'DESC')		
				->leftJoin( self::$has_many_status.' as s', "s.id", '=', "ja.status" )
				->leftJoin( self::$has_many_companies.' as c', "c.id", '=', "ja.company_id" )
				->select(
					DB::raw('
						ja.hash as hash,
						ja.title as ja_title, 
						description,
						s.title as s_title,
						c.company_name as c_company_name'
						)
					)
				->get();
			return $result;
		}
		
		// update a job_analysis row of data
		public static function update( $post_data )
		{
			
			$company_id = Security::decr( $post_data['company_id'] );	
		
			DB::table(self::$table)
				->where('hash', '=', $post_data['hash'])
				->update(
					array(
						'title' 		=> (string) $post_data['title'],
						'description'	=> (string) $post_data['description'],
						'status'		=> (string) $post_data['status'],
						'company_id'	=> (string) $company_id
					)
				);
		}
		
		// get a single row of data
		public static function getData( $post_data )
		{
			$ja_id = Security::decr( $post_data['ja_id'] );
			$result = DB::table(self::$table)
				->where('id', '=', $ja_id)
				->select(
					DB::raw(
						'hash, 
						title, 
						description, 
						status,
						company_id'
						)
					)
				->get();
				
			foreach( $result as $values )
			{
				$result['company_id'] = Security::encr( $values->company_id );
			}
			
			return $result;
		}
	}