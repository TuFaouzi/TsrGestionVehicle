<div class="row" style="border: 1px solid gainsboro;">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="panel-body">                            
                <div class="widget-header widget-header-blue widget-header-flat">                            
                    <h4 class="widget-title lighter">
                        <?php echo display('generalereport'); ?>
                    </h4>
                    <hr>
                </div>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <div class="step-content pos-rel" id="step-container">
                        <div class="step-pane active" id="step1"> 
                            <form name="expense_entry" class="form-horizontal" id="notice-submit" action="<?php echo base_url() . 'report_general/generate/'; ?>" method="post" >
                                <!-- select an option -->
                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="company_id"><?php echo display('selectanoption'); ?>&nbsp;&nbsp;<span class="fa fa-asterisk red" style="color:red;"></span></label>
                                    <div class="col-xs-12 col-sm-9">
                                        <div class="clearfix" >
                                            <select class="testselect1" id="general_report" name="general_report">
                                                <option value="" ><?php echo display("selectanoption"); ?></option>
                                                <option value="1"><?php echo display('dailyallvehicleperformance'); ?></option>
                                                <option value="2"><?php echo display('dailysinglevehicleperformance'); ?></option>
                                                <option value="3"><?php echo display('allvehicleperformance'); ?></option>
                                                <option value="4"><?php echo display('vehiclewiseperformance'); ?></option>
                                                <option value="5"><?php echo display('driverwiseperformance'); ?></option>
                                                <option value="6"><?php echo display('companywiseperformance'); ?></option>
                                                <option value="7"><?php echo display('datetodatecompanywiseperformance'); ?></option>
                                                <option value="8"><?php echo display('datetodatedriverwiseperformance'); ?></option>
                                                <option value="9"><?php echo display('datetodatesinglevehicleperformance'); ?></option>
                                                <option value="10"><?php echo display('datetodateallvehicleperformance'); ?></option>
                                            </select>
                                        </div>
                                        <div class="help-block" id="title-exists"><?php echo form_error('company_id'); ?></div>
                                    </div> 
                                </div> 
                                <!-- form_hidden_part option -->
                                <div id="form_hidden_part">
                                    <!-- This part is load by ajax ...  -->
                                    <!-- defination in ajax_query controller -->
                                </div>  
                                <!-- submit-btn name -->
                                <div class="form-group" id="submit_btn">
                                    <label class="control-label col-xs-12 col-sm-3 "></label>
                                    <div class="col-xs-12 col-sm-9">
                                        <div class="clearfix" >
                                            <button class="btn btn-sm btn-info" type="submit">
                                                <i class="ace-icon fa fa-check"></i>
                                                <?php echo display('generate'); ?>
                                            </button>
                                        </div>
                                    </div> 
                                </div>
                            </form> 
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="panel panel-bd lobidrag">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h4 class="text-center bg-info" style="padding:10px">
                                                    <?php
                                                    $report = array(
                                                        1 => display('dailyallvehicleperformance'),
                                                        2 => display('dailysinglevehicleperformance'),
                                                        3 => display('allvehicleperformance'),
                                                        4 => display('vehiclewiseperformance'),
                                                        5 => display('driverwiseperformance'),
                                                        6 => display('companywiseperformance'),
                                                        7 => display('datetodatecompanywiseperformance'),
                                                        8 => display('datetodatedriverwiseperformance'),
                                                        9 => display('datetodatesinglevehicleperformance'),
                                                        10 => display('datetodateallvehicleperformance')
                                                    );
                                                    if ($this->input->post('general_report')) {
                                                        echo @$report[$this->input->post('general_report')];
                                                    }

                                                    echo '&nbsp;&nbsp;-&nbsp;&nbsp;';

                                                    $import_export = array(
                                                        '0' => 'Local',
                                                        '1' => 'Import',
                                                        '2' => 'Export',
                                                        '3' => 'Export & Import'
                                                    );
                                                    echo @$import_export[$this->input->post('import_export')];

                                                    echo '&nbsp;&nbsp;-&nbsp;&nbsp;';

                                                    if ($this->input->post('date_1') && $this->input->post('date_1')) {
                                                        echo " (" . $this->input->post('date_1') . " to " . $this->input->post('date_2') . ")";
                                                    }
                                                    ?>
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="panel-body"> 
                                            <div class="table-responsive">
                                                <table id="dataTableExample3" class="display compact cell-border" cellspacing="0" width="100%">     
                                                    <thead>
                                                        <tr>
                                                            <th><?php echo display('slno'); ?></th>
                                                            <th><?php echo display('date'); ?></th>
                                                            <th><?php echo display('triplinkid'); ?></th>
                                                            <th><?php echo display('companyname'); ?></th>
                                                            <th><?php echo display('drivername'); ?></th>
                                                            <th><?php echo display('vehicleregistrationno'); ?></th>
                                                            <th><?php echo display('trip_type'); ?></th>
                                                            <th><?php echo display('exportimport'); ?></th>
                                                            <th><?php echo display('startpoint'); ?></th>
                                                            <th><?php echo display('endpoint'); ?></th>
                                                            <th class="no-print"><?php echo display('contactrent'); ?></th>
                                                            <th><?php echo display('farerent'); ?></th>
                                                            <th class="no-print"><?php echo display('profit'); ?></th>
                                                            <th><?php echo display('advance'); ?></th>
                                                            <th><?php echo display('due'); ?></th>
                                                            <th><?php echo display('expense'); ?></th>
                                                            <th><?php echo display('balance'); ?></th>
                                                        </tr>
                                                    </thead>

                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="10" class="text-right"><?php echo display('grandtotal'); ?> : </th>
                                                            <th class="no-print"></th>
                                                            <th></th>
                                                            <th class="no-print"></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot>

                                                    <tbody>
                                                        <?php
                                                        if (!empty($trip)) {
                                                            $count = 0;
                                                            $count1 = 0;
                                                            $count2 = 1;
                                                            foreach ($trip as $value) {
                                                                // **************************************************************
                                                                // ************** STARTS OF DOUBBLE TRIP  ***********************
                                                                // **************************************************************   
                                                                echo "<tr ";
                                                                for ($i = 0; $i != count($doubble_trip); $i++) {
                                                                    if (@$doubble_trip[$i] == @$value->trip_link_id) {
                                                                        echo "style=\"font-weight:bold\" ";
                                                                    }
                                                                }
                                                                echo " >";
                                                                // **************************************************************
                                                                // ****************** ENDS OF DOUBBLE TRIP***********************
                                                                // **************************************************************
                                                                ?>
                                                            <td><?php echo $count + 1; ?></td>
                                                            <td><?php echo date("d-m-Y", strtotime($value->date)); ?></td>
                                                            <td><?php echo $value->trip_link_id; ?></td>
                                                            <td><?php echo (!empty($value->company_name)) ? $value->company_name : "<span class=\"blue\" title=\"Non-contracted company\">$value->others_company</span>"; ?></td>
                                                            <td><?php echo (!empty($value->driver_name)) ? $value->driver_name : "---"; ?></td>
                                                            <td><?php echo (!empty($value->hire_v_id)) ? "<span class=\"blue\" title=\"Hired vehicle\">$value->hire_v_id</span>" : $value->v_registration_no; ?></td>
                                                            <td>
                                                                <?php
                                                                #starts of trip type
                                                                $trip_type = array(
                                                                    '1' => 'Own Single',
                                                                    '2' => 'Own Double',
                                                                    '3' => 'Hire Single',
                                                                    '4' => 'Hire Double',
                                                                    '5' => 'Rent Single',
                                                                    '6' => 'Rent Double'
                                                                );
                                                                echo $trip_type[$value->trip_type];
                                                                #ends of showing trip type
                                                                ?> 
                                                            </td>
                                                            <td>
                                                                <?php
                                                                #starts of import / export
                                                                $import_export = array(
                                                                    '0' => 'Local',
                                                                    '1' => 'Import',
                                                                    '2' => 'Export',
                                                                    '3' => 'Export & Import'
                                                                );
                                                                echo $import_export[$value->import_export];
                                                                #ends of showing import / export
                                                                ?> 
                                                            </td>
                                                            <td><?php echo $value->start_point; ?></td>
                                                            <td><?php echo $value->end_point; ?></td>
                                                            <td class="no-print"><?php echo round($value->rent, 2); ?></td> 
                                                            <td><?php echo $value->fare_rent; ?></td></td>
                                                            <td class="no-print"><?php echo round($value->rent - $value->fare_rent, 2); ?></td></td>
                                                            <td><?php echo $value->advance; ?></td>    
                                                            <td><?php echo round($value->fare_rent - $value->advance, 2); ?></td>                   
                                                            <td>
                                                                <?php
                                                                $ex_amount = $this->db->select("*, SUM(amount*quantity) AS total")
                                                                        ->from("expense_data")
                                                                        ->where("trip_link_id", $value->trip_link_id)
                                                                        ->where("expense_group", 1)
                                                                        ->where("active", 1)
                                                                        ->group_by("trip_link_id")
                                                                        ->get()
                                                                        ->row();

                                                                if (!empty($ex_amount)):
                                                                    @$needle = @$trip[$count]->trip_link_id; //search data
                                                                    @$haystack = @$doubble_trip; //array

                                                                    if (@in_array($needle, $haystack)) {
                                                                        @$count_id = array_count_values($haystack);
                                                                        if (@$count_id[$needle] == 2) {
                                                                            if (@$trip[$count1]->trip_link_id != @$trip[$count2]->trip_link_id) {
                                                                                $total_expense = round($ex_amount->total / 2, 2);
                                                                                echo "$total_expense";
                                                                            } else {
                                                                                $total_expense = round($ex_amount->total / 2, 2);
                                                                                echo "$total_expense";
                                                                            }
                                                                        } if (@$count_id[$needle] == 1) {
                                                                            $total_expense = round($ex_amount->total, 2);
                                                                            echo "$total_expense";
                                                                        }
                                                                    } else {
                                                                        @$total_expense = round($ex_amount->total, 2);
                                                                        echo "$total_expense";
                                                                    }
                                                                else:
                                                                    echo $total_expense = "0.00";
                                                                endif;
                                                                ?> 
                                                            </td> 
                                                            <td><?php echo round($value->fare_rent - $total_expense, 2); ?></td>
                                                            </tr> 
                                                            <?php
                                                            $count++;
                                                            $count1++;
                                                            $count2++;
                                                        }//foreach
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>        
                        </div>
                    </div>  
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->
        </div><!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->




<!-- ************************MODAL************************ --> 

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo display('tripexpense'); ?></h4></div>
            <div class="modal-body"> 
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>
                                <?php echo display('slno'); ?>
                            </th>         
                            <th>
                                <?php echo display('expensename'); ?>
                            </th>      
                            <th>
                                <?php echo display('quantity'); ?>
                            </th>      
                            <th>
                                <?php echo display('amount'); ?>
                            </th>     
                            <th>
                                <?php echo display('total'); ?>
                            </th>    
                        </tr>
                    </thead>

                    <tbody id="local_expense_list">  

                    </tbody>

                </table> 
            </div>
            
        </div>
    </div>
</div>

<script type="text/javascript">
    /*-----------STARTS OF GENERAL REPORT FORM--------------*/
    $(document).ready(function () {
        $("#general_report").change(function () {
            var report = $(this).val();

            jquery_ajax('ajax_query', 'general_report_form', report, "#form_hidden_part");
        });
    });
    /*-----------ENDS OF GENERAL REPORTS FORM------------------*/
    $(document).ready(function () {       
        $("#dataTableExample3").DataTable({
            dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            buttons: [
                {extend: 'copy', className: 'btn-sm'},
                {extend: 'csv', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'excel', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm'},
                {extend: 'print', className: 'btn-sm'}
            ],
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };
                //#----------- Total over this page------------------# 
                contactRate = api.column(10, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                fareRate = api.column(11, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                profitTotal = api.column(12, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                advancedTotal = api.column(13, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                dueTotal = api.column(14, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                expenseTotal = api.column(15, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                balanceTotal = api.column(16, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                //#-----------ends of Total over this page------------------#
                // Update footer            
                $(api.column(10).footer()).html(contactRate.toFixed(2));
                $(api.column(11).footer()).html(fareRate.toFixed(2));
                $(api.column(12).footer()).html(profitTotal.toFixed(2));
                $(api.column(13).footer()).html(advancedTotal.toFixed(2));
                $(api.column(14).footer()).html(dueTotal.toFixed(2));
                $(api.column(15).footer()).html(expenseTotal.toFixed(2));
                $(api.column(16).footer()).html(balanceTotal.toFixed(2));
            }
        });
    });
    
    $(".led_btn").click(function () {
        var url = $(this).attr("href");
        var href = url.split("#");
        jquery_ajax('ajax_query', 'get_local_expense', href[1], "#local_expense_list");
    });

</script>