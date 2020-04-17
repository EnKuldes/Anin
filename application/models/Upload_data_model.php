<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_data_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}
	function get_list_shift()
	{
		$result = $this->db->query('SELECT idx, shift FROM c_shift');
    	$data = array();
		if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
				array_push($data, array('idx'=>$row['idx'], 'shift'=>strtolower($row['shift'])));
			}
		}
		return $data;
	}
	function upload($data,$table)
	{
		$this->db->insert_batch($table, $data);
		$affected_rows = $this->db->affected_rows();
		return $affected_rows;
	}
	function upload_v2($data,$table) // khusus upload roster
	{
		$jumlah_data = 0;
		for ($i=0; $i < count($data) ; $i++) { 
			/*$this->db->insert($table, $data[$i]);
			$this->db->where('no_perner', $data[$i]['no_perner']);
			$this->db->where('rooster_date', $data[$i]['rooster_date']);
			$this->db->update($table, $data[$i]);*/
			
			$this->db->where('no_perner', $data[$i]['no_perner']);
			$this->db->where('rooster_date', $data[$i]['rooster_date']);
			$cek = $this->db->get($table);
			if ($cek->num_rows() > 0 ) {
				$this->db->where('no_perner', $data[$i]['no_perner']);
				$this->db->where('rooster_date', $data[$i]['rooster_date']);
				$this->db->update($table, ['id_shift' => $data[$i]['id_shift'], 'lup' => date("Y-m-d H:m:s")]);
			}
			else{
				$this->db->insert($table, $data[$i]);
			}
			if ($this->db->affected_rows() != 0) {
				$jumlah_data++;
			}
		}
		return $jumlah_data;
	}
}