<?php 

class Model_keluhan extends CI_Model { 
    #cek data
    function cekkeluhan($k){
        $this->db->where('akronim',$k);   
        $this->db->where('dt_keluhan.ideleted',0);  
        $query = $this->db->get('dt_keluhan');
        return $query->num_rows();
    }

    function get_firstdata($i){
        $this->db->where('guid_keluhan',$i);
        $this->db->where('dt_keluhan.ideleted',0);    
        $query = $this->db->get('dt_keluhan'); 
        return $query->row_array();
    }

	function get_firstdataemail($i){    
        $this->db->where('dt_keluhan.ideleted',0);  
		$this->db->where('guid_keluhan',$i);
        $this->db->join('dt_consigne','dt_keluhan.guid_consigne = dt_consigne.guid_consigne','inner'); 
		$query = $this->db->get('dt_keluhan');
        return $query->row_array();
    }

    #normal
    function count_all(){ 
        $this->db->select('dt_keluhan.guid_keluhan');  
        $this->db->where('dt_keluhan.ideleted',0);  
        $this->db->join('dt_consigne','dt_keluhan.guid_consigne = dt_consigne.guid_consigne','inner');
        $query = $this->db->get('dt_keluhan');
        return $query->num_rows();

    }
    function list_all_data($start,$end){   
        $this->db->where('dt_keluhan.ideleted',0);  
        $this->db->join('dt_consigne','dt_keluhan.guid_consigne = dt_consigne.guid_consigne','inner');
        $query = $this->db->get('dt_keluhan',$end,$start);  
        return $query->result_array();
    }
    #search
    function count_all_search($q){ 
        $this->db->select('dt_keluhan.guid_keluhan');
        $this->db->group_start(); 
        $this->db->or_like('dt_keluhan.descripsi', $q);  
        $this->db->or_like('dt_keluhan.tgl_keluhan', $q);     
        $this->db->or_like('dt_keluhan.status', $q); 
        $this->db->or_like('dt_consigne.nama_consigne', $q); 
        $this->db->or_like('dt_consigne.nohandpone', $q); 
        $this->db->or_like('dt_consigne.email', $q); 
        $this->db->group_end(); 
        $this->db->where('dt_keluhan.ideleted',0);  
        $this->db->join('dt_consigne','dt_keluhan.guid_consigne = dt_consigne.guid_consigne','inner');
        $query = $this->db->get('dt_keluhan');
        return $query->num_rows();

    }
    function list_all_data_search($q,$start,$end){   
        $this->db->group_start(); 
        $this->db->or_like('dt_keluhan.descripsi', $q);  
        $this->db->or_like('dt_keluhan.tgl_keluhan', $q);     
        $this->db->or_like('dt_keluhan.status', $q); 
        $this->db->or_like('dt_consigne.nama_consigne', $q); 
        $this->db->or_like('dt_consigne.nohandpone', $q); 
        $this->db->or_like('dt_consigne.email', $q); 
        $this->db->group_end(); 
        $this->db->where('dt_keluhan.ideleted',0);  
        $this->db->join('dt_consigne','dt_keluhan.guid_consigne = dt_consigne.guid_consigne','inner');
        $query = $this->db->get('dt_keluhan',$end,$start);
        return $query->result_array();
    } 


    //nnnormal
    #normal
    function count_all_dt($guid_keluhan){  
        $this->db->where('dt_keluhan_replay.guid_keluhan',$guid_keluhan);   
        $query = $this->db->get('dt_keluhan_replay');
        return $query->num_rows();

    }
    function list_all_data_dt($guid_keluhan,$start,$end){   
        $this->db->where('dt_keluhan_replay.guid_keluhan',$guid_keluhan);   
        $query = $this->db->get('dt_keluhan_replay',$end,$start);  
        return $query->result_array();
    } 
}
?>
