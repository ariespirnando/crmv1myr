<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller { 
    public function __construct(){    
		parent::__construct();   
		if(!$this->session->userdata('kodeuser_ses')){   
            redirect(site_url('auth')); 
        } 
         
		$this->load->model(array('Model_consigne','Model_karyawan')); 
      }
      
	public function index(){   
        $data['modul'] = 'welcome';
        $role = base64_decode($this->session->userdata('role_ses'));  ##Baca aja Sesionya 
        $kode_user = base64_decode($this->session->userdata('kodeuser_ses')); 
        switch ($role) {
            case "U-ADMIN":
                $data['karyawan'] = $this->Model_karyawan->get_firstdata_kode($kode_user);
                $data['loaddt'] = $this->db->query("CALL `jumlahloginperbulan`()")->result_array(); 
                $this->template->load('template/template','welcome/admin/view', $data); 
                break; 
            case "U-CS":
                $data['karyawan'] = $this->Model_karyawan->get_firstdata_kode($kode_user);
                $data['loaddt'] = $this->db->query("CALL `jumlahloginperbulan`()")->result_array(); 
                $this->template->load('template/template','welcome/admin/view', $data); 
                break; 
            default:
                redirect(site_url('auth')); 
        }
    }
    public function motifasi(){
        $motifasi = $this->db->query("SELECT kalimat_motifasi
                            FROM motifasi_day AS r1 JOIN
                                (SELECT CEIL(RAND() *
                                            (SELECT MAX(imotifasi)
                                                FROM motifasi_day)) AS imotifasi)
                                AS r2
                            WHERE r1.imotifasi >= r2.imotifasi
                            ORDER BY r1.imotifasi ASC
                            LIMIT 1")->row_array();
        $html ='<div class="alert alert-outline-warning mt-4 mb-2" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x text-black close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button><i class="flaticon-cancel-12 close text-black" data-dismiss="alert"></i> <strong>Informasi Pembayaran SPP Semester Genap 2020</strong> <br>Diumumkan untuk kepada seluruh consigne kelas XI Bahasa untuk segera melakukan pembayaran SPP sebelum dimulainya Ujian Kenaikan Kelas. </div>
        ';

        $html = '<div class="alert alert-outline-primary mt-4 mb-2" role="alert"><b>'.$motifasi['kalimat_motifasi'].'</b></div>';
        echo $html;  
    }
    public function notifikasi(){
            $kode_user = base64_decode($this->session->userdata('kodeuser_ses'));  
            $this->db->select('nt_notif.isi_notifikasi'); 
            $this->db->select('nt_notif.route_url');  
            $this->db->select('nt_notif.date_post');  
            $this->db->where('nt_notif.kode_user',$kode_user);
            $this->db->where('nt_notif.ideleted',0); 
            $this->db->order_by('nt_notif.date_post', 'DESC'); 
            $this->db->limit(20);  
        $query = $this->db->get('nt_notif'); 
        $htm =  $query->result_array(); 
        
        $html = ""; 
        foreach($htm as $h){ 
            $html .='<div class="item-timeline ">';
            $html .='<div class="t-dot" data-original-title="" title="">';
            $html .='</div>';
            $html .='<div class="t-text">';
            $html .='<p><a href="'.base_url().$h['route_url'].'"> '.$h['isi_notifikasi'].'</a></p>';
            $html .='<p class="t-time">'.$h['date_post'].'</p>';
            $html .='</div>';
            $html .='</div>';
        }
        echo $html; 
        
    } 

    public function aktifity2(){
        $kode_user = base64_decode($this->session->userdata('kodeuser_ses')); 
 
            $this->db->select('nt_aktif.isi_aktifitas');  
            $this->db->select('nt_aktif.date_post');  
            $this->db->where('nt_aktif.kode_user',$kode_user);
            $this->db->where('nt_aktif.ideleted',0); 
            $this->db->order_by('nt_aktif.date_post', 'DESC'); 
            $this->db->limit(20);  
        $query = $this->db->get('nt_aktif'); 
        $htm =  $query->result_array(); 
        
        $html = ""; 
        foreach($htm as $h){ 
            $html .='<div class="item-timeline ">';
            $html .='<div class="t-dot" data-original-title="" title="">';
            $html .='</div>';
            $html .='<div class="t-text">';
            $html .='<p>'.$h['isi_aktifitas'].'</p>';
            $html .='<p class="t-time">'.$h['date_post'].'</p>';
            $html .='</div>';
            $html .='</div>';
        }
        echo $html;
    }

    public function staffteraktif(){
        $kode_user = base64_decode($this->session->userdata('kodeuser_ses')); 
        if($kode_user=="U-KEPSEK"){
            $consigne = $this->db->query("CALL `logteraktiv_allstaff`()")->row_array(); 
            echo '<b>Staff</b> Teraktif '.$consigne['bulan'].' '.$consigne['tahun'].' : <b>'.$consigne['nama_karyawan'].'</b>';
        }else{
            $consigne = $this->db->query("CALL `logteraktiv_allguru`()")->row_array(); 
            echo '<b>Guru</b> Teraktif '.$consigne['bulan'].' '.$consigne['tahun'].' : <b>'.$consigne['nama_karyawan'].'</b>';
        }
    }
    public function consigneteraktif(){
        $consigne = $this->db->query("CALL `logteraktiv_allconsigne`()")->row_array(); 
        echo '<b>Siswa</b> Teraktif '.$consigne['bulan'].' '.$consigne['tahun'].' : <b>'.$consigne['nama_consigne'].'</b>';
    }

    public function kbmlist(){ 
        $data = $this->Model_jadwalpelajaran->kbm_today(date("l"));
        $html = "";
        foreach($data as $d){

            $html .='<div class="item-timeline ">';
            $html .='<div class="t-dot" data-original-title="" title="">';
            $html .='</div>';
            $html .='<div class="t-text">';
            $html .='<p><a target="_blank" href="'.base_url().'jadwalpelajaran/onlinemeet/'.$d['guid_conf_subkelasxpel'].'" class="btn btn-sm btn-outline-primary text-left">'.$d['jam_mulai'].' - '.$d['nama_pelajaran'].' - <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg> </p></a>';
            $html .='';
            $html .='</div>';
            $html .='</div>';
 
        }
        echo $html; 
    }
 
 

                

}
