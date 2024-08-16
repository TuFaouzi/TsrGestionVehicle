<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Driver_info_model extends CI_Model{
	
	public function driver_info(){
	    return $this->db->select('driver_info.*, (vehicle_info.v_registration_no) AS v_reg')
			->from('driver_info')
			->join('vehicle_info','vehicle_info.v_id = driver_info.v_registration_no','left')
			->where_not_in('driver_info.active',2)
			->order_by('driver_info.driver_id','desc')
			->get()
			->result(); 
	}		


	public function driver_by_id($driver_id = NULL){
	    return $this->db->select('driver_info.*, (vehicle_info.v_registration_no) AS v_reg')
			->from('driver_info')
			->join('vehicle_info','vehicle_info.v_id = driver_info.v_registration_no','left')
			->where('driver_id',$driver_id)
			->get()
			->row(); 
	}
	
	public function get_driver_info($driver_id = NULL){
	    return $this->db->select('driver_info.*')
			->from('driver_info')
			// ->join('vehicle_info','vehicle_info.v_id = driver_info.v_registration_no')
			->where('driver_id',$driver_id)
			->get()
			->result(); 
	}
	
	function delete_info($driver_id = NULL){
		return $this->db->set('active',2)
			->where('driver_id',$driver_id)
			->update('driver_info');
	}
	
	public function save($data = NULL){
		if(!empty($data['driver_id'])){
			$this->db->where('driver_id',$data['driver_id']);
			$this->db->update('driver_info',$data);
		}else{
			$this->db->insert('driver_info',$data);
		}
		
	} 
	
	public function get_vehicle_model(){ 
		return $this->db->select("*,(select v_type from vehicle_type where vehicle_type.v_type_id = vehicle_info.v_type) as v ")
			->from('vehicle_info')
			->where('active',1)
			->get()
			->result();
	}

	public function driver_dropdown(){
	$drivers = $this->db->where('active',1)->order_by('driver_name','asc')->get('driver_info')->result();
	$driver[''] = lang("SELECT_DRIVER");
	if(!empty ($drivers)){
		foreach($drivers as $value){
			$driver[$value->driver_id] = $value->driver_name;
			} 
		} 
	if(!empty($driver)) return $driver;
	}


} 