<?php 

class Model_consigne extends CI_Model { 
    #cek data
    function cekconsigne($k,$e){ 
		$this->db->where('dt_consigne.ideleted',0);   
		$this->db->group_start();
		$this->db->where('nama_consigne',$k);   
		$this->db->or_where('email',$e);
    	$this->db->group_end();
        
        $query = $this->db->get('dt_consigne');
        return $query->num_rows();
    }

	function cekemail($e){ 
		$this->db->where('email',$e);
		$this->db->where('dt_consigne.ideleted',0);    
        $query = $this->db->get('dt_consigne');
        return $query->num_rows();
	}

	function cekemailDt($e){ 
		$this->db->where('email',$e);
		$this->db->where('dt_consigne.ideleted',0);    
        $query = $this->db->get('dt_consigne');
		return $query->row_array();
	}
  

    function get_firstdata($i){
        $this->db->where('guid_consigne',$i);
        $this->db->where('dt_consigne.ideleted',0);    
        $query = $this->db->get('dt_consigne'); 
        return $query->row_array();
    }

    function get_firstdata_userreset($i){
        $this->db->where('auth_user.guid_user',$i);
        $this->db->where('auth_user.ideleted',0);    
        $query = $this->db->get('auth_user'); 
        return $query->row_array();
    }


    function get_firstdata_kode($i){
        $this->db->where('kode_consigne',$i);
        $this->db->where('dt_consigne.ideleted',0);   
        $query = $this->db->get('dt_consigne');  
        return $query->row_array();
    }

    function get_firstdata_kode_ac($i){
        $this->db->select('dt_consigne.*');
        $this->db->select('auth_email.email');
        $this->db->select('auth_user.username'); 
        $this->db->select('auth_user.guid_user'); 
        $this->db->where('kode_consigne',$i);
        $this->db->where('dt_consigne.ideleted',0);    
        $query = $this->db->get('dt_consigne');  
        return $query->row_array();
    }

      
    #normal
    function count_all(){ 
        $this->db->select('dt_consigne.guid_consigne');  
        $this->db->where('dt_consigne.ideleted',0);   
        $query = $this->db->get('dt_consigne');
        return $query->num_rows();

    }
    function list_all_data($start,$end){   
        $this->db->where('dt_consigne.ideleted',0);   
        $query = $this->db->get('dt_consigne',$end,$start); 
        return $query->result_array();
    }
    #search
    function count_all_search($q){ 
        $this->db->select('dt_consigne.guid_consigne');
        $this->db->group_start(); 
        $this->db->or_like('dt_consigne.kode_consigne', $q);  
        $this->db->or_like('dt_consigne.nama_consigne', $q);  
        $this->db->or_like('dt_consigne.nik_consigne', $q);   
        $this->db->or_like('dt_consigne.status', $q);
        $this->db->group_end();  
        $this->db->where('dt_consigne.ideleted',0);   
        $query = $this->db->get('dt_consigne');
        return $query->num_rows();

    }
    function list_all_data_search($q,$start,$end){   
        $this->db->group_start(); 
        $this->db->or_like('dt_consigne.kode_consigne', $q);  
        $this->db->or_like('dt_consigne.nama_consigne', $q);  
        $this->db->or_like('dt_consigne.nik_consigne', $q);   
        $this->db->or_like('dt_consigne.status', $q);
        $this->db->group_end();  
        $this->db->where('dt_consigne.ideleted',0);   
        $query = $this->db->get('dt_consigne',$end,$start);
        return $query->result_array();
    }

