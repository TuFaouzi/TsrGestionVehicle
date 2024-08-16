<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expense_list_model extends CI_Model {

    public function expense() {
        return $this->db->select('*')
            ->from('expense_list')
            ->where_not_in('active', 2)
             ->order_by('expense_id','desc')
            ->get()
            ->result(); 
    }
    
    public function edit_expense($expense_id) {
        return $this->db->select('*')
            ->from('expense_list')
            ->where('expense_id', $expense_id)
            ->get()
            ->result();
    }


    function delete_expense($expense_id) {
        return $this->db->set('active', 2) 
            ->where('expense_id', $expense_id)
            ->update('expense_list');
    }


    public function save_expense($data) {
        $data['posting_id'] =$this->session->userdata('user_id');
        if (!empty($data['expense_id'])) {
            $this->db->where('expense_id', $data['expense_id']);
            $this->db->update('expense_list', $data);
        } else {
            $this->db->insert('expense_list', $data);
        }
    }

} 