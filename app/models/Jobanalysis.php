<?php

	class Jobanalysis {

		private static $table 			= 'job_analysis';
		private static $has_many_status = 'status';
		
		public static function insert( $post_data )
		{
			DB::table(self::$table)
				->insert(
					array(					
						'created_at'	=> (string) date( 'Y-m-d H:i:s' ),
						'description'	=> (string) $post_data['description'],
						'status'		=> (int) 	$post_data['status'],
						'title' 		=> (string) $post_data['title']
					)
				);
		}
		
		public static function read()
		{
			$result = DB::table(self::$table)
				->orderBy('id', 'DESC')
				
				->get();
			return $result;
		}
	}