<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
	function attend($prener_id,$today_date,$vData)
	{	
		$this->db->where('no_perner', $prener_id);
		$this->db->where("rooster_date", $today_date);
		$this->db->update('tb_rooster', $vData);
		$updateStatus = $this->db->affected_rows();
		return $updateStatus;

	}
	function checkAbsensi($prener_id,$today_date){
		$this->db->select('tbr.no_perner,tbr.rooster_date,tbr.id_shift,cs.login_time,cs.logout_time,tbr.log_status');
		$this->db->from('tb_rooster tbr');
		$this->db->join("c_shift cs", "tbr.id_shift = cs.idx","left");
		$this->db->join("ci_user cius", "tbr.no_perner = cius.no_perner and cius.user_status = 1","left");
		$this->db->where('tbr.no_perner', $prener_id);
		$this->db->where("tbr.rooster_date", $today_date);
		//$this->db->where("tbr.user_status", 1);

		$result = $this->db->get();
		
		return $result->result_array();
	}
	function get_welcome_message($arrival_status,$arrival_idx)
	{
		$this->db->select("c_message, image_icon");
		$this->db->where("arrival_status",$arrival_status);
		$this->db->where("arrival_idx",$arrival_idx);
		$result = $this->db->get("p_message");
		
		return $result->result_array();
	}
}