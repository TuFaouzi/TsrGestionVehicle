<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Rent extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        if($user_id == NULL){redirect('admin');} 
        $this->load->model('rent_model');
    }

    //==================this function for view comapany list (start) ========================//

    public function index() {
        $data['m_cr'] = 'active';
        $data['rents'] = $this->rent_model->rent_list(); 
        $data['content'] = $this->load->view('pages/rent_view',$data,TRUE);
        $this->load->view('wrapper_main',$data);
        //==================this function for view comapany list (start) ========================//
    }

    //=============== This function for create company (Start) =============================//


    public function create() {
        $data['m_cr'] = 'active';
        $data['company_id'] = $this->rent_model->get_company_name();
        $data['v_type_id'] = $this->rent_model->get_vehicle_type();
        $data['starting_station_id'] = $this->rent_model->get_start_point();
        $data['ending_station_id'] = $this->rent_model->get_end_point();
        $data['rents'] = (object) array('company_rent_id' => '', 'company_id' => '', 'v_type_id' => '', 'starting_station_id' => '',
                    'ending_station_id' => '', 'rent_type' => '', 'rent' => '', 'vat' => '', 'vat_status' => '',);
        $data['content'] = $this->load->view('pages/rent_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }

    //=============== This function for create company (End) =============================//
    //=============== This function for Save company (Start) =============================//


    public function save() {
        $data['m_cr'] = 'active';
        $company_rent_id = $this->input->post('company_rent_id'); //this name for get rent id
        $company_id = $this->input->post('company_id'); //this name for get company id
        $v_type_id = $this->input->post('v_type_id'); //this name for get vehicle type id
        $starting_station_id = $this->input->post('starting_station_id'); //this name for get district
        $ending_station_id = $this->input->post('ending_station_id'); //this name for get district
        $rent_type = $this->input->post('rent_type'); //this name for get company web
        $rent = $this->input->post('rent'); //this name for get company web
        $vat = $this->input->post('vat'); //this name for get company web
        $vat_status = $this->input->post('vat_status'); //this name for get company web
        $is_active = $this->input->post('active'); //this name for get company web

        $data['company_id'] = $this->rent_model->get_company_name();
        $data['v_type_id'] = $this->rent_model->get_vehicle_type();
        $data['starting_station_id'] = $this->rent_model->get_start_point();
        $data['ending_station_id'] = $this->rent_model->get_end_point();
        $data['rents'] = (object) array('company_rent_id' => $company_rent_id, 'company_id' => $company_id,
                    'starting_station_id' => $starting_station_id,
                    'ending_station_id' => $ending_station_id,
                    'rent_type' => $rent_type, 'rent' => $rent,
                    'vat' => $vat,'vat_status' => $vat_status,
                    'v_type_id' => $v_type_id);

        $all_value = array('company_rent_id' => $company_rent_id,
            'company_id' => $company_id,
            'starting_station_id' => $starting_station_id,
            'ending_station_id' => $ending_station_id,
            'rent_type' => $rent_type,
            'rent' => $rent,
            'vat' => $vat,
            'vat_status' => $vat_status,
            'v_type_id' => $v_type_id,
            'active' => $is_active
        ); 

        $this->rent_model->save($all_value);
        if(!empty($company_rent_id)){
            $this->session->set_flashdata('success', display('updatesuccessfully'));
        }
        else{
            $this->session->set_flashdata('success', display('savesuccessfully'));
        }
        redirect('rent');
    }

    //=============== This function for Save company (End) =============================//
    //================this Function for edit Company(Start) ============================//


    public function edit_rent($company_rent_id = '') {
        if($this->session->userdata('isLogin') == FALSE 
            || $this->session->userdata('user_type')!=9) {
            redirect('admin');
        }
        #
        $data['m_cr'] = 'active'; 
        $data['company_id'] = $this->rent_model->get_company_name();
        $data['v_type_id'] = $this->rent_model->get_vehicle_type();
        $data['starting_station_id'] = $this->rent_model->get_start_point();
        $data['ending_station_id'] = $this->rent_model->get_end_point();  
        $rentList = $this->rent_model->edit_rent($company_rent_id);
        $data['rents'] = $rentList[0]; 
        $data['content'] = $this->load->view('pages/rent_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    } 
    //================this Function for edit Company(End) ============================//
    

    //================this Function for Delete Company(Start) ============================//
    public function delete_rent($company_rent_id = '') {
        if($this->session->userdata('isLogin') == FALSE 
            || $this->session->userdata('user_type')!=9) {
            redirect('admin');
        }
        else{
            $this->rent_model->delete_rent($company_rent_id);
            $this->session->set_flashdata('success', display('deletesuccessfully'));
            redirect('rent');
        }
    } 
    //================this Function for Delete Company(End) ============================//

 
}
