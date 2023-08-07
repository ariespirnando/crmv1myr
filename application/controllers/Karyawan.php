<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

	public function __construct(){    
		parent::__construct();  
		if($this->session->userdata('kodeuser_ses')){   
			$role = base64_decode($this->session->userdata('role_ses')); 
			switch ($role) {
				case "U-ADMIN": 
					break; 
				case "U-KEPSEK": 
					break; 
				case "U-KURIKULUM": 
					break; 
				default:
					redirect(site_url('auth')); 
			} 
		}else{
			redirect(site_url('auth')); 
		}  
 
		$this->load->model(array('Model_karyawan'));
		$this->load->library('pagination');
	  }
	 
	function add(){ 
		$nama_karyawan = $this->input->post('karyawan');  
		$nik_karyawan = $this->input->post('nik_karyawan');  
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$alamat = $this->input->post('alamat');
		$nohandpone = $this->input->post('nohandpone');
		$email = $this->input->post('email'); 
		$jenis_karyawan = $this->input->post('jenis_karyawan');

		$tanggal_lahir = $this->input->post('tanggal_lahir');
		$tempat_lahir = $this->input->post('tempat_lahir');
		$pendidikan_terakhir = $this->input->post('pendidikan_terakhir');
		$jurusan = $this->input->post('jurusan'); 

		$cek = $this->Model_karyawan->cekkaryawan($nama_karyawan,$tanggal_lahir); 
		$cek2 = $this->Model_karyawan->cekemail($email); 
		if($cek>0){
			$this->session->set_flashdata('message', '<b>'.$nama_karyawan.'</b> sudah tersedia');
			$this->session->set_flashdata('info', '2'); 
		}else if($cek2>0){
			$this->session->set_flashdata('message', '<b>'.$email.'</b> sudah digunakan');
			$this->session->set_flashdata('info', '2');  
		}else{ 
			$kode_karyawan = generate_kode('PG');
			$dataSimpan = array(
				'tanggal_lahir'=>$tanggal_lahir, 
				'tempat_lahir'=>$tempat_lahir, 
				'pendidikan_terakhir'=>$pendidikan_terakhir, 
				'jurusan'=>$jurusan, 
				'kode_karyawan'=>$kode_karyawan,  
				'nama_karyawan'=>$nama_karyawan,
				'jenis_kelamin'=>$jenis_kelamin,
				'nik_karyawan'=>$nik_karyawan, 
				'alamat'=>$alamat,
				'nohandpone'=>$nohandpone, 
				'guid_groups'=>$jenis_karyawan,
				'guid_karyawan'=>generate_guid(), 
			);
			$insert = $this->db->insert('dt_karyawan',$dataSimpan);
			if($insert){  
				$username = generate_username($nama_karyawan);
				$password = generate_pw($username); 
				$dataAuth = array(
					'guid_user'=>generate_guid(),  
					'guid_groups'=>$jenis_karyawan,
					'kode_user'=>$kode_karyawan,
					'username'=>$username,
					'password'=>$password, 
				);
				$insert = $this->db->insert('auth_user',$dataAuth); 
				if($email!=""){
					$dataEmail = array(
						'guid_email'=>generate_guid(),   
						'kode_user'=>$kode_karyawan, 
						'email'=>$email,  
					);
					$insert = $this->db->insert('auth_email',$dataEmail); 
				}

				$this->db->query("call insert_aktifitas('".base64_decode($this->session->userdata('kodeuser_ses'))."','Menambahkan staff baru An : ".$nama_karyawan."')"); 
				$this->db->query("call insert_notif('".$kode_karyawan."','Selamat, Anda sudah terdaftar di applikasi PJJ','')");
				

				$this->session->set_flashdata('message', '<b>'.$nama_karyawan.'</b> berhasil ditambahkan');
				$this->session->set_flashdata('info', '1'); 
			}else{
				$this->session->set_flashdata('message', '<b>'.$nama_karyawan.'</b> gagal ditambahkan');
				$this->session->set_flashdata('info', '2'); 
			} 
		} 
		redirect(site_url('karyawan')); 
	}

	function delete(){
		$guid_karyawan = $this->input->post('guid_karyawan');
		$karyawan = $this->Model_karyawan->get_firstdata($guid_karyawan);

		$this->db->where('guid_karyawan',$guid_karyawan);
		$insert = $this->db->update('dt_karyawan',array('ideleted'=>1));
		if($insert){ 
			#delete email
			$this->db->where('kode_user',$karyawan['kode_karyawan']);
			$this->db->update('auth_email',array('ideleted'=>1));

			#delete user
			$this->db->where('guid_groups',$karyawan['guid_groups']);
			$this->db->where('kode_user',$karyawan['kode_karyawan']);
			$this->db->update('auth_user',array('ideleted'=>1));

			$this->db->query("call insert_aktifitas('".base64_decode($this->session->userdata('kodeuser_ses'))."','Menghapus data staff An : ".$karyawan['nama_karyawan']."')");  

			$this->session->set_flashdata('message', '<b>'.$karyawan['nama_karyawan'].'</b> berhasil dihapus');
			$this->session->set_flashdata('info', '1'); 
		}else{
			$this->session->set_flashdata('message', '<b>'.$karyawan['nama_karyawan'].'</b> gagal dihapus');
			$this->session->set_flashdata('info', '2'); 
		} 
		redirect(site_url('karyawan')); 
	}
	function resetpass(){
		$guid_user = $this->input->post('guid_user');
		$user = $this->Model_karyawan->get_firstdata_userreset($guid_user);  
		$karyawan = $this->Model_karyawan->get_firstdata_kode($user['kode_user']);

		$this->db->where('guid_user',$guid_user);
		$insert = $this->db->update('auth_user',array('password'=>generate_pw($user['username'])));  

		// $guid_karyawan = $this->input->post('guid_karyawan');
		// $karyawan = $this->Model_karyawan->get_firstdata($guid_karyawan);

		// $this->db->where('guid_karyawan',$guid_karyawan);
		// $insert = $this->db->update('dt_karyawan',array('password'=>generate_pw($karyawan['username'])));
 
		if($insert){ 
			$this->db->query("call insert_aktifitas('".base64_decode($this->session->userdata('kodeuser_ses'))."','Mereset password siswa An : ".$karyawan['nama_karyawan']."')"); 
			$this->db->query("call insert_notif('".$karyawan['kode_karyawan']."','Password anda sudah direset ke pengaturan awal','')");

			$this->session->set_flashdata('message', 'Password <b>'.$karyawan['nama_karyawan'].'</b> berhasil diperbaharui');
			$this->session->set_flashdata('info', '1'); 
		}else{
			$this->session->set_flashdata('message', 'Password <b>'.$karyawan['nama_karyawan'].'</b> gagal diperbaharui');
			$this->session->set_flashdata('info', '2'); 
		} 
		redirect(site_url('karyawan')); 
	}
	function edit(){
		$guid_karyawan = $this->input->post('guid_karyawan');
		$nama_karyawan_bef = $this->input->post('karyawan_bef');   
		$email_bef = $this->input->post('email_bef'); 

		$kode_karyawan = $this->input->post('kode_karyawan'); 
		$nik_karyawan = $this->input->post('nik_karyawan'); 
		$nama_karyawan = $this->input->post('karyawan'); 
		$status = $this->input->post('status'); 
		$jenis_kelamin = $this->input->post('jenis_kelamin');  
		$alamat = $this->input->post('alamat');
		$nohandpone = $this->input->post('nohandpone');
		$email = $this->input->post('email'); 
		$jenis_karyawan = $this->input->post('jenis_karyawan');

		$tanggal_lahir = $this->input->post('tanggal_lahir');
		$tanggal_lahir_bef = $this->input->post('tanggal_lahir_bef');
		
		$tempat_lahir = $this->input->post('tempat_lahir');
		$pendidikan_terakhir = $this->input->post('pendidikan_terakhir');
		$jurusan = $this->input->post('jurusan'); 
		
		if($nama_karyawan_bef==$nama_karyawan && $tanggal_lahir==$tanggal_lahir_bef){
			$cek  = 0; 
		}else{
			$cek = $this->Model_karyawan->cekkaryawan($nama_karyawan,$tanggal_lahir); 
		}

		$ivalidmail=0;
		if($email_bef==$email){
			$cek2 = 0;
		}else{
			$cek2 = $this->Model_karyawan->cekemail($email); 
			$ivalidmail =1;
		}
 
		if($cek>0){
			$this->session->set_flashdata('message', 'Pegawai <b>'.$nama_karyawan.'</b> sudah tersedia');
			$this->session->set_flashdata('info', '2'); 
		}else if($cek2>0){
			$this->session->set_flashdata('message', '<b>'.$email.'</b> sudah digunakan');
			$this->session->set_flashdata('info', '2'); 
		}else{ 
			$dataSimpan = array( 
				'tanggal_lahir'=>$tanggal_lahir, 
				'tempat_lahir'=>$tempat_lahir, 
				'pendidikan_terakhir'=>$pendidikan_terakhir, 
				'jurusan'=>$jurusan, 
				'nik_karyawan'=>$nik_karyawan,
				'nama_karyawan'=>$nama_karyawan,  
				'jenis_kelamin'=>$jenis_kelamin,
				'alamat'=>$alamat, 
				'nohandpone'=>$nohandpone, 
				'status'=> $status,
			);
			$this->db->where('guid_karyawan',$guid_karyawan);
			$insert = $this->db->update('dt_karyawan',$dataSimpan);
			if($insert){ 

				$ilock = 0;
				if($status!="Active"){ 
					$ilock = 1;
				} 
				#lock email
				// $this->db->where('kode_user',$kode_karyawan);
				// $this->db->update('auth_email',array('ilock'=>$ilock,'email'=>$email)); 

				if($this->Model_karyawan->cekemail_kode($kode_karyawan)>0){
					$this->db->where('kode_user',$kode_karyawan);
					if($ivalidmail==1){
						#kalo email baru gx sama update valid nya jadi 0 lagi biar diverifikasi ulang
						$this->db->update('auth_email',array('ilock'=>$ilock,'email'=>$email,'ivalid'=>0)); 
					}else{
						$this->db->update('auth_email',array('ilock'=>$ilock,'email'=>$email)); 
					} 
				}else{
					$dataEmail = array(
						'guid_email'=>generate_guid(),   
						'kode_user'=>$kode_karyawan, 
						'email'=>$email,  
						'ilock'=>$ilock,
					);
					$insert = $this->db->insert('auth_email',$dataEmail); 
				} 

				$this->db->query("call insert_aktifitas('".base64_decode($this->session->userdata('kodeuser_ses'))."','Mengubah data staff An : ".$nama_karyawan."')"); 
				$this->db->query("call insert_notif('".$kode_karyawan."','Data pengguna Anda telah diubah oleh Admin Aplikasi PJJ','')");
				
				#lock user
				$this->db->where('guid_groups',$jenis_karyawan);
				$this->db->where('kode_user',$kode_karyawan);
				$this->db->update('auth_user',array('ilock'=>$ilock));

				$this->session->set_flashdata('message', '<b>'.$nama_karyawan.'</b> berhasil diubah');
				$this->session->set_flashdata('info', '1'); 
			}else{
				$this->session->set_flashdata('message', '<b>'.$nama_karyawan.'</b> gagal diubah');
				$this->session->set_flashdata('info', '2'); 
			} 
		} 
		redirect(site_url('karyawan')); 
	}

	function loadedit(){
		$guid_karyawan = $this->input->post('q'); 
		$data['role_in'] = $this->Model_karyawan->list_role_in();
		$data['loaddata'] = $this->Model_karyawan->get_firstdata($guid_karyawan);
		$this->load->view('karyawan/modal_edit',$data);
	}
	function loadview(){
		$guid_karyawan = $this->input->post('q'); 
		$data['role_in'] = $this->Model_karyawan->list_role_in();
		$data['loaddata'] = $this->Model_karyawan->get_firstdata($guid_karyawan);
		$this->load->view('karyawan/modal_view',$data);
	}
	public function index(){  
		$data['modul'] = 'masterpengguna2';  
		$search_text = "";
	    if($this->input->post('submit') != NULL ){
		  $search_text = $this->input->post('search'); 
		  //echo $search_text;exit;
	      $this->session->set_userdata(array("searchkaryawan"=>$search_text));
	    }else{
	      if($this->session->userdata('searchkaryawan') != NULL){
	        $search_text = $this->session->userdata('searchkaryawan');
	      }
		}
		
	    if($this->input->post('reset') != NULL ){
	      $search_text = '';
	      $this->session->set_userdata(array("searchkaryawan"=>$search_text));
		} 

        $config['base_url'] = site_url('karyawan/index');   
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
			$config['total_rows'] = $this->Model_karyawan->count_all(); 
			$data['datakaryawan'] = $this->Model_karyawan->list_all_data($data['page'],$config['per_page']);
		}else{
			$config['total_rows'] = $this->Model_karyawan->count_all_search($search_text);  
			$data['datakaryawan'] = $this->Model_karyawan->list_all_data_search($search_text,$data['page'],$config['per_page']);
		} 

		$this->pagination->initialize($config); 

		$data['role_in'] = $this->Model_karyawan->list_role_in();
		$data['pagination'] = $this->pagination->create_links();   
        $this->template->load('template/template','karyawan/view', $data); 
		
	}
}
