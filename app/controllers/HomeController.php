<?php

class HomeController extends BaseController {

	protected $layout = 'layouts.master';

	public function login()
	{
		if ( Auth::check() )
		{
		    return Redirect::intended('dashboard');
		} else {
			
			$this->layout->title = "Welcome to ERPS - Login";
			$this->layout->heading = "Login";
			$this->layout->content = View::make('login/loginIndex', array( 'location' => Library::ip_details("49.148.66.42") ) );
		}
	}
	
	public function logout()
	{
		Auth::logout();
		return Redirect::intended('/');
		die();
	}
}
