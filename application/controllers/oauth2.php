<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Oauth2 extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Oauth2m', 'oauth2m');
		
	}
	
	
	public function fatal($errorcode, $message)
	{
		header('Content-type: text/json');
		echo json_encode(array(	'code'		=>	$errorcode,
								'message'	=>	$message
								)
							);
		exit -1;
	}
	
	public function authorize()
	{
		$vars = $_GET;
		
		if (isset($_GET['client_id']))
			$client_id = $_GET['client_id'];
		else
			$this->fatal('0', 'missing client_id');
			
		if (isset($_GET['state']))
			$state = $_GET['state'];
		else
			$this->fatal('1', 'missing state');
		
		if (isset($_GET['redirect_uri']))
			$redirect_uri = $_GET['redirect_uri'];
		else
			$this->fatal('2', 'missing redirect_uri');
		
		if (isset($_GET['response_type']))
			$response_type = $_GET['response_type'];
		else
			$this->fatal('3', 'missing response_type');
		
		$code = $this->oauth2m->authorization(array(	'client_id'	=>	$client_id,
														'state'		=>	$state)
											);
		$resp_string = "?".$response_type."=".$code;
		
		if (!$code || $code == null)
			$this->fatal('4', 'missing authorization code');
		else
			header('Location: '.$redirect_uri.$resp_string);
		
	}
	
	public function access_token()
	{
		$vars = $_GET;
		
		if (isset($_GET['client_id']))
			$client_id = $_GET['client_id'];
		else
			$this->fatal('0', 'missing client_id');
			
		if (isset($_GET['redirect_uri']))
			$redirect_uri = $_GET['redirect_uri'];
		else
			$this->fatal('2', 'missing redirect_uri');

		if (isset($_GET['code']))
			$code = $_GET['code'];
		else
			$this->fatal('4', 'missing authorization code');

		if (isset($_GET['client_secret']))
			$client_secret = $_GET['client_secret'];
		else
			$this->fatal('5', 'missing client_secret');

		if (isset($_GET['grant_type']))
			$grant_type = $_GET['grant_type'];
		else
			$this->fatal('6', 'missing grant_type');
		
		
		$token = $this->oauth2m->token(array(			'client_id'		=>	$client_id,
														'client_secret'	=>	$client_secret,
														'grant_type'	=>	$grant_type,
														'code'			=>	$code)
											);
		echo "access_token=".$token;
		return;
	}
	
	public function index()
	{
		

	}
}
