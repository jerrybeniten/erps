<?php
/*
	Module Name: Human Resources
*/
class HrController extends BaseController {

	private $input;
	protected $layout = 'layouts.master';
	
	public function __construct() 
	{
		$this->input = Input::all();
	}
	
	// Main page
	public function hr()
	{
		$this->createView(
			array(
				'ERPS - Human Resources',
				'Human Resources',
				'humanResources/hrIndex',
				'',
				'humanResources/hrMenuPartial'
			)
		);
	}
	
	// Sub-module 
	public function job_analysis() 
	{
		$this->createView(
			array(
				'ERPS - Human Resources - Job Analysis',
				'Human Resources - Job Analysis',
				'humanResources/hrJobAnalysis',
				'',
				'humanResources/hrMenuPartial'
			)
		);
	}
	
	// CRUDS for job analysis
	public function cruds_job_analysis()
	{		
		$rules = array(
			'title'   => 'required',
			'description' => 'required'
		);	
		
		$validatior = Validator::make($this->input, $rules);
		
		switch($this->input['action'])
		{
			// Create this includes update
			case 'create': 
				if( $validatior->passes() && empty( $this->input['hash'] ) ) 
				{
					$hash = Jobanalysis::insert( $this->input );
					return Response::json( 'create:'.$hash );
					
				} else if ( $validatior->passes() && !empty( $this->input['hash'] ) ) {
				
					Jobanalysis::update( $this->input );
					return Response::json( true );
		
				} else {
				
					return Response::json( $validatior->messages() );
				}
			break; 
			
			// Read
			case 'read':
				$result = Jobanalysis::read();
				return Response::json( $result );
			break;
			
			// Gedit = get a single row of data
			case 'gedit':
				$result = Jobanalysis::getData( $this->input );
				return Response::json( $result );
			break;
		
			// Delete
			
			// Search
		} 
		die();
	}
	
	// View Generator
	public function createView( $post_data ) 
	{
		$this->layout->title = $post_data[0];
		$this->layout->heading = $post_data[1];
		$this->layout->content = View::make($post_data[2],  isset($post_data[3]) && !empty($post_data[3]) ? $post_data[3] : array() );
		$this->layout->partial = View::make(isset($post_data[4]) && !empty($post_data[4]) ? $post_data[4] : array()  );
	}
}

