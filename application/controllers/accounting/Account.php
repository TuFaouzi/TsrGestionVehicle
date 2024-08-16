<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Account extends CI_Controller { 

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') == FALSE) 
        redirect('admin');
        $this->load->model(array('accounting/account_model'));
    }

    public function index(){ 
        $data['accounts']   = $this->account_model->read();
        $data['content'] = $this->load->view('accounting/account_view',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    } 

    public function create(){
        $account_id = $this->input->post('account_id');
        
        $this->form_validation->set_rules('sector_name',$this->lang->line('SECTOR_NAME'),'required');
        $this->form_validation->set_rules('sector_type',$this->lang->line('SECTOR_TYPE'),'required'); 
        $this->form_validation->set_rules('active','','required');
        if($this->form_validation->run()==TRUE):
            $accountData = array(
                'account_id'       => $this->input->post('account_id'),
                'sector_name'      => $this->security->xss_clean($this->input->post('sector_name')),
                'sector_type'      => $this->input->post('sector_type'), 
                'status'           => $this->input->post('active'),
                'date'             => date('Y-m-d')
            );
            $this->account_model->save($accountData);
            if(!empty($account_id)){
                $this->session->set_flashdata('success', display('updatesuccessfully'));
            }
            else{
                $this->session->set_flashdata('success', display('savesuccessfully'));
            }
            redirect('accounting/account/');
        else:  
            $data['account'] = (object) array(
                        'account_id'         => $this->input->post('account_id'),
                        'sector_name'       => $this->input->post('sector_name'),
                        'sector_type'     => $this->input->post('sector_type')   
                        );
            $data['content'] = $this->load->view('accounting/account_form',$data,TRUE);
            $this->load->view('wrapper_main',$data);
        endif;
    }

    public function edit($account_id = NULL){ 
        $data['account'] = $this->account_model->read_by_id($account_id);
        if(empty($data['account'])) {redirect('accounting/account'); }
        $data['content'] = $this->load->view('accounting/account_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }
 
    public function delete($account_id = NULL){ 
        $this->account_model->update($account_id);
        $this->session->set_flashdata('success', display('deletesuccessfully'));
        redirect('accounting/account'); 
    }

}
