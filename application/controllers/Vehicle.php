<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vehicle extends CI_Controller {
    
    public function __construct() {
		parent::__construct();
		$user_id = $this->session->userdata('user_id');
		if($user_id == NULL){redirect('admin');}
		$this->load->model('vehicle_model');
    }
	//===================== vehicle type create (start) ===================================//
	public function vehicle_type_create(){
	$data['m_v_l'] = 'active';
	$data['vehicle_types'] = (object) array('v_type_id'=>'','v_type'=>'');		
        $data['content'] = $this->load->view('pages/vehicle_type_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);
	}
	//=======================vehicle type create(end) ===================================//
	
	//==============================vehicle type list view(start)==============================//
	public function vehicle_type_list(){
	$data['m_v_l'] = 'active';
	$data['vehicle_types'] = $this->vehicle_model->vehicle_list(); 
        $data['content'] = $this->load->view('pages/vehicle_type_view',$data,TRUE);
        $this->load->view('wrapper_main',$data);
	}
 
	
	//==============================vehicle type list view (end)==============================//
	
	//==============================vehicle type save(start)==============================//
	public function vehicle_type_save(){ 
		$data['m_v_l'] = 'active';
		$v_type_id = $this->input->post('v_type_id');
		$v_type = trim($this->input->post('v_type')); //this name for get vehicle type
		$is_active = trim($this->input->post('active')); //this name for get vehicle type
		$data['vehicle_types'] = (object) array('v_type_id'=>$v_type_id,'v_type'=>$v_type);
		//============================ for form validation (start) ====================//
		$this->form_validation->set_rules('v_type','Vehicle Type','trim|required'); 
		$this->form_validation->set_rules('active','Is Active','required'); 
                
                if($this->form_validation->run() == FALSE){
                $data['content'] = $this->load->view('pages/vehicle_type_form',$data,TRUE);
                $this->load->view('wrapper_main',$data);
                } else{
                        $saveData = array(
                                'v_type_id'=>$v_type_id,
                                'v_type'=>$v_type,
                                'active'=>$is_active,
                                );
                        $this->vehicle_model->save($saveData);
                        if(!empty($v_type_id)){
                            $this->session->set_flashdata('success', display('updatesuccessfully'));
                        }
                        else{
                            $this->session->set_flashdata('success', display('savesuccessfully'));
                        }
                        
                        redirect('vehicle/vehicle_type_list');
                        
                }
                
		
	}
	//==============================vehicle type save(end)==============================//
	
	//================================vehicle type edit(start)===============================//
	public function vehicle_type_edit($v_type_id = ''){	
        if($this->session->userdata('isLogin') == FALSE 
            || $this->session->userdata('user_type')!=9) {
            redirect('admin');
        }
        #
	$data['m_v_l'] = 'active';
	$vehicleList = $this->vehicle_model->vehicle_type_edit($v_type_id);	
	$data['vehicle_types'] = $vehicleList[0]; 
        $data['content'] = $this->load->view('pages/vehicle_type_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);
	}
	
	
	//================================vehicle type edit(end)===============================//
	
	//================================vehicle type Delete(start)===============================//
	public function vehicle_type_delete($v_type_id = ''){
        if($this->session->userdata('isLogin') == FALSE 
            || $this->session->userdata('user_type')!=9) {
            redirect('admin');
        }
        else{
            $this->vehicle_model->delete_vehicle($v_type_id);
            $this->session->set_flashdata('success', display('deletesuccessfully'));
	    redirect('vehicle/vehicle_type_list');
        }
        #
		
		
	}
	
	
	//================================vehicle type Delete(start)===============================//
	
//***********************************************VEHICLE INFORMATION (START)*************************************//	
	
	//================================vehicle Information create(start)===============================//
	
	public function vehicle_information_create(){
		$data['m_v_li'] = 'active';
		$data['v_type'] = $this->vehicle_model->get_vehicle_type();
		$data['v_owner'] = array( 0 => 'Hire', 1 => 'Own');
		$data['vehicle_infos'] = (object) array('v_id'=>'','v_owner'=>'','v_model_no'=>'','v_registration_no'=>'','v_chassis_no'=>'','v_engine_no'=>'','v_type'=>'');		
                $data['content'] = $this->load->view('pages/vehicle_information_form',$data,TRUE);
                $this->load->view('wrapper_main',$data);
	}
	
	
	//================================vehicle Information create (End)===============================//
	
	//=============================vehicle information save(start) ===================================//
	public function vehicle_information_save(){
		$data['m_v_li'] = 'active';
		$v_id = $this->input->post('v_id');
		$v_model_no = trim($this->input->post('v_model_no')); //this name for get vehicle model 
		$v_registration_no = trim($this->input->post('v_registration_no')); //this name for get reg no
		$v_chassis_no = trim($this->input->post('v_chassis_no')); //this name for get chess no
		$v_engine_no = trim($this->input->post('v_engine_no')); //this name for get engine no
		$v_type = $this->input->post('v_type'); //this name for get vehicle type from dropdown
		$v_owner = $this->input->post('v_owner'); //this name for get owner from dropdown
		$is_active = $this->input->post('active'); //this name for get owner from dropdown
		
		$data['v_type'] = $this->vehicle_model->get_vehicle_type();
		$data['v_owner'] = array( 0 => 'Hire', 1 => 'Own');
		$data['vehicle_infos'] = (object) array('v_id'=>$v_id,'v_model_no'=>$v_model_no,'v_registration_no'=>$v_registration_no,'v_chassis_no'=>$v_chassis_no,'v_engine_no'=>$v_engine_no,'v_type'=>$v_type,'v_owner'=>$v_owner);		
		//============================ for form validation (start) ====================//
		$this->form_validation->set_rules('v_registration_no','Vehicle Registrarion NO','trim|required'); 
		$this->form_validation->set_rules('v_type','Vehicle Type','required'); 
		$this->form_validation->set_rules('v_owner','Vehicle Owner','required'); 
			
			if($this->form_validation->run() == FALSE){
		        $data['content'] = $this->load->view('pages/vehicle_information_form',$data,TRUE);
		        $this->load->view('wrapper_main',$data);
			}else{
				$saveData = array(
				'v_id' => $v_id,
				'v_model_no' => $v_model_no,
				'v_registration_no' => $v_registration_no,
				'v_chassis_no' => $v_chassis_no,
				'v_engine_no' => $v_engine_no,
				'v_type' => $v_type,		
				'v_owner' => $v_owner,	
				'active' => $is_active
				);		

				$this->vehicle_model->vehicle_info_save($saveData);
                                if(!empty($v_id)){
                                     $this->session->set_flashdata('success', display('updatesuccessfully'));
                                }
                                else{
                                    $this->session->set_flashdata('success', display('savesuccessfully'));
                                }
				redirect('vehicle/vehicle_info_list');
			}
	}

	//=============================vehicle information save(end) ===================================//
	
	//=================================== vehicle information list (start)===================//
	
	public function vehicle_info_list(){
	$data['m_v_li'] = 'active';
	$data['vehicle_infos'] = $this->vehicle_model->info_list(); 
        $data['content'] = $this->load->view('pages/vehicle_information_view',$data,TRUE);
        $this->load->view('wrapper_main',$data); 
	}
	
	//=================================== vehicle information list (end)===================//
	
	
	//======================================  vehicle information edit (Start)==========================//
	
	public function vehicle_info_edit($v_id = ''){
        if($this->session->userdata('isLogin') == FALSE 
            || $this->session->userdata('user_type')!=9) {
            redirect('admin');
        }
        #
		$data['m_v_li'] = 'active';
		$data['v_type'] = $this->vehicle_model->get_vehicle_type();
		$data['v_owner'] = array( 0 => 'Hire', 1 => 'Own');  
		$infoList = $this->vehicle_model->vehicle_info_edit($v_id);	
		$data['vehicle_infos'] = $infoList[0]; 
        $data['content'] = $this->load->view('pages/vehicle_information_form',$data,TRUE);
        $this->load->view('wrapper_main',$data); 
	}
	//======================================  vehicle information  edit (Start)==========================//
	
	//======================================  vehicle information delete (Start)==========================//
	public function vehicle_info_delete($v_id = ''){
        if($this->session->userdata('isLogin') == FALSE 
            || $this->session->userdata('user_type')!=9) {
            redirect('admin');
        }
        else{
            $this->vehicle_model->vehicle_info_delete($v_id);
            $this->session->set_flashdata('success', display('deletesuccessfully'));
            redirect('vehicle/vehicle_info_list'); 
        }
        #

	}
	
	//======================================  vehicle information delete (end)==========================//
	
	//**********************************************VEHICLE INFORMATION (end)************************************************//
	
	//--------------------------------------------------------------------------------------------//
	
	//************************************************VEHICLE FITNESS (START)===================================//
	
	
	//=====================================vehicle fitness create (start)=====================//
	public function vehicle_fitness_add(){
		$data['m_fit'] = 'active';
		$data['v_id'] = $this->vehicle_model->get_vehicle_model();
		$data['vehicle_fitnes'] = (object) array('v_fitness_id'=>'','v_id'=>'','reg_issue'=>'',
                                'reg_expire'=>'','fitness_issue'=>'',
                                'fitness_expire'=>'','insurance_issue'=>'',
                                'insurance_expire'=>'','tax_issue'=>'',
                                'tax_expire'=>'','root_permit_issue'=>'',
                                'root_permit_expire'=>'');	 
        $data['content'] = $this->load->view('pages/vehicle_fitness_form',$data,TRUE);
        $this->load->view('wrapper_main',$data); 
	}
	
	//=====================================vehicle fitness create (end)=====================//
	//=====================================vehicle fitness Save (end)=====================//
	public function vehicle_fitness_save(){
		$data['m_fit'] = 'active';
		$v_fitness_id = $this->input->post('v_fitness_id'); 
		$v_id =$this->input->post('v_id'); //this name for get vehicle registration id
		$reg_issue = $this->input->post('reg_issue'); //this name for get vehicle reg issue date
		$reg_expire = $this->input->post('reg_expire'); //this name for get vehicle reg expire date
		$fitness_issue = $this->input->post('fitness_issue'); //this name for get vehicle fitness issue date
		$fitness_expire = $this->input->post('fitness_expire'); //this name for get vehicle fitness expire date
		$insurance_issue = $this->input->post('insurance_issue'); //this name for get insurance issue date
		$insurance_expire = $this->input->post('insurance_expire'); //this name for get insurance expire date
		$tax_issue = $this->input->post('tax_issue'); //this name for get taxe issue date
		$tax_expire = $this->input->post('tax_expire'); //this name for get tax expire date
		$root_permit_issue = $this->input->post('root_permit_issue'); //this name for get root permit issue date
		$root_permit_expire = $this->input->post('root_permit_expire'); //this name for get  root expair date
		$fuel_issue = $this->input->post('fuel_issue'); //this name for get  fuel_issue date
		$fuel_expire = $this->input->post('fuel_expire'); //this name for fuel_expire date
		$is_active = $this->input->post('active'); //this name for get  root expair date
		
		$data['v_id'] = $this->vehicle_model->get_vehicle_model();
		$data['vehicle_fitnes'] = (object) array(
			'v_fitness_id'=>$v_fitness_id,
			'v_id'=>$v_id,
			'fitness_issue' => $fitness_issue, 
			'fitness_expire'=> $fitness_issue,
			'reg_issue'=>$reg_issue,
			'reg_expire'=>$reg_expire,
			'insurance_issue'=>$insurance_issue,
			'insurance_expire'=>$insurance_expire,
			'tax_issue'=>$tax_issue,
			'tax_expire'=>$tax_expire,
			'insurance_expire'=>$insurance_expire,
			'tax_issue'=>$tax_issue,
			'root_permit_issue'=>$root_permit_issue,
			'root_permit_expire'=>$root_permit_expire,
			'fuel_issue'=>$fuel_issue,
			'fuel_expire'=>$fuel_expire
			);	 
		//============================ for form validation (start) ====================//
		$this->form_validation->set_rules('v_id','Vehicle Registration No','required'); 
		$this->form_validation->set_rules('root_permit_issue','Root Issue Date','trim'); 
		$this->form_validation->set_rules('root_permit_expire','Root Expair Date','trim'); 
		$this->form_validation->set_rules('reg_issue','Vehicle Registrarion Issue Date','trim'); 
		$this->form_validation->set_rules('reg_expire','Reg Expair date','trim'); 
		$this->form_validation->set_rules('fitness_issue','Fitness Issue Date','trim'); 
		$this->form_validation->set_rules('fitness_expire','Fitness Expire Date','trim'); 
		$this->form_validation->set_rules('insurance_issue','Insurance  Issue Date','trim'); 
		$this->form_validation->set_rules('insurance_expire','Insurance  Expire Date','trim'); 
		$this->form_validation->set_rules('tax_issue','Tax Issue Date','trim'); 
		$this->form_validation->set_rules('tax_expire','Tax Expire Date','trim'); 
		$this->form_validation->set_rules('fuel_issue','Fuel Issue Date','trim'); 
		$this->form_validation->set_rules('fuel_expire','Fuel Expire Date','trim'); 
		$this->form_validation->set_rules('active','Is Active','required'); 
			
		if($this->form_validation->run() == FALSE){
	        $data['content'] = $this->load->view('pages/vehicle_fitness_form',$data,TRUE);
	        $this->load->view('wrapper_main',$data); 
		}else{
			$saveData = array(
				'v_fitness_id' => $v_fitness_id,
				'v_id' => $v_id,
				'reg_issue' => date("Y-m-d",strtotime($reg_issue)),
				'fitness_issue' => date("Y-m-d",strtotime($fitness_issue)), 
				'reg_expire' =>  date("Y-m-d",strtotime($reg_expire)),
				'insurance_issue' =>  date("Y-m-d",strtotime($insurance_issue)),
				'fitness_expire' =>  date("Y-m-d",strtotime($fitness_expire)),
				'insurance_expire' =>  date("Y-m-d",strtotime($insurance_expire)),
				'tax_issue' =>  date("Y-m-d",strtotime($tax_issue)),		
				'tax_expire' =>  date("Y-m-d",strtotime($tax_expire)),
				'root_permit_issue' =>  date("Y-m-d",strtotime($root_permit_issue)),
				'root_permit_expire' =>  date("Y-m-d",strtotime($root_permit_expire)),
				'fuel_issue' =>  date("Y-m-d",strtotime($fuel_issue)),
				'fuel_expire' =>  date("Y-m-d",strtotime($fuel_expire)),
				'active' => $is_active
				);		
			$this->vehicle_model->fitness_save($saveData);
                        if(!empty($v_fitness_id)){
                            $this->session->set_flashdata('success', display('updatesuccessfully'));
                        }
                        else{
                            $this->session->set_flashdata('success', display('savesuccessfully'));
                        }
			redirect('vehicle/vehicle_fitness_list');
		}
	}
	
	//=====================================vehicle fitness Save (end)=====================//
	//=====================================vehicle fitness List (Start)=====================//
	public function vehicle_fitness_list()
	{
	$data['m_fit'] = 'active';
	$data['vehicle_fitnes'] = $this->vehicle_model->fitness_list();
        $data['content'] = $this->load->view('pages/vehicle_fitnes_view',$data,TRUE);
        $this->load->view('wrapper_main',$data); 
	} 
	
	//=====================================vehicle fitness List (End)=====================//
	
	//====================================vehicle fitness edit(start)================//
	public function vehicle_fitness_edit($v_fitness_id = ''){
        if($this->session->userdata('isLogin') == FALSE 
            || $this->session->userdata('user_type')!=9) {
            redirect('admin');
        }
        #
		$data['m_fit'] = 'active';
		$data['v_id'] = $this->vehicle_model->get_vehicle_model(); 
		$fitness = $this->vehicle_model->fitness_edit($v_fitness_id);	
		$data['vehicle_fitnes'] = $fitness[0]; 
        $data['content'] = $this->load->view('pages/vehicle_fitness_edit',$data,TRUE);
        $this->load->view('wrapper_main',$data); 
	}
	
	
	//====================================vehicle fitness edit(start)================//
	//====================================vehicle fitness Delete(start)================//
	public function vehicle_fitness_delect($v_fitness_id = ''){ 
        if($this->session->userdata('isLogin') == FALSE 
            || $this->session->userdata('user_type')!=9) {
            redirect('admin');
        }
        #
		$this->vehicle_model->delete_fitnes($v_fitness_id); 
			redirect('vehicle/vehicle_fitness_list'); 
	}
  
}