<?php

// Begin Load third party Library PHPSpreadsheet
require  APPPATH . 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// End Load

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Download_data Class
 */
class Download_data extends MX_Controller
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
				//$this->load->model("admin_model");
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
    	/*$data['main_content'] = 'dashboard';
    	$data['main_menu'] = $this->globals->menu(0,$h="",$c="submenu");
		$data['page_title'] = $this->globals->p_title($data['main_content']);

    	$this->load->view('includes/template',$data);*/
    }
    function upload_roster()
    {
    	
    }
    // ------------------------------------------------
}

?>