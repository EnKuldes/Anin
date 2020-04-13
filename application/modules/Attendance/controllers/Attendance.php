<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Attendance Class
 */
class Attendance extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model("attendance_model");
		$this->load->library('../controllers/Globals');
		date_default_timezone_set('Asia/Jakarta');
	}

	function index()
    {
    	$data['main_content'] = 'Attendance';
		$data['page_title'] = $this->globals->p_title($data['main_content']);

    	$this->load->view('attendance',$data);
    }
    function attend()
    {
    	$prener = $_POST['prener_id'];
    	$today_date = date("Y-m-d H:i:s");
    	$rooster_date = date("Y-m-d",strtotime($today_date));
    	$status_attend = $this->attendance_model->checkAbsensi($prener,$rooster_date);
    	if (sizeof($status_attend)>0) {
    		switch ($status_attend[0]["log_status"]) {
				case 0:
					$vData = array(
						"log_status" => 1,
						"logon" => $today_date
					);
					$img_status_user = "login";
					$sArrival = 1; // Datang
					$tArrival = date("H:i:s", strtotime($status_attend[0]["login_time"]));
					break;
				case 1:
					$vData = array(
						"log_status" => 2,
						"logoff" => $today_date
					);
					$img_status_user = "logout";
					$sArrival = 0; // Pulang
					$tArrival = date("H:i:s", strtotime($status_attend[0]["logout_time"]));
					break;
				default:
					$message[] = [
						'c_message' => "Sudah melakukan absensi masuk dan absensi keluar pada hari ini!"
						, 'image_icon' => "assets/images/p_message/late_1.gif"
					];
					die(json_encode($message));
					break;
			}
			$attend_me = $this->attendance_model->attend($prener,$rooster_date,$vData);
			if ($attend_me == 1) {
				$fileDate = date('Ymd_His',strtotime($today_date));
		    	define('UPLOAD_DIR', 'uploads/attendance/');
		    	$img = $_POST['snap_image'];
				$img = str_replace('data:image/jpeg;base64,', '', $img);
				$img = str_replace(' ', '+', $img);
				$data = base64_decode($img);
				$file = UPLOAD_DIR .$prener. '_' . $fileDate . '_' . $img_status_user . '.png';
				$success = file_put_contents($file, $data);
				if ($success) {
					$sImgupload = 1;
				}
				else{
					$sImgupload = 0;
				}
			}

			// Difference Time
			$arrivalTime = date("H:i:s", strtotime($today_date));
			$diffTime = floor((strtotime($tArrival)-strtotime($arrivalTime))/60);
			if ($diffTime > 15) {
				$vArrivalIdx = 1;
			}
			elseif ($diffTime < -15) {
				$vArrivalIdx = 3;
			}
			else{
				$vArrivalIdx = 2;
			}
			if ( $status_attend[0]["id_shift"] == 6 ) {
				$vArrivalIdx = 2;
			}
			$welcome_message = $this->attendance_model->get_welcome_message($sArrival,$vArrivalIdx);

			echo json_encode($welcome_message);
    	}
    	else{
    		$message[] = [
				'c_message' => "Tidak dapat menemukan rooster dengan prener ID ".$prener."!"
				, 'image_icon' => "assets/images/p_message/late_1.gif"
			];
			die(json_encode($message));
    	}
	    	
    }
    function auth()
    {
    	$this->load->model("auth_model");
    	$user_id = $this->input->post("userid");
    	$password = sha1($this->input->post("password"));
    	$results = $this->auth_model->authe_me($user_id,$password);
    	if (sizeof($results) > 0) {
    		$dSessions = array(
    			"user_name" => $results[0]["user_name"],
    			"prener_id" => $results[0]["no_perner"],
    			"user_group" => $results[0]["user_group"],
    			"user_avatar" => $results[0]["user_avatar"],
    			"layanan_user" => $results[0]["layanan_id"],
    			"is_logged_in" => true
			);
			$this->session->set_userdata($dSessions);
			$first_page = $this->auth_model->get_first_page($results[0]["user_group"]);
			$vSuccess = array(
				"type" => "success",
				"message" => "You successfully login, wait 5 second to redirect or <a href='$first_page'>click here</a>.",
				"redirected_page" => $first_page
			);
    		echo json_encode($vSuccess);
    	}
    	else{
    		$vError = array(
    			"type" => "error",
    			"message" => "There is something wrong, either your account is disable or wrong username/password.",
    			"redirected_page" => null
    		);
    		echo json_encode($vError);
    	}
    	//echo json_encode($results);
    }
}

?>