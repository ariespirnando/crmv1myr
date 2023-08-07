<?php 

class Model_promosi extends CI_Model { 
    #cek data
    function cekpromosi($k){
        $this->db->where('nama_promosi',$k);   
        $this->db->where('dt_promosi.ideleted',0);  
        $query = $this->db->get('dt_promosi');
        return $query->num_rows();
    }

    function get_firstdata($i){
        $this->db->where('guid_promosi',$i);
        $this->db->where('dt_promosi.ideleted',0);    
        $query = $this->db->get('dt_promosi'); 
        return $query->row_array();
    }

      
    #normal
    function count_all(){ 
        $this->db->select('dt_promosi.guid_promosi');  
        $this->db->where('dt_promosi.ideleted',0);  
        $role = base64_decode($this->session->userdata('role_ses'));
        if($role== 'U-SISWA' || $role=='U-WALISISWA'){
            $this->db->where('dt_promosi.clasifikasi','Public');  
        }
        $this->db->order_by('dt_promosi.tgl_posting', 'DESC');
        $query = $this->db->get('dt_promosi');
        return $query->num_rows();

    }
    function list_all_data($start,$end){   
        $this->db->where('dt_promosi.ideleted',0); 
        $role = base64_decode($this->session->userdata('role_ses'));
        if($role== 'U-SISWA' || $role=='U-WALISISWA'){
            $this->db->where('dt_promosi.clasifikasi','Public');  
        }
        $this->db->order_by('dt_promosi.tgl_posting', 'DESC'); 
        $query = $this->db->get('dt_promosi',$end,$start); 
        return $query->result_array();
    }
    #search
    function count_all_search($q){ 
        $this->db->select('dt_promosi.guid_promosi');
        $this->db->group_start(); 
        $this->db->or_like('dt_promosi.kode_promosi', $q);  
        $this->db->or_like('dt_promosi.nama_promosi', $q);  
        $this->db->or_like('dt_promosi.status', $q); 
        $this->db->group_end(); 
        $this->db->where('dt_promosi.ideleted',0);  
        $role = base64_decode($this->session->userdata('role_ses'));
        if($role== 'U-SISWA' || $role=='U-WALISISWA'){
            $this->db->where('dt_promosi.clasifikasi','Public');  
        }
        $this->db->order_by('dt_promosi.tgl_posting', 'DESC');
        $query = $this->db->get('dt_promosi');
        return $query->num_rows();

    }
    function list_all_data_search($q,$start,$end){   
        $this->db->group_start(); 
        $this->db->or_like('dt_promosi.kode_promosi', $q);  
        $this->db->or_like('dt_promosi.nama_promosi', $q);  
        $this->db->or_like('dt_promosi.status', $q); 
        $this->db->group_end();   
        $this->db->where('dt_promosi.ideleted',0);  
        $role = base64_decode($this->session->userdata('role_ses'));
        if($role== 'U-SISWA' || $role=='U-WALISISWA'){
            $this->db->where('dt_promosi.clasifikasi','Public');  
        }
        $this->db->order_by('dt_promosi.tgl_posting', 'DESC');
        $query = $this->db->get('dt_promosi',$end,$start);
        return $query->result_array();
    }
}
?>