<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bank_model extends CI_Model{

	public function read(){
		return $this->db->select("*")
						->from("acc_bank")
						->where_not_in("status",2)
						->order_by("bank_id","desc")
						->get()
						->result();
	}
	
	public function save($data = NULL){
		if(!empty($data['bank_id'])):
			return $this->db->where('bank_id',$data['bank_id'])->update('acc_bank',$data);
		else:
			return $this->db->insert('acc_bank',$data);
		endif;
	}

	public function read_by_id($bank_id = NULL){
		return $this->db->select("*")
						->from("acc_bank")  
						->where('bank_id',$bank_id)
						->get()
						->row();
	}

	public function update($bank_id = NULL){
		return $this->db->set("status",2)
						->where('bank_id',$bank_id)
						->update("acc_bank");
	}


	public function bank_dropdown(){
        $result = $this->db->select("bank_id,bank_name")
            ->from('acc_bank')
            ->where('status',1) 
            ->get()
            ->result();
        $bank[''] = $this->lang->line("SELECT_CATEGORY");
        foreach ($result as $value) { 
        	$bank[$value->bank_id] = $value->bank_name;
        } 
        if(!empty($bank)) return $bank; 
	}
	
} 