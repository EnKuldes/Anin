<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Attendance Class
 */
class Agent extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model("auth_model");
		// Check Authorization
		$cont = $this->router->fetch_class(); 
		$no_perner = $this->session->userdata('user_id');
		$auth = $this->auth_model->get_link_auth($cont,$no_perner);
		// Check is Logged In?
		if ($this->session->userdata('is_logged_in')) {
			if ($auth != 0) {
				$this->load->helper('url');
				$this->load->model("agent_model");
				$this->load->library('../controllers/Globals');
			}
			else{
				redirect('Error_page/error_401');
			}
		}
		else{
			redirect('Error_page/error_session_to');
		}
	}

	function index()
    {
    	$data['main_content'] = 'dashboard';
    	$data['main_menu'] = $this->globals->menu(0,$h="",$c="submenu");
		$data['page_title'] = $this->globals->p_title($data['main_content']);

    	$this->load->view('includes/template',$data);
    }
    function dashboard()
    {
    	$this->index();
    }
    function get_roster()
    {
    	$datas = $this->agent_model->get_list_roster($this->session->userdata('prener_id'));
    	foreach ($datas as $data) {
    		$result['data'][] = [
    			"id"=>$data['idx'],
    			"perner"=>$data['no_perner'],
				"title"=>$data['shift'].' '.$data['shift_desc'],
				"start"=>$data['rooster_date'].' '.$data['waktu_masuk'],
				"end"=>$data['rooster_date'].' '.$data['waktu_keluar'],
				// "start"=>$data['rooster_date'],
				// "end"=>$data['rooster_date'],
				"absensi_masuk"=>$data['absensi_masuk'],
				"absensi_keluar"=>$data['absensi_keluar'],
				"waktu_masuk"=>$data['waktu_masuk'],
				"waktu_keluar"=>$data['waktu_keluar']
    		];
    	}
    	echo json_encode($result);
    }
    function get_roster_summary()
    {
    	$datas = $this->agent_model->get_roster_summary($this->session->userdata('prener_id'));
    	echo json_encode($datas);
    }
    // ------------------------------------------------
    function logoff()
    {
    	$this->session->sess_destroy();
		redirect(base_url('Attendance'));
    }
}

?>
