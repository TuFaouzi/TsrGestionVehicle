<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_balancesheet extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        if($user_id == NULL){redirect('admin');} 
	    $this->load->model(array('report_company_model'));
    }
 
    /*
     * @function name - generate
     * @parameter - no parameter
     * @return - array data
     * @author - Md. Shohrab Hossain
     * @created on - 22/03/2016
     */
    public function index(){ 
        $date_1 = date('Y-m-d',strtotime($this->input->post('date_1')));
        $date_2 = date('Y-m-d',strtotime($this->input->post('date_2')));
        /*----------------------------------------------------*/
        /* (export & import /double) trip expense divided by 2 */  
        /* because expense amount count 2 times in double trip */
        /*-----------------------------------------------------*/ 

        /*TRIP*/
        $this->db->select("
            trip.import_export AS trip_category,
            SUM(trip.rent - trip.fare_rent) AS profit 
        ");
        $this->db->select_min('trip.date','min_date'); 
        $this->db->select_max('trip.date','max_date'); 
        $this->db->select_sum('trip.rent','contact_rate'); 
        $this->db->select_sum('trip.fare_rent','fare_rate');
        $this->db->from('trip'); 
        $this->db->where('trip.active',1); 
        if($this->input->post('date_1') != ""):
            $this->db->where("trip.date BETWEEN '$date_1' AND '$date_2'", NULL, FALSE );
        endif;
        $this->db->group_by('trip.import_export');
        $trip = $this->db->get();
        $data['trip'] = $trip->result(); 
 
        /*EXPENSE*/
        $this->db->select('
                expense_data.expense_group AS expense_category,
                SUM(quantity * amount) AS expense_amount
            ');
        $this->db->from('expense_data'); 
        $this->db->where('active',1); 
        if($this->input->post('date_1') != ""):
            $this->db->where("date BETWEEN '$date_1' AND '$date_2'", NULL, FALSE );
        endif;
        $this->db->where_not_in('expense_group',1);
        $this->db->group_by('expense_group');
        $this->db->limit(4);
        $expense = $this->db->get();
        $data['expense'] = $expense->result();
 

        $data['date'] = (object) array('date_1'=>$this->input->post('date_1'),'date_2'=>$this->input->post('date_2'));
        $data['content'] = $this->load->view('pages/report_balancesheet',$data,TRUE);
        $this->load->view('wrapper_main',$data); 
    }

}