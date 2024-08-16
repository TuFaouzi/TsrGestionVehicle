<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Trip_information extends CI_Controller {
    public function __construct(){ 
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        if($user_id == NULL){redirect('admin');} 
        $this->load->model(array(
            'trip_information_model',
            'expense_list_model',
            'expense_entry_model',
            'company_model',
            'driver_info_model',
            'city_model'
            ));
    }
    public function add_trip() { 
        $data['m_trip'] = "active";
        $data['driver_info'] = $this->trip_information_model->get_info("driver_info");
        $data['vehicle_info'] = $this->trip_information_model->get_info("vehicle_info");
        $data['company_info'] = $this->company_model->company_name_list();
        $data['state_info'] = $this->trip_information_model->get_distance_info(); 
        $data['expense'] = $this->trip_information_model->expense();
        $data['content'] = $this->load->view('pages/trip_information_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }
    public function get_v_type($v_id = NULL){
        $data = $this->db->select("v_type")
                        ->from('vehicle_info')
                        ->where('v_id',$v_id)
                        ->limit(1)
                        ->get()
                        ->row(); 
        return $data->v_type;
    }
    public function generate_random_id($table,$field){
        $this->load->helper('string'); 
        $random_id = random_string('alnum', 10);
        $num_rows = $this->db->select("*")
                          ->from($table)
                          ->where($field,$random_id)
                          ->get()
                          ->num_rows();
        if($num_rows > 0){ 
            $random_id = random_string('alnum', 10);
        }  
        return strtoupper($random_id);
    }
    public function save_trip() {    
        $data['m_trip'] = "active"; 
        // --------------------------------------------- 
        $trip_type        =  $this->input->post('trip_type');
        $import_export    =  $this->input->post('import_export');
        $driver_id        =  $this->input->post('driver_id'); 
        $v_id             =  $this->input->post('v_id');
        $hire_v_id        =  $this->input->post('hire_v_id');  
        if($this->input->post('v_id') != ''):
            $v_type_id    =  $this->get_v_type($this->input->post('v_id')); //calling get_v_type
        endif;
        $start_dist_id    =  $this->input->post('start_dist_id');
        $start_station_id =  $this->input->post('start_point');
        $end_dist_id      =  $this->input->post('end_dist_id');
        $end_station_id   =  $this->input->post('end_point');
        $company_id       =  $this->input->post('company_id');
        $others_company   =  $this->input->post('others_company');
        $date             =  $this->input->post('trip_date');
        $rent             =  $this->input->post('rent');
        $fare_rent        =  $this->input->post('fare_rent');
        $advance          =  $this->input->post('advance');
        //generate a trip_linked_id
        $trip_link_id     =  $this->generate_random_id('trip','trip_link_id');
        $posting_id       =  $this->session->userdata('user_id'); 
        //expense
        $expense_id = $this->input->post('expense_id');//expense id
        $expense_group = $this->input->post('expense_group'); //expense group
        $qty = $this->input->post('qty');
        $price = $this->input->post('price');
        // ---------------------------------------------
        $this->form_validation->set_rules('trip_type','Trip Type','required');
        $this->form_validation->set_rules('import_export','Import / Export','required'); 
        if($this->form_validation->run() == FALSE){
            $data['driver_info'] = $this->trip_information_model->get_info("driver_info");
            $data['vehicle_info'] = $this->trip_information_model->get_info("vehicle_info");
            $data['company_info'] = $this->company_model->company_name_list();
            $data['state_info'] = $this->trip_information_model->get_distance_info(); 
            $data['expense'] = $this->trip_information_model->expense();
            $data['content'] = $this->load->view('pages/trip_information_form',$data,TRUE);
            $this->load->view('wrapper_main',$data);
        }else{
        //---------------------------------------------------
            #checking the import & export 
            if($import_export == 1){ //import
                $initialize = 1;
                $number = 2;
            }
            if($import_export == 2){ //export
                $initialize = 0;
                $number = 1;
            }
            if($import_export == 3){
                $initialize = 0;//export&import
                $number = 2;
            } 
            // --------------------------------------------- 
            for($i=$initialize; $i != $number; $i++){  
                $trip = array();
                $trip['trip_id']       = $this->generate_random_id('trip','trip_id');
                $trip['trip_type']     = $trip_type;
                $trip['import_export'] = $import_export;
                $trip['driver_id']     = $driver_id;
                    if(!empty($v_id)):
                        $trip['v_id']      = $v_id;
                    else:
                        $trip['v_id']      = 0;
                    endif; 
                    if(!empty($hire_v_id)):
                        $trip['hire_v_id'] = $hire_v_id;
                    else:
                        $trip['hire_v_id'] = NULL;
                    endif;  
                    if(!empty($v_type_id)):
                        $trip['v_type_id'] = $v_type_id;
                    else:
                        $trip['v_type_id'] = NULL;
                    endif;   
                $trip['start_dist_id']    = $start_dist_id[$i];
                $trip['start_station_id'] = $start_station_id[$i];
                $trip['end_dist_id']      = $end_dist_id[$i];
                $trip['end_station_id']   = $end_station_id[$i]; 
                    if(!empty($others_company[$i])):
                        $trip['others_company'] = trim($others_company[$i]); 
                    else:  
                        $trip['others_company'] = '';
                    endif;  
                    if(!empty($company_id[$i])):
                        $trip['company_id'] = $company_id[$i];
                    else: 
                        $trip['company_id'] = '';
                    endif;  
                $trip['date']          = date("Y-m-d",strtotime($date[$i]));
                $trip['rent']          = $rent[$i];
                $trip['fare_rent']     = $fare_rent[$i];
                $trip['advance']       = $advance[$i];
                $trip['trip_link_id']  = $trip_link_id;
                $trip['posting_id']    = $posting_id;  

                #save trip information 
                if($this->trip_information_model->save($trip)) $flag = 1; 
            }  // ends of for loop  
// ---------------------------------------------------------------
            #this part for expense data insertion
            for($exp=0;$exp!=count($expense_id);$exp++){ 
                $insert = array(
                'import_export' => $trip['import_export'],
                'trip_link_id' => $trip['trip_link_id'],
                'expense_group' => $expense_group[$exp],
                'expense_id' => $expense_id[$exp],
                'expense_serial' => '',
                'date' => $trip['date'],
                'v_id' => $v_id,
                'quantity' => $qty[$exp],
                'amount' => $price[$exp],
                'posting_id' => $posting_id,
                );
                #save expense data 
                $this->expense_entry_model->save($insert); 
                // ends of data insert
            } //ends of for loop
            #ends of expense data insertion
// ------------------------------------------------------------
            if($flag == 1):
               $this->session->set_flashdata('success', display('savesuccessfully'));
            else:
                $this->session->set_flashdata('error', display('pleasetryagain'));
                
            endif;
            redirect('trip_information/add_trip'); 
            // ----------------------------------------------
        }               
    }
    /*
     * @function name - view
     * @parameter - no parameter 
     * @return - array data
     * @author - Md. Shohrab Hossain
     * @created on - 10/10/2015
     */
    public function view(){ 
        $data['m_tr_l'] = "active";
        $data['import'] = $this->trip_information_model->read_daily(1);
        $data['export'] = $this->trip_information_model->read_daily(2);
        $data['export_import'] = $this->trip_information_model->read_daily(3);
        $data['doubble_trip'] = $this->doubble_trip();
        $data['content'] = $this->load->view('pages/trip_information',$data,TRUE);
        $this->load->view('wrapper_main',$data);

    } 
    public function view_all(){ 
        $data['m_tr_l'] = "active";
        $data['trip'] = $this->trip_information_model->read();
        $data['doubble_trip'] = $this->doubble_trip();
        $data['content'] = $this->load->view('pages/trip_information_all',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }
    public function doubble_trip(){ 
        $result = $this->db->select("trip.trip_link_id")
        ->from("trip")
        ->where("trip_type",2)
        ->or_where("trip_type",4)
        ->or_where("trip_type",6)
        ->get()
        ->result();
        foreach ($result as $key => $value) {
            $doubble[$key] = $value->trip_link_id;
        } 
        if(!empty($doubble))return $doubble;
    }
    /*
     * @function name - view_trip_by_trip_link_id
     * @parameter - no parameter 
     * @return - array data
     * @author - Md. Shohrab Hossain
     * @created on - 13/10/2015
     */

    public function view_trip_by_trip_link_id($trip_link_id,$pdf=NULL){ 
        $data['m_tr_l'] = "active";
        $data['single_trip'] = $this->trip_information_model->trip_by_trip_link_id($trip_link_id);
        $data['expense_data'] = $this->trip_information_model->expense_by_trip_link_id($trip_link_id);
        $data['content'] = $this->load->view('pages/trip_information_single',$data,TRUE);
        $this->load->view('wrapper_main',$data);

        if($pdf == "pdf"){   
            // $html = $this->output->get_output($html);
            $this->load->library('dompdf_gen'); 
            $this->dompdf->load_html($data['content']);
            $this->dompdf->render();
            $filename = strtoupper(date('d_M_Y').'_'.$this->uri->segment(2)."_".$this->uri->segment(4));
            $this->dompdf->stream($filename.".pdf",array("Attachment" => 0));
        }    
    } 
     /*
     * @function name - delete
     * @parameter - no parameter 
     * @return - array data
     * @author - Md. Shohrab Hossain
     * @created on - 11/10/2015
     */
    public function delete($trip_link_id = NULL){
        if($this->session->userdata('isLogin') == FALSE 
            || $this->session->userdata('user_type')!=9) {
            redirect('admin');
        }
        #
        $trip_link_id = $this->uri->segment(3);
        $this->trip_information_model->delete($trip_link_id); 
        $this->expense_entry_model->delete($trip_link_id); 
        $this->session->set_flashdata('success', display('deletesuccessfully'));
        redirect('trip_information/view');
    }
     /*
     * @function name - edit
     * @parameter - $trip_id
     * $trip_id - its contain trip_information form data 
     * @return - array data
     * @author - Md. Shohrab Hossain
     * @created on - 11/10/2015
     */
    public function edit($trip_id = NULL){
        if($this->session->userdata('isLogin') == FALSE 
            || $this->session->userdata('user_type')!=9) {
            redirect('admin');
        }
        #
        $data['m_tr_l'] = "active";
        $trip_id = $this->uri->segment(3);
        $trip_link_id = $this->trip_information_model->get_trip_link_id($trip_id);
        $data['driver_info'] = $this->driver_info_model->driver_dropdown();
        $data['vehicle_info'] = $this->trip_information_model->get_info("vehicle_info");
        $data['trip_info'] = $this->trip_information_model->get_single_trip($trip_id);
        $data['company_info'] = $this->company_model->company_name_list();
        $data['state'] = $this->city_model->get_district(); 
        $data['expense'] = $this->trip_information_model->expense_data($trip_link_id);
        $data['content'] = $this->load->view('pages/trip_information_edit_form',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    }
    public function save_edit(){  
        $data['m_tr_l'] = "active"; 
        //expense
        $transection_id = $this->input->post('transection_id');//expense id
        $expense_id = $this->input->post('expense_id');//expense id
        $expense_group = $this->input->post('expense_group'); //expense group
        $qty = $this->input->post('qty');
        $price = $this->input->post('price');
        // ---------------------------------------------
        $trip = array();
        $trip['id'              ] = $this->input->post('id');    
        $trip['import_export'   ] = $this->input->post('import_export');    
        $trip['start_dist_id'   ] = $this->input->post('start_dist_id');
        $trip['start_station_id'] = $this->input->post('start_point');
        $trip['end_dist_id'     ] = $this->input->post('end_dist_id');
        $trip['end_station_id'  ] = $this->input->post('end_point'); 
        if($this->input->post('others_company') != ''):
            $trip['others_company'] = trim($this->input->post('others_company')); 
            $trip['company_id']   = '';
        else: 
            $trip['company_id']   = $this->input->post('company_id');
            $trip['others_company'] = '';
        endif; 
        $trip['driver_id'       ] = $this->input->post('driver_id');
        $trip['date'            ] = date("Y-m-d",strtotime($this->input->post('trip_date')));
        $trip['rent'            ] = $this->input->post('rent');
        $trip['fare_rent'       ] = $this->input->post('fare_rent');
        $trip['advance'         ] = $this->input->post('advance'); 
        $trip['posting_id'      ] = $this->session->userdata('user_id');
        #save trip information 
        $this->trip_information_model->update($trip); 
// ---------------------------------------------------------------
        #this part for expense data insertion
        for($exp=0;$exp!=count($expense_id);$exp++){ 
            $update = array(
            'transection_id' => $transection_id[$exp],   
            'date' => $trip['date'], 
            'import_export' => $trip['import_export'],
            'quantity' => $qty[$exp],
            'amount' => $price[$exp],
            'posting_id' => $this->session->userdata('user_id'),
            ); 
            #save expense data 
            $this->expense_entry_model->update($update);                  
            // ends of data insert
        } //ends of for loop
        #ends of expense data insertion
        redirect('trip_information/view');
// ------------------------------------------------------------
    }
}
