<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promosi extends CI_Controller {

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

 
		
		$this->load->model(array('Model_promosi'));
		$this->load->library('pagination');
	  }
	
	function add(){ 
		$nama_promosi = $this->input->post('nama_promosi');
		$clasifikasi = $this->input->post('clasifikasi');
		$isi_promosi = $this->input->post('isi_promosi');  
 
		$cek = 0;//$this->Model_promosi->cekpromosi($nama_promosi);
		if($cek>0){
			$this->session->set_flashdata('message', 'Promosi sudah tersedia');
			$this->session->set_flashdata('info', '2'); 
		}else{ 
			$dataSimpan = array(
				'kode_promosi'=>generate_kode('PN'),  
				'nama_promosi'=>$nama_promosi, 
				'clasifikasi'=>$clasifikasi, 
				'isi_promosi'=>$isi_promosi, 
				'tgl_posting'=>date('Y-m-d H:i:s'), 
				'guid_promosi'=>generate_guid(), 
			);
			$insert = $this->db->insert('dt_promosi',$dataSimpan);
			if($insert){ 
				$this->db->query("call insert_aktifitas('".base64_decode($this->session->userdata('kodeuser_ses'))."','Menambahkan Promosi atau Informasi')");  
				$this->session->set_flashdata('message', 'Promosi berhasil ditambahkan');
				$this->session->set_flashdata('info', '1'); 
			}else{
				$this->session->set_flashdata('message', 'Promosi gagal ditambahkan');
				$this->session->set_flashdata('info', '2'); 
			} 
		} 
		redirect(site_url('promosi')); 
	}

	function delete(){
		$guid_promosi = $this->input->post('guid_promosi');
		$promosi = $this->Model_promosi->get_firstdata($guid_promosi);

		$this->db->where('guid_promosi',$guid_promosi);
		$insert = $this->db->update('dt_promosi',array('ideleted'=>1));
		if($insert){ 
			$this->db->query("call insert_aktifitas('".base64_decode($this->session->userdata('kodeuser_ses'))."','Menghapus Promosi atau Informasi')"); 
			$this->session->set_flashdata('message', 'Promosi <b>'.$promosi['nama_promosi'].'</b> berhasil dihapus');
			$this->session->set_flashdata('info', '1'); 
		}else{
			$this->session->set_flashdata('message', 'Promosi <b>'.$promosi['nama_promosi'].'</b> gagal dihapus');
			$this->session->set_flashdata('info', '2'); 
		} 
		redirect(site_url('promosi')); 
	}
	function edit(){
		$guid_promosi = $this->input->post('guid_promosi'); 
		$nama_promosi_bef = $this->input->post('nama_promosi_bef'); 
		$nama_promosi = $this->input->post('nama_promosi');  
		$clasifikasi = $this->input->post('clasifikasi');
		$isi_promosi = $this->input->post('isi_promosi');  
		$status = $this->input->post('status');  
		
		if($nama_promosi_bef==$nama_promosi){
			$cek = 0;
		}else{
			$cek = $this->Model_promosi->cekpromosi($nama_promosi);
		}

		if($cek>0){
			$this->session->set_flashdata('message', 'Promosi <b>'.$nama_promosi.'</b> sudah tersedia');
			$this->session->set_flashdata('info', '2'); 
		}else{ 
			$dataSimpan = array( 
				'nama_promosi'=>$nama_promosi, 
				'clasifikasi'=>$clasifikasi, 
				'isi_promosi'=>$isi_promosi, 
				'status'=> $status,
			);
			$this->db->where('guid_promosi',$guid_promosi);
			$insert = $this->db->update('dt_promosi',$dataSimpan);
			if($insert){ 
				$this->db->query("call insert_aktifitas('".base64_decode($this->session->userdata('kodeuser_ses'))."','Mengubah Promosi atau Informasi')");
				$this->session->set_flashdata('message', 'Promosi <b>'.$nama_promosi.'</b> berhasil diubah');
				$this->session->set_flashdata('info', '1'); 
			}else{
				$this->session->set_flashdata('message', 'Promosi <b>'.$nama_promosi.'</b> gagal diubah');
				$this->session->set_flashdata('info', '2'); 
			} 
		} 
		redirect(site_url('promosi')); 
	}

	function loadedit(){
		$guid_promosi = $this->input->post('q'); 
		$data['loaddata'] = $this->Model_promosi->get_firstdata($guid_promosi);
		$this->load->view('promosi/modal_edit',$data);
	}
	public function index()
	{  	
		$role = base64_decode($this->session->userdata('role_ses'));
		if($role=="U-CS"){ 
			$data['modul'] = 'masterumum';  
			$search_text = "";
			if($this->input->post('submit') != NULL ){
			$search_text = $this->input->post('search'); 
			//echo $search_text;exit;
			$this->session->set_userdata(array("searchpromosi"=>$search_text));
			}else{
			if($this->session->userdata('searchpromosi') != NULL){
				$search_text = $this->session->userdata('searchpromosi');
			}
			}
			
			if($this->input->post('reset') != NULL ){
			$search_text = '';
			$this->session->set_userdata(array("searchpromosi"=>$search_text));
			} 

			$config['base_url'] = site_url('promosi/index');   
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
				$config['total_rows'] = $this->Model_promosi->count_all(); 
				$data['datasiswa'] = $this->Model_promosi->list_all_data($data['page'],$config['per_page']);
			}else{
				$config['total_rows'] = $this->Model_promosi->count_all_search($search_text);  
				$data['datasiswa'] = $this->Model_promosi->list_all_data_search($search_text,$data['page'],$config['per_page']);
			} 

			$this->pagination->initialize($config); 
			$data['pagination'] = $this->pagination->create_links();   
			$this->template->load('template/template','promosi/view', $data); 
		}else{
			redirect(site_url('promosi/url-error404'));
		}
		
	}

	public function informasi()
	{  	$role = base64_decode($this->session->userdata('role_ses'));
		if($role!="U-CS"){ 
			$data['modul'] = 'informasi';  
			$search_text = "";
			if($this->input->post('submit') != NULL ){
			$search_text = $this->input->post('search'); 
			//echo $search_text;exit;
			$this->session->set_userdata(array("searchpromosii"=>$search_text));
			}else{
			if($this->session->userdata('searchpromosii') != NULL){
				$search_text = $this->session->userdata('searchpromosii');
			}
			}
			
			if($this->input->post('reset') != NULL ){
			$search_text = '';
			$this->session->set_userdata(array("searchpromosii"=>$search_text));
			} 

			$config['base_url'] = site_url('promosi/informasi');   
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
				$config['total_rows'] = $this->Model_promosi->count_all(); 
				$data['datasiswa'] = $this->Model_promosi->list_all_data($data['page'],$config['per_page']);
			}else{
				$config['total_rows'] = $this->Model_promosi->count_all_search($search_text);  
				$data['datasiswa'] = $this->Model_promosi->list_all_data_search($search_text,$data['page'],$config['per_page']);
			} 

			$this->pagination->initialize($config); 
			$data['pagination'] = $this->pagination->create_links();   
			$this->template->load('template/template','promosi/view_informasi', $data); 
		}else{
			redirect(site_url('promosi/url-error404'));
		}
		
	}
}
