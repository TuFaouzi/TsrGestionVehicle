<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Bank extends CI_Controller { 

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') == FALSE) 
        redirect('admin');
        $this->load->model(array('accounting/bank_model'));
    }

    public function index(){ 
        $data['banks']   = $this->bank_model->read();
        $data['content'] = $this->load->view('accounting/bank_view',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    } 

    public function create(){
        $bank_id = $this->input->post('bank_id');
        
        $this->form_validation->set_rules('bank_name','Bank name','required');
        $this->form_validation->set_rules('branch_name','Branch name','required');
        $this->form_validation->set_rules('account_number','Account name','required');
        $this->form_validation->set_rules('active','','required');
        if($this->form_validation->run()==TRUE):
            $bankData = array(
                'bank_id'          => $this->input->post('bank_id'),
                'bank_name'        => $this->security->xss_clean($this->input->post('bank_name')),
                'branch_name'      => $this->security->xss_clean($this->input->post('branch_name')),
                'account_number'   => $this->security->xss_clean($this->input->post('account_number')),
                'opening_credit'   => $this->security->xss_clean($this->input->post('opening_credit')),
                'status'           => $this->input->post('active'),
                'date'             => date('Y-m-d')
            );
            $this->bank_model->save($bankData);
            if(!empty($bank_id)){
                $this->session->set_flashdata('success', display('updatesuccessfully'));
            }
            else{
                $this->session->set_flashdata('success', display('savesuccessfully'));
            }
            redirect('accounting/bank/');
        else:
            $data['bank'] = (object) array(
                        'bank_id'         => $this->input->post('bank_id'),
                        'bank_name'       => $this->input->post('bank_name'),
                        'branch_name'     => $this->input->post('branch_name'),
                        'account_number'  => $this->input->post('account_number'),
                        'opening_credit'  => $this->input->post('opening_credit'),
                        'status'          => $this->input->post('active'),
                        );
            $data['content'] = $this->load->view('accounting/bank_form',$data,TRUE);
            $this->load->view('wrapper_main',$data);
        endif;
    }

    public function edit($bank_id = NULL){ 
        $data['bank'] = $this->bank_model->read_by_id($bank_id);
        if(empty($data['bank'])) {redirect('accounting/bank'); }
        $data['content'] = $this->load->view('accounting/bank_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }
 
    public function delete($bank_id = NULL){ 
        $this->bank_model->update($bank_id);
        redirect('accounting/bank'); 
    }

}
