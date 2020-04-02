<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
	function authe_me($user_login, $user_password){
		$this->db->where('user_login', $user_login);
		$this->db->where("user_password", $user_password);
		$this->db->where("user_status", 1);

		$result = $this->db->get("ci_user");
		
		return $result->result_array();
	}
	function get_first_page($user_group)
	{
		
		$this->db->select('cm.menu_link');
		$this->db->from('ci_menu cm');
		$this->db->join('ci_access ca','cm.menu_id = ca.id_menu');
		$this->db->where("ca.`id_group`",$user_group);
		$this->db->where("cm.`menu_link !=", '#');
		//$this->db->where("cm.menu_parent", 0);
		$this->db->order_by("cm.menu_sort", "asc");
		$this->db->limit(1);
		$result = $this->db->get();
		
		return $result->row()->menu_link;
		
	}
	function get_link_auth($cont,$no_perner)
	{
		$this->db->select('menu_link');
		$this->db->from('ci_access');
		$this->db->join('ci_user', 'id_group = user_group');
		$this->db->join('ci_menu', 'id_menu = menu_id');
		$this->db->where('no_perner', $no_perner);
		$this->db->where('menu_link = "'.$cont.'"');
		$this->db->or_where('menu_link like "%'.$cont.'%"');
		$result = $this->db->get();
		$return = $result->num_rows();

		return $return;
	}
}