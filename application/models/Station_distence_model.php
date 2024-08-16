<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Station_distence_model extends CI_Model {

    public function get_vehicle_model() { 
        $query = $this->db->get('vehicle_info');
        $reglist = $query->result();
        $regs[''] = display("selectvehiclemodel");
        if (!empty($reglist)) {
            foreach ($reglist as $reg) {
                $regs[$reg->v_id] = $reg->v_registration_no;
            }
        }
        return $regs;
    }

    public function save($data) { 
        $data['posting_id'] = $this->session->userdata('user_id');
        if (!empty($data['distance_id'])) {
            $this->db->where('distance_id', $data['distance_id']);
            if ($this->db->update('city_city_distance', $data)) {
                return TRUE;
            }
        } else {
            if ($this->db->insert('city_city_distance', $data)) {
                return TRUE;
            }
        }
    }

    public function distence_list() { 
        $sql = "SELECT *,  
		(
                    SELECT 
                            city_name 
                    FROM 
                            city 
                            WHERE city_city_distance.city_id_one = city.city_id
                            ) AS start_point, 
                                      (
                                              SELECT 
                                                      city_name 
                                              FROM 
                                                      city 
                                                      WHERE city_city_distance.city_id_two = city.city_id
                                      ) AS end_point                                                            
                            FROM 
                                    city_city_distance 
                            WHERE city_city_distance.active
                    NOT LIKE 2  order by city_city_distance.distance_id desc";
        return $this->db->query($sql)
                ->result(); 
    }


    public function edit($distance_id = '') {
        return $this->db->select('*')
                    ->from('city_city_distance')
                    ->where('distance_id', $distance_id)
                    ->get()
                    ->result();
    }

    public function station_distence_delete($distance_id) {
        return $this->db->set('active',2)
                 ->where('distance_id',$distance_id)
                 ->update('city_city_distance');
    }



    //******************************************* VEHICLE FITNESS (end)*************************//
    public function get_city() {
       return $this->db->select("state.*")
                    ->from('state')
                    ->join('city','state.state_id = city.state_id')
                    ->where('city.active',1)
                    ->group_by('state.state_id')
                    ->get()
                    ->result(); 
    }


    public function state_dropdown() {
       $data = $this->db->select('state_id,state_name')
             ->from('state') 
             ->order_by('state_name','asc')
             ->get()
             ->result();      
            if(!empty ($data)){
                foreach($data as $value){
                    $array[$value->company_id] = $value->company_name;
                } 
            }
        if(!empty($array)) return $array;
    } 

}