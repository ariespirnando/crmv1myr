<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LandingPage extends CI_Controller {

	public function __construct(){     
		//
		parent::__construct();  
		$this->load->model(array('Model_keluhan','Model_consigne')); 
	}
	public function index(){  
			$data = [];
			$this->load->view('landing_page',$data);
	} 
	public function keluhan(){  
		$data = [];
		$this->load->view('landing_pagekeluhan',$data);
	} 
	public function rkeluhan(){  
		$data['tiket'] = $this->uri->segment(3);
		$this->load->view('landing_pagerkeluhan',$data);
	} 

	public function keluhanAdd(){  
		$email = $this->input->post('email');   
		$keterangan = $this->input->post('keterangan');  
		if($this->Model_consigne->cekemail($email) > 0 ){ 
			$consigne = $this->Model_consigne->cekemailDt($email); 
			$dataSimpan = array( 
				'guid_consigne'=>$consigne['guid_consigne'],   
				'descripsi'=>$keterangan,  
				'guid_keluhan'=>generate_guid(), 
				'tgl_keluhan' =>date('Y-m-d H:i:s'), 
			);
			$insert = $this->db->insert('dt_keluhan',$dataSimpan);   

			$this->session->set_flashdata('message', 'Keluhan telah disampaikan, silahkan cek email secara berkala untuk tindakan lebih lanjut dari kami, Terimakasih');
			$this->session->set_flashdata('info', '1'); 
		}else{
			$this->session->set_flashdata('message', '<b>'.$email.'</b> tidak terdaftar');
			$this->session->set_flashdata('info', '2'); 
		} 
		redirect(site_url('/landingpage/keluhan')); 
 
	} 
	public function rkeluhanAdd(){  
		$guid_keluhan = $this->input->post('tiket');   
		$reply = $this->input->post('keterangan');  

		$dataSimpan = array( 
			'guid_user'=>"",   
			'reply'=>$reply,  
			'guid_keluhan'=>$guid_keluhan, 
			'date_reply' =>date('Y-m-d H:i:s'), 
			'tipe' =>'NON',
		);
		$insert = $this->db->insert('dt_keluhan_replay',$dataSimpan);    
		redirect(site_url('/landingpage'));  
	} 
}
