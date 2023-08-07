<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct(){    
		parent::__construct(); 
		$this->load->model(array('Model_auth')); 
	}
	public function index(){  
		if($this->session->userdata('isLogIn_ses')==1 && $this->session->userdata('role_ses')!=""){  
			redirect(site_url('auth/email'));
		}else{
			$data = array(); 
			$cap = $this->auth_captcha();
			$this->session->set_userdata('kode_captcha', $cap['word']);  
			$data['image'] =  $cap['image']; 
			$this->load->view('auth/login_page',$data);
		} 
	}

	public function consignee(){  
		if($this->session->userdata('isLogIn_ConsigneSes')==1){  
			redirect(site_url('consignehome'));
		}else{
			$data = array(); 
			$cap = $this->auth_captcha();
			$this->session->set_userdata('kode_captcha', $cap['word']);  
			$data['image'] =  $cap['image']; 
			$this->load->view('auth/login_page_consignee',$data);
		} 
	}

	public function addemail(){
		$email = $this->input->post('email');
		$kode_user = $this->input->post('dyx');

		
		$cek = $this->Model_auth->cekemail($email);

		$inicheck = 0;
		if($cek>0){
			$resp = array(  //Email dah kedaftar
				"ismail"=>0,  
			); 
		}else{
			try {

				$cek2 = $this->Model_auth->cekemail_kode($kode_user);
				if($cek2>0){ //UPDATE
					$this->db->where('kode_user',$kode_user);
					$this->db->update('auth_email',array('email'=>$email));  
				}else { //INSERT
					$dataEmail = array(
						'guid_email'=>generate_guid(),   
						'kode_user'=>$kode_user, 
						'email'=>$email,   
					);
					$insert = $this->db->insert('auth_email',$dataEmail); 
				}    
				$this->session->set_userdata(array('email_ses' => $email ));

				$resp = array(  //Sukses
					"ismail"=>2,  
				);  
				$inicheck = 1;
			} catch (\Throwable $th) {
				$resp = array(  //Gagal Simpen
					"ismail"=>1,  
				); 
			}
			// if($inicheck==1){
			// 	sendemail_1(1,$email);
			// }
			
		}
		echo json_encode($resp); 

	}

	public function cekemailrecov(){
		$email = $this->input->post('email'); 
		$cek = $this->Model_auth->cekemail($email);
		if($cek>0){
			$resp = array(  //lanjut send email
				"ismail"=>0,  
			); 
		}else{
			$resp = array(  //stop
				"ismail"=>1,  
			); 
		}
		echo json_encode($resp); 
	}
	public function sendmailemail(){
		$itipe = $this->input->post('itipe');
		$email = $this->input->post('email');
		if($itipe == 1){
			sendemail_1(1,$email,"","");
		}else{
			//koding new password
			$que = "SELECT au.guid_user, au.username FROM auth_email ae 
			JOIN auth_user au ON ae.kode_user = au.kode_user
			WHERE ae.ideleted = 0 AND au.ideleted = 0 
			AND LOWER(ae.email) = LOWER('".$email."') LIMIT 1";

			$dt = $this->db->query($que)->row_array();
			if(!empty($dt['guid_user']) && !empty($dt['username'])){
				//Generate Password
				
				$random = substr(md5($dt['username'].time()), 0, 5);
				$this->db->where('guid_user',$dt['guid_user']);
				$insert = $this->db->update('auth_user',array('password'=>generate_pw($random)));  
				sendemail_1(2,$email,$dt['username'],$random);
			}
			
		}
	}
	public function email(){   
		if($this->session->userdata('email_ses')!=""){  
			redirect(site_url('welcome'));
		}else{
			$data = array();  
			$data['dyx'] = base64_decode($this->session->userdata('kodeuser_ses'));
			$this->load->view('auth/email_register',$data);
		} 
	}


	public function passrecov(){   
		if($this->session->userdata('isLogIn_ses')!=""){  
			redirect(site_url('welcome'));
		}else{
			$data = array();   
			$this->load->view('auth/password_recovery',$data);
		} 
	}




	public function generate_captcha(){
		$cap = $this->auth_captcha();
		$this->session->set_userdata('kode_captcha', $cap['word']);  
		echo $cap['image'];
		echo '<div class="form-group col-md-12">';
		echo '</div>';
		echo '<input name="captca" type="text" class="form-control" id="captca" placeholder="Input Captcha" value="">';
	}
	public function auth_captcha(){
        $vals = array(
            'img_path' => FCPATH.'captcha/',
            'img_url' => base_url().'captcha/',
            'font_path' => FCPATH . 'captcha/font/1.ttf',
            'font_size' => 97,
            'img_width' => '210',
            'img_height' => 25,
            'expiration' => 120
        );
        $cap = create_captcha($vals);
        return $cap;
    }
	public function consignee_auth(){
		$user = $this->input->post('username'); 
		$capc = $this->input->post('captca'); 
		$captcha = $capc;
		if($captcha != $this->session->userdata('kode_captcha')){
			$resp = array(  
				"isauth"=>1,  
				"message1"=>$capc,
				"message2"=>$this->session->userdata('kode_captcha'),
			);
		}else{  
			$username = $user; 
			
			$login = $this->Model_auth->consignee_check($username); 
			if(!empty($login['kode_consigne']) && !empty($login['nama_consigne'])){
				$arraydata = array(
					'isLogIn_ConsigneSes' => 1,
					'guid_ConsigneSes'    => base64_encode($login['guid_consigne']),
					'kode_ConsigneSes'=> base64_encode($login['kode_consigne']),
					'nama_ConsigneSes'=> base64_encode($login['nama_consigne']),
					'nohandpone_ConsigneSes'=> base64_encode($login['nohandpone']),  
					'email_ConsigneSes'	  => base64_encode($login['email']), 
				); 
				$this->session->set_userdata($arraydata);
				$resp = array(
					"module"=>'auth/consignee', 
					"isauth"=>3,  
				); 
				$this->Model_auth->history($login['guid_consigne'],'Login');
			}else{
				$resp = array(  
					"isauth"=>2,  
				);
			}  
		}
		echo json_encode($resp);
	}
	public function login(){
		$user = $this->input->post('username');
		$pass = $this->input->post('password');
		$capc = $this->input->post('captca');
		#cek capca
		// $captcha = base64_decode(urldecode($capc));
		$captcha = $capc;
		if($captcha != $this->session->userdata('kode_captcha')){
			$resp = array(  
				"isauth"=>1,  
				"message1"=>$capc,
				"message2"=>$this->session->userdata('kode_captcha'),
			);
		}else{
			#Decode
			// $username = base64_decode(urldecode($user));
			// $password = base64_decode(urldecode($pass));

			$username = $user;
			$password = $pass;
			
			$login = $this->Model_auth->password_check($username,generate_pw($password));
			// echo generate_pw($password);
			// exit;
			if(!empty($login['username']) && !empty($login['kode_user']) && !empty($login['kode_groups'])){
				$arraydata = array(
					'isLogIn_ses' => 1,
					'guid_ses'    => base64_encode($login['guid_user']),
					'username_ses'=> base64_encode($login['username']),
					'kodeuser_ses'=> base64_encode($login['kode_user']),
					'rldesc_ses'=> base64_encode($login['description']), 
					'role_ses'	  => base64_encode($login['kode_groups']),
					'email_ses'	  => base64_encode($login['email']), 
				);
				$this->db->query("call insert_aktifitas('".$login['kode_user']."','Log In Applikasi CRM')"); 
				$this->session->set_userdata($arraydata);
				$resp = array(
					"module"=>'auth/email', 
					"isauth"=>3,  
				); 
				$this->Model_auth->history($login['guid_user'],'Login');
			}else{
				$resp = array(  
					"isauth"=>2,  
				);
			}  
		}
		echo json_encode($resp);
	}  
	public function logout(){
		$this->Model_auth->history(base64_decode($this->session->userdata('guid_ses')),'Logout');
		$this->db->query("call insert_aktifitas('".base64_decode($this->session->userdata('kodeuser_ses'))."','Log Out Applikasi CRM')"); 
		$this->session->sess_destroy();
		redirect(site_url('auth'));
	}

}
