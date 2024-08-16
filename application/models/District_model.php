<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class District_model extends CI_Model {

    public function district_info() {
        return $this->db->select('*')
            ->from('state')
            ->where_not_in('active', 2)
            ->order_by('state_id','desc')
            ->get()
            ->result();
    }

    public function edit_state($state_id) {
        return $this->db->select('*')
            ->from('state')
            ->where('state_id', $state_id)
            ->get()
            ->result();
    }

    function delete_state($state_id) {
        return$this->db->set('active', 2)
                ->where('state_id', $state_id)
                ->update('state');
    }

    public function save_district($data) {
        $data['posting_id'] = $this->session->userdata('user_id');
        if (!empty($data['state_id'])) {
            $this->db->where('state_id', $data['state_id']);
            $this->db->update('state', $data);
        } else {

            $this->db->insert('state', $data);
        }
    }

    public function findById($state_id = null, $table = null) {
        $query = $this->db->where('state_id', $state_id)->limit(1)->get($table);
        $element = $query->result_array();
        if (!empty($element)) {
            return $element[0];
        } 
    }

} 