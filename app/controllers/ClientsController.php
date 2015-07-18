<?php
/*
	Module Name: Companies
*/
class ClientsController extends BaseController {

	private $input;
	protected $layout = 'layouts.master';
	
	public function __construct() 
	{
		$this->input = Input::all();
	}
	
	// Main page
	public function clients()
	{
		$this->createView(
			array(
				'ERPS - Clients',
				'Clients',
				'clients/clientsIndex',
				'',
				'clients/clientsMenuPartial'
			)
		);
	}
	
	public function clients_list()
	{
		$this->createView(
			array(
				'ERPS - Clients',
				'Clients',
				'clients/clientsList',
				'',
				'clients/clientsMenuPartial'
			)
		);
	}
	
	public function company_list()
	{
		$data['state_list'] 	= States::read();
		$data['country_list']	= Countries::read();
		
		$this->createView(
			array(
				'ERPS - Company',
				'Company',
				'clients/clientCompanyList',
				$data,
				'clients/clientsMenuPartial'
			)
		);
	}
	
	public function cruds_companies()
	{
		switch($this->input['action']) 
		{
			case 'create': 
				$hash = Companies::insert( $this->input );
				return Response::json( 'create:'.$hash );
			break;
			
			case 'read' : 
				return Response::json(Companies::read());
			break;
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