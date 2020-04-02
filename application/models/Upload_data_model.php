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
}