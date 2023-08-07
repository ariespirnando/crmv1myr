<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Useraccount extends CI_Controller {

	public function __construct(){    
		parent::__construct();  
		if(!$this->session->userdata('kodeuser_ses')){    
			redirect(site_url('auth'));  
		}   
		$this->load->model(array('Model_consigne','Model_karyawan')); 
	  }
	 
	public function index()
	{  
		$data['modul'] = 'welcome';   
		$role = base64_decode($this->session->userdata('role_ses'));  ##Baca aja Sesionya 
        $kode_user = base64_decode($this->session->userdata('kodeuser_ses')); 
        switch ($role) { 
			default:
				$data['loaddata'] = $this->Model_karyawan->get_firstdata_kode_ac($kode_user);
				$this->template->load('template/template','useraccount/view_karyawan', $data);   
		}
        
	}

	public function updatepw(){
		$guid_user     = $this->input->post('guid_user'); 
		$kode_user     = $this->input->post('kode_user'); 
		$passwordlama  = $this->input->post('passwordlama'); 
		$username      = $this->input->post('username');  
		$passwordbaru  = $this->input->post('passwordbaru'); 
		
		$this->db->where('guid_user',$guid_user);
		$this->db->where('kode_user',$kode_user);
		$this->db->where('password',generate_pw($passwordlama));
		$cek = $this->db->get('auth_user')->num_rows();
		if($cek > 0){

			$this->db->where('guid_user',$guid_user);
			$this->db->where('kode_user',$kode_user);
			$this->db->update('auth_user',array('password'=>generate_pw($passwordbaru)));
			$this->db->query("call insert_notif('".$kode_user."','Password anda sudah diubah, apabila bukan anda silahkan hubungi Admin','')");
			$this->session->set_flashdata('message', 'Password sudah diubah');
			$this->session->set_flashdata('info', '1'); 
		}else{
			$this->session->set_flashdata('message', 'Password tidak ditemukan');
			$this->session->set_flashdata('info', '2'); 
		}
		redirect(site_url('useraccount')); 
	}
	public function updatekaryawan(){
		$guid_karyawan = $this->input->post('guid_karyawan');
		$nama_karyawan_bef = $this->input->post('karyawan_bef');   
		$email_bef = $this->input->post('email_bef'); 

		$kode_karyawan = $this->input->post('kode_karyawan'); 
		$nik_karyawan = $this->input->post('nik_karyawan'); 
		$nama_karyawan = $this->input->post('karyawan');  
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
			$this->session->set_flashdata('message', 'Nama sudah tersedia');
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
			);
			$this->db->where('guid_karyawan',$guid_karyawan);
			$insert = $this->db->update('dt_karyawan',$dataSimpan);
			if($insert){ 
 
				#lock email
				// $this->db->where('kode_user',$kode_karyawan);
				// $this->db->update('auth_email',array('ilock'=>$ilock,'email'=>$email)); 

				if($this->Model_karyawan->cekemail_kode($kode_karyawan)>0){
					$this->db->where('kode_user',$kode_karyawan);
					if($ivalidmail==1){
						$this->db->query("call insert_notif('".$kode_karyawan."','Email anda sudah diatur ulang, silakan verifikasi email anda','')");
						#kalo email baru gx sama update valid nya jadi 0 lagi biar diverifikasi ulang
						$this->db->update('auth_email',array('email'=>$email,'ivalid'=>0)); 
					}else{
						$this->db->update('auth_email',array('email'=>$email)); 
					} 
				}else{
					$dataEmail = array(
						'guid_email'=>generate_guid(),   
						'kode_user'=>$kode_karyawan, 
						'email'=>$email,   
					);
					$insert = $this->db->insert('auth_email',$dataEmail); 
				} 
 
				#lock user 

				$this->session->set_flashdata('message', 'Data berhasil diubah');
				$this->session->set_flashdata('info', '1'); 
			}else{
				$this->session->set_flashdata('message', 'Data gagal diubah');
				$this->session->set_flashdata('info', '2'); 
			} 

			redirect(site_url('useraccount')); 
		} 
	}

	public function updateconsigne(){
		$kode_consigne = $this->input->post('kode_consigne');
		$guid_consigne = $this->input->post('guid_consigne');
		$nik_consigne_bef = $this->input->post('nik_consigne_bef');  
		$nik_consigne = $this->input->post('nik_consigne'); 
		$nama_consigne = $this->input->post('consigne');  
		$jenis_kelamin = $this->input->post('jenis_kelamin');  
		$alamat = $this->input->post('alamat');
		$nohandpone = $this->input->post('nohandpone');
		$email = $this->input->post('email'); 
		$email_bef = $this->input->post('email_bef'); 

		$tanggal_lahir = $this->input->post('tanggal_lahir');
		$tempat_lahir = $this->input->post('tempat_lahir');
		
		if($nik_consigne_bef==$nik_consigne){
			$cek = 0;
		}else{
			$cek = $this->Model_consigne->cekconsigne($nik_consigne);
		}

		$ivalidmail =0;
		if($email==$email_bef){
			$cek2 = 0; 
		}else{
			$cek2 = $this->Model_consigne->cekemail($email); 
			$ivalidmail =1;
		}
 
		if($cek2>0){
			$this->session->set_flashdata('message', 'Nama sudah tersedia');
			$this->session->set_flashdata('info', '2'); 
		}else if($cek>0){
			$this->session->set_flashdata('message', 'Email sudah digunakan');
			$this->session->set_flashdata('info', '2'); 
		}else{ 
			$dataSimpan = array( 
				'tanggal_lahir'=>$tanggal_lahir, 
				'tempat_lahir'=>$tempat_lahir,
				'nik_consigne'=>$nik_consigne,   
				'nama_consigne'=>ucwords(strtolower($nama_consigne)),
				'jenis_kelamin'=>$jenis_kelamin,
				'alamat'=>$alamat,
				'nohandpone'=>$nohandpone,  
			);
			$this->db->where('guid_consigne',$guid_consigne);
			$insert = $this->db->update('dt_consigne',$dataSimpan);
			if($insert){  

				#lock email 
				// $this->db->where('kode_user',$kode_consigne);
				// $this->db->update('auth_email',array('ilock'=>$ilock)); 

				if($this->Model_consigne->cekemail_kode($kode_consigne)>0){
					$this->db->where('kode_user',$kode_consigne);
					if($ivalidmail==1){
						$this->db->query("call insert_notif('".$kode_consigne."','Email anda sudah diatur ulang, silakan verifikasi email anda','')");
						#kalo email baru gx sama update valid nya jadi 0 lagi biar diverifikasi ulang
						$this->db->update('auth_email',array('email'=>$email,'ivalid'=>0)); 
					}else{
						$this->db->update('auth_email',array('email'=>$email)); 
					} 
				}else{
					$dataEmail = array(
						'guid_email'=>generate_guid(),   
						'kode_user'=>$kode_consigne, 
						'email'=>$email,   
					);
					$insert = $this->db->insert('auth_email',$dataEmail); 
				} 

				#lock user   

				$this->db->query("call insert_aktifitas('".base64_decode($this->session->userdata('kodeuser_ses'))."','Mengubah data personal')"); 
            	 
				$this->session->set_flashdata('message', 'Data berhasil diubah');
				$this->session->set_flashdata('info', '1'); 
			}else{
				$this->session->set_flashdata('message', 'Data gagal diubah');
				$this->session->set_flashdata('info', '2'); 
			} 
		} 
		redirect(site_url('useraccount')); 

	}

	public function updatewaliswa(){
		$guid_waliconsigne = $this->input->post('guid_waliconsigne');
		$kode_waliconsigne = $this->input->post('kode_waliconsigne');
		
		$nama_waliconsigne_bef = $this->input->post('waliconsigne_bef');  
		$nama_waliconsigne = $this->input->post('waliconsigne');  
		$jenis_kelamin = $this->input->post('jenis_kelamin');  
		$alamat = $this->input->post('alamat');
		$nohandpone = $this->input->post('nohandpone');
		$email = $this->input->post('email'); 
		$email_bef = $this->input->post('email_bef'); 

		$tanggal_lahir = $this->input->post('tanggal_lahir');
		$tanggal_lahir_bef = $this->input->post('tanggal_lahir_bef');

		$tempat_lahir = $this->input->post('tempat_lahir'); 
		$pekerjaan = $this->input->post('pekerjaan'); 
		
		if($nama_karyawan_bef==$nama_karyawan && $tanggal_lahir==$tanggal_lahir_bef){
			$cek = 0;
		}else{
			$cek = $this->Model_waliconsigne->cekwaliconsigne($nama_waliconsigne);
		}

		$ivalidmail=0;
		if($email_bef==$email){
			$cek2 = 0;
		}else{
			$cek2 = $this->Model_waliconsigne->cekemail($email); 
			$ivalidmail =1;
		}

		if($cek>0){
			$this->session->set_flashdata('message', 'Nama sudah tersedia');
			$this->session->set_flashdata('info', '2'); 
		}else if($cek2>0){
			$this->session->set_flashdata('message', 'Email sudah digunakan');
			$this->session->set_flashdata('info', '2');  
		}else{ 
			$dataSimpan = array(  
				'nama_waliconsigne'=>$nama_waliconsigne,  
				'jenis_kelamin'=>$jenis_kelamin,
				'alamat'=>$alamat,
				'nohandpone'=>$nohandpone,
				'tanggal_lahir'=>$tanggal_lahir,
				'tempat_lahir'=>$tempat_lahir,
				'pekerjaan'=>$pekerjaan, 
			);
			$this->db->where('guid_waliconsigne',$guid_waliconsigne);
			$insert = $this->db->update('dt_waliconsigne',$dataSimpan);
			if($insert){ 
 
				#lock email
				// $this->db->where('kode_user',$kode_karyawan);
				// $this->db->update('auth_email',array('ilock'=>$ilock,'email'=>$email)); 

				if($this->Model_waliconsigne->cekemail_kode($kode_waliconsigne)>0){
					$this->db->where('kode_user',$kode_waliconsigne);
					if($ivalidmail==1){
						#kalo email baru gx sama update valid nya jadi 0 lagi biar diverifikasi ulang
						$this->db->query("call insert_notif('".$kode_waliconsigne."','Email anda sudah diatur ulang, silakan verifikasi email anda','')");
						$this->db->update('auth_email',array('email'=>$email,'ivalid'=>0)); 
					}else{
						$this->db->update('auth_email',array( 'email'=>$email)); 
					} 
				}else{
					$dataEmail = array(
						'guid_email'=>generate_guid(),   
						'kode_user'=>$kode_waliconsigne, 
						'email'=>$email,   
					);
					$insert = $this->db->insert('auth_email',$dataEmail); 
				} 
 
				#lock user 
				$this->db->where('kode_user',$kode_waliconsigne);
				$this->db->update('auth_user',array('ilock'=>$ilock));

				$this->session->set_flashdata('message', 'Data berhasil diubah');
				$this->session->set_flashdata('info', '1'); 
			}else{
				$this->session->set_flashdata('message', 'Data gagal diubah');
				$this->session->set_flashdata('info', '2'); 
			} 
		} 

		redirect(site_url('useraccount')); 
	}
}
