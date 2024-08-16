<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alert_center_model extends CI_Model{ 
	public function alerts(){
		return $this->db->select("vehicle_fitness.*,vehicle_info.v_registration_no")
				->from("vehicle_fitness") 
				->join("vehicle_info","vehicle_info.v_id = vehicle_fitness.v_id","full")
				->where("vehicle_fitness.active",1) 
				->get()
				->result(); 
	}
 
} 