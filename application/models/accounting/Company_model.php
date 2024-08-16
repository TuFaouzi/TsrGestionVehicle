<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_model extends CI_Model{

	public function read(){
		return $this->db->select("*")
		->from("acc_company")  
		->get()
		->row();
	}
	
	public function save($data = NULL){
		if(!empty($data['company_id'])):
			return $this->db->where('company_id',$data['company_id'])->update('acc_company',$data);
		else:
			return $this->db->insert('acc_company',$data);
		endif;
	}

	public function read_by_id($company_id = NULL){
		return $this->db->select("*")
						->from("acc_company")  
						->where('company_id',$company_id)
						->get()
						->row();
	}
	
} 