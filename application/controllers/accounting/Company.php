<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Company extends CI_Controller { 

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') == FALSE) 
        redirect('admin');
        $this->load->model(array('accounting/company_model'));
    }

    public function index(){ 
        $data['company'] = $this->company_model->read();
        $data['content'] = $this->load->view('accounting/company_view',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    } 

    public function create(){
         $company_id = $this->input->post('company_id');
        $this->form_validation->set_rules('name',$this->lang->line('COMPANY_NAME'),'required');
        $data['company'] = (object)$comData = array(
            'company_id' => $this->security->xss_clean($this->input->post('company_id')),
            'name'       => $this->security->xss_clean($this->input->post('name')),
            'address'    => $this->security->xss_clean($this->input->post('address')), 
            'mobile_no'  => $this->security->xss_clean($this->input->post('mobile_no')),
            'phone_no'   => $this->security->xss_clean($this->input->post('phone_no')),
            'fax_no'     => $this->security->xss_clean($this->input->post('fax_no')),
            'email'      => $this->security->xss_clean($this->input->post('email')),  
            'website'    => $this->security->xss_clean($this->input->post('website')), 
            'date'       => $this->security->xss_clean(date('Y-m-d')) 
        ); 

        if($this->form_validation->run()==TRUE):
           if(!empty($company_id)){
                $this->session->set_flashdata('success', display('updatesuccessfully'));
            }
            else{
                $this->session->set_flashdata('success', display('savesuccessfully'));
            }
            $this->company_model->save($comData);
            redirect('accounting/company/');
        else:   
            $data['content'] = $this->load->view('accounting/company_form',$data,TRUE);
            $this->load->view('wrapper_main',$data);
        endif;
    }

    public function edit($account_id = NULL){ 
        $data['company'] = $this->company_model->read_by_id($account_id);
        if(empty($data['company'])) {redirect('accounting/company'); }
        $data['content'] = $this->load->view('accounting/company_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }
  

}
