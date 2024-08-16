<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_general_model extends CI_Model{ 

    public function get_company_info($company_id){
       return $this->db->select("*")
            ->from("add_company")
            ->where("company_id",$company_id)
            ->get()
            ->row();        
    }

    public function get_all_company_info() {
       $data = $this->db->select('*')
             ->from('add_company') 
             ->get()
             ->result();      
            if(!empty ($data)){
                foreach($data as $value){
                    $array[$value->company_id] = $value->company_name;
                } 
            }
        if(!empty($array)) return $array;
    } 

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

    public function get_all_driver_info() {
       $data = $this->db->select('*')
             ->from('driver_info') 
             ->get()
             ->result();      
            if(!empty ($data)){
                foreach($data as $value){
                    $array[$value->driver_id] = $value->driver_name;
                } 
            }
        if(!empty($array)) return $array;
    } 

    /*
     * @function name - generate_report 
     * @author - Md. Shohrab Hossain
     * @created on - 14/10/2015
     */

    public function generate_report($general_report,$import_export,$driver_id,$v_id,$company_id,$date_1,$date_2){
        $this->db->select("
        trip.*, add_company.company_name, 
        driver_info.driver_name,
        vehicle_info.v_registration_no,
        (SELECT city.city_name FROM city WHERE trip.start_station_id = city.city_id) AS start_point, 
        (SELECT city.city_name FROM city WHERE trip.end_station_id = city.city_id) AS end_point,
        (SELECT trip.rent) AS contact_rent, 
        ");
        $this->db->from("trip");
        $this->db->join("add_company","add_company.company_id = trip.company_id",'left');
        $this->db->join("driver_info","driver_info.driver_id = trip.driver_id",'left');
        $this->db->join("vehicle_info","vehicle_info.v_id = trip.v_id",'left');
       // ********************************************************************
        #control import_export field
        if($import_export == 0){
            $this->db->where("trip.import_export","0");  
        } if($import_export == 1){
            $this->db->where("trip.import_export","1");  
        } if($import_export == 2){
            $this->db->where("trip.import_export","2");  
        } if($import_export == 3){
            $this->db->where("trip.import_export","3");  
        }  
        #ends of control import_export filed
        
        #control driver_id field
        if(!empty($driver_id) && (
            $general_report == 5
            || $general_report == 8)){
            $this->db->where("trip.driver_id",$driver_id);  
        }
        #ends of control driver_id filed
        
        #control v_registration_no field
        if(!empty($v_id) && (
            $general_report == 2
            || $general_report == 4
            || $general_report == 9)){
            $this->db->where("trip.v_id",$v_id);  
        }
        #ends of control v_registration_no filed 
        
        #control company_id field
        if(!empty($company_id) && (
            $general_report == 6
            || $general_report == 7)){
            $this->db->where("trip.company_id",$company_id);  
        }
        #ends of control company_id filed
        
        #control date field
        if($general_report == 7 
            || $general_report == 8 
            || $general_report == 9 
            || $general_report == 10 
            && (!empty($date_1) && !empty($date_2))){ 
            $this->db->where("trip.date BETWEEN '$date_1' AND '$date_2'", NULL, FALSE );  
        }
        if($general_report == 1 
            || $general_report == 2){ 
            $this->db->where("trip.date", date('Y-m-d'));  
        }
        #ends of control company_id filed
        // ********************************************************************

        $this->db->where("trip.active",1);
        $this->db->group_by("trip.id");
        $this->db->order_by("trip.date","asc");
        return $this->db->get()->result(); 
    }
} 