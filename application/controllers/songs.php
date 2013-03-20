<?php

class Songs extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('songs_model');
		
	}
	
	function index()
	{
		$a = array(	'id'	=>	md5('Jay-Z'.rand()),
								'artist' =>	array(	'name'	=>	'Jay-Z',
													'id'	=>	md5('Jaz-Z')),
								'title'	=>	'Empire State of Mind'
							);
						
		echo("<pre>".json_encode($a)."</pre>");
						
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
