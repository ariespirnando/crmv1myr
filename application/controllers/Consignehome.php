<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consignehome extends CI_Controller { 
    public function __construct(){    
		parent::__construct();   
		if(!$this->session->userdata('kode_ConsigneSes')){   
            redirect(site_url('auth/consignee')); 
        } 
         
		$this->load->model(array('Model_consigne','Model_karyawan')); 
      }
      
	public function index(){   
        $data['modul'] = 'consignehome';  
        $this->template->load('template/template','welcome/consigne/view', $data); 
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

}
