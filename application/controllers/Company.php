<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        if($user_id == NULL){redirect('admin');} 
	   $this->load->model('company_model');
           
    }
	
	//==================this function for view comapany list (start) ========================//
	
	public function index(){
	$data['m_cmpny'] = 'active';
	$data['companys'] = $this->company_model->company(); 
        $data['content'] = $this->load->view('pages/company_view',$data,TRUE);
        $this->load->view('wrapper_main',$data);
	}
	//==================this function for view comapany list (start) ========================//


	//=============== This function for create company (Start) =============================//
	public function create(){	 
	$data['m_cmpny'] = 'active';
	$data['companys'] = (object) array('company_id'=>'','company_name'=>'','company_address'=>'','company_cell'=>'','company_email'=>'','company_web'=>'');
        $data['content'] = $this->load->view('pages/company_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);
		
	}
	
	//=============== This function for create company (End) =============================//
	
	//=============== This function for Save company (Start) =============================//
	
	
	public function save(){  
		$data['m_cmpny'] = 'active';
		$company_id = $this->input->post('company_id');//this name for get company id
		$company_name = trim($this->input->post('company_name'));//this name for get company name
		$company_address = trim($this->input->post('company_address'));//this name for get company address
		$company_cell = trim($this->input->post('company_cell'));//this name for get company cell no
		$company_email = trim($this->input->post('company_email'));//this name for get company e-mail
		$company_web = trim($this->input->post('company_web'));//this name for get company web
		$company_web = trim($this->input->post('company_web'));//this name for get company web
		$is_active = trim($this->input->post('active'));//this name for get company web

		$data['companys'] = (object) array('company_id'=> $company_id,'company_name'=> $company_name,'company_address'=> $company_address,'company_cell'=> $company_cell,'company_email'=> $company_email,'company_web'=> $company_web);
		//============================ for form validation (start) ====================//
		$this->form_validation->set_rules('company_name','Company Name','trim|required'); 
		$this->form_validation->set_rules('company_cell','Company Cell','trim'); 
		$this->form_validation->set_rules('company_email','Company E-Mail','trim');
		$this->form_validation->set_rules('active','Is Active','required'); 
		
	
			
		if($this->form_validation->run() == FALSE){
	        $data['content'] = $this->load->view('pages/company_form',$data,TRUE);
	        $this->load->view('wrapper_main',$data);
		} else{ 
			$saveData = array('company_id'=>$company_id,
								'company_name'=>$company_name,
								'company_address'=>$company_address,
								'company_cell'=>$company_cell,
								'company_email'=>$company_email,
								'company_web'=>$company_web,
								'active'=>$is_active
								); 	 
			$this->company_model->save($saveData);
                       
                        if(!empty($company_id)){
                            $this->session->set_flashdata('success', display('updatesuccessfully'));
                        }
                        else{
                            $this->session->set_flashdata('success', display('savesuccessfully'));
                        }
			redirect('company');
		}		
	}
	//=============== This function for Save company (End) =============================//
	
	//================this Function for edit Company(Start) ============================//
	
	
	public function edit_company($company_id=''){	
		if($this->session->userdata('isLogin') == FALSE 
			|| $this->session->userdata('user_type')!=9) {
			redirect('admin');
		}
		#
		$data['m_cmpny'] = 'active';
		$companyList = $this->company_model->edit_company($company_id);	
		$data['companys'] = $companyList[0];
        $data['content'] = $this->load->view('pages/company_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);
	}
	//================this Function for edit Company(End) ============================//
	
	//================this Function for Delete Company(Start) ============================//
	
	public function delete_company($company_id=''){
		if($this->session->userdata('isLogin') == FALSE 
			|| $this->session->userdata('user_type')!=9) {
			redirect('admin');
		}
                else{
                    $this->company_model->delete_company($company_id);
                    $this->session->set_flashdata('success', display('deletesuccessfully'));
		    redirect('company');
                }
		#
		
	}
	//================this Function for Delete Company(End) ============================//
 
}
	
	