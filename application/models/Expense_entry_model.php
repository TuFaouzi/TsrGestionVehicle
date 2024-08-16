<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expense_entry_model extends CI_Model {

    public function get_vehicle_info() {
       $data = $this->db->select('*')
             ->from('vehicle_info')
             ->where('active', 1) 
             ->order_by('v_registration_no','asc')
             ->get()
             ->result(); 
            $array[''] = lang("SELECT_VEHICLE_REGISTRATION_NO");        
            if(!empty ($data)){
                foreach($data as $value){
                    $array[$value->v_id] = $value->v_registration_no;
                } 
            }
        return $array;
    } 
    
    public function expense($group=NULL) {
        return $this->db->select('*')
                 ->from('expense_list')
                 ->where_not_in('expense_group', 1)//escape regular data
                 ->where('expense_group',$group)
                 ->where('active', 1)
                 ->order_by('expense_name','desc')
                 ->get()
                 ->result(); 
    }
    
    public function expense_entry_data() {
        return $this->db->select('expense_data.*, vehicle_info.v_registration_no, expense_list.expense_name')
            ->from('expense_data')
            ->join('vehicle_info','expense_data.v_id = vehicle_info.v_id','left')
            ->join('expense_list','expense_list.expense_id = expense_data.expense_id','left') 
            ->where_not_in('expense_data.active',2)
            ->where_not_in('expense_data.expense_group',1) //escape regular data
            ->order_by('expense_data.transection_id','desc')
            ->get()
            ->result(); 
    }

    public function expense_entry_data_by_id($transection_id) {
        return $this->db->select('expense_data.*, vehicle_info.v_registration_no, expense_list.expense_name')
            ->from('expense_data')
            ->join('vehicle_info','expense_data.v_id = vehicle_info.v_id','left')
            ->join('expense_list','expense_list.expense_id = expense_data.expense_id','left') 
            ->where('expense_data.transection_id',$transection_id)
            ->where('expense_data.active',1) 
            ->get()
            ->row(); 
    }

    public function save($data) { 
        return $this->db->insert('expense_data', $data);
    }


    public function edit_expense($expense_id) {
        return $this->db->select('*')
            ->from('expense_list')
            ->db->where('expense_id', $expense_id)
            ->get()
            ->result();
    }

    function expnese_entry_delete($transection_id) { 
        return $this->db->where('transection_id',$transection_id)
            ->delete('expense_data');
    } 

    function update($data){
        return $this->db->where('transection_id',$data['transection_id'])
            ->update('expense_data',$data);
    } 

    function delete($trip_link_id){
        return $this->db->where('trip_link_id',$trip_link_id)
            ->delete('expense_data');
    } 

} 