<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_model extends CI_Model{


	public function get_station_start($id){
		$query = "SELECT city.*,state.state_name FROM city INNER JOIN state ON city.state_id = state.state_id WHERE ((state.state_id = '$id' and city.active = 1)) ORDER BY city_name ASC";
		$result = $this->db->query($query);
	        $stateList = $result->result(); 
		        foreach($stateList as $value){
				echo'<option value="'.$value->city_id.'">'.$value->city_name.'</option>';
			} 
                  
	}
	
	public function get_station_end($id){
		$query = "SELECT city.*,state.state_name from city INNER JOIN state ON city.state_id = state.state_id WHERE ((state.state_id = '$id' and city.active = 1)) ORDER BY city_name ASC";
		$result = $this->db->query($query);
		$stateList = $result->result(); 
				foreach($stateList as $value){
				echo'<option value="'.$value->city_id.'">'.$value->city_name.'</option>';
			} 
	}

	public function get_local_expense($trip_link_id){
		return $this->db->select('expense_data.*, vehicle_info.v_registration_no, expense_list.expense_name')
	         ->from('expense_data')
	         ->join('vehicle_info','expense_data.v_id = vehicle_info.v_id','left')
	         ->join('expense_list','expense_list.expense_id = expense_data.expense_id') 
	         ->where('expense_data.active',1)
	         ->where('expense_data.trip_link_id',$trip_link_id)
	         ->where('expense_data.expense_group',1)
	         ->order_by('expense_list.expense_name','asc')
	         ->get()
	         ->result(); 
	}
  

} 