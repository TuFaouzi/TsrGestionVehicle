<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alert_center extends CI_Controller {
	
	function __construct(){
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        if($user_id == NULL){redirect('admin');} 
		$this->load->model('alert_center_model');
    }

	
	public function index($pdf = NULL){   
		$data['result'] = $this->alert_center_model->alerts(); 
		$data['content'] = $this->load->view('pages/alert_center',$data,TRUE);
		$this->load->view('wrapper_main',$data);
	}


}