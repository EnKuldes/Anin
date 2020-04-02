<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error_page extends MX_Controller {
    public function __construct()
    {
			/*$this->load->library('../controllers/globals');
			$this->load->model("admin_model");*/
    }

	function index()
	{				
		/*$invalid = $this->session->flashdata('invalid');
		$this->load->model("auth_model");
			
		if($this->session->userdata('is_logged_in')){
			$this->auth($this->session->userdata('user_group'));
		}else{
			$company_code = $this->uri->segment(1);
			if(strlen($company_code)<1){
				$company_code = 1;
			}
			$data['init_theme'] = $this->auth_model->get_init_theme_2($company_code);
			$company_url = basename(parse_url(base_url(), PHP_URL_PATH));
			$company_domain = array_shift((explode('.', $_SERVER['HTTP_HOST'])));
			$data['invalid'] = $invalid;
			$this->load->view('login_v', $data);
		}	*/	
	}

	function error_404()
	{		
		
		$this->load->view('pages-404');
		
	}
	function error_401()
	{		
		
		$this->load->view('pages-404');
		
	}
	function error_session_to()
	{		
		
		$this->load->view('pages-404');
		
	}

}