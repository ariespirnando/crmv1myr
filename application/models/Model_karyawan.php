<?php 

class Model_karyawan extends CI_Model { 
    #
    function list_role_in(){   
        $this->db->where('auth_groups.iTipe',0);  
        if(base64_decode($this->session->userdata('role_ses'))=='U-KURIKULUM'){
            $this->db->where('auth_groups.kode_groups','U-GURU'); 
        }
        $query = $this->db->get('auth_groups'); 
        return $query->result_array();
    }
    
    #cek data
    function cekkaryawan($k,$t){
        $this->db->where('nama_karyawan',$k);   
        $this->db->where('tanggal_lahir',$t);    
        $this->db->where('dt_karyawan.ideleted',0);  
        $query = $this->db->get('dt_karyawan');
        return $query->num_rows();
    }
    #cek data 

    function cekemail($k){
        $this->db->where('auth_email.email',$k);   
        $this->db->where('auth_email.ideleted',0);   
        $query = $this->db->get('auth_email');
        return $query->num_rows();
    }

    function cekemail_kode($k){
        $this->db->where('auth_email.kode_user',$k);   
        $this->db->where('auth_email.ideleted',0);   
        $query = $this->db->get('auth_email');
        return $query->num_rows();
    }

    function get_firstdata_kode_ac($i){
        $this->db->select('dt_karyawan.*');
        $this->db->select('auth_email.email');
        $this->db->select('auth_user.username'); 
        $this->db->select('auth_user.guid_user');  
        $this->db->where('kode_karyawan',$i);
        $this->db->where('dt_karyawan.ideleted',0);
        $this->db->join('auth_user','auth_user.kode_user = dt_karyawan.kode_karyawan','inner');
        $this->db->join('auth_email','auth_email.kode_user = dt_karyawan.kode_karyawan','left');      
        $query = $this->db->get('dt_karyawan'); 
        return $query->row_array();
    }

    function get_firstdata_kode($i){
        $this->db->where('kode_karyawan',$i);
        $this->db->where('dt_karyawan.ideleted',0);    
        $query = $this->db->get('dt_karyawan'); 
        return $query->row_array();
    }

    function get_firstdata($i){
        $this->db->where('guid_karyawan',$i);
        $this->db->where('dt_karyawan.ideleted',0);  
        $this->db->join('auth_groups','dt_karyawan.guid_groups = auth_groups.guid_groups','inner');   
        $this->db->join('auth_email','auth_email.kode_user = dt_karyawan.kode_karyawan','left');    
        $query = $this->db->get('dt_karyawan'); 
        return $query->row_array();
    }
    function get_firstdata_userreset($i){
        $this->db->where('auth_user.guid_user',$i);
        $this->db->where('auth_user.ideleted',0);    
        $query = $this->db->get('auth_user'); 
        return $query->row_array();
    }
 
    #normal
    function count_all(){ 
        $this->db->select('dt_karyawan.guid_karyawan');  
        $this->db->where('dt_karyawan.ideleted',0);   
        if(base64_decode($this->session->userdata('role_ses'))=='U-KURIKULUM'){
            $this->db->where('auth_groups.kode_groups','U-GURU'); 
        }
        if(base64_decode($this->session->userdata('role_ses'))=='U-ADMIN'){
            $this->db->join('auth_user','auth_user.kode_user = dt_karyawan.kode_karyawan','inner'); 
        }
        $this->db->join('auth_groups','dt_karyawan.guid_groups = auth_groups.guid_groups','inner');
        $this->db->join('auth_email','auth_email.kode_user = dt_karyawan.kode_karyawan','left');  
        $query = $this->db->get('dt_karyawan');
        return $query->num_rows();

    }
    function list_all_data($start,$end){   
        $this->db->where('dt_karyawan.ideleted',0);  
        if(base64_decode($this->session->userdata('role_ses'))=='U-KURIKULUM'){
            $this->db->where('auth_groups.kode_groups','U-GURU'); 
        }
        if(base64_decode($this->session->userdata('role_ses'))=='U-ADMIN'){
            $this->db->join('auth_user','auth_user.kode_user = dt_karyawan.kode_karyawan','inner'); 
        }
        $this->db->join('auth_groups','dt_karyawan.guid_groups = auth_groups.guid_groups','inner');
        $this->db->join('auth_email','auth_email.kode_user = dt_karyawan.kode_karyawan','left');  
        $this->db->order_by('dt_karyawan.dateinsupt', 'DESC'); 
        $this->db->order_by('dt_karyawan.nama_karyawan', 'ASC'); 
        $query = $this->db->get('dt_karyawan',$end,$start); 
        return $query->result_array();
    }
    #search
    function count_all_search($q){ 
        $this->db->select('dt_karyawan.guid_karyawan');
        $this->db->group_start();
        $this->db->or_like('dt_karyawan.kode_karyawan', $q);  
        $this->db->or_like('dt_karyawan.nama_karyawan', $q);  
        $this->db->or_like('dt_karyawan.nik_karyawan', $q);   
        $this->db->or_like('dt_karyawan.status', $q); 
        $this->db->or_like('auth_groups.description', $q);  
        $this->db->group_end();  
        $this->db->where('dt_karyawan.ideleted',0); 
        if(base64_decode($this->session->userdata('role_ses'))=='U-KURIKULUM'){
            $this->db->where('auth_groups.kode_groups','U-GURU'); 
        }
        if(base64_decode($this->session->userdata('role_ses'))=='U-ADMIN'){
            $this->db->join('auth_user','auth_user.kode_user = dt_karyawan.kode_karyawan','inner'); 
        }
        $this->db->join('auth_groups','dt_karyawan.guid_groups = auth_groups.guid_groups','inner'); 
        $this->db->join('auth_email','auth_email.kode_user = dt_karyawan.kode_karyawan','left');  
        $query = $this->db->get('dt_karyawan');
        return $query->num_rows();

    }
    function list_all_data_search($q,$start,$end){   
        $this->db->group_start();
        $this->db->or_like('dt_karyawan.kode_karyawan', $q);  
        $this->db->or_like('dt_karyawan.nama_karyawan', $q);  
        $this->db->or_like('dt_karyawan.nik_karyawan', $q);   
        $this->db->or_like('dt_karyawan.status', $q); 
        $this->db->or_like('auth_groups.description', $q);  
        $this->db->group_end();   
        $this->db->where('dt_karyawan.ideleted',0);  
        if(base64_decode($this->session->userdata('role_ses'))=='U-KURIKULUM'){
            $this->db->where('auth_groups.kode_groups','U-GURU'); 
        }
        if(base64_decode($this->session->userdata('role_ses'))=='U-ADMIN'){
            $this->db->join('auth_user','auth_user.kode_user = dt_karyawan.kode_karyawan','inner'); 
        }
        $this->db->join('auth_groups','dt_karyawan.guid_groups = auth_groups.guid_groups','inner');
        $this->db->join('auth_email','auth_email.kode_user = dt_karyawan.kode_karyawan','left');  
        $this->db->order_by('dt_karyawan.dateinsupt', 'DESC'); 
        $this->db->order_by('dt_karyawan.nama_karyawan', 'ASC'); 
        $query = $this->db->get('dt_karyawan',$end,$start);
        return $query->result_array();
    }
}
?>