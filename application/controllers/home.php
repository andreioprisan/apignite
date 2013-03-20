<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		
	}
	
	public function auth()
	{
//		$this->load->helper('urihelper');
		
		$providerName = "Apignite";

		$provider = $this->oauth2loader->provider($providerName, array(
			'id' => 'username',
			'secret' => 'password',
		));

		if ( ! $this->input->get('code'))
		{
			$provider->authorize();
		} else {
			try
			{
				$token = $provider->access($_GET['code']);
				
				echo $token;
				$user = $provider->get_user_info($token);

				echo "<pre>Tokens: ";
				var_dump($token);

				echo "\n\nUser Info: ";
				var_dump($user);
			} catch (OAuth2_Exception $e) {
				show_error('error: '.$e);
			}

		}

		
	}
	
	
	public function index()
	{
		
		$this->template->write('title', 'apignite - welcome');

		$payload['menu'] = array(	
									array('name' => "APIs", 'val' => array(	
										array('name' => "New", 'val' => "/apis/newapi"),
										array('name' => "Versions", 'val' => "/apis/versions"),
										array('name' => "Builder", 'val' => "/apis/builder"),
									), 'align' => 'right'),
									array('name' => "Analytics", 'val' => array(	
										array('name' => "Requests", 'val' => "/analytics/requests"),
										array('name' => "Response Time", 'val' => "/analytics/responsetime"),
										array('name' => "Data", 'val' => "/analytics/data"),
										array('name' => "Errors", 'val' => "/analytics/errors"),
										array('name' => "Error Rate", 'val' => "/analytics/errorrate"),
										array('name' => "Users", 'val' => "/analytics/users"),
									), 'align' => 'right'),
									array('name' => "Policies", 'val' => array(	
										array('name' => "Profiles", 'val' => "/policies/profiles"),
										array('name' => "Status", 'val' => "/policies/status"),
									), 'align' => 'right'),
									array('name' => "Permissions", 'val' => array(	
										array('name' => "Users", 'val' => "/permissions/users"),
										array('name' => "Roles", 'val' => "/permissions/users"),
										array('name' => "OAuth 2", 'val' => "/permissions/oauth2"),
										array('name' => "HTTP Digest", 'val' => "/permissions/httpdigest"),
									), 'align' => 'right'),
									/*
									array(	'name' 		=> "Sign In", 
											'val' 		=> "/login", 
											'align' 	=> "right", 
											'login' 	=> "true"),
											*/
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


		$this->template->write_view('start', 'layouts/homepage', $payload);

		return $this->template->render();
	}
}
