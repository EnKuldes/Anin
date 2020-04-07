<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function get_list_roster($prener_id)
	{
		$this->db->select('
			tb_rooster.idx
			, tb_rooster.no_perner
			, tb_rooster.rooster_date
			, c_shift.shift
			, c_shift.shift_desc 
			, c_shift.login_time AS waktu_masuk
			, tb_rooster.logon AS absensi_masuk
			, c_shift.logout_time AS waktu_keluar
			, tb_rooster.logoff AS absensi_keluar
			');
		$this->db->from('tb_rooster');
		$this->db->join('c_shift', 'tb_rooster.id_shift = c_shift.idx', 'left');
		$this->db->where('tb_rooster.no_perner = '.$prener_id.' AND MONTH(tb_rooster.rooster_date) = MONTH(CURDATE()) AND YEAR(tb_rooster.rooster_date) = YEAR(CURDATE())');
		$this->db->order_by('tb_rooster.rooster_date', 'asc');
		
		$result = $this->db->get();
		return $result->result_array();

	}

	public function get_roster_summary($prener_id)
	{
		$this->db->select('
			SUM(CASE WHEN id_shift NOT IN (6,7,8,9,10) THEN 1 ELSE 0 END) AS counter_hk
			, SUM(CASE WHEN id_shift IN (6,7,8,9,10) THEN 1 ELSE 0 END) AS counter_libur
			, SUM(CASE WHEN status_absensi NOT IN (10,11,12) THEN 1 ELSE 0 END) AS counter_kehadiran
			, SUM(CASE WHEN status_absensi IN (10,11,12) THEN 1 ELSE 0 END) AS counter_ketidakhadiran
			');
		$this->db->from('tb_rooster');
		$this->db->where('tb_rooster.no_perner = '.$prener_id.' AND MONTH(tb_rooster.rooster_date) = MONTH(CURDATE()) AND YEAR(tb_rooster.rooster_date) = YEAR(CURDATE())');
		
		$result = $this->db->get();
		return $result->result_array();
	}
	
}