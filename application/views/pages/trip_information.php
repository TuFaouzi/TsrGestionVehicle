<div class="row" style="border: 1px solid gainsboro;background-color: white">
    <div class="col-xs-12" id="PrintArea">
       
        <div class="panel-body">  
        <div class="table-header">
            <i class="fa fa-list"></i>
            <?php echo display('dailytriplist'); ?> 
            <div class="pull-right btn btn-info">
                <i class="fa fa-plus "></i>
               <a class="white" href="<?php echo base_url(); ?>trip_information/view_all">
                    <strong><?php echo display('alltriplist'); ?></strong>
                </a>
            </div>
        </div>
            <hr>
        </div>

        <!-- ------------------------------------------
        -------------------EXPORT TRIP-------------------
        ----------------------------------------------- -->
        <?php if (!empty($export)): ?>
            <div id="PrintAreaExport"> 
                <table  id="trip_export" class="display compact cell-border" cellspacing="0" width="100%">
                    <thead>
                        <tr><th colspan="16"><h4><?php echo display('exporttriplist'); ?></h4></th></tr>
                    <tr>
                        <th><?php echo display('slno'); ?></th>
                        <th><?php echo display('date'); ?></th>
                        <th><?php echo display('triplinkid'); ?></th>
                        <th><?php echo display('companyname'); ?></th>
                        <th><?php echo display('drivername'); ?></th>
                        <th><?php echo display('vehicleregistrationno'); ?></th>
                        <th><?php echo display('triptype'); ?></th>
                        <th><?php echo display('startpoint'); ?></th>
                        <th><?php echo display('endpoint'); ?></th>
                        <th><?php echo display('contactrent'); ?></th>
                        <th><?php echo display('farerent'); ?></th>
                        <th><?php echo display('profit'); ?></th>
                        <th><?php echo display('advance'); ?></th>
                        <th><?php echo display('expense'); ?></th>
                        <th><?php echo display('balance'); ?></th>
                        <th class="no-print"><?php echo display('action'); ?></th>
                    </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th colspan="9" class="text-right"><?php echo display('grandtotal'); ?>:</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>

                    <tbody>
                        <?php
                        if (!empty($export)) {
                            $count = 0;
                            $count1 = 0;
                            $count2 = 1;
                            foreach ($export as $value) {
                                // **************************************************************
                                // ************** STARTS OF DOUBBLE TRIP  ***********************
                                // **************************************************************   
                                echo "<tr ";
                                for ($i = 0; $i != count($doubble_trip); $i++) {
                                    if ($doubble_trip[$i] == $value->trip_link_id) {
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
                                    '1' => display('ownsingle'),
                                    '2' => display('owndouble'),
                                    '3' => display('hiresingle'),
                                    '4' => display('hiredouble'),
                                    '5' => display('rentsingle'),
                                    '6' => display('rentdouble')
                                );
                                echo $trip_type[$value->trip_type];
                                #ends of showing trip type
                                ?> 
                            </td> 
                            <td><?php echo $value->start_point; ?></td>
                            <td><?php echo $value->end_point; ?></td>
                            <td><?php echo $value->rent; ?></td>
                            <td><?php echo $value->fare_rent; ?></td>
                            <td><?php echo round($value->rent - $value->fare_rent, 2); ?></td>
                            <td><?php echo $value->advance; ?></td>
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
                                                echo $total_expense = round($ex_amount->total / 2, 2);
                                            } else {
                                                echo $total_expense = round($ex_amount->total / 2, 2);
                                            }
                                        } if (@$count_id[$needle] == 1) {
                                            echo $total_expense = round($ex_amount->total, 2);
                                        }
                                    } else {
                                        echo @$total_expense = round($ex_amount->total, 2);
                                    }else:
                                    echo $total_expense = 0.00;
                                endif;
                                ?> 
                            </td>
                            <td><?php echo round($value->fare_rent - $total_expense, 2); ?></td>

                            <td class="no-print"> 
                                <a href="#<?php echo $value->trip_link_id; ?>" class="danger led_btn" title="<?php echo display('grandtotal'); ?>Expense" data-toggle="modal" data-target="#myModal">
                                    <i class="ace-icon fa fa-cogs bigger-130"></i>
                                </a>
                                &nbsp;&nbsp;							
                                <a class="purple" data-toggle="tooltip" title="<?php echo display('grandtotal'); ?>View" href="<?php echo base_url() . "trip_information/view_trip_by_trip_link_id/" . $value->trip_link_id; ?>">
                                    <i class="ace-icon fa fa-eye bigger-130"></i>
                                </a>&nbsp;&nbsp;
                                <?php if ($this->session->userdata('user_type') == 9) { ?>
                                    <a class="green" data-toggle="tooltip" title="<?php echo display('grandtotal'); ?>Edit" href="<?php echo base_url() . "trip_information/edit/" . $value->trip_id; ?>">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>&nbsp;&nbsp;
                                    <a class="red delete" data-toggle="tooltip" title="<?php echo display('grandtotal'); ?>Delete" href="<?php echo base_url() . "trip_information/delete/" . $value->trip_link_id; ?>">
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                    </a>
                                <?php } //ends of if condition ?>
                            </td>
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
            <div class="col-xs-12 no-print">
                <br/> 
                <a class="btn btn-sm btn-primary pull-right" onclick="printContent('PrintAreaExport')">
                    <span class="fa fa-print" ></span>&nbsp;&nbsp;<?php echo display('print'); ?>
                </a>    
            </div>
        <?php endif; ?>    
        <!-- ------------------------------------------
        ---------------ENDS OF EXPORT TRIP---------------
        ----------------------------------------------- -->







        <!-- ------------------------------------------
        -------------------IMPORT TRIP-------------------
        ----------------------------------------------- -->
        <?php if (!empty($import)): ?>
            <div id="PrintAreaImport"> 
                <table  id="trip_import" class="display compact cell-border" cellspacing="0" width="100%">
                    <thead>
                        <tr><th colspan="16"><h4><?php echo display('importtriplist'); ?></h4></th></tr>
                    <tr>
                        <th><?php echo display('slno'); ?></th>
                        <th><?php echo display('date'); ?></th>
                        <th><?php echo display('triplinkid'); ?></th>
                        <th><?php echo display('companyname'); ?></th>
                        <th><?php echo display('drivername'); ?></th>
                        <th><?php echo display('vehicleregistrationno'); ?></th>
                        <th><?php echo display('triptype'); ?></th>
                        <th><?php echo display('startpoint'); ?></th>
                        <th><?php echo display('endpoint'); ?></th>
                        <th><?php echo display('contactrent'); ?></th>
                        <th><?php echo display('farerent'); ?></th>
                        <th><?php echo display('profit'); ?></th>
                        <th><?php echo display('advance'); ?></th>
                        <th><?php echo display('expense'); ?></th>
                        <th><?php echo display('balance'); ?></th>
                        <th class="no-print"><?php echo display('action'); ?></th>
                    </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th colspan="9" class="text-right"><?php echo display('grandtotal'); ?> : </th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>

                    <tbody>
                        <?php
                        if (!empty($import)) {
                            $count = 0;
                            $count1 = 0;
                            $count2 = 1;
                            foreach ($import as $value) {
                                // **************************************************************
                                // ************** STARTS OF DOUBBLE TRIP  ***********************
                                // **************************************************************   
                                echo "<tr ";
                                for ($i = 0; $i != count($doubble_trip); $i++) {
                                    if ($doubble_trip[$i] == $value->trip_link_id) {
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
                                    '1' => display('ownsingle'),
                                    '2' => display('owndouble'),
                                    '3' => display('hiresingle'),
                                    '4' => display('hiredouble'),
                                    '5' => display('rentsingle'),
                                    '6' => display('rentdouble')
                                );
                                echo $trip_type[$value->trip_type];
                                #ends of showing trip type
                                ?> 
                            </td> 
                            <td><?php echo $value->start_point; ?></td>
                            <td><?php echo $value->end_point; ?></td>
                            <td><?php echo $value->rent; ?></td>
                            <td><?php echo $value->fare_rent; ?></td>
                            <td><?php echo round($value->rent - $value->fare_rent, 2); ?></td>
                            <td><?php echo $value->advance; ?></td>
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
                                                // echo "<a href=\"#$value->trip_link_id\" class=\"no-print btn btn-sm btn-success led_btn\" data-toggle=\"modal\" data-target=\"#myModal\">$ex_amount->total</a>";
                                                echo "$total_expense";
                                            } else {
                                                $total_expense = round($ex_amount->total / 2, 2);
                                                // echo "<a href=\"#$value->trip_link_id\" class=\"no-print btn btn-sm btn-danger led_btn\" data-toggle=\"modal\" data-target=\"#myModal\"><i class='fa fa-arrow-down'></i></a>";
                                                echo "$total_expense";
                                            }
                                        } if (@$count_id[$needle] == 1) {
                                            $total_expense = round($ex_amount->total, 2);
                                            echo "$total_expense";
                                            // echo "<a href=\"#$value->trip_link_id\" class=\"btn btn-sm btn-success led_btn\" data-toggle=\"modal\" data-target=\"#myModal\">$total_expense</a>";
                                        }
                                    } else {
                                        @$total_expense = round($ex_amount->total, 2);
                                        echo "$total_expense";
                                        // echo "<a href=\"#$value->trip_link_id\" class=\"btn btn-sm btn-success led_btn\" data-toggle=\"modal\" data-target=\"#myModal\">$total_expense</a>";
                                    }else:
                                    echo $total_expense = 0.00;
                                endif;
                                ?> 
                            </td>
                            <td><?php echo round($value->fare_rent - $total_expense, 2); ?></td>

                            <td class="no-print"> 
                                <a href="#<?php echo $value->trip_link_id; ?>" class="danger led_btn" title="<?php echo display('grandtotal'); ?>Expense" data-toggle="modal" data-target="#myModal">
                                    <i class="ace-icon fa fa-cogs bigger-130"></i>
                                </a>
                                &nbsp;&nbsp;                            
                                <a class="purple" data-toggle="tooltip" title="<?php echo display('grandtotal'); ?>View" href="<?php echo base_url() . "trip_information/view_trip_by_trip_link_id/" . $value->trip_link_id; ?>">
                                    <i class="ace-icon fa fa-eye bigger-130"></i>
                                </a>&nbsp;&nbsp;
                                <?php if ($this->session->userdata('user_type') == 9) { ?>
                                    <a class="green" data-toggle="tooltip" title="<?php echo display('grandtotal'); ?>Edit" href="<?php echo base_url() . "trip_information/edit/" . $value->trip_id; ?>">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>&nbsp;&nbsp;
                                    <a class="red delete" data-toggle="tooltip" title="<?php echo display('grandtotal'); ?>Delete" href="<?php echo base_url() . "trip_information/delete/" . $value->trip_link_id; ?>">
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                    </a>
                                <?php } //ends of if condition ?>
                            </td>
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
            <div class="col-xs-12 no-print">
                <br/> 
                <a class="btn btn-sm btn-primary pull-right" onclick="printContent('PrintAreaImport')">
                    <span class="fa fa-print" ></span>&nbsp;&nbsp;<?php echo display('grandtotal'); ?>Print
                </a>    
            </div>
        <?php endif; ?>
        <!-- ------------------------------------------
        ---------------ENDS OF IMPORT TRIP---------------
        ----------------------------------------------- -->








        <!-- ------------------------------------------
        -------------------IMPORT & EXPORT TRIP-------------------
        ----------------------------------------------- -->
        <?php if (!empty($export_import)): ?>
            <div id="PrintAreaExportImport"> 
                <table  id="trip_information" class="display compact cell-border" cellspacing="0" width="100%">
                    <thead>
                        <tr><th colspan="16"><h4>Export & Import List</h4></th></tr>
                    <tr>
                        <th><?php echo display('slno'); ?></th>
                        <th><?php echo display('date'); ?></th>
                        <th><?php echo display('triplinkid'); ?></th>
                        <th><?php echo display('companyname'); ?></th>
                        <th><?php echo display('drivername'); ?></th>
                        <th><?php echo display('vehicleregistrationno'); ?></th>
                        <th><?php echo display('triptype'); ?></th>
                        <th><?php echo display('startpoint'); ?></th>
                        <th><?php echo display('endpoint'); ?></th>
                        <th><?php echo display('contactrent'); ?></th>
                        <th><?php echo display('farerent'); ?></th>
                        <th><?php echo display('profit'); ?></th>
                        <th><?php echo display('advance'); ?></th>
                        <th><?php echo display('expense'); ?></th>
                        <th><?php echo display('balance'); ?></th>
                        <th class="no-print"><?php echo display('action'); ?></th>
                    </tr>
                    </thead>

                    <tfoot>
                        <tr>
                            <th colspan="9" class="text-right"><?php echo display('grandtotal'); ?> : </th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th> 
                            <th></th> 
                        </tr>
                    </tfoot>

                    <tbody>
                        <?php
                        if (!empty($export_import)) {
                            $count = 0;
                            $count1 = 0;
                            $count2 = 1;
                            foreach ($export_import as $value) {
                                // **************************************************************
                                // ************** STARTS OF DOUBBLE TRIP  ***********************
                                // **************************************************************   
                                echo "<tr ";
                                for ($i = 0; $i != count($doubble_trip); $i++) {
                                    if ($doubble_trip[$i] == $value->trip_link_id) {
                                        echo "style=\"font-weight:normal\" ";
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
                                    '1' => display('ownsingle'),
                                    '2' => display('owndouble'),
                                    '3' => display('hiresingle'),
                                    '4' => display('hiredouble'),
                                    '5' => display('rentsingle'),
                                    '6' => display('rentdouble')
                                );
                                echo $trip_type[$value->trip_type];
                                #ends of showing trip type
                                ?> 
                            </td> 
                            <td><?php echo $value->start_point; ?></td>
                            <td><?php echo $value->end_point; ?></td>
                            <td><?php echo $value->rent; ?></td>
                            <td><?php echo $value->fare_rent; ?></td>
                            <td><?php echo round($value->rent - $value->fare_rent, 2); ?></td>
                            <td><?php echo $value->advance; ?></td>
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
                                                // echo "<a href=\"#$value->trip_link_id\" class=\"no-print btn btn-sm btn-success led_btn\" data-toggle=\"modal\" data-target=\"#myModal\">$ex_amount->total</a>";
                                                echo "$total_expense";
                                            } else {
                                                $total_expense = round($ex_amount->total / 2, 2);
                                                // echo "<a href=\"#$value->trip_link_id\" class=\"no-print btn btn-sm btn-danger led_btn\" data-toggle=\"modal\" data-target=\"#myModal\"><i class='fa fa-arrow-down'></i></a>";
                                                echo "$total_expense";
                                            }
                                        } if (@$count_id[$needle] == 1) {
                                            $total_expense = round($ex_amount->total, 2);
                                            echo "$total_expense";
                                            // echo "<a href=\"#$value->trip_link_id\" class=\"btn btn-sm btn-success led_btn\" data-toggle=\"modal\" data-target=\"#myModal\">$total_expense</a>";
                                        }
                                    } else {
                                        @$total_expense = round($ex_amount->total, 2);
                                        echo "$total_expense";
                                        // echo "<a href=\"#$value->trip_link_id\" class=\"btn btn-sm btn-success led_btn\" data-toggle=\"modal\" data-target=\"#myModal\">$total_expense</a>";
                                    }
                                else:
                                    echo "0.00";
                                endif;
                                ?> 
                            </td>
                            <td><?php echo round($value->fare_rent - $total_expense, 2); ?></td>

                            <td class="no-print"> 
                                <a href="#<?php echo $value->trip_link_id; ?>" class="danger led_btn" title="<?php echo display('expense"'); ?> data-toggle="modal" data-target="#myModal">
                                    <i class="ace-icon fa fa-cogs bigger-130"></i>
                                </a>
                                &nbsp;&nbsp;                            
                                <a class="purple" data-toggle="tooltip" title="<?php echo display('view'); ?>" href="<?php echo base_url() . "trip_information/view_trip_by_trip_link_id/" . $value->trip_link_id; ?>">
                                    <i class="ace-icon fa fa-eye bigger-130"></i>
                                </a>&nbsp;&nbsp;
                                <?php if ($this->session->userdata('user_type') == 9) { ?>
                                    <a class="green" data-toggle="tooltip" title="<?php echo display('edit'); ?>" href="<?php echo base_url() . "trip_information/edit/" . $value->trip_id; ?>">
                                        <i class="ace-icon fa fa-pencil bigger-130"></i>
                                    </a>&nbsp;&nbsp;
                                    <a class="red delete" data-toggle="tooltip" title="<?php echo display('delete'); ?>" href="<?php echo base_url() . "trip_information/delete/" . $value->trip_link_id; ?>">
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                    </a>
                                <?php } //ends of if condition ?>
                            </td>
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
            <div class="col-xs-12 no-print">
                <br/> 
                <a class="btn btn-sm btn-primary pull-right" onclick="printContent('PrintAreaExportImport')">
                    <span class="fa fa-print" ></span>&nbsp;&nbsp;<?php echo display('print'); ?>
                </a>    
            </div>
        <?php endif; ?>
        <!-- ------------------------------------------
        ---------------ENDS OF IMPORT & EXPORT TRIP---------------
        ----------------------------------------------- -->







    </div><!-- /.col -->

    <!--<div class="col-xs-12 no-print">-->
    <!--    <br/> -->
    <!--    <a class="btn btn-sm btn-primary pull-left" onclick="printContent('PrintArea')">-->
    <!--        <span class="fa fa-print" ></span>&nbsp;&nbsp;<?php display('printall'); ?>-->
    <!--    </a>    -->
    <!--</div>-->

