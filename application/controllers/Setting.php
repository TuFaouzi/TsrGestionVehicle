<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Setting extends CI_Controller {
	
	public function __construct() {
         parent::__construct();
          if($this->session->userdata('isLogin') == FALSE) {
            redirect('admin');
          } 
          $this->load->model('setting_model');
        }
        
	public function index(){	 
	 $data['m_cmpny'] = '';
         $data['setting_id'] =  $this->setting_model->getid();
         
         $data['content'] = $this->load->view('pages/setting',$data,TRUE);
         $this->load->view('wrapper_main',$data);	
	}
        
        
        public function update($company_id=''){      
          $data['id']	= $this->input->post('id');  
          $data['values']	= $this->input->post('values');
          $this->setting_model->edit_setting($data);
          $this->session->set_flashdata('success', display('savesuccessfully'));
          redirect('setting');

	}
        
} 


