<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consigne extends CI_Controller {

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

		 
		$this->load->model(array('Model_consigne'));
		$this->load->library('pagination');
	  }
	
	function add(){ 
		$nama_consigne = $this->input->post('consigne');  
		 
		$alamat = $this->input->post('alamat');
		$nohandpone = $this->input->post('nohandpone');
		$email = $this->input->post('email');  
		
		$cek  = $this->Model_consigne->cekconsigne($nama_consigne);
		$cek2 = $this->Model_consigne->cekemail($email);

		if($cek>0){
			$this->session->set_flashdata('message', '<b>'.$nama_consigne.'</b> sudah tersedia');
			$this->session->set_flashdata('info', '2'); 
		}else if($cek>2){
			$this->session->set_flashdata('message', '<b>'.$email.'</b> sudah tersedia');
			$this->session->set_flashdata('info', '2');  
		}else{ 
			$kode_consigne = generate_kode('CS');
			$dataSimpan = array(
				'kode_consigne'=> $kode_consigne,  
				'nama_consigne'=>ucwords(strtolower($nama_consigne)), 
				'alamat'=>$alamat,
				'nohandpone'=>$nohandpone,  
				'guid_consigne'=>generate_guid(), 
			);
			$insert = $this->db->insert('dt_consigne',$dataSimpan);
			if($insert){ 
				$username = $kode_consigne;
				$password = generate_pw($username); 
				$dataAuth = array(
					'guid_user'=>generate_guid(),  
					'guid_groups'=>'CA1971FA2675',
					'kode_user'=>$kode_consigne,
					'username'=>$username,
					'password'=>$password, 
				);
				$insert = $this->db->insert('auth_user',$dataAuth); 

				if($email != ""){
					$dataEmail = array(
						'guid_email'=>generate_guid(),   
						'kode_user'=>$kode_consigne, 
						'email'=>$email,  
					);
					$insert = $this->db->insert('auth_email',$dataEmail); 
				}

				$this->db->query("call insert_aktifitas('".base64_decode($this->session->userdata('kodeuser_ses'))."','Menambahkan consigne baru An : ".ucwords(strtolower($nama_consigne))."')"); 
            	$this->db->query("call insert_notif('".$kode_consigne."','Selamat, Anda sudah terdaftar di applikasi PJJ','')");

				$this->session->set_flashdata('message', '<b>'.$nama_consigne.'</b> berhasil ditambahkan');
				$this->session->set_flashdata('info', '1'); 
			}else{
				$this->session->set_flashdata('message', '<b>'.$nama_consigne.'</b> gagal ditambahkan');
				$this->session->set_flashdata('info', '2'); 
			} 
		} 
		redirect(site_url('consigne')); 
	}

	function delete(){
		$guid_consigne = $this->input->post('guid_consigne');
		$consigne = $this->Model_consigne->get_firstdata($guid_consigne);

		$this->db->where('guid_consigne',$guid_consigne);
		$insert = $this->db->update('dt_consigne',array('ideleted'=>1));
		if($insert){ 
			#delete email
			$this->db->where('kode_user',$consigne['kode_consigne']);
			
			$this->db->update('auth_email',array('ideleted'=>1));

			#delete user 
			$this->db->where('kode_user',$consigne['kode_consigne']);
			$this->db->update('auth_user',array('ideleted'=>1));

			$this->db->query("call insert_aktifitas('".base64_decode($this->session->userdata('kodeuser_ses'))."','Menghapus data consigne An : ".ucwords(strtolower($consigne['nama_consigne']))."')");  

			$this->session->set_flashdata('message', 'Consigne An : <b>'.$consigne['nama_consigne'].'</b> berhasil dihapus');
			$this->session->set_flashdata('info', '1'); 
		}else{
			$this->session->set_flashdata('message', 'Consigne An : <b>'.$consigne['nama_consigne'].'</b> gagal dihapus');
			$this->session->set_flashdata('info', '2'); 
		} 
		redirect(site_url('consigne')); 
	}
	function resetpass(){
		$guid_user = $this->input->post('guid_user');
		$user = $this->Model_consigne->get_firstdata_userreset($guid_user);
		$consigne = $this->Model_consigne->get_firstdata_kode($user['kode_user']);

		$this->db->where('guid_user',$guid_user);
		$insert = $this->db->update('auth_user',array('password'=>generate_pw($user['username'])));  

		if($insert){  
			#harusnya email disini 
			$this->db->query("call insert_aktifitas('".base64_decode($this->session->userdata('kodeuser_ses'))."','Mereset password consigne An : ".$consigne['nama_consigne']."')"); 
            $this->db->query("call insert_notif('".$consigne['kode_consigne']."','Password anda sudah direset ke pengaturan awal','')");

			$this->session->set_flashdata('message', 'Password <b>'.$consigne['nama_consigne'].'</b> berhasil diperbaharui');
			$this->session->set_flashdata('info', '1'); 
		}else{
			$this->session->set_flashdata('message', 'Password <b>'.$consigne['nama_consigne'].'</b> gagal diperbaharui');
			$this->session->set_flashdata('info', '2'); 
		} 
		redirect(site_url('consigne')); 
	}
	function edit(){
		$kode_consigne = $this->input->post('kode_consigne');
		$guid_consigne = $this->input->post('guid_consigne'); 
		$nama_consigne = $this->input->post('consigne'); 
		$status = $this->input->post('status');  
		$alamat = $this->input->post('alamat'); 
		$email = $this->input->post('email'); 
		$email_bef = $this->input->post('email_bef'); 
 
		$nohandpone = $this->input->post('nohandpone');
		  
		$ivalidmail =0;
		if($email==$email_bef){
			$cek2 = 0; 
		}else{
			$cek2 = $this->Model_consigne->cekemail($email); 
			$ivalidmail =1;
		}
 
		if($cek2>0){
			$this->session->set_flashdata('message', '<b>'.$email.'</b> sudah tersedia');
			$this->session->set_flashdata('info', '2'); 
		}else{ 
			$dataSimpan = array( 
				'nohandpone'=>$nohandpone,  
				'nama_consigne'=>ucwords(strtolower($nama_consigne)), 
				'alamat'=>$alamat, 
				'status'=> $status,
			);
			$this->db->where('guid_consigne',$guid_consigne);
			$insert = $this->db->update('dt_consigne',$dataSimpan);
			if($insert){ 
				$ilock = 0;
				if($status!="Active"){ 
					$ilock = 1;
				} 

				#lock email 
				// $this->db->where('kode_user',$kode_consigne);
				// $this->db->update('auth_email',array('ilock'=>$ilock)); 

				if($this->Model_consigne->cekemail_kode($kode_consigne)>0){
					$this->db->where('kode_user',$kode_consigne);
					if($ivalidmail==1){
						#kalo email baru gx sama update valid nya jadi 0 lagi biar diverifikasi ulang
						$this->db->update('auth_email',array('ilock'=>$ilock,'email'=>$email,'ivalid'=>0)); 
					}else{
						$this->db->update('auth_email',array('ilock'=>$ilock,'email'=>$email)); 
					} 
				}else{
					$dataEmail = array(
						'guid_email'=>generate_guid(),   
						'kode_user'=>$kode_consigne, 
						'email'=>$email,  
						'ilock'=>$ilock,
					);
					$insert = $this->db->insert('auth_email',$dataEmail); 
				} 

				#lock user  
				$this->db->where('kode_user',$kode_consigne);
				$this->db->update('auth_user',array('ilock'=>$ilock));
				//$this->db->update('auth_user',array('ilock'=>$ilock,'username'=>$nik_consigne,'password'=>generate_pw($nik_consigne)));

				$this->db->query("call insert_aktifitas('".base64_decode($this->session->userdata('kodeuser_ses'))."','Mengubah data consigne An : ".ucwords(strtolower($nama_consigne))."')"); 
            	$this->db->query("call insert_notif('".$kode_consigne."','Data pengguna Anda telah diubah oleh Admin Aplikasi PJJ','')");

				$this->session->set_flashdata('message', '<b>'.$nama_consigne.'</b> berhasil diubah');
				$this->session->set_flashdata('info', '1'); 
			}else{
				$this->session->set_flashdata('message', '<b>'.$nama_consigne.'</b> gagal diubah');
				$this->session->set_flashdata('info', '2'); 
			} 
		} 
		redirect(site_url('consigne')); 
	}

	function loadedit(){
		$guid_consigne = $this->input->post('q'); 
		$data['loaddata'] = $this->Model_consigne->get_firstdata($guid_consigne);
		$this->load->view('consigne/modal_edit',$data);
	}
	function loadview(){
		$guid_consigne = $this->input->post('q'); 
		$data['loaddata'] = $this->Model_consigne->get_firstdata($guid_consigne);
		$this->load->view('consigne/modal_view',$data);
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

        $config['base_url'] = site_url('consigne/index');   
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
			$config['total_rows'] = $this->Model_consigne->count_all(); 
			$data['dataconsigne'] = $this->Model_consigne->list_all_data($data['page'],$config['per_page']);
		}else{
			$config['total_rows'] = $this->Model_consigne->count_all_search($search_text);  
			$data['dataconsigne'] = $this->Model_consigne->list_all_data_search($search_text,$data['page'],$config['per_page']);
		} 

		$this->pagination->initialize($config); 
		$data['pagination'] = $this->pagination->create_links();   
        $this->template->load('template/template','consigne/view', $data); 
		
	}
}
