<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_company extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        if($user_id == NULL){redirect('admin');} 
	    $this->load->model(array('report_company_model'));
    }
    public function generate($pdf=NULL){    
        $data['m_bill'] = 'active';
        $data['report'] = (object)$report = array(
            'company_option' => $this->input->post('company_option'), 
            'import_export' => $this->input->post('import_export'), 
            'company_id' => $this->input->post('company_id'), 
            'others_company' => $this->input->post('others_company'), 
            'date_1' => date('Y-m-d',strtotime($this->input->post('date_1'))), 
            'date_2' => date('Y-m-d',strtotime($this->input->post('date_2')))
        );   

        $this->form_validation->set_rules('company_option',$this->lang->line('SELECT_COMPANY_TYPE'),'required');
        if($this->form_validation->run() == TRUE):
            #------------STARTS OF COMPANY PROFILE-----------#
            if(!empty($report['others_company'])):
                $data['company_info'] = (object)array('company_name'=>$report['others_company']);
            else:
                $data['company_info'] = $this->report_company_model->get_company_info($report['company_id']); 
            endif;
            #-------------ENDS OF COMPANY PROFILE------------#
            $data['bill'] = $this->report_company_model->company_bill($report);
        endif; 
        $data['company'] = $this->report_company_model->get_all_company_info();
        $data['content'] = $this->load->view('pages/report_company',$data,TRUE);
        $this->load->view('wrapper_main',$data);  
    }
    public function pdf(){  
        $report = array( 
            'import_export' => $this->input->get('i'), 
            'company_id' => $this->input->get('c'), 
            'others_company' => $this->input->get('o'), 
            'date_1' => ($this->input->get('d1')!="1970-01-01")?$this->input->get('d1'):NULL, 
            'date_2' => ($this->input->get('d2')!="1970-01-01")?$this->input->get('d2'):NULL
        );  
        if(!empty($report['others_company'])):
            $data['company_info'] = (object)array('company_name'=>$report['others_company']);
        else:
            $data['company_info'] = $this->report_company_model->get_company_info($report['company_id']); 
        endif;
        $data['bill'] = $this->report_company_model->company_bill($report); 
        $data['content'] = $this->load->view('pages/report_company_pdf',$data,TRUE);
        // $html = $this->output->get_output($html);
        $this->load->library('dompdf_gen'); 
        $this->dompdf->load_html($data['content']);
        $this->dompdf->render();
        $filename = strtoupper(date('d_M_Y').'_'.$this->uri->segment(2)."_".$this->uri->segment(4));
        $this->dompdf->stream($filename.".pdf",array("Attachment" => 0));
    }
}