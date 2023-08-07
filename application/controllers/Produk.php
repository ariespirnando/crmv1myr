<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

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
 
		
		$this->load->model(array('Model_produk'));
		$this->load->library('pagination');
	  }
	
	function add(){
		$kode_produk = $this->input->post('kodeproduk'); 
		$nama_produk = $this->input->post('produk');  
 
		$cek = $this->Model_produk->cekproduk($kode_produk);
		if($cek>0){
			$this->session->set_flashdata('message', 'Produk <b>'.$nama_produk.'</b> sudah tersedia');
			$this->session->set_flashdata('info', '2'); 
		}else{ 
			$dataSimpan = array(
				'kode_produk'=>generate_kode('PR'),  
				'akronim'=>$kode_produk,  
				'nama_produk'=>$nama_produk, 
				'guid_produk'=>generate_guid(), 
			);
			$insert = $this->db->insert('dt_produk',$dataSimpan);
			if($insert){ 
				$this->db->query("call insert_aktifitas('".base64_decode($this->session->userdata('kodeuser_ses'))."','Menambah mata produk ".$nama_produk."')");
				$this->session->set_flashdata('message', 'Produk <b>'.$nama_produk.'</b> berhasil ditambahkan');
				$this->session->set_flashdata('info', '1'); 
			}else{
				$this->session->set_flashdata('message', 'Produk <b>'.$nama_produk.'</b> gagal ditambahkan');
				$this->session->set_flashdata('info', '2'); 
			} 
		} 
		redirect(site_url('produk')); 
	}

	function delete(){
		$guid_produk = $this->input->post('guid_produk');
		$produk = $this->Model_produk->get_firstdata($guid_produk);

		$this->db->where('guid_produk',$guid_produk);
		$insert = $this->db->update('dt_produk',array('ideleted'=>1));
		if($insert){ 
			$this->db->query("call insert_aktifitas('".base64_decode($this->session->userdata('kodeuser_ses'))."','Menghapus mata produk ".$produk['nama_produk']."')");
			$this->session->set_flashdata('message', 'Produk <b>'.$produk['nama_produk'].'</b> berhasil dihapus');
			$this->session->set_flashdata('info', '1'); 
		}else{
			$this->session->set_flashdata('message', 'Produk <b>'.$produk['nama_produk'].'</b> gagal dihapus');
			$this->session->set_flashdata('info', '2'); 
		} 
		redirect(site_url('produk')); 
	}
	function edit(){
		$guid_produk = $this->input->post('guid_produk');
		$kode_produk_bef = $this->input->post('kode_produk_bef');

		$kode_produk = $this->input->post('kodeproduk'); 
		$nama_produk = $this->input->post('produk'); 
		$status = $this->input->post('status');  

		if($kode_produk_bef==$kode_produk){
			$cek = 0;
		}else{
			$cek = $this->Model_produk->cekproduk($kode_produk);
		}

		if($cek>0){
			$this->session->set_flashdata('message', 'Produk <b>'.$nama_produk.'</b> sudah tersedia');
			$this->session->set_flashdata('info', '2'); 
		}else{ 
			$dataSimpan = array(
				'akronim'=>$kode_produk, 
				'nama_produk'=>$nama_produk,  
				'status'=> $status,
			);
			$this->db->where('guid_produk',$guid_produk);
			$insert = $this->db->update('dt_produk',$dataSimpan);
			if($insert){ 
				$this->db->query("call insert_aktifitas('".base64_decode($this->session->userdata('kodeuser_ses'))."','Mengubah mata produk ".$nama_produk."')");
				$this->session->set_flashdata('message', 'Produk <b>'.$nama_produk.'</b> berhasil diubah');
				$this->session->set_flashdata('info', '1'); 
			}else{
				$this->session->set_flashdata('message', 'Produk <b>'.$nama_produk.'</b> gagal diubah');
				$this->session->set_flashdata('info', '2'); 
			} 
		} 
		redirect(site_url('produk')); 
	}

	function loadedit(){
		$guid_produk = $this->input->post('q'); 
		$data['loaddata'] = $this->Model_produk->get_firstdata($guid_produk);
		$this->load->view('produk/modal_edit',$data);
	}
	public function index()
	{  
		$data['modul'] = 'masterkurikulum';  
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

        $config['base_url'] = site_url('produk/index');   
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
			$config['total_rows'] = $this->Model_produk->count_all(); 
			$data['datasiswa'] = $this->Model_produk->list_all_data($data['page'],$config['per_page']);
		}else{
			$config['total_rows'] = $this->Model_produk->count_all_search($search_text);  
			$data['datasiswa'] = $this->Model_produk->list_all_data_search($search_text,$data['page'],$config['per_page']);
		} 

		$this->pagination->initialize($config); 
		$data['pagination'] = $this->pagination->create_links();   
        $this->template->load('template/template','produk/view', $data); 
		
	}
}
