<?php

class DashboardController extends BaseController {

	protected $layout = 'layouts.master';

	public function dashboard() {

		$this->createView(
			array(
				'ERPS - Dashboard',
				'Dashboard',
				'dashboard/dashboardIndex'
			)
		);
	}

	public function createView( $post_data ) {

		$this->layout->title = $post_data[0];
		$this->layout->heading = $post_data[1];
		$this->layout->content = View::make($post_data[2],  isset($post_data[3]) && !empty($post_data[3]) ? $post_data[3] : array() );
	}
}
