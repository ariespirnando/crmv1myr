<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keluhancs extends CI_Controller {

	public function __construct(){    
		parent::__construct();   
		if($this->session->userdata('kodeuser_ses')){   
			$role = base64_decode($this->session->userdata('role_ses')); 
			switch ($role) {
				case "U-CS": 
					break;  
				default:
					redirect(site_url('auth')); 
			} 
		}else{
			redirect(site_url('auth')); 
		} 

		 
		$this->load->model(array('Model_keluhan'));
		$this->load->library('pagination');
	  }

	    
	public function index()
	{  
		$data['modul'] = 'masterpengguna';  
		$search_text = "";
	    if($this->input->post('submit') != NULL ){
		  $search_text = $this->input->post('search'); 
		  //echo $search_text;exit;
	      $this->session->set_userdata(array("searchconsigne"=>$search_text));
	    }else{
	      if($this->session->userdata('searchconsigne') != NULL){
	        $search_text = $this->session->userdata('searchconsigne');
	      }
		}
		
	    if($this->input->post('reset') != NULL ){
	      $search_text = '';
	      $this->session->set_userdata(array("searchconsigne"=>$search_text));
		} 

        $config['base_url'] = site_url('konsiyasi/index');   
        $config['per_page'] = 12;  //show record per halaman
		$config["uri_segment"] = 3;  // uri parameter  
		$config['prev_link'] = FALSE;
		$config['next_link'] = FALSE;  
		$config['first_link'] = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>';
		$config['last_link'] = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg>';
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_open'] = '<li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_open'] = '<li>';

		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;  
		$data['search'] = $search_text; 
		if($search_text==""){
			$config['total_rows'] = $this->Model_keluhan->count_all(); 
			$data['dataconsigne'] = $this->Model_keluhan->list_all_data($data['page'],$config['per_page']);
		}else{
			$config['total_rows'] = $this->Model_keluhan->count_all_search($search_text);  
			$data['dataconsigne'] = $this->Model_keluhan->list_all_data_search($search_text,$data['page'],$config['per_page']);
		} 

		$this->pagination->initialize($config); 
		$data['pagination'] = $this->pagination->create_links();   
        $this->template->load('template/template','keluhan/view', $data); 
		
	}


    public function view_keluhan()
	  {   
		  $data['guid_keluhan'] = $this->uri->segment(3);
		  $data['dtkeluhan'] = $this->Model_keluhan->get_firstdata($this->uri->segment(3));
		  $data['modul'] = 'masterpengguna';  
		  $search_text = "";
		  if($this->input->post('submit') != NULL ){
			$search_text = $this->input->post('search'); 
			//echo $search_text;exit;
			$this->session->set_userdata(array("searchproduk"=>$search_text));
		  }else{
			if($this->session->userdata('searchproduk') != NULL){
			  $search_text = $this->session->userdata('searchproduk');
			}
		  }
		  
		  if($this->input->post('reset') != NULL ){
			$search_text = '';
			$this->session->set_userdata(array("searchproduk"=>$search_text));
		  } 
  
		  $config['base_url'] = site_url('konsiyasi/add_produk/'.$this->uri->segment(3).'/');   
		  $config['per_page'] = 12;  //show record per halaman
		  $config["uri_segment"] = 4;  // uri parameter  
		  $config['prev_link'] = FALSE;
		  $config['next_link'] = FALSE;  
		  $config['first_link'] = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>';
		  $config['last_link'] = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg>';
		  $config['full_tag_open'] = '<ul class="pagination">';
		  $config['full_tag_close'] = '</ul>';
		  $config['num_tag_open'] = '<li>';
		  $config['num_tag_close'] = '</li>';
		  $config['cur_tag_open'] = '<li class="active"><a href="#">';
		  $config['cur_tag_close'] = '</a></li>';
		  $config['prev_tag_open'] = '<li>';
		  $config['prev_tag_close'] = '</li>';
		  $config['next_tag_open'] = '<li>';
		  $config['next_tag_close'] = '</li>';
		  $config['last_tag_open'] = '<li>';
		  $config['last_tag_open'] = '<li>';
		  $config['first_tag_open'] = '<li>';
		  $config['first_tag_open'] = '<li>';
  
		  $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;  
		  $data['search'] = ""; 
		  if($search_text==""){
			  $config['total_rows'] = $this->Model_keluhan->count_all_dt($this->uri->segment(3)); 
			  $data['datasiswa'] = $this->Model_keluhan->list_all_data_dt($this->uri->segment(3),$data['page'],$config['per_page']);
		  } 
  
		  $this->pagination->initialize($config); 
		  $data['pagination'] = $this->pagination->create_links();   
		  $this->template->load('template/template','keluhan/view_detail', $data); 
		  
	  }

	  function addresponse(){
		$guid_user = $this->input->post('guiduser'); 
		$reply = $this->input->post('alamat'); 
		$guid_keluhan = $this->input->post('guidkeluhan');  
		$dts = $this->Model_keluhan->get_firstdataemail($guid_keluhan );

		$data['nama'] = $dts['nama_consigne'];
		$data['response'] = $reply;
		$data['guid_keluhan'] = $guid_keluhan;
		$data['menanggapi'] = $dts['descripsi'];
		$data['tanggalkeluhan'] = $dts['tgl_keluhan'];
		
        // Load library email dan konfigurasinya
		$config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => '',  // Email gmail
            'smtp_pass'   => '',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];
        $this->load->library('email', $config);

        // Email dan nama pengirim
        $this->email->from('no-reply@masrud.com', 'Mayora');

        // Email penerima
        $this->email->to($dts['email']); // Ganti dengan email tujuan
 
        // Subject email
        $this->email->subject('Tanggapan Keluhan | Mayora');

        // Isi email
        $this->email->message($this->load->view('email',$data, TRUE));

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) { 

			$dataSimpan = array( 
				'guid_user'=>$guid_user,   
				'reply'=>$reply,  
				'guid_keluhan'=>$guid_keluhan, 
				'date_reply' =>date('Y-m-d H:i:s'), 
				'tipe' =>'CS',
			);
			$insert = $this->db->insert('dt_keluhan_replay',$dataSimpan);   
	
			if($insert){  
				$this->db->where('guid_keluhan',$guid_keluhan);
				$this->db->update('dt_keluhan',array('tgl_response'=>date('Y-m-d H:i:s')));  
			}  

			$this->session->set_flashdata('message', 'Tanggapan berhasil dikirim');
			$this->session->set_flashdata('info', '1'); 

        } else {
            echo 'Error! email tidak dapat dikirim.';

			$this->session->set_flashdata('message', 'Gagal mengirim tanggapan ke consigne, pastikan email consigne terdaftar');
			$this->session->set_flashdata('info', '2'); 
        }
		
		redirect(site_url('/keluhancs/view_keluhan/'.$guid_keluhan)); 
	  } 
}
