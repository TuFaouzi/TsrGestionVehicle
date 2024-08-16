<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Trip_local extends CI_Controller {
 
    public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        if($user_id == NULL){redirect('admin');} 
        $this->load->model(array(
            'trip_local_model',
            'expense_list_model',
            'expense_entry_model',
            'driver_info_model',
            'vehicle_model',
            'company_model',
            'city_model'
            ));
    }

    //==================this function for view comapany list (start) ========================//

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
        #generating trip_id
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
        #ends of generatiing trip_id
    }

    public function create() {  
        $data['m_ltrip'] = 'active';  
        // ---------------------------------------------  
        $expense_id = $this->input->post('expense_id');//expense id
        $expense_group = $this->input->post('expense_group'); //expense group
        $qty = $this->input->post('qty');
        $price = $this->input->post('price');
        // ---------------------------------------------
        $this->form_validation->set_rules('trip_type','Trip Type','required');
        $this->form_validation->set_rules('import_export','Local Trip','required'); 
        //--------------------------------------------------- 
        if($this->form_validation->run() == TRUE){
            $data['trip_info'] = (object)$trip = array();
            $trip['id']            = $this->input->post('id');
            $trip['trip_id']       = $this->generate_random_id('trip','trip_id');
            $trip['trip_type']     = $this->input->post('trip_type');
            $trip['import_export'] = $this->input->post('import_export');
            $trip['driver_id']     = $this->input->post('driver_id');
                if($this->input->post('v_id') != ''):
                    $trip['v_id']      = $this->input->post('v_id');
                else:
                    $trip['v_id']      = 0;
                endif; 
                if($this->input->post('hire_v_id') != ''):
                    $trip['hire_v_id'] = $this->input->post('hire_v_id');
                else:
                    $trip['hire_v_id'] = NULL;
                endif; 
            $trip['start_dist_id']    = $this->input->post('start_dist_id');
            $trip['start_station_id'] = $this->input->post('start_point');
            $trip['end_dist_id']      = $this->input->post('end_dist_id');
            $trip['end_station_id']   = $this->input->post('end_point'); 
                if($this->input->post('others_company') != ''):
                    $trip['others_company'] = trim($this->input->post('others_company')); 
                    $trip['company_id']   = NULL;
                else: 
                    $trip['company_id']   = $this->input->post('company_id');
                    $trip['others_company'] = NULL;
                endif; 
            $trip['date']          = date("Y-m-d",strtotime($this->input->post('trip_date')));
            $trip['rent']          = $this->input->post('rent');
            $trip['fare_rent']     = $this->input->post('fare_rent');
            $trip['advance']       = $this->input->post('advance');
            $trip['trip_link_id']  = $this->generate_random_id('trip','trip_link_id');
            $trip['posting_id']    = $this->session->userdata('user_id');    
            // --------------------------------------------------------------- 
            if($this->trip_local_model->save($trip)) $flag = 1; 
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
                'v_id' => $trip['v_id'],
                'quantity' => $qty[$exp],
                'amount' => $price[$exp],
                'posting_id' => $trip['posting_id'],
                );
                #save expense data 
                $this->expense_entry_model->save($insert); 
                // ends of data insert
            } //ends of for loop
            #ends of expense data insertion
            // ------------------------------------------------------------
            if($flag == 1):
                $this->session->set_flashdata('message','Save successfully');
            else:
                $this->session->set_flashdata('exception','Please try again');
            endif;
            redirect('trip_local/create');   
        } else{ 
            $data['trip_info'] = (object)array(
                'id'              => $this->input->post('id'),
                'trip_type'       => $this->input->post('trip_type'),
                'import_export'   => $this->input->post('import_export'),
                'driver_id'       => $this->input->post('driver_id'),
                'v_id'            => $this->input->post('v_id'),
                'hire_v_id'       => $this->input->post('hire_v_id'),
                'start_dist_id'   => $this->input->post('start_dist_id'),
                'start_point'     => $this->input->post('start_point'),
                'end_dist_id'     => $this->input->post('end_dist_id'),
                'end_point'       => $this->input->post('end_point'),
                'trip_date'       => $this->input->post('trip_date'),
                'company_id'      => $this->input->post('company_id'),
                'others_company'  => $this->input->post('others_company'),
                'rent'            => $this->input->post('rent'),
                'fare_rent'       => $this->input->post('fare_rent'),
                'advance'         => $this->input->post('advance'),
                'posting_id'      => $this->session->userdata('user_id')
            );
            // -------------------------
            $data['driver_info'] = $this->driver_info_model->driver_dropdown();
            $data['vehicle_info'] = $this->vehicle_model->get_vehicle_model(); 
            $data['company_info'] = $this->company_model->company_name_list();
            $data['state_info'] = $this->trip_local_model->get_distance_info(); 
            $data['expense'] = $this->trip_local_model->expense(); 
            $data['content'] = $this->load->view('pages/trip_local_form',$data,TRUE);
            $this->load->view('wrapper_main',$data);
        } 
    }

    /*
     * @function name - view
     * @parameter - no parameter 
     * @return - array data
     * @author - Md. Shohrab Hossain
     * @created on - 12/10/2015
     */

    public function view(){ 
        $data['m_t_l'] = 'active';
        $data['trip'] = $this->trip_local_model->read();
        $data['content'] = $this->load->view('pages/trip_local_view',$data,TRUE);
        $this->load->view('wrapper_main',$data);
    } 

    /*
     * @function name - edit
     * @parameter - $trip_id
     * $trip_id - its contain trip_information form data 
     * @return - array data
     * @author - Md. Shohrab Hossain
     * @created on - 12/10/2015
     */

    public function edit($trip_id = NULL){
        if($this->session->userdata('isLogin') == FALSE 
            || $this->session->userdata('user_type')!=9) {
            redirect('admin');
        }
        #
        $data['m_t_l'] = 'active';  
        $transection_id = $this->input->post('transection_id');//expense id
        $expense_id = $this->input->post('expense_id');//expense id
        $expense_group = $this->input->post('expense_group'); //expense group
        $qty = $this->input->post('qty');
        $price = $this->input->post('price');
        // ---------------------------------------------
        $this->form_validation->set_rules('trip_type','Trip Type','required');
        $this->form_validation->set_rules('import_export','Local Trip','required'); 
        //--------------------------------------------------- 
        if($this->form_validation->run() == TRUE){
            $data['trip_info'] = (object)$trip = array();
            $trip['id']            = $this->input->post('id'); 
            $trip['import_export'] = $this->input->post('import_export'); 
            $trip['trip_type']     = $this->input->post('trip_type'); 
            $trip['driver_id']     = $this->input->post('driver_id');
                if($this->input->post('v_id') != ''):
                    $trip['v_id']      = $this->input->post('v_id');
                else:
                    $trip['v_id']      = 0;
                endif; 
                if($this->input->post('hire_v_id') != ''):
                    $trip['hire_v_id'] = $this->input->post('hire_v_id');
                else:
                    $trip['hire_v_id'] = NULL;
                endif; 
            $trip['start_dist_id']    = $this->input->post('start_dist_id');
            $trip['start_station_id'] = $this->input->post('start_point');
            $trip['end_dist_id']      = $this->input->post('end_dist_id');
            $trip['end_station_id']   = $this->input->post('end_point'); 
                if($this->input->post('others_company') != ''):
                    $trip['others_company'] = trim($this->input->post('others_company')); 
                    $trip['company_id']   = NULL;
                else: 
                    $trip['company_id']   = $this->input->post('company_id');
                    $trip['others_company'] = NULL;
                endif; 
            $trip['date']          = date("Y-m-d",strtotime($this->input->post('trip_date')));
            $trip['rent']          = $this->input->post('rent');
            $trip['fare_rent']     = $this->input->post('fare_rent');
            $trip['advance']       = $this->input->post('advance'); 
            $trip['posting_id']    = $this->session->userdata('user_id');    
            // --------------------------------------------------------------- 
            #save trip information 
            $this->trip_local_model->update($trip); 
            // echo "<pre>";print_r($trip);exit;
            // ---------------------------------------------------------------
            for($exp=0;$exp!=count($expense_id);$exp++):
                $update = array(
                'transection_id' => $transection_id[$exp],   
                'import_export' => $trip['import_export'],   
                'date' => $trip['date'], 
                'expense_serial' => '',
                'date' => $trip['date'],
                'v_id' => $trip['v_id'],
                'quantity' => $qty[$exp],
                'amount' => $price[$exp],
                'posting_id' => $trip['posting_id']
                );  
                #save expense data 
                $this->expense_entry_model->update($update);                  
                // ends of data insert
            endfor; //ends of for loop
            #ends of expense data insertion
            // ------------------------------------------------------------
            redirect('trip_local/view');   
        } else{  
            $trip_id = $this->uri->segment(3);
            $trip_link_id = $this->trip_local_model->get_trip_link_id($trip_id);
            $data['trip_info'] = $this->trip_local_model->get_single_trip($trip_id); 
            $data['driver_info'] = $this->driver_info_model->driver_dropdown();
            $data['vehicle_info'] = $this->vehicle_model->get_vehicle_model(); 
            $data['company_info'] = $this->company_model->company_name_list();
            $data['state'] = $this->city_model->get_district(); 
            $data['expense'] = $this->trip_local_model->expense_data($trip_link_id);
            $data['content'] = $this->load->view('pages/trip_local_edit_form',$data,TRUE);
            $this->load->view('wrapper_main',$data);
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
        $this->trip_local_model->delete($trip_link_id); 
        $this->expense_entry_model->delete($trip_link_id); 
        redirect('trip_local/view');
    }

    /*
     * @function name - view_trip_by_trip_link_id
     * @parameter - no parameter 
     * @return - array data
     * @author - Md. Shohrab Hossain
     * @created on - 13/10/2015
     */

    public function view_trip_by_trip_link_id($trip_link_id,$pdf=NULL){ 
        $data['m_t_l'] = 'active';
        $data['single_trip'] = $this->trip_local_model->trip_by_trip_link_id($trip_link_id);
        $data['expense_data'] = $this->trip_local_model->expense_by_trip_link_id($trip_link_id);
        $data['content'] = $this->load->view('pages/trip_local_single',$data,TRUE);
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

}
