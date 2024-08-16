<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Inflow extends CI_Controller { 

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('isLogin') == FALSE) 
        redirect('admin');
        $this->load->model(array('accounting/inflow_model','accounting/account_model','accounting/bank_model'));
    }

    public function index(){
        $data['dropdown'] = $this->account_model->credit_dropdown();
        $data['inflow'] = $this->inflow_model->read();
        $data['content'] = $this->load->view('accounting/inflow_view',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }

    public function create(){
        $inflow_id = $this->input->post('inflow_id');
        $this->form_validation->set_rules('received_date',$this->lang->line('RECEIVED_DATE'),'required');
        $this->form_validation->set_rules('received_from',$this->lang->line('RECEIVED_FROM'),'required|max_length[255]');
        $this->form_validation->set_rules('received_type',$this->lang->line('RECEIVED_TYPE'),'required');
        $this->form_validation->set_rules('account_name',$this->lang->line('ACCOUNT_NAME'),'required');
        $this->form_validation->set_rules('amount',$this->lang->line('AMOUNT'),'required'); 
        $this->form_validation->set_rules('active','','required'); 
        #STARTS OF FORM CONDITION
        $received_type = $this->input->post('received_type'); 
        if($received_type == 2 || $received_type == 3 || $received_type == 4):
            $this->form_validation->set_rules('bank_name',$this->lang->line('BANK_NAME'),'required|max_length[255]');
            $this->form_validation->set_rules('branch_name',$this->lang->line('BRANCH_NAME'),'required|max_length[255]'); 
            $this->form_validation->set_rules('deposit_bank_id',$this->lang->line('DEPOSIT_BANK_NAME'),'required|max_length[255]'); 
            if($received_type == 2):
                $this->form_validation->set_rules('account_number',$this->lang->line('ACCOUNT_NUMBER'),'required'); 
            elseif($received_type == 3):
                $this->form_validation->set_rules('pay_order_number',$this->lang->line('PAY_ORDER_NUMBER'),'required'); 
            elseif($received_type == 4):
                $this->form_validation->set_rules('letter_of_credit',$this->lang->line('LC'),'required'); 
            endif;
        endif;
    	#ENDS OF FORM CONDITION

        $data['inflow'] = (object)$inflowData = array(
            'inflow_id'      => $this->input->post('inflow_id'),
            'received_date'  => date('Y-m-d',strtotime($this->input->post('received_date'))),
            'received_from'  => $this->security->xss_clean($this->input->post('received_from')),
            'received_type'  => $this->security->xss_clean($this->input->post('received_type')),
            'bank_name'      => $this->security->xss_clean($this->input->post('bank_name')),
            'branch_name'    => $this->security->xss_clean($this->input->post('branch_name')),
            'account_number' => $this->security->xss_clean($this->input->post('account_number')),
            'pay_order_number' => $this->security->xss_clean($this->input->post('pay_order_number')),
            'letter_of_credit' => $this->security->xss_clean($this->input->post('letter_of_credit')),
            'deposit_bank_id'   => $this->security->xss_clean($this->input->post('deposit_bank_id')),
            'account_name'   => $this->security->xss_clean($this->input->post('account_name')),
            'amount'         => $this->security->xss_clean($this->input->post('amount')),
            'description'    => $this->security->xss_clean($this->input->post('description')),
            'status'         => $this->input->post('active'), 
            'date'           => date('Y-m-d')
        ); 

        if($this->form_validation->run() == TRUE):  
            $this->inflow_model->save($inflowData);
            @$id = $this->db->insert_id();
            $primary_id = (!empty($id)?$id:$this->input->post('inflow_id'));
            if(!empty($inflow_id)){
                $this->session->set_flashdata('success', display('updatesuccessfully'));
            }
            else{
                $this->session->set_flashdata('success', display('savesuccessfully'));
            }             
            redirect('accounting/inflow/single_view/'.$primary_id);
        else: #if validation false   
            $data['dropdown'] = $this->account_model->credit_dropdown();
            $data['bank_dropdown'] = $this->bank_model->bank_dropdown();
            $data['content'] = $this->load->view('accounting/inflow_form',$data,TRUE);
            $this->load->view('wrapper_main',$data);
        endif;
    }

    public function edit($inflow_id = NULL){ 
        $data['dropdown'] = $this->account_model->credit_dropdown();
        $data['bank_dropdown'] = $this->bank_model->bank_dropdown();
        $data['inflow'] = $this->inflow_model->read_by_id($inflow_id);
        #starts of checking
        if(empty($data['inflow'])):
            redirect('accounting/inflow/');
        endif;
        #ends of checking 
        $data['content'] = $this->load->view('accounting/inflow_form_edit',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }

    
    public function single_view($inflow_id = NULL){ 
        $this->load->model('accounting/company_model');
        $data['company'] = $this->company_model->read();  
        $data['inflow'] = $this->inflow_model->read_by_id($inflow_id);
        #starts of checking
        if(empty($inflow_id) || (empty($data['company']) || empty($data['inflow']))):
            redirect('accounting/inflow/');
        endif;
        #ends of checking 
        $data['content'] = $this->load->view('accounting/inflow_single_view',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    } 

    public function delete($inflow_id = NULL){
        $this->inflow_model->delete($inflow_id);
         $this->session->set_flashdata('success', display('deletesuccessfully'));
        redirect('accounting/inflow/');
    }

}
