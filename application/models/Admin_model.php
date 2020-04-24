<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	function get_list_layanan()
	{
		$this->db->select('c_layanan, layanan_desc');
		$this->db->from('c_layanan');
		$this->db->where('layanan_status', 1);
		$this->db->order_by('c_layanan', 'asc');
		$result = $this->db->get();
		return $result->result_array();
	}

	function get_layanan($layanan_id)
	{
		$this->db->select('c_layanan, layanan_desc');
		$this->db->from('c_layanan');
		$this->db->where('layanan_status', 1);
		$this->db->where('c_layanan', $layanan_id);
		$this->db->order_by('c_layanan', 'asc');
		$result = $this->db->get();
		return $result->row_array();;
	}

	function get_roster_information($layanan_id, $whereCon, $groupBy)
	{
		$this->db->select('
			rooster_date
			, COUNT(no_perner) AS jumlah_pegawai
			, SUM(CASE WHEN tb_rooster.id_shift IN (1,2,3,4,5,14,15,16) THEN 1 ELSE 0 END) AS duty
			, SUM(CASE WHEN tb_rooster.id_shift IN (6,7,8,9,10) THEN 1 ELSE 0 END) AS off_duty
			, SUM(CASE WHEN tb_rooster.id_shift IN (1,2,3,4,5,14,15,16) AND tb_rooster.log_status > 0 THEN 1 ELSE 0 END) AS presensi
			, SUM(CASE WHEN tb_rooster.id_shift IN (1,2,3,4,5,14,15,16) AND tb_rooster.log_status = 0 THEN 1 ELSE 0 END) AS belum_presensi
			');
		$this->db->from('tb_rooster');
		$this->db->where('no_perner IN (SELECT no_perner FROM ci_user WHERE layanan_id = '.$layanan_id.')');
		$this->db->where('rooster_date '.$whereCon.'');
		if ($groupBy != '') {
			$this->db->group_by($groupBy);
		}
		$query = $this->db->get();
		$result = $query->row();

		if ($groupBy != '') {
			$result = $query->result_array();
		}
		return $result;
	}

	function get_attendance_information($layanan_id)
	{
		$this->db->select('
			ci_user.no_perner, ci_user.user_name, c_shift.shift
			, tb_rooster.log_status
			, IF(tb_rooster.log_status = 2, c_shift.logout_time, c_shift.login_time) AS waktu_jadwal
			, IF(tb_rooster.log_status = 0, NULL, IF(tb_rooster.log_status = 1, tb_rooster.logon, tb_rooster.logoff) ) AS waktu_absensi
			', false);
		$this->db->from('ci_user');
		$this->db->join('tb_rooster', 'ci_user.no_perner = tb_rooster.no_perner');
		$this->db->join('c_shift', 'c_shift.idx = tb_rooster.id_shift', 'left');
		$this->db->where('ci_user.layanan_id = '.$layanan_id.' AND tb_rooster.rooster_date = CURDATE() AND tb_rooster.id_shift IN (1,2,3,4,5,14,15,16)	');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;

	}

	function get_year_list($layanan_id)
	{
		$this->db->select('DISTINCT YEAR(tb_rooster.rooster_date) AS year');
		$this->db->from('tb_rooster');
		$this->db->where('no_perner IN (SELECT no_perner FROM ci_user WHERE layanan_id = '.$layanan_id.')');
		$this->db->order_by('rooster_date', 'desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	function get_month_list($layanan_id, $year)
	{
		$this->db->select('DISTINCT MONTH(tb_rooster.rooster_date) AS month');
		$this->db->from('tb_rooster');
		$this->db->where('no_perner IN (SELECT no_perner FROM ci_user WHERE layanan_id = '.$layanan_id.') AND YEAR(tb_rooster.rooster_date) = '.$year);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	function get_report($layanan_id, $year, $month)
	{
		$this->db->select('
			ci_user.no_perner
			, ci_user.user_name
			, tb_rooster.rooster_date
			, c_shift.shift AS kode_shift
			, tb_rooster.id_shift
			, IFNULL(tb_rooster.status_absensi, 0) AS status_absensi
			, c_shift.kategori_shift
			, IF(c_shift.kategori_shift = 0, "danger", IF(c_shift.kategori_shift = 1, "primary", "warning") ) AS bg_color
			', false);
		$this->db->from('tb_rooster');
		$this->db->join('ci_user', 'ci_user.no_perner = tb_rooster.no_perner', 'right');
		$this->db->join('c_shift', 'c_shift.idx = tb_rooster.id_shift', 'left');
		$this->db->where('ci_user.layanan_id = '.$layanan_id.' AND YEAR(tb_rooster.rooster_date) = '.$year.' AND MONTH(tb_rooster.rooster_date) = '.$month.'');
		$this->db->order_by('ci_user.no_perner', 'asc');
		$this->db->order_by('tb_rooster.rooster_date', 'asc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
}