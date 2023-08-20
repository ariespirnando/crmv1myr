<?php 

class Model_auth extends CI_Model { 
    #cek data
    function password_check($username,$password){ 
        $this->db->select('auth_email.email,auth_user.guid_user,auth_user.username, auth_user.kode_user, auth_groups.kode_groups, auth_groups.description');
        $this->db->join('auth_groups','auth_groups.guid_groups = auth_user.guid_groups','inner');
        $this->db->join('auth_email','auth_email.kode_user = auth_user.kode_user and auth_email.ideleted = 0','left');
        $this->db->where('auth_user.username',$username);
        $this->db->where('auth_user.password',$password);   
        $this->db->where('auth_user.ilock',0);  
        $this->db->where('auth_user.ideleted',0);  
        $query = $this->db->get('auth_user');  
        // print_r($this->db->last_query());
        // exit; 
        return $query->row_array();
    }

    function consignee_check($username){ 
        $this->db->select('kode_consigne,nama_consigne,guid_consigne,nohandpone,email'); 
        $this->db->group_start(); 
        $this->db->or_where('nohandpone',$username);
        $this->db->or_where('email',$username); 
        $this->db->group_end();      
        $this->db->where('ideleted',0);  
        $query = $this->db->get('dt_consigne');   
        return $query->row_array();
    }

    function history($guid_user,$type){
		$dataHistory = array(
			'guid_history'=>generate_guid(),   
			'guid_user'=>$guid_user, 
			'type'=>$type,  
			'ip_address'=>get_client_ip()
		);
		$insert = $this->db->insert('auth_history',$dataHistory); 
    }
    
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
	
	function cekemailconsigne($email){
		$this->db->where('auth_email.email',$k);   
        $this->db->where('auth_email.ideleted',0);   
        $query = $this->db->get('auth_email');
        return $query->num_rows();
	}
}
?>