</div><!-- /.row -->
<!-- PAGE CONTENT ENDS -->



<!-- ************************MODAL************************ --> 


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo display('tripexpense'); ?></h4></div>
            <div class="modal-body"> 
                <table  class="table table-striped table-bordered table-hover">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" onclick="printContent('myModal')">
                    <span class="fa fa-print" ></span>&nbsp;&nbsp;<?php echo display('print'); ?>
                </button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><?php echo display('close'); ?></button>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">

    $(document).ready(function () {
        /*----------------------------------------
         ---------------EXPORT----------------
         ----------------------------------------*/
        $('#trip_export').DataTable({
            // "language": {
            //     "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Bangla.json"
            // }, 
            paging: false,
            searching: false,
            bInfo: false,
            "lengthMenu": [[-1], ["All"]],
            "createdRow": function (row) {
                $('td', row).eq(2).addClass('red');
            },
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };

                //#----------- Total over this page------------------#
                rentTotal = api.column(9, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                rentFareTotal = api.column(10, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                profitTotal = api.column(11, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                advancedTotal = api.column(12, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                expenseTotal = api.column(13, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                balanceTotal = api.column(14, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                //#-----------ends of Total over this page------------------#
                // Update footer
                $(api.column(9).footer()).html(rentTotal.toFixed(2));
                $(api.column(10).footer()).html(rentFareTotal.toFixed(2));
                $(api.column(11).footer()).html(profitTotal.toFixed(2));
                $(api.column(12).footer()).html(advancedTotal.toFixed(2));
                $(api.column(13).footer()).html(expenseTotal.toFixed(2));
                $(api.column(14).footer()).html(balanceTotal.toFixed(2));

            }
        });
        /*----------------------------------------
         ---------------EXPORT----------------
         ----------------------------------------*/
        $('#trip_import').DataTable({
            // "language": {
            //     "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Bangla.json"
            // }, 
            paging: false,
            searching: false,
            bInfo: false,
            "lengthMenu": [[15, 50, 100, -1], [15, 50, 100, "All"]],
            "createdRow": function (row) {
                $('td', row).eq(2).addClass('red');
            },
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };
                //#----------- Total over this page------------------#
                rentTotal = api.column(9, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                rentFareTotal = api.column(10, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                profitTotal = api.column(11, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                advancedTotal = api.column(12, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                expenseTotal = api.column(13, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                balanceTotal = api.column(14, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                //#-----------ends of Total over this page------------------#
                // Update footer
                $(api.column(9).footer()).html(rentTotal.toFixed(2));
                $(api.column(10).footer()).html(rentFareTotal.toFixed(2));
                $(api.column(11).footer()).html(profitTotal.toFixed(2));
                $(api.column(12).footer()).html(advancedTotal.toFixed(2));
                $(api.column(13).footer()).html(expenseTotal.toFixed(2));
                $(api.column(14).footer()).html(balanceTotal.toFixed(2));
            }
        });
        /*----------------------------------------
         ---------------EXPORT----------------
         ----------------------------------------*/
        $('#trip_information').DataTable({
            // "language": {
            //     "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Bangla.json"
            // }, 
            paging: false,
            searching: false,
            bInfo: false,
            "lengthMenu": [[15, 50, 100, -1], [15, 50, 100, "All"]],
            "createdRow": function (row) {
                $('td', row).eq(2).addClass('red');
            },
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };
                //#----------- Total over this page------------------#
                rentTotal = api.column(9, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                rentFareTotal = api.column(10, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                profitTotal = api.column(11, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                advancedTotal = api.column(12, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                expenseTotal = api.column(13, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                balanceTotal = api.column(14, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                //#-----------ends of Total over this page------------------#
                // Update footer
                $(api.column(9).footer()).html(rentTotal.toFixed(2));
                $(api.column(10).footer()).html(rentFareTotal.toFixed(2));
                $(api.column(11).footer()).html(profitTotal.toFixed(2));
                $(api.column(12).footer()).html(advancedTotal.toFixed(2));
                $(api.column(13).footer()).html(expenseTotal.toFixed(2));
                $(api.column(14).footer()).html(balanceTotal.toFixed(2));
            }
        });
    });


    $(".led_btn").click(function () {
        var url = $(this).attr("href");
        var href = url.split("#");
        jquery_ajax('ajax_query', 'get_local_expense', href[1], "#local_expense_list");
    });

</script>