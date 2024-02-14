<?php  
class M_login extends CI_Model{ 
	function cek_login($select,$table,$where){
		$this->db->select($select);
		$this->db->from($table);
		$this->db->where($where);
		return $this->db->get();
	}
}
//end of file M_login.php
//location application\model