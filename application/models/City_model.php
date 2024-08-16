<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class City_model extends CI_Model{
	
	
	public function city_info(){
		return $this->db->select('city.*,state.state_name as district_name')
			->from('city')
			->join('state','city.state_id = state.state_id')
			->where_not_in('city.active',2) 
	    	->order_by('city.city_id','desc')
			->get()
			->result(); 
	}
	
	 public function city_edit($city_id){
		return $this->db->select('*')
			->from('city')
			->where('city_id',$city_id)
			->get()
			->result();
	 }
	
	function delete_city($city_id){
		return $this->db->set('active', 2)
			->where('city_id', $city_id)
			->update('city');
	}
	
	public function save_city($data){
		$data['posting_id'] = $this->session->userdata('user_id');
		if(!empty($data['city_id'])){
			$this->db->where('city_id',$data['city_id']);
			$this->db->update('city',$data);
		}else{
			$this->db->insert('city',$data);
		}
	} 
	
	public function get_district(){
	$districtlist = $this->db->where('active',1)->order_by('state_name','asc')->get('state')->result();
	$districts[''] = display("selectstate");
	if(!empty ($districtlist)){
		foreach($districtlist as $district){
			$districts[$district->state_id] = $district->state_name;
			} 
		} 
	return $districts;
	}
	
} 