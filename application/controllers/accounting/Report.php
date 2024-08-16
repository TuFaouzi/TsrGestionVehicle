<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Report extends CI_Controller { 

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') == FALSE 
            || $this->session->userdata('user_type')!=9) 
        redirect('admin'); 
        $this->load->model(array('accounting/report_model'));
    }

    public function index(){
        $data['report'] = (object)array(
                'accounting_report' => $this->input->post('accounting_report'),
                'date_1'            => $this->input->post('date_1'),
                'date_2'            => $this->input->post('date_2'),
        );
        $data['content'] = $this->load->view('accounting/report',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }

    public function generate(){
        $data['report'] = (object)$report = array(
                'accounting_report' => $this->input->post('accounting_report'),
                'date_1'            => $this->input->post('date_1'),
                'date_2'            => $this->input->post('date_2'),
        );
        $data['result']  = $this->report_model->report($report); 
        $data['content'] = $this->load->view('accounting/report',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    } 

}
