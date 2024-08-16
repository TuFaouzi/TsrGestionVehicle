<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fule_rate extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        if($user_id == NULL){redirect('admin');} 
	   $this->load->model('fule_rate_model');
           
    }
	
	//=================this fubction for view fule rate list(start) ===================//
	public function index(){
		$data['m_fuel'] = "active";
		$data['rates'] = $this->fule_rate_model->fule_rate();      
		$data['content'] = $this->load->view('pages/fule_rate_view',$data,TRUE);
        $this->load->view('wrapper_main',$data);
	}
	//=================this fubction for view fule rate list(End) ===================//
	
	//=============== This function for create/insert fule rate (Start) =============================//
	
	
	public function create(){	
		$data['m_fuel'] = "active";
		$data['v_id'] = $this->fule_rate_model->get_vehicle_model();
		$data['rates'] = (object) array('v_fuel_id'=>'','v_id'=>'','v_fuel_per_kilo_litter'=>'','v_fuel_rate'=>'');
		$data['content'] = $this->load->view('pages/fule_rate_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);	
	}
	//=============== This function for create/insert fule rate (Start) =============================//

	
	
	//=============== This function for Save fule rate (Start) =============================//
	
	
	public function save(){
		$data['m_fuel'] = "active";
		$v_fuel_id = $this->input->post('v_fuel_id');//this id for get fule rate id
		$v_id = trim($this->input->post('v_id'));//this name for get vehicle registration no
		$v_fuel_per_kilo_litter = trim($this->input->post('v_fuel_per_kilo_litter'));//this name for get fule
		$v_fuel_rate = trim($this->input->post('v_fuel_rate'));//this name for get fule
	    $is_active = trim($this->input->post('active'));//this name for get fule
	   
	    $data['v_id'] = $this->fule_rate_model->get_vehicle_model();
		$data['rates'] = (object) array('v_fuel_id'=> $v_fuel_id,'v_id'=> $v_id,'v_fuel_per_kilo_litter'=> $v_fuel_per_kilo_litter,'v_fuel_rate'=>$v_fuel_rate);
		//============================ for form validation (start) ====================//
		$this->form_validation->set_rules('v_fuel_rate','Fuel Rate','trim|required'); 
		$this->form_validation->set_rules('v_fuel_per_kilo_litter','Fuel Per Kilo ','required'); 
		$this->form_validation->set_rules('active','Is Active','required'); 
		if($this->form_validation->run() == FALSE){
			$data['content'] = $this->load->view('pages/fule_rate_form',$data,TRUE);
	        $this->load->view('wrapper_main',$data);
		} else{
			$saveData = array(
                                'v_fuel_id' =>$v_fuel_id,
                                'v_id'=> $v_id,
                                'v_fuel_per_kilo_litter'=> $v_fuel_per_kilo_litter,
                                'v_fuel_rate' => $v_fuel_rate,
                                'posting_id' => $this->session->userdata('user_id'),
                                'active' => $is_active
			 ); 
			$this->fule_rate_model->save($saveData);
                        if(!empty($v_fuel_id)){
                            $this->session->set_flashdata('success', display('updatesuccessfully'));
                        }
                        else{
                            $this->session->set_flashdata('success', display('savesuccessfully'));
                        }
                        
			redirect('fule_rate');
		}
	}
	//=============== This function for Save Fuel Rate (End) =============================//
	
	//================this Function for edit Fuel Rate(Start) ============================//
	
	
	public function rate_edit($v_fuel_id=''){	
        if($this->session->userdata('isLogin') == FALSE 
            || $this->session->userdata('user_type')!=9) {
            redirect('admin');
        }
        #
		$data['m_fuel'] = "active";
		$data['v_id'] = $this->fule_rate_model->get_vehicle_model();
		$rateList = $this->fule_rate_model->edit_rate($v_fuel_id);
		$data['rates'] = $rateList[0];
		$data['content'] = $this->load->view('pages/fule_rate_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);
	}
	//================this Function for edit Fuel Rate(End) ============================//
	//================this Function for Delete Fuel Rate(Start) ============================//
	
	public function delete_rate($v_fuel_id=''){
        if($this->session->userdata('isLogin') == FALSE 
            || $this->session->userdata('user_type')!=9) {
            redirect('admin');
        }
        else{
            $this->fule_rate_model->delete_rate($v_fuel_id);
            $this->session->set_flashdata('success', display('deletesuccessfully'));
            redirect('fule_rate');	
        }
        #
		
	}
	//================this Function for Delete Fuel Rate(End) ============================//
	
	
}
	
	