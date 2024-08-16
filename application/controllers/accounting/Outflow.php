<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Outflow extends CI_Controller { 

    public function __construct() { 
        parent::__construct();
        if($this->session->userdata('isLogin') == FALSE) 
        redirect('admin');
        $this->load->model(array('accounting/outflow_model','accounting/account_model','accounting/bank_model'));
    }

    public function index(){
        $data['dropdown'] = $this->account_model->debit_dropdown();
        $data['outflow'] = $this->outflow_model->read();
        $data['content'] = $this->load->view('accounting/outflow_view',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }

    public function create(){
        $outflow_id = $this->input->post('outflow_id');
        $this->form_validation->set_rules('payment_date',$this->lang->line('PAYMENT_DATE'),'required');
        $this->form_validation->set_rules('payment_to',$this->lang->line('PAYMENT_TO'),'required|max_length[255]');
        $this->form_validation->set_rules('payment_type',$this->lang->line('PAYMENT_TYPE'),'required');
        $this->form_validation->set_rules('account_name',$this->lang->line('ACCOUNT_NAME'),'required|max_length[255]');
        $this->form_validation->set_rules('amount',$this->lang->line('AMOUNT'),'required'); 
        $this->form_validation->set_rules('active','','required'); 
        #STARTS OF FORM CONDITION
        $received_type = $this->input->post('payment_type'); 
        if($received_type == 2 || $received_type == 3 || $received_type == 4):
            $this->form_validation->set_rules('bank_name',$this->lang->line('BANK_NAME'),'required|max_length[255]');
            $this->form_validation->set_rules('branch_name',$this->lang->line('BRANCH_NAME'),'required'); 
            if($received_type == 2):
                $this->form_validation->set_rules('account_number',$this->lang->line('BRANCH_NAME'),'required'); 
            elseif($received_type == 3):
                $this->form_validation->set_rules('pay_order_number',$this->lang->line('BRANCH_NAME'),'required'); 
            elseif($received_type == 4):
                $this->form_validation->set_rules('letter_of_credit',$this->lang->line('LC'),'required'); 
            endif;
            $this->form_validation->set_rules('deposit_bank_id',$this->lang->line('DEPOSIT_BANK_NAME'),'required|max_length[255]');
        endif;
    	#ENDS OF FORM CONDITION

        $data['outflow'] = (object)$outflowData = array(
            'outflow_id'      => $this->input->post('outflow_id'),
            'payment_date'  => date('Y-m-d',strtotime($this->input->post('payment_date'))),
            'payment_to'  => $this->security->xss_clean($this->input->post('payment_to')),
            'payment_type'  => $this->security->xss_clean($this->input->post('payment_type')),
            'bank_name'      => $this->security->xss_clean($this->input->post('bank_name')),
            'branch_name'    => $this->security->xss_clean($this->input->post('branch_name')),
            'account_number' => $this->security->xss_clean($this->input->post('account_number')),
            'pay_order_number' => $this->security->xss_clean($this->input->post('pay_order_number')),
            'letter_of_credit' => $this->security->xss_clean($this->input->post('letter_of_credit')),
            'deposit_bank_id' => $this->security->xss_clean($this->input->post('deposit_bank_id')),
            'account_name'   => $this->security->xss_clean($this->input->post('account_name')),
            'amount'         => $this->security->xss_clean($this->input->post('amount')),
            'description'    => $this->security->xss_clean($this->input->post('description')),
            'status'         => $this->input->post('active'), 
            'date'           => date('Y-m-d')
        ); 
        if($this->form_validation->run() == TRUE):  
            $this->outflow_model->save($outflowData);
            @$id = $this->db->insert_id();
            $primary_id = (!empty($id)?$id:$this->input->post('outflow_id'));
            if(!empty($outflow_id)){
                $this->session->set_flashdata('success', display('updatesuccessfully'));
            }
            else{
                $this->session->set_flashdata('success', display('savesuccessfully'));
            }
            redirect('accounting/outflow/single_view/'.$primary_id);
        else: #if validation false   
            $data['dropdown'] = $this->account_model->debit_dropdown();
            $data['bank_dropdown'] = $this->bank_model->bank_dropdown();
            $data['content'] = $this->load->view('accounting/outflow_form',$data,TRUE);
            $this->load->view('wrapper_main',$data);
        endif;
    }

    public function edit($outflow_id = NULL){
        $data['dropdown'] = $this->account_model->debit_dropdown();
        $data['outflow'] = $this->outflow_model->read_by_id($outflow_id);
        $data['bank_dropdown'] = $this->bank_model->bank_dropdown();
        #starts of checking
        if(empty($outflow_id) || empty($data['outflow'])):
            redirect('accounting/outflow/');
        endif;
        #ends of checking 
        $data['content'] = $this->load->view('accounting/outflow_edit_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }

    public function single_view($outflow_id = NULL){ 
        $this->load->model('accounting/company_model');
        $data['company'] = $this->company_model->read(); 
        $data['outflow'] = $this->outflow_model->read_by_id($outflow_id);
        #starts of checking
        if(empty($outflow_id) || (empty($data['company']) || empty($data['outflow']))):
            redirect('accounting/outflow/');
        endif;
        #ends of checking 
        $data['content'] = $this->load->view('accounting/outflow_single_view',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    } 

    public function delete($outflow_id = NULL){
        $this->outflow_model->delete($outflow_id);
        $this->session->set_flashdata('success', display('deletesuccessfully'));
        redirect('accounting/outflow/');
    }

}
