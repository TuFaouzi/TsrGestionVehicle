<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_expense_model extends CI_Model{ 

    public function get_all_vehicle_info() {
       $data = $this->db->select('*')
             ->from('vehicle_info') 
             ->get()
             ->result();        
            if(!empty ($data)){
                foreach($data as $value){
                    $array[$value->v_id] = $value->v_registration_no;
                }
            }
        if(!empty($array)) return $array;
    } 

    public function get_all_expense_list() {
       $data = $this->db->select('*')
             ->from('expense_list') 
             ->get()
             ->result();      
            if(!empty ($data)){
                foreach($data as $value){
                    $array[$value->expense_id] = $value->expense_name;
                }
            }
        if(!empty($array)) return $array;
    }

    public function get_a_expense($type) {
       $data = $this->db->select('*')
             ->from('expense_list') 
             ->where('expense_group',$type) 
             ->get()
             ->result();      
            if(!empty ($data)){
                foreach($data as $value){
                    $array[$value->expense_id] = $value->expense_name;
                }
            }
        if(!empty($array)) return $array;
    } 

    /*
     * @function name - generate_report 
     * @author - Md. Shohrab Hossain
     * @created on - 18/10/2015
     */

    public function generate_report($expense_report,$v_id,$expense_id,$date_1,$date_2){
        $this->db->select('expense_data.*, vehicle_info.v_registration_no,trip.hire_v_id, 
            expense_list.expense_name');
        $this->db->from('expense_data');
        $this->db->join('vehicle_info','expense_data.v_id = vehicle_info.v_id','left');
        $this->db->join('expense_list','expense_list.expense_id = expense_data.expense_id','left');
        $this->db->join('trip','trip.trip_link_id = expense_data.trip_link_id','left'); 
    // ================================================================
    // ===================STARTS OF INPUT CONTROL AREA=================  
    // ================================================================
        #control input
        if($expense_report == 1 || $expense_report == 2){ 
            $this->db->where('expense_data.date', date("Y-m-d")); 
        }
        #ends of control input  

        #vehicle id field 
        if(!empty($v_id) && ($expense_report == 2 
            || $expense_report == 4
            || $expense_report == 5
            || $expense_report == 17 
            || $expense_report == 18)){ 
            $this->db->where('expense_data.v_id',$v_id);  
        }
        #ends of vehicle id field

        #expense_id field 
        if(!empty($expense_id) && 
                ($expense_report == 7
                || $expense_report == 8
                || $expense_report == 17
                || $expense_report == 18)){   
            $this->db->where('expense_data.expense_id',$expense_id); 
        }
        #ends of expense_id field

        #expense_id field 
        if($expense_report == 9 || $expense_report == 10){   //for regular expense
            $this->db->where('expense_data.expense_group',1);  
        }if($expense_report == 11 || $expense_report == 12){   //for maintenance expense
            $this->db->where('expense_data.expense_group',2);  
        }if($expense_report == 13 || $expense_report == 14){   //for other expense
            $this->db->where('expense_data.expense_group',3);  
        }if($expense_report == 19 || $expense_report == 20){   //for office expense
            $this->db->where('expense_data.expense_group',4);  
        }if($expense_report == 21 || $expense_report == 22){   //for garage expense
            $this->db->where('expense_data.expense_group',5);  
        }
        #ends of expense_id field 

        #own/hire field 
        if($expense_report == 15){   //for own vehicle
            $this->db->where('trip.trip_type',1); 
            $this->db->or_where('trip.trip_type',2); 
            $this->db->or_where('trip.trip_type',5); 
            $this->db->or_where('trip.trip_type',6); 
        }if($expense_report == 16){   //for hire vehicle
            $this->db->where('trip.trip_type',3); 
            $this->db->or_where('trip.trip_type',4);  
        } 
        #ends of own/hire field 

        #date field 
        if((!empty($date_1) && !empty($date_2)) &&
                ($expense_report == 5
                || $expense_report == 6
                || $expense_report == 8
                || $expense_report == 10
                || $expense_report == 12
                || $expense_report == 14
                || $expense_report == 18
                || $expense_report == 20
                || $expense_report == 22)){ 
            $this->db->where("expense_data.date BETWEEN '$date_1' AND '$date_2'", NULL, FALSE );
        }
        #ends of date field
    // ========================================================================
    // ===================ENDS OF INPUT CONTROL AREA===========================
    // ========================================================================
    
        $this->db->where('expense_data.active',1); 
        $this->db->group_by('expense_data.transection_id');
        $this->db->order_by('expense_data.date','asc'); 
        return $this->db->get()->result();
    }
} 