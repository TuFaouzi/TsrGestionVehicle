<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_company_model extends CI_Model{

	public function company_bill($data = NULL){ 
        $this->db->trans_start();

        $this->db->select("
            trip.*, add_company.*, (trip.others_company) AS company_name,
            (SELECT city_name FROM city WHERE trip.start_station_id = city.city_id) AS start_city, 
            (SELECT city_name FROM city  WHERE trip.end_station_id = city.city_id) AS end_city 
            ");
        $this->db->from("trip"); 
        $this->db->join("add_company","add_company.company_id = trip.company_id","left");
        if(!empty($data['others_company'])): //others company
            $this->db->like('trip.others_company',trim($data['others_company']),"none");
        elseif(!empty($data['company_id'])): //contact company id
            $this->db->where('trip.company_id',$data['company_id']); 
        endif;
        if(!empty($data['import_export'])): //check export/import
            if($data['import_export'] == 4): //for local trip
                $this->db->where('import_export',0); 
            else:
                $this->db->where('import_export',$data['import_export']); 
            endif;
        endif;
        $this->db->where("trip.date BETWEEN '$data[date_1]' AND '$data[date_2]'", NULL, FALSE);
        $this->db->where('trip.active', 1);
        $this->db->order_by("trip.date","asc");

        return $this->db->get()->result(); 
        $this->db->trans_complete();
	} 

	public function get_company_info($company_id){
	   return $this->db->select("*")
			->from("add_company")
			->where("company_id",$company_id)
			->get()
			->row();		
	}

    public function get_all_company_info() {
       $data = $this->db->select('*')
             ->from('add_company')
             ->where('active', 1) 
             ->get()
             ->result(); 
            $array[''] = lang("COMPANY_NAME");        
            if(!empty ($data)){
                foreach($data as $value){
                    $array[$value->company_id] = $value->company_name;
                } 
            }
        return $array;
    } 
} 