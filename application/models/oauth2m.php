<?php

class Oauth2m extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	function authorization($data)
	{
		$table = "oauth2_authorizations";
		$query_raw = "select count(*) as count from $table where client_id = '".$data['client_id']."' and state = '".$data['state']."'";
		
		$query = $this->db->query($query_raw);
		$r_r = get_object_vars($query->row());
		if ($r_r['count'] > 0)
		{
			$this->db->update($table, 
										array(	'code' 		=> md5($data['client_id']."|".$data['state'])), 
										array(	'client_id' => $data['client_id'],
												'state' 	=> $data['state'])
							);
			return md5($data['client_id']."|".$data['state']);
		} else {
			$this->db->insert($table, 
				array(	'code' 		=> md5($data['client_id']."|".$data['state']), 
						'client_id' => $data['client_id'],
			 			'state' 	=> $data['state']));
			return md5($data['client_id']."|".$data['state']);
		}
		
	}
	
	function getNamespace($client_id, $client_secret)
	{
		$query = $this->db->get_where('oauth2_namespaces', array('client_id' => $client_id, 'client_secret' => $client_secret));
		
		if (!$query)
			return false;
		else 
			return $query->row()->namespace_id;
	}
	
	
	function getAuthorization($client_id, $code)
	{
		$query = $this->db->get_where('oauth2_authorizations', array('client_id' => $client_id, 'code' => $code));
		
		if (!$query)
			return false;
		else 
			return $query->row()->authorization_id;
	}
	
	
	function getToken($namespace_id, $authorization_id)
	{
		$query = $this->db->get_where('oauth2_authorizations', array('namespace_id' => $namespace_id, 'authorization_id' => $authorization_id));
		
		if (!$query)
			return false;
		else 
			return $query->row()->token;
	}
	
	function getNamespaceID($namespace)
	{
		$query = $this->db->get_where('oauth2_namespaces', array('name' => $namespace));
		
		if (!$query->result())
			return false;
		else 
			return $query->row()->namespace_id;
	}
	
	function checkToken($token)
	{
		$query = $this->db->get_where('oauth2_tokens', array('token' => $token));
		
		if (!$query)
			return false;
		else 
			return true;
	}
	
	function token($data)
	{
		$authorization_id = $this->getAuthorization($data['client_id'], $data['code']);
		$namespace_id = $this->getNamespace($data['client_id'], $data['client_secret']);
		
		$table = "oauth2_tokens";
		$query_raw = "select count(*) as count from $table where authorization_id = '".$authorization_id."' and namespace_id = '".$namespace_id."'";
		
		$query = $this->db->query($query_raw);
		$r_r = get_object_vars($query->row());
		if ($r_r['count'] > 0)
		{
			$this->db->update($table, 
										array(	'token' 		=> md5($namespace_id."|".$authorization_id)), 
										array(	'namespace_id' => $namespace_id,
										 		'authorization_id' 	=> $authorization_id)
							);
			return md5($namespace_id."|".$authorization_id);
		} else {
			$this->db->insert($table, 
				array(	'token' 		=> md5($namespace_id."|".$authorization_id), 
						'namespace_id' => $namespace_id,
			 			'authorization_id' 	=> $authorization_id));
			return md5($namespace_id."|".$authorization_id);
		}
		
	}
	
	function save_nike_runs_gps($data)
	{
		$table = "nike_runs_gps";
		$query_raw = "select count(*) as count from $table where n_r_id = '".$data['n_r_id']."'";
		
		$query = $this->db->query($query_raw);
		
		$r_r = get_object_vars($query->row());
		if ($r_r['count'] > 0)
		{
			return;
			$this->db->update($table, $data, "n_r_id = '".$data['n_r_id']."'");
		} else {
			$this->db->insert($table, $data);
		}
		
	}
	
	function save_nike_runs_snapshots($data)
	{
		$table = "nike_runs_snapshots";
		$query_raw = "select count(*) as count from $table where n_r_snapshot_id = '".$data['n_r_snapshot_id']."'";
		
		$query = $this->db->query($query_raw);
		
		$r_r = get_object_vars($query->row());
		if ($r_r['count'] > 0)
		{
			return;
			$this->db->update($table, $data, "n_r_snapshot_id = '".$data['n_r_snapshot_id']."'");
		} else {
			$this->db->insert($table, $data);
		}
		
	}
	
	function save_nike_u_profiles($data)
	{
		$table = "nike_u_profiles";
		$query_raw = "select count(*) as count from $table where n_u_id = '".$data['n_u_id']."'";
		
		$query = $this->db->query($query_raw);
		
		$r_r = get_object_vars($query->row());
		if ($r_r['count'] > 0)
		{
			$this->db->update($table, $data, "n_u_id = '".$data['n_u_id']."'");
		} else {
			$this->db->insert($table, $data);
		}
	}
	
	function save_nike_u_stats($data)
	{
		$table = "nike_u_stats";
		$query_raw = "select count(*) as count from $table where n_u_id = '".$data['n_u_id']."'";
		
		$query = $this->db->query($query_raw);
		
		$r_r = get_object_vars($query->row());
		if ($r_r['count'] > 0)
		{
			$this->db->update($table, $data, "n_u_id = '".$data['n_u_id']."'");
		} else {
			$this->db->insert($table, $data);
		}
	}
	
	function get_all_nike_credentials()
	{
		$table = "nike_u_profiles";
		$query_raw = "select username, password from $table";
		
		$query = $this->db->query($query_raw);
		return $query->result();
	}
	
	function get_thisuser_nikeplus_uid()
	{
		$table = "nike_u_profiles";
		$query_raw = "select n_u_id from $table where u_id = '".$this->session->userdata('uid')."'";
		
		$query = $this->db->query($query_raw);
		if ($query->result())
		{
			$res = get_object_vars($query->row());
			return $res['n_u_id'];
		} else {
			return "0";
		}
	}
	
}

