<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Driver_info extends CI_Controller {

	public function __construct() {
        parent::__construct(); 
        $user_id = $this->session->userdata('user_id');
        if($user_id == NULL){redirect('admin');} 
	   $this->load->model(array('driver_info_model','vehicle_model'));
    }


	public function index($pdf = NULL){
		$data['m_divr'] = "active";
		$data['informations'] = $this->driver_info_model->driver_info(); 
		$data['content'] = $this->load->view('pages/driver_info_view',$data,TRUE);
	    $this->load->view('wrapper_main',$data);

        if($pdf == "pdf"):   
            ini_set('memory_limit', '256M'); 
            // $html = $this->output->get_output($html);
            $this->load->library('dompdf_gen'); 
            $this->dompdf->load_html($data['content']);
            $this->dompdf->render(); 
            $filename = strtoupper(date('d_M_Y').'_'.$this->uri->segment(1)."_".$this->uri->segment(3));
            $this->dompdf->stream($filename.".pdf");
        endif;  
	}
	//=============== This function for create company (Start) =============================//
	
	public function create(){	
		$data['m_divr'] = "active"; 
		$data['v_reg_no'] = $this->vehicle_model->get_vehicle_model();  
		$data['informations'] = (object) array('driver_id'=>'','driver_name'=>'','v_registration_no'=>'','d_license_no'=>'',
                                        'd_father_name' => '','d_mother_name' => '','d_nid' => '',
                                        'd_license_expire_date'=>'','d_mobile'=>'',
                                        'd_address_present'=>'','d_address_permanent'=>'',
                                        'd_join_date'=>'','d_release_date'=>'',
                                        'd_emergency_contact_person'=>'','d_emergency_cell'=>'');
		$data['content'] = $this->load->view('pages/driver_info_form',$data,TRUE);
	        $this->load->view('wrapper_main',$data);
	}
	//=============== This function for create company (End) =============================//
	
	//=============== This function for Save company (Start) =============================//
	
	
	public function save(){ 
            	
		$driver_id = $this->input->post('driver_id'); 
		$driver_name = trim($this->input->post('driver_name')); 
		$v_registration_no = trim($this->input->post('v_registration_no')); 
		$d_license_no = trim($this->input->post('d_license_no')); 
		$d_father_name = trim($this->input->post('d_father_name')); 
		$d_mother_name = trim($this->input->post('d_mother_name')); 
		$d_nid = trim($this->input->post('d_nid')); 
		$d_license_expire_date = date('Y-m-d',strtotime($this->input->post('d_license_expire_date'))); 
		$d_join_date = date('Y-m-d',strtotime($this->input->post('d_join_date'))); 
		$d_release_date = date('Y-m-d',strtotime($this->input->post('d_release_date'))); 
		$d_mobile = trim($this->input->post('d_mobile')); 
		$d_address_present = trim($this->input->post('d_address_present')); 
		$d_address_permanent = trim($this->input->post('d_address_permanent')); 
		$d_emergency_contact_person = trim($this->input->post('d_emergency_contact_person')); 
		$d_emergency_cell = trim($this->input->post('d_emergency_cell')); 
		$is_active = trim($this->input->post('active')); 
                
                $this->form_validation->set_rules('driver_name',display('drivername'),'trim|required');
		$this->form_validation->set_rules('d_mobile',display('mobileno'),'trim|required');
		$this->form_validation->set_rules('v_registration_no',display('vehicleregistrationno'),'trim|required');
		$this->form_validation->set_rules('d_license_no',display('licensenumber LICENSE_NUMBER'),'trim|required');
		$this->form_validation->set_rules('d_address_permanent',display('permanentaddress'),'trim|required');
		$this->form_validation->set_rules('active',display('isactive'),'required'); 
            	if($this->form_validation->run()==FALSE){
                $data['informations'] = (object) array('driver_id'=> $driver_id,
                    'driver_name'=> $driver_name,
                    'v_registration_no'=> $v_registration_no,
                    'd_license_no'=> $d_license_no,
                    'd_father_name' => $d_father_name,
                    'd_mother_name' => $d_mother_name,
                    'd_nid' => $d_nid,
                    'd_license_expire_date'=>$d_license_expire_date,
                    'd_join_date'=>$d_join_date,'d_release_date'=>$d_release_date,
                    'd_mobile'=>$d_mobile,'d_address_present'=>$d_address_present,
                    'd_address_permanent'=>$d_address_permanent,
                    'd_emergency_contact_person'=>$d_emergency_contact_person,
                    'd_emergency_cell'=>$d_emergency_cell,
                    'active'=>$is_active
		);  
                    
                    
		   $data['v_reg_no'] = $this->vehicle_model->get_vehicle_model();
                 
                   $data['content'] = $this->load->view('pages/driver_info_form',$data,TRUE);
		    $this->load->view('wrapper_main',$data);
		}
                else{
                     $image=$_FILES['d_picture']['name'];
                     if (!empty($image))
                        {
                          $config['allowed_types'] = 'jpg|jpeg|png'; 
                          $config['upload_path'] = 'assets/driver/';
                          $this->load->library('upload', $config);

                         if (!$this->upload->do_upload('d_picture')){
                           $this->form_validation->set_message('image_upload', $this->upload->display_errors());
                           $this->session->set_flashdata('error', display('onlypngjpgjpegfileselected'));
                           redirect('driver_info/create');
                         }   
                          else{
                                $upload_data	= $this->upload->data();
                                $data['d_picture']	= $upload_data['file_name'];
                          }
                        }	
                
                    $data['driver_id']		        = $this->input->post('driver_id');
                    $data['driver_name']		= $this->input->post('driver_name');
                    $data['v_registration_no']		= ($this->input->post('v_registration_no'));
                    $data['d_license_no']		= ($this->input->post('d_license_no'));
                    $data['d_father_name']		= ($this->input->post('d_father_name'));
                    $data['d_mother_name']		= $this->input->post('d_mother_name');
                    $data['d_nid']		        = $this->input->post('d_nid');
                    $data['d_license_expire_date']	= date('Y-m-d',strtotime($this->input->post('d_license_expire_date'))); 
                    $data['d_join_date']		= date('Y-m-d',strtotime($this->input->post('d_join_date'))); 
                    $data['d_release_date']		= date('Y-m-d',strtotime($this->input->post('d_release_date'))); 
                    $data['d_mobile']		        = trim($this->input->post('d_mobile')); 
                    $data['d_address_present']		= trim($this->input->post('d_address_present')); 
                    $data['d_address_permanent']	= trim($this->input->post('d_address_permanent')); 
                    $data['d_emergency_contact_person']	= trim($this->input->post('d_emergency_contact_person')); 
                    $data['d_emergency_cell']	        = trim($this->input->post('d_emergency_cell')); 
                    $data['active']	                = $this->input->post('active'); 


                     $this->driver_info_model->save($data);
                     if(!empty($driver_id)){
                         $this->session->set_flashdata('success', display('updatesuccessfully'));
                     }
                     else{
                         $this->session->set_flashdata('success', display('savesuccessfully'));
                     }
                     
                     redirect('driver_info');
                }
				
	}
	//=============== This function for Save company (End) =============================//
	
	//================this Function for edit Company(Start) ============================//
	public function edit($driver_id = NULL){
		if($this->session->userdata('isLogin') == FALSE 
			|| $this->session->userdata('user_type')!=9) {
			redirect('admin');
		}
		#
		$data['m_divr'] = "active";
		$data['v_reg_no'] = $this->vehicle_model->get_vehicle_model();  
		$infoList = $this->driver_info_model->get_driver_info($driver_id);
		$data['informations'] = $infoList[0]; 
		$data['content'] = $this->load->view('pages/driver_info_form',$data,TRUE);
	    $this->load->view('wrapper_main',$data);
			
	}
	
	
	public function delete_info($driver_id = NULL){
		if($this->session->userdata('isLogin') == FALSE 
			|| $this->session->userdata('user_type')!=9) {
			redirect('admin');
		}
		#
		if($this->driver_info_model->delete_info($driver_id)){
                    $this->session->set_flashdata('success', display('deletesuccessfully'));
		    redirect('driver_info');	
		}
	}
	

	public function driver_by_id($driver_id = NULL, $pdf = NULL){
		$data['m_divr'] = "active";
		$data['informations'] = $this->driver_info_model->driver_by_id($driver_id); 
		$data['content'] = $this->load->view('pages/driver_single_view',$data,TRUE);
	    $this->load->view('wrapper_main',$data);

        if($pdf == "pdf"):   
            // $html = $this->output->get_output($html);
            $this->load->library('dompdf_gen'); 
            $this->dompdf->load_html($data['content']);
            $this->dompdf->render(); 
            $filename = strtoupper(date('d_M_Y').'_'.$this->uri->segment(1)."_".$this->uri->segment(3));
            $this->dompdf->stream($filename.".pdf");
        endif; 
	}

}
	
	