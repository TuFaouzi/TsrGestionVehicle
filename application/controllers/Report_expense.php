<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_expense extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        if($user_id == NULL){redirect('admin');} 
	    $this->load->model(array('report_expense_model'));
    }
    /*
     * @function name - view
     * @parameter - no parameter
     * @return - array data
     * @author - Md. Shohrab Hossain
     * @created on - 13/10/2015
     */

    public function view(){     
        $data['content'] = $this->load->view('pages/report_expense','',TRUE);
        $this->load->view('wrapper_main',$data); 
    }  

    /*
     * @function name - generate
     * @parameter - no parameter
     * @return - array data
     * @author - Md. Shohrab Hossain
     * @created on - 13/10/2015
     */ 

    public function generate(){     
        $expense_report = $this->input->post('expense_report');
        $v_id =$this->input->post('v_id'); 
        $expense_id =$this->input->post('expense_id');
        $date_1 = date("Y-m-d", strtotime($this->input->post('date_1')));
        $date_2 = date("Y-m-d", strtotime($this->input->post('date_2')));

        $data['exp_report'] = $this->report_expense_model->generate_report($expense_report,$v_id,$expense_id,$date_1,$date_2);  
        #showing the view page 
        $data['content'] = $this->load->view('pages/report_expense',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }   
    
}