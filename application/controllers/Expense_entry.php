<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expense_entry extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        if($user_id == NULL){redirect('admin');} 
	   $this->load->model('expense_entry_model');
    }

    public function create(){
        $data['m_expense'] = 'active'; 
        $data['v_info'] = $this->expense_entry_model->get_vehicle_info();
        $data['expense'] = $this->expense_entry_model->expense();         
        $data['content'] = $this->load->view('pages/expense_entry_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }

    public function LoadAjax($group = NULL){ 
        $expense = $this->expense_entry_model->expense($group); 

        echo " 
        <thead>
            <tr>
                <th>".display("expensename")."</th> 
                <th>".$this->lang->line("EXPENSE_SERIAL")."</th> 
                <th>".display("quantity")."</th>    
                <th>".display("amount")."</th>  
                <th>".display("total")."</th>
            </tr>
        </thead>
        <tbody>";

        $sl = 1; 
        if(count($expense) > 0):
        foreach ($expense as $value) {
            echo "<tr>";
                echo "<input type=\"hidden\" name=\"expense_group[]\"  value=\"$value->expense_group\"  />";
            echo "<td>";
                echo "<label>$value->expense_name</label>";
                echo "<input type=\"hidden\" name=\"expense_id[]\"  value=\"$value->expense_id\"  />";
            echo "</td>";
            echo "<td>"; 
                echo "<input type=\"text\" name=\"expense_serial[]\" />";
            echo "</td>";
            echo "<td><center><input type=\"text\" name=\"qty[]\" placeholder=\"Quantity\" class=\"amount_edit\" id=" . 'quantity_' . $sl . "></td>";
            echo "<td><center><input type=\"text\" name=\"price[]\" placeholder=\"Amount\" class=\"amount_edit\" id=" . 'amount_' . $sl . " ></center></td>";
            echo "<td><center id=" . 'total_' . $sl . " name=\"total[]\"></center></td>";
            echo "</tr>";
            $sl++;
        } //ends of foreach
        else:
            echo "No data found!";
        endif; 

        echo "</tbody>";
    }

    public function save(){ 
        $data['m_expense'] = 'active';
        // ----------------------------- 
    	$trip_link_id = 0;//trip_link_id
        //date format chage [date piker to mysql format]
        $date = date("Y-m-d", strtotime(str_replace('/', '-', $this->input->post('date'))));
    	$v_id = $this->input->post('v_id');//vehicle registration number
    	$expense_id = $this->input->post('expense_id');//expense id
        $expense_serial = $this->input->post('expense_serial'); 
        $expense_group = $this->input->post('expense_group'); 
    	$qty = $this->input->post('qty');
    	$price = $this->input->post('price');
    	$posting_id = $this->session->userdata('user_id');
            // --------------------------------------------------------
            $this->form_validation->set_rules('date','Date','required');
    	    $this->form_validation->set_rules('expense','Expense Group','required');
    	    if($this->form_validation->run() == TRUE){
            // insert into database
            $flag = 0;
            for($i=0;$i!=count($expense_id);$i++){ 
                $insert = array(
                    'import_export' => "",
                    'trip_link_id' => $trip_link_id,
                    'expense_group' => $expense_group[$i],
                    'expense_serial' => $expense_serial[$i],
                    'expense_id' => $expense_id[$i],
                    'date' => $date,
                    'v_id' => $v_id,
                    'quantity' => $qty[$i],
                    'amount' => $price[$i],
                    'posting_id' => $posting_id,
                    );
                if(!empty($qty[$i])){
                    $this->expense_entry_model->save($insert);  
                    $flag = 1;                   
                }
                // ends of data insert
    		} //ends of for loop
            if($flag == 1):
                $this->session->set_flashdata('success','savesuccessfully');
            else:
                $this->session->set_flashdata('error','fillupallrequiredfields');
            endif;
                redirect('expense_entry/create');
        //ends of if condition        
        }else{
		$data['v_info'] = $this->expense_entry_model->get_vehicle_info();
		$data['expense'] = $this->expense_entry_model->expense($this->input->post('expense'));           
                $data['content'] = $this->load->view('pages/expense_entry_form',$data,TRUE);
                $this->load->view('wrapper_main',$data);
		} 
    }
    //==================this function for view expense entry save (end) ========================//


    public function edit_save($transection_id){   
        $data = array(
            'transection_id' => $this->input->post('transection_id'),
            'expense_group' => $this->input->post('expense_group'), 
            'expense_serial' => $this->input->post('expense_serial'),
            'v_id' => $this->input->post('v_id'),
            'quantity' => $this->input->post('qty'),
            'amount' => $this->input->post('price'),
            'date' => date('Y-m-d',strtotime($this->input->post('date'))),
            'posting_id' => $this->session->userdata('user_id')
            );   
        $this->expense_entry_model->update($data); 
         $this->session->set_flashdata('success', display('updatesuccessfully'));
        redirect('expense_entry/view');
    }


    //==================this function for view expense entry view (start) ========================//
    public function view() { 
        $data['m_exp_e'] = 'active';
        $data['expenses'] = $this->expense_entry_model->expense_entry_data();
        $data['content'] = $this->load->view('pages/expense_entry_view',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }
     //==================this function for view expense entry view (end) ========================//

    //================this Function for edit expense entry(Start) ============================//
    public function expense_entry_edit($transection_id=NULL) {
        if($this->session->userdata('isLogin') == FALSE 
            || $this->session->userdata('user_type')!=9) {
            redirect('admin');
        }
        #
        $data['m_exp_e'] = 'active';
        $data['v_info'] = $this->expense_entry_model->get_vehicle_info();    
        $data['expense_data'] = $this->expense_entry_model->expense_entry_data_by_id($transection_id); 
        $data['content'] = $this->load->view('pages/expense_entry_edit_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }
    //================this Function for edit expense entry(End) ============================//
   
    //================this Function for Delete expense entry(Start) ============================//

    public function delete($transection_id = '') {
        if($this->session->userdata('isLogin') == FALSE 
            || $this->session->userdata('user_type')!=9) {
            redirect('admin');
        }
        else{
            $this->expense_entry_model->expnese_entry_delete($transection_id); 
            $this->session->set_flashdata('success','deletesuccessfully');
            redirect('expense_entry/view');
        }
        #
        
    }
    //================this Function for Delete expense entry(End) ============================//


}