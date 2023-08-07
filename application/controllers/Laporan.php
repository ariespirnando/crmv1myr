<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct(){    
		parent::__construct();  
		if($this->session->userdata('kodeuser_ses')){   
			$role = base64_decode($this->session->userdata('role_ses')); 
			switch ($role) {
				case "U-ADMIN": 
					break;  
				default:
					redirect(site_url('auth')); 
			} 
		}else{
			redirect(site_url('auth')); 
		}   
		 
		$this->load->library('pagination');
	  }
	 
	public function index()
	{  
		$data['modul'] = 'masterlaporan';  
		$data['loaddt'] = $this->db->query("CALL `jumlahloginperbulan`()")->result_array(); 
        $this->template->load('template/template','laporan/view', $data);  
	}
}
