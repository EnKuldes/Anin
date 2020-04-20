<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Attendance Class
 */
class Admin extends MX_Controller
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
			if ($auth != 0 && $this->session->userdata('user_group') == 2) {
				$this->load->helper('url');
				$this->load->model("admin_model");
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
    function download_roster_v2() // Versi tes
    {
    	$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Hello World !');

		$writer = new Xlsx($spreadsheet);
		$filepath = FCPATH . "/uploads/".date("Ymd_Gis").".xlsx";
		echo $filepath;
		$writer->save($filepath);
    }
    function upload_roster()
    {
    	$data['main_content'] = 'upload_roster';
    	$data['main_menu'] = $this->globals->menu(0,$h="",$c="submenu");
		$data['page_title'] = $this->globals->p_title($data['main_content']);

    	$this->load->view('includes/template',$data);
    }
    function report()
    {
    	$data['main_content'] = 'report';
    	$data['main_menu'] = $this->globals->menu(0,$h="",$c="submenu");
		$data['page_title'] = $this->globals->p_title($data['main_content']);

    	$this->load->view('includes/template',$data);
    }
    // ------------------------------------------------
    function get_list_layanan()
    {
    	$datas = $this->admin_model->get_list_layanan();
    	echo json_encode($datas);
    }
    function get_roster_information()
    {
    	$id_layanan = $this->input->post('id_layanan');
    	$whereCon = '= CURDATE()';
    	$groupBy = '';
    	$datas = $this->admin_model->get_roster_information($id_layanan, $whereCon, $groupBy);
    	echo json_encode($datas);
    }
    function get_trend_roster_information()
    {
    	$id_layanan = $this->input->post('id_layanan');
    	$whereCon = 'BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE()';
    	$groupBy = 'rooster_date';
    	$datas = $this->admin_model->get_roster_information($id_layanan, $whereCon, $groupBy);
    	echo json_encode($datas);
    }
    function get_attendance_information()
    {
    	$id_layanan = $this->input->post('id_layanan');
    	$datas = $this->admin_model->get_attendance_information($id_layanan);
    	echo json_encode($datas);
    }
    function get_list_date()
    {
    	if ($this->input->post()) {
    		if ($this->input->post('id_layanan')) {
				$id_layanan = $this->input->post('id_layanan');
    			if ($this->input->post('year')) {
    				$year = $this->input->post('year');
    				$datas = $this->admin_model->get_month_list($id_layanan, $year);
    			}
    			else{
    				$datas = $this->admin_model->get_year_list($id_layanan);
    			}
    		}
    	}
    	else{
    		throw new \Exception("Tidak ada variabel yang dikirim!");
    	}
    	echo json_encode($datas);
    }
    function get_report()
    {
    	if ($this->input->post()) {
			$id_layanan = $this->input->post('id_layanan');
			$year = $this->input->post('year');
			$month = $this->input->post('month');
			$datas = $this->admin_model->get_report($id_layanan, $year, $month);
			for ($i=0; $i < count($datas) ; $i++) { 
				$kode_shift = $datas[$i]['kode_shift'];
				$roster_shift = $datas[$i]['id_shift'];
				$status_absensi = $datas[$i]['status_absensi'];
				$kategori_shift = $datas[$i]['kategori_shift'];

				if ($status_absensi > 0) {
					if ($kategori_shift != 1) { // Bukan roster masuk
						$datas[$i]['absensi'] = $kode_shift.'*';
					}
					else{$datas[$i]['absensi'] = $kode_shift;}
				}
				else{
					if ($kategori_shift != 1) { // Bukan roster masuk
						$datas[$i]['absensi'] = $kode_shift;
					}
					else{$datas[$i]['absensi'] = '-';}
				}
			}
			echo json_encode($datas);
    	}
    	else{
    		throw new \Exception("Tidak ada variabel yang dikirim!");
    	}
    }
    function download_format_upload()
    {
    	$this->load->helper('download');
    	force_download(FCPATH . "/uploads/format/Contoh_Format_Upload.xlsx", NULL);
    }
    function download_report()
    {
    	if ($this->input->post()) {
			$id_layanan = $this->input->post('id_layanan');
			$year = $this->input->post('year');
			$month = $this->input->post('month');
			$datas = $this->admin_model->get_report($id_layanan, $year, $month);
			for ($i=0; $i < count($datas) ; $i++) { 
				$kode_shift = $datas[$i]['kode_shift'];
				$roster_shift = $datas[$i]['id_shift'];
				$status_absensi = $datas[$i]['status_absensi'];
				$kategori_shift = $datas[$i]['kategori_shift'];

				if ($status_absensi > 0) {
					if ($kategori_shift != 1) { // Bukan roster masuk
						$datas[$i]['absensi'] = $kode_shift.'*';
					}
					else{$datas[$i]['absensi'] = $kode_shift;}
				}
				else{
					if ($kategori_shift != 1) { // Bukan roster masuk
						$datas[$i]['absensi'] = $kode_shift;
					}
					else{$datas[$i]['absensi'] = '-';}
				}
			}
			
			// List Prener dan Date
			$list_perner = array_filter($datas, "no_perner");
			$list_date = array_filter($datas, "rooster_date");
			// Nulis Spreadsheet
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			// Kolom dan Baris Pertama
			$sheet->setCellValue('A1', 'Prener');
			$i = 2;
			foreach ($list_perner as $key) {
				$sheet->setCellValue('A'.$i, $key);
			}


			$writer = new Xlsx($spreadsheet);
			$filepath = FCPATH . "/uploads/".date("Ymd_Gis").".xlsx";
			echo $filepath;
			$writer->save($filepath);
    	}
    	else{
    		throw new \Exception("Tidak ada variabel yang dikirim!");
    	}
    }
}

?>
