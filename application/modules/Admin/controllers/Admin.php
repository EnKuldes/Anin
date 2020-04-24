<?php
/* Manggil Class PHPSPreadsheet */
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
			
			// Nama Layanan
			$layanan = $this->admin_model->get_layanan($id_layanan);
			// Array Alfabet Kolom Excel
			$abjad = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "AA", "AB", "AC", "AD", "AE", "AF", "AG", "AH", "AI", "AJ", "AK", "AL", "AM", "AN", "AO", "AP", "AQ", "AR", "AS", "AT", "AU", "AV", "AW", "AX", "AY", "AZ", "BA", "BB", "BC", "BD", "BE", "BF", "BG", "BH", "BI", "BJ", "BK", "BL", "BM", "BN", "BO", "BP", "BQ", "BR", "BS", "BT", "BU", "BV", "BW", "BX", "BY", "BZ"];

			// List Prener dan Date
			$temp_list_perner = array_unique(array_map(function ($i) { return $i['no_perner']; }, $datas));
			$temp_list_date = array_unique(array_map(function ($i) { return $i['rooster_date']; }, $datas));
			foreach ($temp_list_perner as $perner) {
				$list_perner[] = $perner;
			}
			foreach ($temp_list_date as $date) {
				$list_date[] = $date;
			}
			
			// Nulis Spreadsheet
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			
			// Menyesuaikan dengan format
			$sheet->setCellValue('A1', 'Absen '.date("M Y", strtotime($year.'-'.$month.'-01')));
			$sheet->setCellValue('A2', $layanan['layanan_desc']);
			$highCol = $abjad[count($list_date)+1];
			$sheet->mergeCells('A1:'.$highCol.'1');
			$sheet->mergeCells('A2:'.$highCol.'2');
			$sheet->getStyle('A1:'.$highCol.'1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle('A2:'.$highCol.'2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle('A1:'.$highCol.'1')->getFont()->setName('Cambria')->setSize(20)->setBold(1);
			$sheet->getStyle('A2:'.$highCol.'2')->getFont()->setName('Cambria')->setSize(20)->setBold(1);
			$sheet->setCellValue('A3', 'No.');
			$sheet->mergeCells('A3:A4');
			$sheet->getStyle('A3:A4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
			$sheet->setCellValue('B3', 'Nama');
			$sheet->mergeCells('B3:B4');
			$sheet->getStyle('B3:B4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
			$idx = 2;
			foreach ($list_date as $date) {
				$sheet->setCellValue($abjad[$idx].'3', date("d", strtotime($date)));
				$sheet->setCellValue($abjad[$idx].'4', date("D", strtotime($date)));
				$idx++;
			}

			for ($i=0; $i < count($list_perner) ; $i++) { 
				$new_data[$list_perner[$i]] = [];
				for ($j=0; $j < count($datas) ; $j++) { 
					if ($list_perner[$i] == $datas[$j]['no_perner']) {
						$new_data[$list_perner[$i]][] = $datas[$j];
					}
				}
			}

			for ($i=0; $i < count($list_perner) ; $i++) { 
				for ($j=0; $j < count($new_data[$list_perner[$i]]) ; $j++) { 
					if ($j == 0) {
						$sheet->setCellValue('A'.($i+5), $i+1)
							->setCellValue('B'.($i+5), $new_data[$list_perner[$i]][$j]['user_name']);
					}
					if ( $list_date[$j] == $new_data[$list_perner[$i]][$j]['rooster_date'] ) {
						$sheet->setCellValue( $abjad[2+$j].($i+5), $new_data[$list_perner[$i]][$j]['absensi']);
					}
				}
			}

			// Style Cell Border
			$styleArray = [
				'borders' => [
					'allBorders' => [
						'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
						//'color' => ['argb' => 'FFFF0000'],
					],
				],
			];
			$sheet->getStyle('A3:'.$highCol.(count($list_perner)+4))->applyFromArray($styleArray);

			$writer = new Xlsx($spreadsheet);
			$filepath = FCPATH . "/uploads/Absen ".$layanan['layanan_desc']." Bogor ".date("M Y", strtotime($year.'-'.$month.'-01')).".xlsx";
			echo $filepath;
			$writer->save($filepath);
    	}
    	else{
    		throw new \Exception("Tidak ada variabel yang dikirim!");
    	}
    }
}

?>
