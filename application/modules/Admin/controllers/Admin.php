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
			if ($auth != 0 && $this->session->userdata('user_group') > 1) {
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
		$data['layanan_id'] = $this->session->userdata('layanan_user');

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
		$data['layanan_id'] = $this->session->userdata('layanan_user');

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
			$bg_color = ['danger'=>'f1556c', 'primary'=>'6658dd', 'warning'=>'f7b84b'];

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
			$spreadsheet->getDefaultStyle()->getFont()->setName('Cambria')->setSize(10);
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
			$sheet->getStyle('A3:B4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF99');
			$idx = 2;
			// Baris Keterangan
			$rowKeterangan = count($list_perner)+6;
			$sheet->setCellValue('B'.$rowKeterangan, 'Keterangan');
			$list_keterangan = ['TOTAL MASUK BY ROOSTER', 'TOTAL MASUK', 'ALPA', 'CTF', 'CT', 'CDK', 'TOTAL TIDAK HADIR', '% HARIAN'];
			for ($i=0; $i < count($list_keterangan) ; $i++) { 
				$sheet->setCellValue('B'.($rowKeterangan+$i+1), $list_keterangan[$i]);
			}
			// End
			foreach ($list_date as $date) {
				$sheet->setCellValue($abjad[$idx].'3', date("d", strtotime($date)));
				$sheet->setCellValue($abjad[$idx].'4', date("D", strtotime($date)));
				// Keterangan
				$sheet->setCellValue($abjad[$idx].$rowKeterangan, date("d", strtotime($date)));
				// End
				$idx++;
			}
			$sheet->getStyle('A3:'.$abjad[$idx].'4')->getFont()->setSize(11)->setBold(1);

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
						$sheet->getStyle( $abjad[2+$j].($i+5) )->getFont()->getColor()->setARGB( $bg_color[$new_data[$list_perner[$i]][$j]['bg_color']] );
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

			// Keterangan
			$highestColumnDate = $sheet->getHighestColumn(3);
			$highestRowPerner = count($list_perner)+4;
			$highestColumnDateIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumnDate);
			$highestColumnDateIndex = $highestColumnDateIndex - 1;
			for ($j=2; $j < $highestColumnDateIndex; $j++) { 
				// $sheet->setCellValue($abjad[$j].($rowKeterangan+1), '=COUNTA('.$abjad[$j].'5:'.$abjad[$j].$highestRowPerner.')-COUNTIF('.$abjad[$j].'5:'.$abjad[$j].$highestRowPerner.',"CT")' );
				$sheet->setCellValue($abjad[$j].($rowKeterangan+1), '=COUNTA('.$abjad[$j].'5:'.$abjad[$j].$highestRowPerner.')-COUNTIF('.$abjad[$j].'5:'.$abjad[$j].$highestRowPerner.',"CT")-COUNTIF('.$abjad[$j].'5:'.$abjad[$j].$highestRowPerner.',"-")-COUNTIF('.$abjad[$j].'5:'.$abjad[$j].$highestRowPerner.',"CIK")-COUNTIF('.$abjad[$j].'5:'.$abjad[$j].$highestRowPerner.',"CML")' );
				$sheet->setCellValue($abjad[$j].($rowKeterangan+2), '=COUNTA('.$abjad[$j].'5:'.$abjad[$j].$highestRowPerner.')-COUNTIF('.$abjad[$j].'5:'.$abjad[$j].$highestRowPerner.',"CTF")-COUNTIF('.$abjad[$j].'5:'.$abjad[$j].$highestRowPerner.',"CT")-COUNTIF('.$abjad[$j].'5:'.$abjad[$j].$highestRowPerner.',"-")-COUNTIF('.$abjad[$j].'5:'.$abjad[$j].$highestRowPerner.',"CIK")-COUNTIF('.$abjad[$j].'5:'.$abjad[$j].$highestRowPerner.',"AP")-COUNTIF('.$abjad[$j].'5:'.$abjad[$j].$highestRowPerner.',"OP")-COUNTIF('.$abjad[$j].'5:'.$abjad[$j].$highestRowPerner.',"CML")' );
				$sheet->setCellValue($abjad[$j].($rowKeterangan+3), '=COUNTIF('.$abjad[$j].'5:'.$abjad[$j].$highestRowPerner.',"AP")' );
				$sheet->setCellValue($abjad[$j].($rowKeterangan+4), '=COUNTIF('.$abjad[$j].'5:'.$abjad[$j].$highestRowPerner.',"CTF")' );
				$sheet->setCellValue($abjad[$j].($rowKeterangan+5), '=COUNTIF('.$abjad[$j].'5:'.$abjad[$j].$highestRowPerner.',"CT")' );
				$sheet->setCellValue($abjad[$j].($rowKeterangan+6), '=COUNTIF('.$abjad[$j].'5:'.$abjad[$j].$highestRowPerner.',"CDK")' );
				$sheet->setCellValue($abjad[$j].($rowKeterangan+7), '='.$abjad[$j].($rowKeterangan+3).'+'.$abjad[$j].($rowKeterangan+4).'+'.$abjad[$j].($rowKeterangan+6).'' );
				$sheet->setCellValue($abjad[$j].($rowKeterangan+8), '='.$abjad[$j].($rowKeterangan+7).'/'.$abjad[$j].($rowKeterangan+1).'' );
				$sheet->getStyle($abjad[$j].($rowKeterangan+8))->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE_00);
			}
			$sheet->setCellValue($abjad[$highestColumnDateIndex].$rowKeterangan, 'Jumlah');
			$sheet->setCellValue($abjad[$highestColumnDateIndex].($rowKeterangan+1), '=SUM(C'.($rowKeterangan+1).':'.$abjad[$highestColumnDateIndex-1].($rowKeterangan+1).')' );
			$sheet->setCellValue($abjad[$highestColumnDateIndex].($rowKeterangan+2), '=SUM(C'.($rowKeterangan+2).':'.$abjad[$highestColumnDateIndex-1].($rowKeterangan+2).')' );
			$sheet->setCellValue($abjad[$highestColumnDateIndex].($rowKeterangan+3), '=SUM(C'.($rowKeterangan+3).':'.$abjad[$highestColumnDateIndex-1].($rowKeterangan+3).')' );
			$sheet->setCellValue($abjad[$highestColumnDateIndex].($rowKeterangan+4), '=SUM(C'.($rowKeterangan+4).':'.$abjad[$highestColumnDateIndex-1].($rowKeterangan+4).')' );
			$sheet->setCellValue($abjad[$highestColumnDateIndex].($rowKeterangan+5), '=SUM(C'.($rowKeterangan+5).':'.$abjad[$highestColumnDateIndex-1].($rowKeterangan+5).')' );
			$sheet->setCellValue($abjad[$highestColumnDateIndex].($rowKeterangan+6), '=SUM(C'.($rowKeterangan+6).':'.$abjad[$highestColumnDateIndex-1].($rowKeterangan+6).')' );
			$sheet->setCellValue($abjad[$highestColumnDateIndex].($rowKeterangan+7), '=SUM(C'.($rowKeterangan+7).':'.$abjad[$highestColumnDateIndex-1].($rowKeterangan+7).')' );
			$sheet->setCellValue($abjad[$highestColumnDateIndex].($rowKeterangan+8), '=AVERAGE(C'.($rowKeterangan+8).':'.$abjad[$highestColumnDateIndex-1].($rowKeterangan+8).')' );

			$sheet->getStyle('B'.$rowKeterangan.':'.$abjad[$highestColumnDateIndex].($rowKeterangan+8))->applyFromArray($styleArray);



			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Absen '.$layanan['layanan_desc'].' Bogor '.date("M Y", strtotime($year.'-'.$month.'-01')).'.xlsx"');
			header('Cache-Control: max-age=0');
			$writer = new Xlsx($spreadsheet);
			$filepath = FCPATH . "/uploads/Absen ".$layanan['layanan_desc']." Bogor ".date("M Y", strtotime($year.'-'.$month.'-01')).".xlsx";
			//ob_end_clean();
			//$writer->save($filepath);
			$writer->save('php://output');
			exit;
    	}
    	else{
    		throw new \Exception("Tidak ada variabel yang dikirim!");
    	}
    }
}

?>
