<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_model extends CI_Model{

	public function read(){
		return $this->db->select("*")
		->from("acc_account")
		->where_not_in("status",2)
		->order_by("account_id","desc")
		->get()
		->result();
	}
	
	public function save($data = NULL){
		if(!empty($data['account_id'])):
			return $this->db->where('account_id',$data['account_id'])->update('acc_account',$data);
		else:
			return $this->db->insert('acc_account',$data);
		endif;
	}

	public function read_by_id($account_id = NULL){
		return $this->db->select("*")
						->from("acc_account")  
						->where('account_id',$account_id)
						->get()
						->row();
	}

	public function update($account_id = NULL){
		return $this->db->set("status",2)
						->where('account_id',$account_id)
						->update("acc_account");
	}

	public function credit_dropdown(){
        $result = $this->db->select("sector_name")
            ->from('acc_account')
            ->where('status',1)
            ->where('sector_type','Credit (+)')
            ->get()
            ->result();
        $credit[''] = $this->lang->line("SELECT_CATEGORY");
        foreach ($result as $value) { 
        	$credit[$value->sector_name] = $value->sector_name;
        } 
        if(!empty($credit)) return $credit; 
	}

	public function debit_dropdown(){
        $result = $this->db->select("sector_name")
            ->from('acc_account')
            ->where('status',1)
            ->where('sector_type','Debit (-)')
            ->get()
            ->result();
        $credit[''] = $this->lang->line("SELECT_CATEGORY");
        foreach ($result as $value) { 
        	$credit[$value->sector_name] = $value->sector_name;
        } 
        if(!empty($credit)) return $credit; 
	}
	
} 