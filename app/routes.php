<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::any('/', 'HomeController@login');

// Form protection against CSRF (Cross-site Request Forgery)
Route::when('*', 'csrf', array('post', 'put', 'delete'));

// Authentication
Route::any('authenticate', 'AuthenticateController@authenticate');

// Registration
Route::any('users/cruds_users', 'UsersController@cruds_users');

// Authentication process first before proceeding.
Route::group(array('before' => 'auth'), function()
{
	// Authentication
	Route::any('logout', 'HomeController@logout');
	
	// Dashboard
	Route::any('dashboard', 'DashboardController@dashboard');
	
	// Human Resources 
	Route::any('hr', 'HrController@hr');
	Route::any('hr/job_analysis', 'HrController@job_analysis');
	Route::any('hr/cruds_job_analysis', 'HrController@cruds_job_analysis');
});

