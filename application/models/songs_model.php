<?php

class Songs_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	//md5(concat(category_id,"|",method_id,"|",m_type,"|",m_name))
	
	function apiparent_get($api_id)
	{
		$query_parts = array('api_id' => $api_id);

		$query = $this->db->get_where('api_versions', $query_parts);
		
		if (!$query)
			return false;
		else 
			return $query->row();
	}
	
	
	function category_update($data)
	{
		$table = "api_e_category";
		$query_raw = "select count(*) as count from $table where api_id = '".$data['api_id']."' and category_id = '".$data['category_id']."'";
		
		$query = $this->db->query($query_raw);
		$r_r = get_object_vars($query->row());
		if ($r_r['count'] > 0)
		{
			$this->db->update($table, $data,	array(	'api_id' 		=> $data['api_id'],
										 				'category_id' 	=> $data['category_id']));
			return $this->db->insert_id();
		} else {
			$this->db->insert($table, $data);
			return $this->db->insert_id();
		}
		
	}
	
	function category_get($api_id, $category_id = NULL)
	{
		if ($category_id != NULL)
			$query_parts = array('api_id' => $api_id, 'category_id' => $category_id);
		else
			$query_parts = array('api_id' => $api_id);

		$query = $this->db->get_where('api_e_category', $query_parts);
		
		if (!$query)
			return false;
		else 
			return $query->result();
	}
	
	function method_update($data)
	{
		$table = "api_e_method";
		$query_raw = "select count(*) as count from $table where method_id = '".$data['method_id']."' and category_id = '".$data['category_id']."'";
		
		$query = $this->db->query($query_raw);
		$r_r = get_object_vars($query->row());
		if ($r_r['count'] > 0)
		{
			$this->db->update($table, $data,	array(	'method_id' 	=> $data['method_id'],
										 				'category_id' 	=> $data['category_id']));
			return $this->db->insert_id();
		} else {
			$this->db->insert($table, $data);
			return $this->db->insert_id();
		}
		
	}
	
	function method_get($category_id, $method_id = NULL)
	{
		if ($method_id != NULL)
			$query_parts = array('method_id' => $method_id, 'category_id' => $category_id);
		else
			$query_parts = array('category_id' => $category_id);

		$query = $this->db->get_where('api_e_method', $query_parts);
		
		if (!$query)
			return false;
		else 
			return $query->result();
	}
	
	function method_get_uid($uid)
	{
		if ($uid != NULL)
			$query_parts = array('m_uid' => $uid);
		else
			return false;
			
		$query = $this->db->get_where('api_e_method', $query_parts);
		
		if (!$query)
			return false;
		else 
			return $query->row();
	}
	
	function method_get_mid($mid)
	{
		if ($mid != NULL)
			$query_parts = array('method_id' => $mid);
		else
			return false;
			
		$query = $this->db->get_where('api_e_method', $query_parts);
		
		if (!$query)
			return false;
		else 
			return $query->row();
	}
	
	
	
	function param_update($data)
	{
		$table = "api_e_param";
		$query_raw = "select count(*) as count from $table where method_id = '".$data['method_id']."' and param_id = '".$data['param_id']."'";
		
		$query = $this->db->query($query_raw);
		$r_r = get_object_vars($query->row());
		
		if ($data['type'] == NULL || $data['name'] == NULL)
			return false;
		
		if ($r_r['count'] > 0)
		{
			$this->db->update($table, $data,	array(	'method_id' 	=> $data['method_id'],
										 				'param_id' 		=> $data['param_id']));
			return $this->db->insert_id();
		} else {
			$this->db->insert($table, $data);
			return $this->db->insert_id();
		}
		
	}
	
	function param_get($method_id, $param_id = NULL)
	{
		if ($param_id != NULL)
			$query_parts = array('method_id' => $method_id, 'param_id' => $param_id);
		else
			$query_parts = array('method_id' => $method_id);

		$query = $this->db->get_where('api_e_param', $query_parts);
		
		if (!$query)
			return false;
		else 
			return $query->result();
	}
	
	
	function param_delete($method_id, $param_id)
	{
		if ($method_id == NULL || $param_id == NULL)
			return false;
		
		$query_parts = array('method_id' => $method_id, 'param_id' => $param_id);
		
		$query = $this->db->delete('api_e_param', $query_parts);
		
		if (!$query)
			return false;
		else 
			return true;
	}
	
	
	
}

