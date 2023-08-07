<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LandingPage extends CI_Controller {

	public function __construct(){    
		parent::__construct();  
	}
	public function index(){  
			$data = [];
			$this->load->view('landing_page',$data);
	} 
}
