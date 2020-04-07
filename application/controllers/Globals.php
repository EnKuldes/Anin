<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Globals Class
 */
class Globals extends MX_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function p_title($page_tile){
		$this->db->select("menu_name");
		$this->db->from("ci_menu");
		$this->db->where("menu_link like '%".$page_tile."%'");
		
		$result = $this->db->get();
		
		$result->row();
		
		
		return $result->row()->menu_name. " - Anin";
	}
	public function menu($parent,$hasil,$clas) // Eksekusi Pertama kan $clas = has-submenu; kedua submenu/has-submenu, ketiga dan seterusnya || active
	//public function menu($hasil)
	{
		$w = $this->db->query("SELECT ci_menu.*
								FROM
								ci_access
								INNER JOIN ci_menu ON ci_access.id_menu = ci_menu.menu_id
								WHERE menu_parent='".$parent."' AND ci_access.id_group=".$this->session->userdata('user_group')." AND  menu_status=1 
								ORDER BY ci_menu.menu_sort ASC");
		//$hasil .= $w->num_rows();
		if ($parent > 0) {
			$hasil .= "<ul class='$clas'>";
		}
		foreach ($w->result_array() as $h) {
			$link_url = base_url();
			$link_url .= $h['menu_link'];
		
			if ($h["menu_child"] > 0) {
				$hasil .= "<li class='has-submenu'>";
			}
			else{
				$hasil .= "<li>";
			}
			//if ($h["menu_parent"] == 0) {
				if($h['menu_link'] == $this->uri->segment(1) || $h['menu_link'] == $this->uri->segment(1)."/".$this->uri->segment(2)){
					//$hasil .= "<li class='$clas'><a href='$h->menu_link' class='active'><i class='$h->menu_icon'></i>$h->menu_name <div class='arrow-down'></div></a>";
					$hasil .= "<a href='".$link_url."' class='active'><i class='".$h['menu_icon']."'></i>".$h['menu_name']." ";
				}
				else{
					$hasil .= "<a href='".$link_url."'><i class='".$h['menu_icon']."'></i>".$h['menu_name']." ";
				}
			/*}
			else{
				if($h['menu_link'] == $this->uri->segment(1) || $h['menu_link'] == $this->uri->segment(1)."/".$this->uri->segment(2)){
					//$hasil .= "<li class='$clas'><a href='$h->menu_link' class='active'><i class='$h->menu_icon'></i>$h->menu_name <div class='arrow-down'></div></a>";
					$hasil .= "<a href='".$h['menu_link']."' class='active'>".$h['menu_name']." ";
				}
				else{
					$hasil .= "<a href='".$h['menu_link']."'>".$h['menu_name']." ";
				}
			}*/
				

			if ($h["menu_child"] > 0) {
				$hasil .= "<div class='arrow-down'></div>";
			}

			$hasil .= " </a>";

			if ($h["menu_child"] > 0) {
				$hasil = $this->menu($h["menu_id"],$hasil,$c="submenu");
			}

			$hasil .= "</li>";
		
		}
		
		if ($parent > 0) {
			$hasil .= "</ul>";
		}

		return $hasil;
	}
	// ------------------------------------------------
    function logoff()
    {
    	$this->session->sess_destroy();
		redirect(base_url('Attendance'));
    }
	
}

?>