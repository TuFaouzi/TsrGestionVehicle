<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_model extends CI_Model{
	
	
	public function company(){
		return $this->db->select('*')
			->from('add_company')
			->where_not_in('active',2)
            ->order_by('company_id','desc')
			->get()
			->result();
	}
	
	public function edit_company($company_id = ''){
		return $this->db->select('*')
			->from('add_company')
			->where('company_id',$company_id)
			->get()
			->result();
	}
	
	function delete_company($company_id){
		return $this->db->set('active',2)
			->where('company_id',$company_id)
			->update('add_company'); 
	}
	
	public function save($data){
		$data['posting_id'] = $this->session->userdata('user_id');
		if(!empty($data['company_id'])){
			$this->db->where('company_id',$data['company_id']);
			$this->db->update('add_company',$data);
		}else{
			$this->db->insert('add_company',$data);
		}
	} 

	public function company_name_list(){
		$query = $this->db->select('company_id,company_name')
			->from('add_company')
			->where('active',1)
			->order_by('company_name','asc')
			->get()
			->result();
		$company[''] = lang("SELECT_COMPANY_NAME"); 
		foreach($query as $value){
			$company[$value->company_id] = $value->company_name;
		}  
		return $company;
	}
	

} 