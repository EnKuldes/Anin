<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error_page extends MX_Controller {
    public function __construct()
    {
    	parent::__construct();
		/*$this->load->library('../controllers/globals');
		$this->load->model("admin_model");*/
		$this->load->library('../controllers/Globals');
    }

	function index()
	{				
		$data['main_content'] = 'pages_error';
    	$data['main_menu'] = $this->globals->menu(0,$h="",$c="submenu");
		$data['page_title'] = "Error Page!";
		$data['error_title'] = "Page not found!";
		$data['error_desc'] = "Halaman yang kamu cari tidak ditemukan!";

    	$this->load->view('includes/template',$data);
	}

	function error_404()
	{		
		$data['main_content'] = 'pages_error';
    	$data['main_menu'] = $this->globals->menu(0,$h="",$c="submenu");
		$data['page_title'] = "Error Page!";
		$data['error_title'] = "Page not found!";
		$data['error_desc'] = "Halaman yang kamu cari tidak ditemukan!";

    	$this->load->view('includes/template',$data);
		
	}
	function error_401()
	{		
		
		$data['main_content'] = 'pages_error';
    	$data['main_menu'] = $this->globals->menu(0,$h="",$c="submenu");
		$data['page_title'] = "Error Page!";
		$data['error_title'] = "Authorization Required!";
		$data['error_desc'] = "Kamu tidak punya authoriasi untuk mengakses halaman ini!";

    	$this->load->view('includes/template',$data);
		
	}
	function error_session_to()
	{				
		$this->session->sess_destroy();
		redirect(base_url('Attendance'));
		
	}

}
