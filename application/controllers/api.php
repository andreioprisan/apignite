<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {
	private $request_vars;
	private $data;
	private $http_accept;
	private $method;
	private $appnamespace;
	private $namespace_id;
	public $session_id;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->model('Oauth2m', 'oauth2m');
		
		$seg = $this->uri->segments;
		
		$this->session_id = $this->session->userdata('session_id');
		
		if ($seg[1] != "api")
			exit;
		
		if (!isset($seg[2]))
			$this->fatal('20', 'no app namespace set');
			
		$appnamespace = $seg[2];
		
		$namespace_id = $this->oauth2m->getNamespaceID($appnamespace);
		if (!$namespace_id)
			$this->fatal('10', 'no such app namespace: '.$appnamespace.'');
			
		//echo $namespace_id;
		$this->namespace_id = $namespace_id;
		$this->appnamespace = $appnamespace;
		
		$this->request_vars		= array();
		$this->data				= '';
		$this->http_accept		= (strpos($_SERVER['HTTP_ACCEPT'], 'json')) ? 'json' : 'xml';
		$this->method			= 'get';
		
		//$this->digest();
		
		
		exit;
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
		
	}
	
	public function showauthreq()
	{
//		unset($_SERVER['PHP_AUTH_DIGEST']);
		
		header('HTTP/1.1 401 Unauthorized');
		header('WWW-Authenticate: Digest realm="' . $this->appnamespace . '",qop="auth",nonce="' . uniqid() . '",opaque="' . md5($this->appnamespace) . '"');

//		$this->LogOut();
		die($this->sendResponse(401));
	}
	
	public function LogOut()
	{
		$this->session->sess_destroy();	
	}
	
	function IsAuthenticated()
	{
		$auth_user = "root";
		$auth_pass = "toor2";
		
		
		if (!isset($_SERVER['PHP_AUTH_DIGEST']) || empty($_SERVER['PHP_AUTH_DIGEST']))
		{
			$this->session->set_userdata(array('error' => "no digest!"));
			return false;
		}

		// check PHP_AUTH_DIGEST
		if (!($data = $this->http_digest_parse($_SERVER['PHP_AUTH_DIGEST'])) || $data['username'] != $auth_user)
		{
			$this->session->set_userdata(array('error' => "username not matching"));
			return false;
		}
		
		$A1 = md5($data['username'] . ':' . $this->appnamespace . ':' . $auth_pass);
		$A2 = md5($_SERVER['REQUEST_METHOD'].':'.$data['uri']);

		
		// Give session id instead of data['nonce']
		$valid_response =   md5($A1.':'.$data['nonce'].':'.$data['nc'].':'.$data['cnonce'].':'.$data['qop'].':'.$A2);
		
		if ($data['response'] != $valid_response)
		{
			$this->session->set_userdata(array('error' => "invalid response"));
			return False;
		}
		
		$this->session->set_userdata(array('loggedin' => '1'));
		$this->session->set_userdata(array('error' => ""));
			
		return True;
	}

	
	public function digest()
	{
		$this->session->set_userdata(array('loggedin' => '0'));
		
		if (!$this->IsAuthenticated() || $this->session->userdata('loggedin') == '0') {  
			$this->showauthreq();
		} else {
			$this->session->set_userdata(array('namespace_id' => $this->namespace_id));
			$this->session->set_userdata(array('loggedin' => '1'));
		}
		
	
		echo "ok";
		
	}
	
	public static function processRequest()
	{
		// get our verb
		$request_method = strtolower($_SERVER['REQUEST_METHOD']);
		$return_obj		= new RestRequest();
		// we'll store our data here
		$data			= array();

		switch ($request_method)
		{
			// gets are easy...
			case 'get':
				$data = $_GET;
				break;
			// so are posts
			case 'post':
				$data = $_POST;
				break;
			// here's the tricky bit...
			case 'put':
				// basically, we read a string from PHP's special input location,
				// and then parse it out into an array via parse_str... per the PHP docs:
				// Parses str  as if it were the query string passed via a URL and sets
				// variables in the current scope.
				parse_str(file_get_contents('php://input'), $put_vars);
				$data = $put_vars;
				break;
		}

		// store the method
		$return_obj->setMethod($request_method);

		// set the raw data, so we can access it if needed (there may be
		// other pieces to your requests)
		$return_obj->setRequestVars($data);

		if(isset($data['data']))
		{
			// translate the JSON to an Object for use however you want
			$return_obj->setData(json_decode($data['data']));
		}
		return $return_obj;
	}

	public function sendResponse($status = 200, $body = '', $content_type = 'text/html')
	{
		$statusCodeMessage =  $this->getStatusCodeMessage($status);
		
		$status_header = 'HTTP/1.1 ' . $status . ' ' . $statusCodeMessage;
		// set the status
		header($status_header);
		// set the content type
		header('Content-type: ' . $content_type);

		// pages with body are easy
		if($body != '')
		{
			// send the body
			echo $body;
			exit;
		}
		// we need to create the body if none is passed
		else
		{
			// create some body messages
			$message = '';

			// this is purely optional, but makes the pages a little nicer to read
			// for your users.  Since you won't likely send a lot of different status codes,
			// this also shouldn't be too ponderous to maintain
			switch($status)
			{
				case 401:
					$message = 'You must be authorized to view this page.';
					break;
				case 404:
					$message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
					break;
				case 500:
					$message = 'The server encountered an error processing your request.';
					break;
				case 501:
					$message = 'The requested method is not implemented.';
					break;
			}

			// servers don't always have a signature turned on (this is an apache directive "ServerSignature On")
			$signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

			// this should be templatized in a real-world solution
			$body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
						<html>
							<head>
								<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
								<title>' . $status . ' ' . $statusCodeMessage . '</title>
							</head>
							<body>
								<h1>' . $statusCodeMessage . '</h1>
								<p>' . $message . '</p>
								<hr />
								<address>' . $signature . '</address>
							</body>
						</html>';

			echo $body;
			exit;
		}
	}
	
	public function getStatusCodeMessage($status)
	{
		// these could be stored in a .ini file and loaded
		// via parse_ini_file()... however, this will suffice
		// for an example
		$codes = Array(
		    100 => 'Continue',
		    101 => 'Switching Protocols',
		    200 => 'OK',
		    201 => 'Created',
		    202 => 'Accepted',
		    203 => 'Non-Authoritative Information',
		    204 => 'No Content',
		    205 => 'Reset Content',
		    206 => 'Partial Content',
		    300 => 'Multiple Choices',
		    301 => 'Moved Permanently',
		    302 => 'Found',
		    303 => 'See Other',
		    304 => 'Not Modified',
		    305 => 'Use Proxy',
		    306 => '(Unused)',
		    307 => 'Temporary Redirect',
		    400 => 'Bad Request',
		    401 => 'Unauthorized',
		    402 => 'Payment Required',
		    403 => 'Forbidden',
		    404 => 'Not Found',
		    405 => 'Method Not Allowed',
		    406 => 'Not Acceptable',
		    407 => 'Proxy Authentication Required',
		    408 => 'Request Timeout',
		    409 => 'Conflict',
		    410 => 'Gone',
		    411 => 'Length Required',
		    412 => 'Precondition Failed',
		    413 => 'Request Entity Too Large',
		    414 => 'Request-URI Too Long',
		    415 => 'Unsupported Media Type',
		    416 => 'Requested Range Not Satisfiable',
		    417 => 'Expectation Failed',
		    500 => 'Internal Server Error',
		    501 => 'Not Implemented',
		    502 => 'Bad Gateway',
		    503 => 'Service Unavailable',
		    504 => 'Gateway Timeout',
		    505 => 'HTTP Version Not Supported'
		);

		return (isset($codes[$status])) ? $codes[$status] : '';
	}
	
	function http_digest_parse($txt)
	{
	    // protect against missing data
	    $needed_parts = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1);
	    $data = array();
	    $keys = implode('|', array_keys($needed_parts));

	    preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);

	    foreach ($matches as $m) {
	        $data[$m[1]] = $m[3] ? $m[3] : $m[4];
	        unset($needed_parts[$m[1]]);
	    }

	    return $needed_parts ? false : $data;
	}

	public function setData($data)
	{
		$this->data = $data;
	}

	public function setMethod($method)
	{
		$this->method = $method;
	}

	public function setRequestVars($request_vars)
	{
		$this->request_vars = $request_vars;
	}

	public function getData()
	{
		return $this->data;
	}

	public function getMethod()
	{
		return $this->method;
	}

	public function getHttpAccept()
	{
		return $this->http_accept;
	}

	public function getRequestVars()
	{
		return $this->request_vars;
	}
	
}
