<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_model extends CI_Model{
	
	
	public function getid(){
            $query=$this->db->query("SELECT * FROM  web_setting where id='1'");
	    return $query->result();	
	}
        
        public function edit_setting($data){  
	  $query=$this->db->where('id',$data['id'])->update('web_setting',$data);	    
	}


} 