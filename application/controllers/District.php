<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class District extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        if($user_id == NULL){redirect('admin');} 
	$this->load->model('district_model');
           
    }
	
	//============================== this function for show district list(start)=========//
	public function district_list(){
	$data['m_dist'] = 'active';
	$data['districts'] = $this->district_model->district_info(); 
        $data['content'] = $this->load->view('pages/district_info_view',$data,TRUE);
        $this->load->view('wrapper_main',$data);
	}
	
	//============================== this function for show district list(start)=========//
	
	//=============== This function for create district (Start) =============================//

	
	public function district_create(){	
	$data['m_dist'] = 'active';
	$data['districts'] = (object) array('state_id'=>'','state_name'=>''); 
        $data['content'] = $this->load->view('pages/district_info_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);	
	}
	
	//=============== This function for create district (End) =============================//
	
	//=============== This function for Save district (Start) =============================//
	
	
	public function district_save(){
		$data['m_dist'] = 'active';
		$state_id = $this->input->post('state_id');//this name for get state/district id
		$state_name = trim($this->input->post('state_name'));//this name for get driver name
		$is_active = trim($this->input->post('active'));
		$data['districts'] = (object) array('state_id'=> $state_id,'state_name'=> $state_name);
		//============================ for form validation (start) ====================//
		$this->form_validation->set_rules('state_name','State Name ','trim|required'); 
		if($this->form_validation->run() == FALSE){ 
	        $data['content'] = $this->load->view('pages/district_info_form',$data,TRUE);
	        $this->load->view('wrapper_main',$data);	
		} else{ 
			$saveData = array(
								'state_id' =>$state_id,
								'state_name'=> $state_name,
								'active' => $is_active						
							); 
                        
			$this->district_model->save_district($saveData);
                        if(!empty($state_id)){
                            $this->session->set_flashdata('success', display('updatesuccessfully'));
                        }
                        else{
                            $this->session->set_flashdata('success', display('savesuccessfully'));
                        } 
			redirect('district/district_list');
		}
				
	}

	//=============== This function for Save district (End) =============================//
	
	//================this Function for edit district(Start) ============================//
	
	
	
	public function state_edit($state_id=''){	
		if($this->session->userdata('isLogin') == FALSE 
			|| $this->session->userdata('user_type')!=9) {
			redirect('admin');
		}
		#
		$data['m_dist'] = 'active';
		if(!empty($state_id)){ 
			$element = $this->district_model->findById($state_id, 'state'); 
			if(empty($element)){
				show_404();
			}
		} 
		$stateList = $this->district_model->edit_state($state_id); 
		$data['districts'] = $stateList[0];  	        
		$data['content'] = $this->load->view('pages/district_info_form',$data,TRUE);
	        $this->load->view('wrapper_main',$data);	 
	}
	//================this Function for edit district(End) ============================//
	
	//================this Function for delete district(Start) ============================//
	
	
	public function delete_state($state_id=''){ 
		if($this->session->userdata('isLogin') == FALSE 
			|| $this->session->userdata('user_type')!=9) {
			redirect('admin');
		}
		#
		if($this->district_model->delete_state($state_id)){
                       $this->session->set_flashdata('success', display('deletesuccessfully'));
			redirect('district/district_list');	
		}
	}
	//================this Function for delete district(End) ============================//
	
	
}
	
	