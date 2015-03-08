<?php

	class Jobanalysis {

		private static $table 			= 'job_analysis';
		private static $has_many_status = 'status';
		
		// insert a row of data
		public static function insert( $post_data )
		{
			DB::table( self::$table )
				->insert(
					array(					
						'created_at'	=> (string) date( 'Y-m-d H:i:s' ),
						'description'	=> (string) $post_data['description'],
						'status'		=> (int) 	$post_data['status'],
						'title' 		=> (string) $post_data['title']
					)
				);
		}
		
		// get all data
		public static function read()
		{
			$result = DB::table(self::$table.' as ja')
				->orderBy('ja.id', 'DESC')		
				->leftJoin( self::$has_many_status.' as s', "s.id", '=', "ja.status" )
				->select(
					DB::raw('
						hash,
						ja.title as ja_title, 
						description,
						s.title as s_title'
						)
					)
				->get();
			return $result;
		}
		
		// update a job_analysis row of data
		public static function update( $post_data )
		{
			DB::table(self::$table)
				->where('hash', '=', $post_data['hash'])
				->update(
					array(
						'title' 		=> $post_data['title'],
						'description'	=> $post_data['description'],
						'status'		=> $post_data['status']
					)
				);
		}
		
		// get a single row of data
		public static function getData( $post_data )
		{
			$ja_id = Security::decr( $post_data['ja_id'] );
			$result = DB::table(self::$table)
				->where('id', '=', $ja_id)
				->select(DB::raw('hash, title, description, status'))
				->get();
			return $result;
		}
	}