<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trip_information_model extends CI_Model {

    public function get_info($table_name) {
        return $this->db->select("*")
                        ->from($table_name)
                        ->where("active",1)
                        ->get()
                        ->result();   
    }

    public function get_trip_link_id($trip_id) {
        return $this->db->select("*")
                        ->from('trip')
                        ->where("trip_id",$trip_id)
                        ->get()
                        ->row()
                        ->trip_link_id;   
    }

    public function get_distance_info() {
       return $this->db->select("state.*")
                    ->from('state')
                    ->join('city','state.state_id = city.state_id')
                    ->where('city.active',1)
                    ->group_by('state.state_id')
                    ->order_by('state.state_name','asc')
                    ->get()
                    ->result();  
    }

   
    public function save($data) {
        $this->db->trans_start();
        return $this->db->insert('trip', $data); 
        $this->db->trans_complete();
    }


    public function update($data) {
        return $this->db->where('id',$data['id'])
                    ->update('trip', $data); 
    }

    function delete($trip_link_id){
        return $this->db->where('trip_link_id',$trip_link_id)
            ->delete('trip');
    } 

        //==============this function for get expense list (start) ===============//
    public function expense(){
        return $this->db->select('*')
                 ->from('expense_list')
                 ->where('expense_group', 1)
                 ->where('active', 1)
                 ->get()
                 ->result(); 
    }

    public function expense_data($trip_link_id) {
        return $this->db->select('expense_data.*, vehicle_info.v_registration_no, expense_list.expense_name')
                 ->from('expense_data')
                 ->join('vehicle_info','expense_data.v_id = vehicle_info.v_id','left')
                 ->join('expense_list','expense_list.expense_id = expense_data.expense_id') 
                 ->where('expense_data.trip_link_id',$trip_link_id)     
                 ->order_by('transection_id','asc')
                 ->get()
                 ->result(); 
    }
    //==============this function for get expense list (End) ===============// 

    public function read(){
        return $this->db->select("
            trip.*, add_company.company_name, driver_info.driver_name,vehicle_info.v_registration_no,
            (SELECT city.city_name FROM city WHERE trip.start_station_id = city.city_id) AS start_point, 
            (SELECT city.city_name FROM city WHERE trip.end_station_id = city.city_id) AS end_point 
            ")
            ->from("trip")
            ->join("add_company","add_company.company_id = trip.company_id","left")
            ->join("driver_info","driver_info.driver_id = trip.driver_id","left")
            ->join("vehicle_info","vehicle_info.v_id = trip.v_id","left")
            ->where_not_in("trip.active",2)
            ->where_not_in("trip.import_export",0)  
            ->order_by("trip.date","desc")
            ->get()
            ->result();
    }

    
    public function read_daily($import_export=NULL){
        return $this->db->select("
            trip.*, add_company.company_name, driver_info.driver_name,vehicle_info.v_registration_no,
            (SELECT city.city_name FROM city WHERE trip.start_station_id = city.city_id) AS start_point, 
            (SELECT city.city_name FROM city WHERE trip.end_station_id = city.city_id) AS end_point 
            ")
            ->from("trip")
            ->join("add_company","add_company.company_id = trip.company_id","left")
            ->join("driver_info","driver_info.driver_id = trip.driver_id","left")
            ->join("vehicle_info","vehicle_info.v_id = trip.v_id","left")
            ->where_not_in("trip.active",2)
            ->where("trip.import_export",$import_export) 
            ->where("trip.date",date("Y-m-d")) 
            ->order_by("trip.id","desc")
            ->get()
            ->result();
    }

    public function get_single_trip($trip_id){
        
        return $this->db->select("
            trip.*, add_company.company_name, driver_info.driver_name,vehicle_info.v_registration_no,
            (SELECT city.city_name FROM city WHERE trip.start_station_id = city.city_id) AS start_point, 
            (SELECT city.city_name FROM city WHERE trip.end_station_id = city.city_id) AS end_point 
            ")
            ->from("trip")
            ->join("add_company","add_company.company_id = trip.company_id","left")
            ->join("driver_info","driver_info.driver_id = trip.driver_id","left")
            ->join("vehicle_info","vehicle_info.v_id = trip.v_id","left")
            ->where("trip.trip_id",$trip_id) 
            ->get()
            ->row();
    }

    public function trip_by_trip_link_id($trip_link_id){
       
        return $this->db->select("
            trip.*, add_company.company_name, driver_info.driver_name,vehicle_info.v_registration_no,
            (SELECT city.city_name FROM city WHERE trip.start_station_id = city.city_id) AS start_point, 
            (SELECT city.city_name FROM city WHERE trip.end_station_id = city.city_id) AS end_point 
            ")
            ->from("trip")
            ->join("vehicle_info","vehicle_info.v_id = trip.v_id","left")
            ->join("add_company","add_company.company_id = trip.company_id","left")
            ->join("driver_info","driver_info.driver_id = trip.driver_id","left")
            ->where("trip.trip_link_id",$trip_link_id) 
            ->get()
            ->result();
    }

    public function expense_by_trip_link_id($trip_link_id){
        return $this->db->select('expense_data.*, vehicle_info.v_registration_no, expense_list.expense_name')
         ->from('expense_data')
         ->join('vehicle_info','expense_data.v_id = vehicle_info.v_id','left')
         ->join('expense_list','expense_list.expense_id = expense_data.expense_id') 
         ->where('expense_data.trip_link_id',$trip_link_id)
         ->where('expense_data.active',1)
         ->get()
         ->result(); 
    }

}
