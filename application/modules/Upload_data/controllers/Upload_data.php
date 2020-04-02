<?php

//ini_set('memory_limit', '128M');
// Begin Load third party Library PHPSpreadsheet
//require  APPPATH . 'vendor/autoload.php';
//use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
// End Load

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Upload_data Class
 */
class Upload_data extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model("auth_model");
		// Check Authorization
		if ($this->session->userdata('is_logged_in')) {}
		$cont = $this->router->fetch_class(); 
		$no_perner = $this->session->userdata('user_id');
		//$auth = $this->auth_model->get_link_auth($cont,$no_perner);
		// Check is Logged In?
		if ($this->session->userdata('is_logged_in')) {
			//if ($auth != 0) {
				$this->load->helper('url');
				$this->load->model("Upload_data_model");
				$this->load->library('../controllers/Globals');
			/*}
			else{
				redirect('Error_page/error_401');
			}*/
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
    	if(isset($_FILES["file"]["name"])){
    		$fileName = time().$_FILES['file']['name'];
		    $config['upload_path'] = FCPATH . '/uploads/'; //buat folder dengan nama assets di root folder
		    $config['file_name'] = $fileName;
		    $config['allowed_types'] = 'xlsx';
		    $config['max_size'] = '50000';
		     
		    $this->load->library('upload'); // ngambil list library yang di construct sama kelas ini
		    $this->upload->initialize($config);
		     
		    if(! $this->upload->do_upload('file') )	{$this->upload->display_errors();}
		         
		    //$media = $this->upload->data('file');
			$media = $this->upload->data();
		    $inputFileName = FCPATH . '/uploads/'.$media['file_name'];
		    $reader = IOFactory::createReaderForFile($inputFileName);
		    $reader->setReadDataOnly(true);
		    try {
			    $spreadsheet = IOFactory::load($inputFileName);
			} catch (InvalidArgumentException $e) {
			    $helper->log('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
			    die($e->getMessage());
			}
		    
		    $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
		    $highestRow = $spreadsheet->getActiveSheet()->getHighestRow();
		    $highestColumn = $spreadsheet->getActiveSheet()->getHighestColumn();
		    $rowHeader = $spreadsheet->getActiveSheet()->rangeToArray('A' . 1 . ':' . $highestColumn . 1,
                                        NULL,
                                        TRUE,
                                        FALSE);
		    //print_r ($rowHeader);
		    $data = array();

		    $list_shift = $this->Upload_data_model->get_list_shift();

		    for ($row = 2; $row <= $highestRow; $row++){//  Read a row of data into an array
		    	$rowData = $spreadsheet->getActiveSheet()->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                            NULL,
                                            TRUE,
                                            FALSE);
		    	for ($colomn=1; $colomn < max(array_map('count', $rowHeader)); $colomn++) { 
		    		$shift = $this->compareShiftCode($rowData[0][$colomn], $list_shift);
		    		$rooster_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($rowHeader[0][$colomn]);
		    		$rooster_date = new DateTime("@$rooster_date");
		    		$data[] = array(
		    			"no_perner" => $rowData[0][0],
		    			"rooster_date" => $rooster_date->format('Y-m-d'),
		    			"id_shift" => $shift
		    		);
		    	}
		    }
		    $insert = $this->Upload_data_model->upload($data,"tb_rooster");
		    if ( $insert > 0 ) {
		    	$information['message'] = 'Sukses mengunggah data.';
	            $information['alert-title'] = 'Sukses!';
	            $information['alert-class'] = 'success';
		    }
		    else{
		    	$information['message'] = 'Tidak ada data baru yang dimasukan.';
	            $information['alert-title'] = 'Info';
	            $information['alert-class'] = 'info';
		    }
    	}
    	else{
    		$information['message'] = 'Tidak ada file yang di unggah';
            $information['alert-title'] = 'Warning!';
            $information['alert-class'] = 'error';
    	}
    	echo json_encode($information);
    }
    function compareShiftCode($shift,$list_shift){
    	foreach ($list_shift as $key) {
            if (strtolower(trim($shift)) == $key['shift']) {
                $result = $key['idx'];
            }
        }
        //die(print_r($colordatas));
        return $result;
    }
    // ------------------------------------------------
}

?>