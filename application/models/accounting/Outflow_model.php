<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Outflow_model extends CI_Model{

	public function read(){
		return $this->db->select("acc_outflow.*, acc_bank.bank_name AS deposit_bank")
		->from("acc_outflow")
		->join('acc_bank','acc_bank.bank_id = acc_outflow.deposit_bank_id','left')
		->where_not_in("acc_outflow.status",2)  
		->order_by('acc_outflow.outflow_id','desc')
		->get()
		->result();
	}
	
	public function save($data = NULL){
		if(!empty($data['outflow_id'])):
			return $this->db->where('outflow_id',$data['outflow_id'])->update('acc_outflow',$data);
		else:
			return $this->db->insert('acc_outflow',$data);
		endif;
	}

	public function read_by_id($outflow_id = NULL){
		return $this->db->select("acc_outflow.*, acc_bank.bank_name AS deposit_bank")
						->from("acc_outflow")  
						->join('acc_bank','acc_bank.bank_id = acc_outflow.deposit_bank_id','left')
						->where('acc_outflow.outflow_id',$outflow_id)
						->get()
						->row();
	}

	public function delete($outflow_id = NULL){
		return $this->db->set('status',2)
			->where('outflow_id',$outflow_id)
			->update("acc_outflow");
	} 
	
} 