<?php

class Tos extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
	}
	
	function index()
	{
		
		$this->template->write('title', 'iburnd - terms of service');
		
		$payload['menu'] = array(	
									array(	'name' 		=> "Sign In", 
											'val' 		=> "/facebook_auth/login", 
											'align' 	=> "right", 
											'login' 	=> "true"),
								);
		
		$payload['css'] = array(	"prettify", 
									"bootstrap.min",
									"bootstrap-responsive.min",
									"font-awesome",
									"apignite",
									);
		$payload['js'] = array(	"jquery-1.7.min", 
								"jquery.tablesorter", 
								"bootstrap.min",
								"application",
								"prettify",
								);

		$this->template->write_view('tos', 'layouts/tos', $payload);

		return $this->template->render();
	}
}
