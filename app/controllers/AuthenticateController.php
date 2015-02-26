<?php

class AuthenticateController extends BaseController {

	private $input;
	
	public function __construct() 
	{
		$this->input = Input::all();
	}
	
	public function authenticate()
	{
		$email 	  = $this->input['email'];
		$password = $this->input['password'];
		
		if (Auth::attempt(array('email' => $email, 'password' => $password, 'is_active' => 1)))
		{
		    return Redirect::intended('dashboard');
		} else {
			return Redirect::intended('/');
		}
	}
}