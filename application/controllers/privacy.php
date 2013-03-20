<?php

class Privacy extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		
	}
	
	function index()
	{
		
		$this->template->write('title', 'iburnd - privacy policy');
		
		$payload['menu'] = array(	
									array(	'name' 		=> "Sign In", 
											'val' 		=> "/login", 
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
								
		$payload['js'] = array(	"jquery-1.7.min", "jquery.tablesorter", "prettify",
								"bootstrap2.0-jqueryui/jquery-ui-1.8.16.custom.min",
								"bootstrap2.0-jqueryui/start",
								"bootstrap2.0/bootstrap.min",
								"application",
								);
		
		$this->template->write_view('privacy', 'layouts/privacy', $payload);
		
		return $this->template->render();
	}
}
