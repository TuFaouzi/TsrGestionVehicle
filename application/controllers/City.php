<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class City extends CI_Controller {//this controller for city wise stations

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') == FALSE) {
            redirect('admin');
        } 
        $this->load->model('city_model');
    }

    //============================== this function for show city list(start)=========//
    public function city_list() {
        $data['m_station'] = 'active';
        $data['citys'] = $this->city_model->city_info(); 
        $data['content'] = $this->load->view('pages/city_view',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }

    //============================== this function for show city list(start)=========//
    //=============== This function for create city (Start) =============================//


    public function city_create() { 
        $data['m_station'] = 'active';
        $data['state_id'] = $this->city_model->get_district();
        $data['citys'] = (object) array('city_id' => '', 'state_id' => '', 'city_name' => '', 'active' => '');
        $data['content'] = $this->load->view('pages/city_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }

    //=============== This function for create city (End) =============================//
    //=============== This function for Save city (Start) =============================//


    public function city_save() {
        $data['m_station'] = 'active';
        $city_id = $this->input->post('city_id'); //this name for get state/city id
        $state_id = $this->input->post('state_id'); //this name for get district id
        $city_name = trim($this->input->post('city_name')); //this name for get city name
        $is_active = trim($this->input->post('active'));
        $data['state_id'] = $this->city_model->get_district(); 
        $data['citys'] = (object) array('city_id' => $city_id, 'state_id' => $state_id, 'city_name' => $city_name);

        //============================ for form validation (start) ====================//
        $this->form_validation->set_rules('state_id', 'State Name ', 'trim|required');
        $this->form_validation->set_rules('city_name', 'City Name ', 'trim|required');
        $this->form_validation->set_rules('active', 'Is Active', 'required');
        if ($this->form_validation->run()==FALSE){
            $data['content'] = $this->load->view('pages/city_form',$data,TRUE);
            $this->load->view('wrapper_main',$data);
        }else{   
            $saveData = array(
                'city_id' => $city_id,
                'state_id' => $state_id,
                'city_name' => $city_name,
                'active' => $is_active,
            ); 
            $this->city_model->save_city($saveData);
            if(!empty($city_id)){
                $this->session->set_flashdata('success', display('updatesuccessfully'));
            }
            else{
                $this->session->set_flashdata('success', display('savesuccessfully'));
            }
            redirect('city/city_list');
        }
    }

    //=============== This function for Save city (End) =============================//
    //==========================this Function for edit city(Start) ============================//


    public function edit($city_id = '') { 
        if($this->session->userdata('isLogin') == FALSE 
            || $this->session->userdata('user_type')!=9) {
            redirect('admin');
        }
        #
        $data['m_station'] = 'active';
        $data['state_id'] = $this->city_model->get_district();
        $companyList = $this->city_model->city_edit($city_id);
        $data['citys'] = $companyList[0]; 
        $data['content'] = $this->load->view('pages/city_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }

    //================this Function for edit city (end) ============================//
    //================this Function for delete city(Start) ============================//


    public function delete_state($city_id = '') {  
        if($this->session->userdata('isLogin') == FALSE 
            || $this->session->userdata('user_type')!=9) {
            redirect('admin');
        }
        #
        if ($this->city_model->delete_city($city_id)) {
            $this->session->set_flashdata('success', display('deletesuccessfully'));
            redirect('city/city_list');
        }
    }

    //================this Function for delete city(End) ============================//
}
