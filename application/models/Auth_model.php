<?php 

/**
 * 
 */
class auth_model extends CI_Model
{
	
	public function tambahUser($data)
	{
		return $this->db->insert('user', $data);
	}

	public function getKotaId()
	{
		return $this->db->get('user')->result_array();
	}

	public function user_login($table, $where)
	{
		return $this->db->get_where($table,$where);
	}

	public function seller_login($table, $where)
	{
		return $this->db->get_where($table,$where);
	}
}
 ?>