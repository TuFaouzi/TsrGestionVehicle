<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rent_model extends CI_Model {

    public function rent_list() {
        $sql = "SELECT company_rent.*, 
                add_company.company_name,
                vehicle_type.v_type, 
                (SELECT city.city_name as ss FROM city WHERE company_rent.starting_station_id=city.city_id) AS starting_st,
                (SELECT city.city_name as es FROM  city WHERE company_rent.ending_station_id=city.city_id) as ending_st
                FROM company_rent left join add_company on add_company.company_id = company_rent.company_id 
                left join vehicle_type on vehicle_type.v_type_id = company_rent.v_type_id
                left join city on city.city_id = company_rent.`starting_station_id` and city.city_id = company_rent.`ending_station_id`
                where company_rent.`active` NOT LIKE 2 ORDER BY company_rent.company_rent_id DESC";
        return $this->db->query($sql)->result();
    }

    public function edit_rent($company_rent_id = '') {
        return $this->db->select('*')
            ->from('company_rent')
            ->where('company_rent_id', $company_rent_id)
            ->get()
            ->result();
    }

    function delete_rent($company_rent_id) {
        return $this->db->where('company_rent_id',$company_rent_id)
            ->delete('company_rent'); 
    }

    public function save($data) {
        $data['posting_id'] = $this->session->userdata('user_id');
        if (!empty($data['company_rent_id'])) {
            $this->db->where('company_rent_id', $data['company_rent_id']);
            $this->db->update('company_rent', $data);
        } else {

            $this->db->insert('company_rent', $data);
        }
    }

    public function get_company_name() {
        $query = $this->db->where('active',1)->order_by('company_name','asc')->get('add_company');
        $companyList = $query->result();
        $companys[''] = display("selectcompanyname");
        if (!empty($companyList)) {
            foreach ($companyList as $company) {
                $companys[$company->company_id] = $company->company_name;
            }
            return $companys;
        }
    }

    public function get_vehicle_type() {
        $query = $this->db->where('active',1)->order_by('v_type','asc')->get('vehicle_type');
        $vehicle_typeList = $query->result();
        $type_lists[''] = display('selectvehiclttype');
        if (!empty($vehicle_typeList)) {
            foreach ($vehicle_typeList as $vehicle_list) {
                $type_lists[$vehicle_list->v_type_id] = $vehicle_list->v_type;
            }
        }
        return $type_lists;
    }

    public function get_start_point() {
        $query = $this->db->where('active',1)->order_by('city_name','asc')->get('city');
        $point_list = $query->result();
        $locations[''] = display('selectstartingpoint');
        if (!empty($point_list)) {
            foreach ($point_list as $points) {
                $locations[$points->city_id] = $points->city_name;
            }
        }
        return $locations;
    }

    public function get_end_point() {
        $query = $this->db->where('active',1)->order_by('city_name','asc')->get('city');
        $point_list = $query->result();
        $locations[''] = display('selectendingpoint');
        if (!empty($point_list)) {
            foreach ($point_list as $points) {
                $locations[$points->city_id] = $points->city_name;
            }
        }
        return $locations;
    } 

    public function get_company_info() {
       $data = $this->db->select('*')
             ->from('add_company')
             ->where('active', 1) 
             ->order_by('company_name','asc')
             ->get()
             ->result(); 
        $array[''] = display("COMPANUNAME");        
        if(!empty ($data)){
            foreach($data as $value){
                $array[$value->company_id] = $value->company_name;
            }
        }
        return $array;
    } 
}
