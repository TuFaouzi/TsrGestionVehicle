<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expense_list extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        if($user_id == NULL){redirect('admin');} 
        $this->load->model('expense_list_model');
    }

    //==================this function for view expense list (start) ========================//
    public function index() {
        $data['m_etl'] = 'active';
        $data['expenses'] = $this->expense_list_model->expense(); 
        $data['content'] = $this->load->view('pages/expense_list_view',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }
     //==================this function for view expense list (end) ========================//

    //=============== This function for create company (Start) =============================//


    public function create() {
        $data['m_etl'] = 'active';
		$data['expense_group'] = array( 1 => 'Regular', 2 => 'Maintenance', 3 =>'Others', 4 =>'Office', 5 =>'Garage');
        $data['expenses'] = (object) array('expense_id' => '', 'expense_name' => '', 'expense_group' => '');									
        $data['content'] = $this->load->view('pages/expense_list_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }

    //=============== This function for create company (End) =============================//
    //=============== This function for Save company (Start) =============================//


    public function save() {
        $data['m_etl'] = 'active';
        $expense_id = $this->input->post('expense_id'); //this name for expense id
        $expense_name = $this->input->post('expense_name'); //this name for get expense name
        $expense_group = $this->input->post('expense_group'); //this name for get expense group id
        $is_active = $this->input->post('active');  
        
        $data['expense_group'] = array( 1 => 'Regular', 2 => 'Maintenance', 3 =>'Others');
        $data['expenses'] = (object) array('expense_id' => $expense_id, 'expense_name' => $expense_name,
											'expense_group' => $expense_group);


        //============================ for form validation (start) ====================//
        $this->form_validation->set_rules('expense_name',$this->lang->line('EXPENSE_NAME'),'trim|required'); 
        $this->form_validation->set_rules('expense_group','','required'); 
        $this->form_validation->set_rules('active','','required'); 
        if ($this->form_validation->run() == FALSE) {
            $data['content'] = $this->load->view('pages/expense_list_form',$data,TRUE);
            $this->load->view('wrapper_main',$data);
        }
        else{ 
            $all_value = array('expense_id' => $expense_id,
    						'expense_name' => $expense_name,
                            'expense_group' => $expense_group,
                            'active' => $is_active
            );
            $this->expense_list_model->save_expense($all_value);
            if(!empty($expense_id)){
                $this->session->set_flashdata('success', display('updatesuccessfully'));
            }
            else{
                $this->session->set_flashdata('success', display('savesuccessfully'));
            }
            redirect('expense_list');
        }
        //============================ for form validation (End) ====================//
    }

    //=============== This function for Save company (End) =============================//
   
    //================this Function for edit Company(Start) ============================//
    public function expense_list_edit($expense_id = '') {
        if($this->session->userdata('isLogin') == FALSE 
            || $this->session->userdata('user_type')!=9) {
            redirect('admin');
        }
        #
        $data['m_etl'] = 'active';
		$data['expense_group'] = array(1 =>'Regular',2 =>'Maintenance',3=>'Others',4 =>'Office',5=>'Garage');
        $expenseList = $this->expense_list_model->edit_expense($expense_id);
        $data['expenses'] = $expenseList[0];
        $data['content'] = $this->load->view('pages/expense_list_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }

    //================this Function for edit Company(End) ============================//
    //================this Function for Delete Company(Start) ============================//

    public function expense_list_delete($expense_id = '') {
        if($this->session->userdata('isLogin') == FALSE 
            || $this->session->userdata('user_type')!=9) {
            redirect('admin');
        }
        else{
            $this->expense_list_model->delete_expense($expense_id); 
            $this->session->set_flashdata('success', display('savesuccessfully'));
            redirect('expense_list');
        }
        #
        
            
    }
    //================this Function for Delete Company(End) ============================//

}
