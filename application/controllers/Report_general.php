<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_general extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        if($user_id == NULL){redirect('admin');} 
	    $this->load->model(array('report_general_model'));
    }
    /*
     * @function name - view
     * @parameter - no parameter
     * @return - array data
     * @author - Md. Shohrab Hossain
     * @created on - 13/10/2015
     */

    public function view(){ 
        $data['company'] = $this->report_general_model->get_all_company_info();
        $data['v_id'] = $this->report_general_model->get_all_vehicle_info();
        $data['driver_id'] = $this->report_general_model->get_all_driver_info();
        $data['content'] = $this->load->view('pages/report_general',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }  

    /*
     * @function name - generate
     * @parameter - no parameter
     * @return - array data
     * @author - Md. Shohrab Hossain
     * @created on - 13/10/2015
     */ 

    public function generate(){     
        $general_report = $this->input->post('general_report'); 
        $import_export = $this->input->post('import_export'); 
        $driver_id =$this->input->post('driver_id'); 
        $v_id =$this->input->post('v_id');  
        $company_id =$this->input->post('company_id'); 
        $date_1 = date("Y-m-d", strtotime($this->input->post('date_1'))); 
        $date_2 = date("Y-m-d", strtotime($this->input->post('date_2'))); 

        $data['trip'] = $this->report_general_model->generate_report($general_report,$import_export,$driver_id,$v_id,$company_id,$date_1,$date_2);  
        $data['doubble_trip'] = $this->doubble_trip();
        #showing the view page
        $data['company'] = $this->report_general_model->get_all_company_info();
        $data['v_id'] = $this->report_general_model->get_all_vehicle_info();
        $data['driver_id'] = $this->report_general_model->get_all_driver_info();
        $data['content'] = $this->load->view('pages/report_general',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }   

    public function doubble_trip(){ 
        $result = $this->db->select("trip.trip_link_id")
        ->from("trip")
        ->where("trip_type",2)
        ->or_where("trip_type",4)
        ->or_where("trip_type",6)
        ->get()
        ->result();
        foreach ($result as $key => $value) {
            $doubble[$key] = $value->trip_link_id;
        } 
        if(!empty($doubble)) return $doubble;
    }
    
}