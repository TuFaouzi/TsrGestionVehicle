<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class report_model extends CI_Model{
 
    /*
     * @function name - report 
     * @author - Md. Shohrab Hossain
     * @created on - 10/12/2015
     */

    public function report($data = NULL){    
        if(empty($data['accounting_report'])):
            redirect('accounting/report');
        else:
            #----------------------------------------#
            #--------starts of date condition -------#
            #----------------------------------------#
            $now = new DateTime();
            switch ($data['accounting_report']):
                case 1:
                    #---LAST ONE MONTH REPORT--#  
                    $lastMonth = $now->sub(new DateInterval('P1M'));
                    $date_1 = $lastMonth->format('Y-m-d');
                    $date_2 = date("Y-m-d");
                    break; 
                case 2:
                    #---LAST ONE MONTH REPORT--#  
                    $lastMonth = $now->sub(new DateInterval('P3M'));
                    $date_1 = $lastMonth->format('Y-m-d');
                    $date_2 = date("Y-m-d");
                    break; 
                case 3:
                    #---LAST THREE MONTH REPORT--#  
                    $lastMonth = $now->sub(new DateInterval('P6M'));
                    $date_1 = $lastMonth->format('Y-m-d');
                    $date_2 = date("Y-m-d");
                    break; 
                case 4:
                    #---LAST SIX MONTH REPORT--#  
                    $lastMonth = $now->sub(new DateInterval('P12M'));
                    $date_1 = $lastMonth->format('Y-m-d');
                    $date_2 = date("Y-m-d");
                    break; 
                case 5:
                    #---LAST ONE YEAR REPORT--#  
                    $date_1 = date("Y-m-d",strtotime($data['date_1']));
                    $date_2 = date("Y-m-d",strtotime($data['date_2']));
                    break; 
            endswitch;
            #----------------------------------------#
            #------ ends of date condition ---------#
            #----------------------------------------# 

            #~~~~~~~~~~~~~INFLOW~~~~~~~~~~~~~~#
            $this->db->select("*");
            $this->db->from("acc_inflow"); 
            $this->db->where("received_date BETWEEN '$date_1' AND '$date_2'", NULL,FALSE);
            $this->db->where("status",1); 
            $this->db->order_by("received_date",'desc'); 
            $inflow = $this->db->get()->result();
            #~~~~~~~~~~~~~INFLOW~~~~~~~~~~~~~~#

            #~~~~~~~~~~~~~OUTFLOW~~~~~~~~~~~~~#
            $this->db->select("*");
            $this->db->from("acc_outflow"); 
            $this->db->where("payment_date BETWEEN '$date_1' AND '$date_2'", NULL,FALSE);
            $this->db->where("status",1); 
            $this->db->order_by("payment_date",'desc'); 
            $outflow = $this->db->get()->result();
            #~~~~~~~~~~~~~OUTFLOW~~~~~~~~~~~~~#
            return array('inflow'=>$inflow, 'outflow'=>$outflow);
        endif;
    }
   

} 