    //AddNotIn
    #normal
    function count_all_notin(){ 
        $this->db->select('dt_consigne.guid_consigne');  
        $this->db->where('dt_consigne.status','Active'); 
        $this->db->where('dt_consigne.ideleted',0);  
        $this->db->where('dt_consigne.kode_consigne NOT IN (SELECT dt_waliconsigne_detail.kode_consigne FROM dt_waliconsigne_detail where dt_waliconsigne_detail.ideleted = 0)', NULL, FALSE);
        $query = $this->db->get('dt_consigne');
        return $query->num_rows();

    }
    function list_all_data_notin($start,$end){   
        $this->db->where('dt_consigne.ideleted',0);  
        $this->db->where('dt_consigne.status','Active'); 
        $this->db->where('dt_consigne.kode_consigne NOT IN (SELECT dt_waliconsigne_detail.kode_consigne FROM dt_waliconsigne_detail where dt_waliconsigne_detail.ideleted = 0)', NULL, FALSE);
        $query = $this->db->get('dt_consigne',$end,$start); 
        return $query->result_array();
    }
    #search
    function count_all_search_notin($q){ 
        $this->db->select('dt_consigne.guid_consigne');
        $this->db->group_start(); 
        $this->db->or_like('dt_consigne.kode_consigne', $q);  
        $this->db->or_like('dt_consigne.nama_consigne', $q);  
        $this->db->or_like('dt_consigne.nik_consigne', $q);   
        $this->db->or_like('dt_consigne.status', $q);
        $this->db->group_end();  
        $this->db->where('dt_consigne.status','Active'); 
        $this->db->where('dt_consigne.ideleted',0);  
        $this->db->where('dt_consigne.kode_consigne NOT IN (SELECT dt_waliconsigne_detail.kode_consigne FROM dt_waliconsigne_detail where dt_waliconsigne_detail.ideleted = 0)', NULL, FALSE);
        $query = $this->db->get('dt_consigne');
        return $query->num_rows();

    }
    function list_all_data_search_notin($q,$start,$end){   
        $this->db->group_start(); 
        $this->db->or_like('dt_consigne.kode_consigne', $q);  
        $this->db->or_like('dt_consigne.nama_consigne', $q);  
        $this->db->or_like('dt_consigne.nik_consigne', $q);   
        $this->db->or_like('dt_consigne.status', $q);
        $this->db->group_end();   
        $this->db->where('dt_consigne.status','Active'); 
        $this->db->where('dt_consigne.ideleted',0);  
        $this->db->where('dt_consigne.kode_consigne NOT IN (SELECT dt_waliconsigne_detail.kode_consigne FROM dt_waliconsigne_detail where dt_waliconsigne_detail.ideleted = 0)', NULL, FALSE);
        $query = $this->db->get('dt_consigne',$end,$start);
        return $query->result_array();
    }


