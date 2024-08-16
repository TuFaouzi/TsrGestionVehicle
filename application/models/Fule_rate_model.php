<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fule_rate_model extends CI_Model{
	
	public function fule_rate(){
		$query = "SELECT
					vehicle_fuel_rate.*,
					vehicle_info.v_registration_no, 
					vehicle_info.v_model_no, 
					vehicle_info.v_engine_no 
				FROM `vehicle_fuel_rate` 
				inner join 
				vehicle_info on vehicle_info.v_id = vehicle_fuel_rate.v_id
				WHERE vehicle_fuel_rate.active NOT LIKE '2' order by v_fuel_id desc
				";
		return $this->db->query($query)
				->result();
	}
	
	public function edit_rate($v_fuel_id = ''){ 
		return $this->db->select('*')
				->from('vehicle_fuel_rate')
				->where('v_fuel_id',$v_fuel_id)
				->get()
				->result();
	}
	
	public function delete_rate($v_fuel_id){
		return $this->db->set('active',2)
				->where('v_fuel_id',$v_fuel_id)
				->update('vehicle_fuel_rate'); 	
	}
	
	public function save($data){
		$data['v_fuel_last_update_dat'] = date("Y-m-d h:i:s");
		if(!empty($data['v_fuel_id'])){
			$this->db->where('v_fuel_id',$data['v_fuel_id']);
			$this->db->update('vehicle_fuel_rate',$data);
		}else{
			$this->db->insert('vehicle_fuel_rate',$data);
		}
	} 
	
	
	public function get_vehicle_model(){
		$query = $this->db->where('active',1)->get('vehicle_info');
		$reglist = $query->result();
		$regs[''] = lang("SELECT_VEHICLE_REGISTRATION_NO");
		if(!empty ($reglist)){
			foreach($reglist as $reg){
				$regs[$reg->v_id] = $reg->v_registration_no;
				} 
			}
		return $regs;
	}


} 