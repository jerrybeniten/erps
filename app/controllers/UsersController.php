<?php
/*
	Module Name: Users
*/
class UsersController extends BaseController {

	private $input;
	protected $layout = 'layouts.master';
	
	public function __construct() 
	{
		$this->input = Input::all();
	}
		
	// CRUDS for job analysis
	public function cruds_users()
	{		
		$rules = array(
			'email' 	=> 'required|email|unique:users',
			'user_type' => 'required'
		);	
		
		$validatior = Validator::make($this->input, $rules);
		
		switch($this->input['action'])
		{
			// Create
			case 'create': 
				if( $validatior->passes() ) 
				{
					User::insert( $this->input );
											
					$datax = array('email' => array( 
						1 => $this->input['email']
					));
					
					Mail::send('emails.register', $datax, function($message) Use ($datax)
					{
					  
						$message->to($datax['email'][1], 'ERPS')
					  		  ->subject('ERPS Subscription');
					  
					});
					
					return Response::json( true );
				} else {
					return Response::json( $validatior->messages() );
				}
			break; 
			
			// Read
		
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