    #normal subxconsigne
    function count_all_subxconsigne($ta){ 
        $this->db->select('dt_consigne.guid_consigne'); 
        $this->db->where('dt_consigne.status','Active');  
        $this->db->where('dt_consigne.ideleted',0);  
        $this->db->where('dt_consigne.kode_consigne NOT IN (SELECT DISTINCT(conf_subkelasxconsigne.kode_consigne) FROM dt_tahunajaran
        JOIN conf_kelas ON conf_kelas.kode_tahunajaran = dt_tahunajaran.kode_tahunajaran
        JOIN conf_kelasxsubkelas ON conf_kelasxsubkelas.guid_conf_kelas = conf_kelas.guid_conf_kelas
        JOIN conf_subkelasxconsigne ON conf_subkelasxconsigne.guid_conf_kelasxsubkelas = conf_kelasxsubkelas.guid_conf_kelasxsubkelas
        WHERE conf_kelas.ideleted = 0 AND
                conf_kelasxsubkelas.ideleted = 0 AND
                conf_subkelasxconsigne.ideleted = 0 AND
                dt_tahunajaran.guid_tahunajaran = "'.$ta.'")', NULL, FALSE);
        $query = $this->db->get('dt_consigne');
        return $query->num_rows();

    }
    function list_all_data_subxconsigne($ta,$start,$end){   
        $this->db->where('dt_consigne.ideleted',0); 
        $this->db->where('dt_consigne.status','Active');  
        $this->db->where('dt_consigne.kode_consigne NOT IN (SELECT DISTINCT(conf_subkelasxconsigne.kode_consigne) FROM dt_tahunajaran
        JOIN conf_kelas ON conf_kelas.kode_tahunajaran = dt_tahunajaran.kode_tahunajaran
        JOIN conf_kelasxsubkelas ON conf_kelasxsubkelas.guid_conf_kelas = conf_kelas.guid_conf_kelas
        JOIN conf_subkelasxconsigne ON conf_subkelasxconsigne.guid_conf_kelasxsubkelas = conf_kelasxsubkelas.guid_conf_kelasxsubkelas
        WHERE conf_kelas.ideleted = 0 AND
                conf_kelasxsubkelas.ideleted = 0 AND
                conf_subkelasxconsigne.ideleted = 0 AND
                dt_tahunajaran.guid_tahunajaran = "'.$ta.'")', NULL, FALSE);
        $query = $this->db->get('dt_consigne',$end,$start); 
        return $query->result_array();
    }
    #search
    function count_all_search_subxconsigne($ta,$q){ 
        $this->db->select('dt_consigne.guid_consigne');
        $this->db->group_start(); 
        $this->db->or_like('dt_consigne.kode_consigne', $q);  
        $this->db->or_like('dt_consigne.nama_consigne', $q);  
        $this->db->or_like('dt_consigne.nik_consigne', $q);   
        $this->db->or_like('dt_consigne.jenis_kelamin', $q);
        $this->db->group_end();  
        $this->db->where('dt_consigne.status','Active'); 
        $this->db->where('dt_consigne.ideleted',0);  
        $this->db->where('dt_consigne.kode_consigne NOT IN (SELECT DISTINCT(conf_subkelasxconsigne.kode_consigne) FROM dt_tahunajaran
        JOIN conf_kelas ON conf_kelas.kode_tahunajaran = dt_tahunajaran.kode_tahunajaran
        JOIN conf_kelasxsubkelas ON conf_kelasxsubkelas.guid_conf_kelas = conf_kelas.guid_conf_kelas
        JOIN conf_subkelasxconsigne ON conf_subkelasxconsigne.guid_conf_kelasxsubkelas = conf_kelasxsubkelas.guid_conf_kelasxsubkelas
        WHERE conf_kelas.ideleted = 0 AND
                conf_kelasxsubkelas.ideleted = 0 AND
                conf_subkelasxconsigne.ideleted = 0 AND
                dt_tahunajaran.guid_tahunajaran = "'.$ta.'")', NULL, FALSE);
        $query = $this->db->get('dt_consigne');
        return $query->num_rows();

    }
    function list_all_data_search_subxconsigne($ta,$q,$start,$end){   
        $this->db->group_start(); 
        $this->db->or_like('dt_consigne.kode_consigne', $q);  
        $this->db->or_like('dt_consigne.nama_consigne', $q);  
        $this->db->or_like('dt_consigne.nik_consigne', $q);   
        $this->db->or_like('dt_consigne.jenis_kelamin', $q);
        $this->db->group_end();   
        $this->db->where('dt_consigne.status','Active'); 
        $this->db->where('dt_consigne.ideleted',0);  
        $this->db->where('dt_consigne.kode_consigne NOT IN (SELECT DISTINCT(conf_subkelasxconsigne.kode_consigne) FROM dt_tahunajaran
        JOIN conf_kelas ON conf_kelas.kode_tahunajaran = dt_tahunajaran.kode_tahunajaran
        JOIN conf_kelasxsubkelas ON conf_kelasxsubkelas.guid_conf_kelas = conf_kelas.guid_conf_kelas
        JOIN conf_subkelasxconsigne ON conf_subkelasxconsigne.guid_conf_kelasxsubkelas = conf_kelasxsubkelas.guid_conf_kelasxsubkelas
        WHERE conf_kelas.ideleted = 0 AND
                conf_kelasxsubkelas.ideleted = 0 AND
                conf_subkelasxconsigne.ideleted = 0 AND
                dt_tahunajaran.guid_tahunajaran = "'.$ta.'")', NULL, FALSE);
        $query = $this->db->get('dt_consigne',$end,$start);
        return $query->result_array();
    }
}
?>
