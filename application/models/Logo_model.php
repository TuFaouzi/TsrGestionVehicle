<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logo_model extends CI_Model {

        public function save($data){
                $this->db->insert('logo',$data);	
	}
        public function logo_view(){
            return $this->db->select('*')
			->from('logo')
			->get()
			->result();
        }
        function edit($id)
	{
		$query=$this->db->query("SELECT * FROM logo WHERE logo_id='$id'");
		return $query->result();
	}
        function update($data)
	{
		$query=$this->db->where('logo_id',$data['logo_id'])->update('logo',$data);
	}
        public function delete($id){
            $this->db->where('logo_id',$id)->delete('logo');
        }

}
