<?php

class Members extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		
	}
	
	function index($id, $id2)
	{
		echo $id;
		echo $id2;
		die();
		
		$data = array(	'memberid'	=>	'',
						'name'		=>	'');
						
		echo "in /members";
		var_dump($_GET);
		
		// db call to query
	}

	function put()
	{
		$data = $_POST;
		$this->db->put($data);
		
	}
	
	function post()
	{
		$data = $_POST;
		$this->db->update($data);
		
	}

	function get()
	{
		$data = $_GET;
		$this->db->get($data['memberid']);
		
	}

	function delete()
	{
		$data = $_GET;
		$this->db->delete($data['memberid']);
		
	}
	
}
