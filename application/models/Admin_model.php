<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model{
	
	public function user($username,$password,$type){ 
		return	$this->db->select('*') 
			->from('user') 
			->where('username',$username) 
			->where('password',MD5($password)) 
			->where('type',$type) 
			->where('active',1) 
			->get() 
			->row();
	} 
	
	public function user_view(){ 
		return	$this->db->select('*') 
			->from('user')  
			->where_not_in('active',2) 
			->get() 
			->result();
	} 

	public function user_by_id($user_id){ 
	return	$this->db->select('*') 
			->from('user')  
			->where('id',$user_id) 
			->where('active',1) 
			->get() 
			->row();
	} 
	
	public function check_user(){ 
		return	$this->db->select('*') 
			->from('user')   
			->get() 
			->num_rows();
	} 

	public function save($data){ 
		return	$this->db->insert('user',$data);
	} 

	public function update($data){ 
		return	$this->db->where('id',$data['id'])
					->update('user',$data);
	} 
	
	public function app_setting()
	{ 
		return	$this->db->select('*') 
			->from('setting')  
			->get() 
			->row();
	} 

	public function app_setting_update($data){ 
		return	$this->db->where('id',$data['id'])
					->update('setting',$data);
	} 
       
} 