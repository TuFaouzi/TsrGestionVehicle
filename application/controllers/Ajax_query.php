<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ajax_query extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        if ($user_id == NULL) {
            redirect('admin');
        }
        $this->load->model('ajax_model');
    }

    public function station_start($id) {
        $this->ajax_model->get_station_start($id);
    }

    public function station_end($id) {
        $this->ajax_model->get_station_end($id);
    }

    public function get_local_expense($trip_link_id = NULL) {
        $expenses = $this->ajax_model->get_local_expense($trip_link_id);
        if (count($expenses) > 0) {
            $count = 1;
            $grand_total_amount = 0;
            foreach ($expenses as $expense){
                echo "<tr>";
                echo "<td>" . $count++ . "</td>";
                echo "<td>$expense->expense_name</td>";
                echo "<td>$expense->quantity</td>";
                echo "<td>$expense->amount</td>";
                echo "<td>" . $total_amount = round($expense->quantity * $expense->amount, 2) . "</td>";
                echo "</tr>";
                $grand_total_amount = round($grand_total_amount + $total_amount, 2); // calculate grand total amount
            }
            echo "";
            echo "<tr>";
            echo "<th class=\"text-right\" colspan=\"5\">Grand Total =  $grand_total_amount </th>";
            echo "</tr>";
            echo "";
        }
    }

