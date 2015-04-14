<?php

class HomeController extends BaseController {

	protected $layout = 'layouts.master';

	public function login()
	{
		if ( Auth::check() )
		{
		    return Redirect::intended('dashboard');
		} else {
			
			$data = array( 
				'location'	 => Library::ip_details(),
				'countries'	 => Countries::read()
			);	
			
			$this->layout->title = "Welcome to ERPS - Login";
			$this->layout->heading = "Login";
			$this->layout->content = View::make('login/loginIndex',  $data);
		}
	}
	
	public function logout()
	{
		Auth::logout();
		return Redirect::intended('/');
		die();
	}
}
