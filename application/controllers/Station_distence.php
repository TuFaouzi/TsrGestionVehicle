<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Station_distence extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        if($user_id == NULL){redirect('admin');} 
        $this->load->model('station_distence_model');
    }

    //===================== vehicle type create (start) ===================================//
    public function station_distence_create() {
        $data['m_st'] = 'active';
        $data['measurement_scale'] = array(1 => 'Kilo Meters', 2 => 'Miles');
        $data['city'] = $this->station_distence_model->get_city();
        $data['distance_values'] = (object) ['distance_id' => '', 'city' => '', 'city_id_one' => '','city_id_two' => '', 'distance' => '', 'measurement_scale' => ''];
        $data['content'] = $this->load->view('pages/station_distence_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }

    //=======================vehicle type create(end) ===================================//
    //==============================vehicle type list view(start)==============================//
    public function station_distence_list() {
        $data['m_st'] = 'active';
        $data['distance_values'] = $this->station_distence_model->distence_list();
        $data['content'] = $this->load->view('pages/station_distence_view',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }

    //==============================vehicle type list view (end)==============================//
    //==============================vehicle type save(start)==============================//
    public function distence_save() {
        $data['m_st'] = 'active';
        $distance_id = $this->input->post('distance_id');
        $distance = trim($this->input->post('distance')); //this name for get dietence
        $measurement_scale = $this->input->post('measurement_scale'); //this name for get mesuring scale
        $city_id_one = $this->input->post('start_point'); //this name for get city id one
        $city_id_two = $this->input->post('end_point'); //this name for get city id two
        $city = $this->input->post('city'); //this name for get city id two
        $is_active = $this->input->post('active');

        $data['measurement_scale'] = array(1 => 'Kilo Meters', 2 => 'Miles');
        $data['distance_values'] = (object) array('distance_id' => $distance_id,'city'=>$city, 'city_id_one' => $city_id_one, 'city_id_two' =>$city_id_two , 'distance' => $distance, 'measurement_scale' => $measurement_scale);
        //============================ for form validation (start) ====================//
        $this->form_validation->set_rules('start_point','Start Point','required');
        $this->form_validation->set_rules('end_point','End Point','required'); 
        $this->form_validation->set_rules('distance','Distance','required'); 
        $this->form_validation->set_rules('active','Active','required'); 
        if($this->form_validation->run() == FALSE){
          $data['measurement_scale'] = array(1 => 'Kilo Meters', 2 => 'Miles');
          $data['city'] = $this->station_distence_model->get_city();
          $data['content'] = $this->load->view('pages/station_distence_form',$data,TRUE);
          $this->load->view('wrapper_main',$data);
        }
        //============================ for form validation (End) ====================//
        else{ 
            $all_value = array('distance_id' => $distance_id,
                'distance' => $distance,
                'measurement_scale' => $measurement_scale,
                'city_id_one' => $city_id_one,
                'city_id_two' => $city_id_two,
                'active' => $is_active
            );
            $this->station_distence_model->save($all_value);
            $this->session->set_flashdata('success', display('savesuccessfully'));
            redirect('station_distence/station_distence_list');
        }
    }

    //==============================vehicle type save(end)==============================//
    //================================vehicle type edit(start)===============================//
    public function station_distence_edit($distance_id = '') {
        if($this->session->userdata('isLogin') == FALSE 
            || $this->session->userdata('user_type')!=9) {
            redirect('admin');
        }
        #
        $data['m_st'] = 'active';
        $distenceList = $this->station_distence_model->edit($distance_id);
        $data['distance_values'] = $distenceList[0];
        $data['measurement_scale'] = array(1 => 'Kilo Meters', 2 => 'Miles');
        $data['city'] = $this->station_distence_model->get_city();
        $data['content'] = $this->load->view('pages/station_distence_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }
 

    //================================vehicle type edit(end)===============================//
    //================================vehicle type Delete(start)===============================//
    public function station_distence_delete($distance_id = '') {
        if($this->session->userdata('isLogin') == FALSE 
            || $this->session->userdata('user_type')!=9) {
            redirect('admin');
        }
        else{
            $this->station_distence_model->station_distence_delete($distance_id);
            $this->session->set_flashdata('success', display('savesuccessfully'));
            redirect('station_distence/station_distence_list');
        }
        #
        
        
    }

    //================================vehicle type Delete(start)===============================//
}