// ************************************************************************
// *************************GENERAL REPORT FORM**************************** 
// ************************************************************************
    public function general_report_form($report_id = '') {
        switch ($report_id) {
            case "1": //Daily All Vehicle Performance
                $this->import_export();
                break;
            case "2": //Daily Single Vehicle Performance
                $this->import_export();
                $this->vehicle_name();
                break;
            case "3": //All Vehicle Performance                
                $this->import_export();
                break;
            case "4": //Vehicle wise Performance
                $this->import_export();
                $this->vehicle_name();
                break;
            case "5": //Driver Wise Performance
                $this->import_export();
                $this->driver_name();
                break;
            case "6": //Company Wise Performance 
                $this->import_export();
                $this->company_name();
                break;
            case "7": //Date to Date Company Wise Performance 
                $this->import_export();
                $this->company_name();
                $this->date();
                break;
            case "8": //Date to Date Driver Wise Performance 
                $this->import_export();
                $this->driver_name();
                $this->date();
                break;
            case "9": //Date to Date Single Vehicle Performance 
                $this->import_export();
                $this->vehicle_name();
                $this->date();
                break;
            case "10": //Date to Date All Vehicle Performance
                $this->import_export();
                $this->date();
                break;
        }
    }

    function import_export() {
        echo "<script>$('.testselect1').SumoSelect();</script>";

        echo "<div class=\"form-group\">";
        echo "<label class=\"control-label col-xs-12 col-sm-3 no-padding-right\" for=\"company_id\">Export / Import</label>";
        echo "<div class=\"col-xs-12 col-sm-9\">";
        echo "<div class=\"clearfix\" >";
        echo "<select name=\"import_export\" class=\"col-xs-12 col-sm-4 testselect1\">";
        echo "<option value=\"0\">Local</option>";
        echo "<option value=\"2\">Export</option>";
        echo "<option value=\"1\">Import</option>";
        echo "<option value=\"3\">Export & Import</option>";
        echo "<option value=\"4\">Export - Import - Local</option>";
        echo "</select>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    function driver_name() {
        $this->load->model('report_general_model');
        $driver_id = $this->report_general_model->get_all_driver_info();

        echo "<div class=\"form-group\">";
        echo "<label class=\"control-label col-xs-12 col-sm-3 no-padding-right\">" . $this->lang->line('DRIVER_NAME') . "</label>";
        echo "<div class=\"col-xs-12 col-sm-9\">";
        echo "<div class=\"clearfix\" >";
        echo form_dropdown('driver_id', $driver_id, set_value('driver_id', $driver_id), 'class="col-xs-12 col-sm-4 testselect1"');
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    function vehicle_name() {
        $this->load->model('report_general_model');
        $v_id = $this->report_general_model->get_all_vehicle_info();
        echo "<script>$('.testselect1').SumoSelect();</script>";
        echo "<div class=\"form-group\">";
        echo "<label class=\"control-label col-xs-12 col-sm-3 no-padding-right\">" . $this->lang->line('VEHICLE_REGISTRATION_NO') . "</label>";
        echo "<div class=\"col-xs-12 col-sm-9\">";
        echo "<div class=\"clearfix\" >";
        echo form_dropdown('v_id', $v_id, set_value('v_id', $v_id), 'class="col-xs-12 col-sm-4 testselect1"');
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    function company_name() {
        $this->load->model('report_general_model');
        $company_id = $this->report_general_model->get_all_company_info();
        echo "<div class=\"form-group\">";
        echo "<label class=\"control-label col-xs-12 col-sm-3 no-padding-right\">" . $this->lang->line('COMPANY_NAME') . "</label>";
        echo "<div class=\"col-xs-12 col-sm-9\">";
        echo "<div class=\"clearfix\" >";
        echo form_dropdown('company_id', $company_id, set_value('company_id', $company_id), 'class="col-xs-12 col-sm-4 testselect1"');
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    function date() {
        echo "<script src=\"//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.js\"></script>";
        echo "<script src=\"//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.css\"></script>";
        echo "<script>$('.datepicker').datepicker({dateFormat: 'dd-mm-yy'})</script>";

        echo "<div class=\"form-group\" id=\"date\">";
        echo "<label class=\"control-label col-xs-12 col-sm-3 no-padding-right\" for=\"date\">" . $this->lang->line('DATE') . "</label>";
        echo "<div class=\"col-xs-12 col-sm-9\">";
        echo "<div class=\"row\">";
        echo "<div class=\"col-xs-12 col-sm-6\" style=\"width: 42.6%;\">";
        echo "<input type=\"text\" name=\"date_1\" class=\"datepicker form-control\">";
        echo "</div>";
        echo "<div class=\"col-xs-12 col-sm-6\" style=\"width: 42.6%;\">";
        echo "<input type=\"text\" name=\"date_2\" class=\"datepicker form-control\" >";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

// ************************************************************************
// *********************ENDS OF GENERAL REPORT FORM************************ 
// ************************************************************************
// ************************************************************************
// *************************EXPENSE REPORT FORM**************************** 
// ************************************************************************
    public function expense_report_form($report_id = '') {
        switch ($report_id) {
            case "1": //Daily All Vehicle Expense 
                echo "&nbsp;";
                break;
            case "2": //Daily Single Vehicle Expense 
                $this->vehicle_name();
                break;
            case "3": //All Vehicle Expense   
                echo "&nbsp;";
                break;
            case "4": //Vehicle wise Expense 
                $this->vehicle_name();
                break;
            case "5": //Date to Date Vehicle Wise Expense  
                $this->vehicle_name();
                $this->date();
                break;
            case "6": //Date to Date All Vehicle Expense  
                $this->date();
                break;
            case "7": //Particular Wise Expense 
                $this->expense_name();
                break;
            case "8": //Date to Date Particular Wise Expense 
                $this->expense_name();
                $this->date();
                break;
            case "9": //Regular Expense  
                echo "&nbsp";
                // $this->expense_type(1); //1 for regular expense 
                break;
            case "10": //Date to Date Regular Expense   
                $this->date();
                break;
            case "11": //Maintenance Expense 
                echo "&nbsp;";
                break;
            case "12": //Date to Date Maintenance Expense 
                // $this->expense_type(2); //2 for Maintenance Expense 
                $this->date();
                break;
            case "13": //Others Expense 
                echo "&nbsp;"; //3 for Others Expense 
                break;
            case "14": //Date to Date Others Expense  
                $this->date();
                break;
            case "15": //Owner Vehicle Expense
                echo "&nbsp;";
                break;
            case "16": //Hire Vehicle Expense
                echo "&nbsp;";
                break;
            case "17": //Vehicle Wise Particular Expense 
                $this->vehicle_name(); //3 for Maintenance Expense 
                $this->expense_name();
                break;
            case "18"://Date to Date Vehicle Wise Particular Expense 
                $this->vehicle_name(); //3 for Maintenance Expense 
                $this->expense_name();
                $this->date();
                break;
            case "20": //Date to Date Office Expense  
                $this->date();
                break;
            case "22": //Date to Date Garage Expense  
                $this->date();
                break;
        }
    }

    function expense_name() {
        $this->load->model('report_expense_model');
        $expense_name = $this->report_expense_model->get_all_expense_list();
        echo "<script>$('.testselect1').SumoSelect();</script>";
        echo "<div class=\"form-group\">";
        echo "<label class=\"control-label col-xs-12 col-sm-3 no-padding-right\">Expense Name</label>";
        echo "<div class=\"col-xs-12 col-sm-9\">";
        echo "<div class=\"clearfix\" >";
         echo form_dropdown('expense_id', $expense_name, set_value('expense_id', $expense_name), 'class="col-xs-12 col-sm-4 testselect1"');
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

    function expense_type($type) {
        $this->load->model('report_expense_model');
        $expense_name = $this->report_expense_model->get_a_expense($type);
        echo "<div class=\"form-group\">";
        echo "<label class=\"control-label col-xs-12 col-sm-3 no-padding-right\">Expense Name</label>";
        echo "<div class=\"col-xs-12 col-sm-9\">";
        echo "<div class=\"clearfix\" >";
        echo @form_dropdown('expense_id', $expense_name);
        echo "</div>";
        echo "</div>";
        echo "</div>";
    }

// ************************************************************************
// *********************ENDS OF EXPENSE REPORT FORM************************ 
// ************************************************************************
}
