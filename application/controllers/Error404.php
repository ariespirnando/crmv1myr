<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error404 extends CI_Controller { 
	public function index()
	{ 
		$this->load->model(array('Model_auth')); 
		$this->Model_auth->history(base64_decode($this->session->userdata('guid_ses')),'Error404');
		//$this->session->sess_destroy();
		$this->load->view('pages_error404'); 
	}
	public function clear(){
		$this->session->sess_destroy();
		redirect(site_url('auth')); 
	}
}
