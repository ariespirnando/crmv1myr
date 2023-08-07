<?php 

class Model_produk extends CI_Model { 
    #cek data
    function cekproduk($k){
        $this->db->where('akronim',$k);   
        $this->db->where('dt_produk.ideleted',0);  
        $query = $this->db->get('dt_produk');
        return $query->num_rows();
    }

    function get_firstdata($i){
        $this->db->where('guid_produk',$i);
        $this->db->where('dt_produk.ideleted',0);    
        $query = $this->db->get('dt_produk'); 
        return $query->row_array();
    }

    #normal
    function count_all(){ 
        $this->db->select('dt_produk.guid_produk');  
        $this->db->where('dt_produk.ideleted',0);  
        $query = $this->db->get('dt_produk');
        return $query->num_rows();

    }
    function list_all_data($start,$end){   
        $this->db->where('dt_produk.ideleted',0);  
        $query = $this->db->get('dt_produk',$end,$start); 
        return $query->result_array();
    }
    #search
    function count_all_search($q){ 
        $this->db->select('dt_produk.guid_produk');
        $this->db->group_start(); 
        $this->db->or_like('dt_produk.kode_produk', $q);  
        $this->db->or_like('dt_produk.akronim', $q);  
        $this->db->or_like('dt_produk.nama_produk', $q);  
        $this->db->or_like('dt_produk.status', $q); 
        $this->db->group_end(); 
        $this->db->where('dt_produk.ideleted',0);  
        $query = $this->db->get('dt_produk');
        return $query->num_rows();

    }
    function list_all_data_search($q,$start,$end){   
        $this->db->group_start(); 
        $this->db->or_like('dt_produk.kode_produk', $q);  
        $this->db->or_like('dt_produk.akronim', $q);  
        $this->db->or_like('dt_produk.nama_produk', $q);  
        $this->db->or_like('dt_produk.status', $q); 
        $this->db->group_end(); 
        $this->db->where('dt_produk.ideleted',0);  
        $query = $this->db->get('dt_produk',$end,$start);
        return $query->result_array();
    }


    //NOTIN
    #normal
    function count_all_notin($cons){ 
        $this->db->select('dt_produk.guid_produk');  
        $this->db->where('dt_produk.ideleted',0);  
        $this->db->where('dt_produk.guid_produk NOT IN (SELECT dt_consigne_with_pr.guid_produk FROM dt_consigne_with_pr where dt_consigne_with_pr.ideleted = 0 and dt_consigne_with_pr.guid_consigne="'.$cons.'")', NULL, FALSE);
        
        $query = $this->db->get('dt_produk');
        return $query->num_rows();

    }
    function list_all_data_notin($cons,$start,$end){   
        $this->db->where('dt_produk.ideleted',0);  
        $this->db->where('dt_produk.guid_produk NOT IN (SELECT dt_consigne_with_pr.guid_produk FROM dt_consigne_with_pr where dt_consigne_with_pr.ideleted = 0 and dt_consigne_with_pr.guid_consigne="'.$cons.'")', NULL, FALSE);
        
        $query = $this->db->get('dt_produk',$end,$start); 
        return $query->result_array();
    }
    #search
    function count_all_search_notin($cons,$q){ 
        $this->db->select('dt_produk.guid_produk');
        $this->db->group_start(); 
        $this->db->or_like('dt_produk.kode_produk', $q);  
        $this->db->or_like('dt_produk.akronim', $q);  
        $this->db->or_like('dt_produk.nama_produk', $q);  
        $this->db->or_like('dt_produk.status', $q); 
        $this->db->group_end(); 
        $this->db->where('dt_produk.ideleted',0);  
        $this->db->where('dt_produk.guid_produk NOT IN (SELECT dt_consigne_with_pr.guid_produk FROM dt_consigne_with_pr where dt_consigne_with_pr.ideleted = 0 and dt_consigne_with_pr.guid_consigne="'.$cons.'")', NULL, FALSE);
        
        $query = $this->db->get('dt_produk');
        return $query->num_rows();

    }
    function list_all_data_search_notin($cons,$q,$start,$end){   
        $this->db->group_start(); 
        $this->db->or_like('dt_produk.kode_produk', $q);  
        $this->db->or_like('dt_produk.akronim', $q);  
        $this->db->or_like('dt_produk.nama_produk', $q);  
        $this->db->or_like('dt_produk.status', $q); 
        $this->db->group_end(); 
        $this->db->where('dt_produk.ideleted',0);  
        $this->db->where('dt_produk.guid_produk NOT IN (SELECT dt_consigne_with_pr.guid_produk FROM dt_consigne_with_pr where dt_consigne_with_pr.ideleted = 0 and dt_consigne_with_pr.guid_consigne="'.$cons.'")', NULL, FALSE);
        
        $query = $this->db->get('dt_produk',$end,$start);
        return $query->result_array();
    }


    //IN
    #normal
    function count_all_in($cons){ 
        $this->db->select('dt_produk.guid_produk');  
        $this->db->where('dt_produk.ideleted',0);  
        $this->db->where('dt_produk.guid_produk  IN (SELECT dt_consigne_with_pr.guid_produk FROM dt_consigne_with_pr where dt_consigne_with_pr.ideleted = 0 and dt_consigne_with_pr.guid_consigne="'.$cons.'")', NULL, FALSE);
        
        $query = $this->db->get('dt_produk');
        return $query->num_rows();

    }
    function list_all_data_in($cons,$start,$end){   
        $this->db->where('dt_produk.ideleted',0);  
        $this->db->where('dt_produk.guid_produk  IN (SELECT dt_consigne_with_pr.guid_produk FROM dt_consigne_with_pr where dt_consigne_with_pr.ideleted = 0 and dt_consigne_with_pr.guid_consigne="'.$cons.'")', NULL, FALSE);
        
        $query = $this->db->get('dt_produk',$end,$start); 
        return $query->result_array();
    }
    #search
    function count_all_search_in($cons,$q){ 
        $this->db->select('dt_produk.guid_produk');
        $this->db->group_start(); 
        $this->db->or_like('dt_produk.kode_produk', $q);  
        $this->db->or_like('dt_produk.akronim', $q);  
        $this->db->or_like('dt_produk.nama_produk', $q);  
        $this->db->or_like('dt_produk.status', $q); 
        $this->db->group_end(); 
        $this->db->where('dt_produk.ideleted',0);  
        $this->db->where('dt_produk.guid_produk  IN (SELECT dt_consigne_with_pr.guid_produk FROM dt_consigne_with_pr where dt_consigne_with_pr.ideleted = 0 and dt_consigne_with_pr.guid_consigne="'.$cons.'")', NULL, FALSE);
        
        $query = $this->db->get('dt_produk');
        return $query->num_rows();

    }
    function list_all_data_search_in($cons,$q,$start,$end){   
        $this->db->group_start(); 
        $this->db->or_like('dt_produk.kode_produk', $q);  
        $this->db->or_like('dt_produk.akronim', $q);  
        $this->db->or_like('dt_produk.nama_produk', $q);  
        $this->db->or_like('dt_produk.status', $q); 
        $this->db->group_end(); 
        $this->db->where('dt_produk.ideleted',0);  
        $this->db->where('dt_produk.guid_produk  IN (SELECT dt_consigne_with_pr.guid_produk FROM dt_consigne_with_pr where dt_consigne_with_pr.ideleted = 0 and dt_consigne_with_pr.guid_consigne="'.$cons.'")', NULL, FALSE);
        
        $query = $this->db->get('dt_produk',$end,$start);
        return $query->result_array();
    }
}
?>