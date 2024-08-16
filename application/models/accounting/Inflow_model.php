<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inflow_model extends CI_Model{

	public function read(){
		return $this->db->select("acc_inflow.*, acc_bank.bank_name AS deposit_bank")
		->from("acc_inflow")
		->join('acc_bank','acc_bank.bank_id = acc_inflow.deposit_bank_id','left')
		->where_not_in("acc_inflow.status",2)  
		->order_by('acc_inflow.inflow_id','desc')
		->get()
		->result();
	}
	
	public function save($data = NULL){
		if(!empty($data['inflow_id'])):
			return $this->db->where('inflow_id',$data['inflow_id'])->update('acc_inflow',$data);
		else:
			return $this->db->insert('acc_inflow',$data);
		endif;
	}

	public function read_by_id($inflow_id = NULL){
		return $this->db->select("acc_inflow.*, acc_bank.bank_name AS deposit_bank")
						->from("acc_inflow")  
						->join('acc_bank','acc_bank.bank_id = acc_inflow.deposit_bank_id','left')
						->where('acc_inflow.inflow_id',$inflow_id)
						->get()
						->row();
	}

	public function delete($inflow_id = NULL){
		return $this->db->set('status',2)
			->where('inflow_id',$inflow_id)
			->update("acc_inflow");
	} 
	
} 