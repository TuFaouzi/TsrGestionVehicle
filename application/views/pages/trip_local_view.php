<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-body">  
                <div class="table-header">
                    <i class="fa fa-list"></i>
                    <?php echo display('localtripinformation'); ?> 
                </div>
                <hr>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                        <table id="dataTableExample3" class="display compact cell-border" cellspacing="0" width="100%">

                        <thead>
                            <tr>
                                <th><?php echo display('slno'); ?></th>
                                <th><?php echo display('date'); ?></th>
                                <th><?php  display('triplinkid'); ?></th>
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
                                <th colspan="16" class="text-right"></th>   
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            if (!empty($trip)) {
                                $count = 0;
                                foreach ($trip as $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $count + 1; ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($value->date)); ?></td>
                                        <td><?php $value->trip_link_id; ?></td>
                                        <td><?php echo (!empty($value->company_name)) ? $value->company_name : "<span class=\"blue\" title=\"Non-contracted company\">$value->others_company</span>"; ?></td>
                                        <td><?php echo (!empty($value->driver_name)) ? $value->driver_name : "---"; ?></td>
                                        <td><?php echo (!empty($value->hire_v_id)) ? "<span class=\"blue\" title=\"Hired vehicle\">$value->hire_v_id</span>" : $value->v_registration_no; ?></td>
                                        <td>
                                            <?php
                                            if ($value->trip_type == 1) {
                                                echo "Own Single";
                                            } elseif ($value->trip_type == 2) {
                                                echo "Own Double";
                                            } elseif ($value->trip_type == 3) {
                                                echo "Hire Single";
                                            } elseif ($value->trip_type == 4) {
                                                echo "Rent Single";
                                            } elseif ($value->trip_type == 5) {
                                                echo "Rent Single";
                                            } elseif ($value->trip_type == 6) {
                                                echo "Rent Double";
                                            }
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
                                        if (!empty($ex_amount->total))
                                            echo $total_expense = round($ex_amount->total, 2);
                                        else
                                            echo $total_expense = "0.00";
                                        ?>
                                        </td>
                                        <td><?php echo round($value->fare_rent - $total_expense, 2); ?></td>
                                        <td class="no-print"> 
                                            <a href="#<?php echo $value->trip_link_id; ?>" class="danger led_btn" title="<?php echo display('expense')?>" data-toggle="modal" data-target="#myModal">
                                                <i class="ace-icon fa fa-cogs bigger-130"></i>
                                            </a>
                                            &nbsp;&nbsp;
                                            <a class="purple" data-toggle="tooltip" title="<?php echo display('view')?>" href="<?php echo base_url() . "trip_local/view_trip_by_trip_link_id/" . $value->trip_link_id; ?>">
                                                <i class="ace-icon fa fa-eye bigger-130"></i>
                                            </a>&nbsp;&nbsp;
                                           <?php if ($this->session->userdata('user_type') == 9) { ?>
                                                <a class="green" data-toggle="tooltip" title="<?php echo display('edit')?>" href="<?php echo base_url() . "trip_local/edit/" . $value->trip_id; ?>">
                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                </a>&nbsp;&nbsp;
                                                <a class="red delete" data-toggle="tooltip" title="<?php echo display('delete')?>" href="<?php echo base_url() . "trip_local/delete/" . $value->trip_link_id; ?>">
                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                </a>
                                            <?php } //ends of if condition  ?>
                                        </td> 
                                    </tr>
                                        <?php
                                            $count++;
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



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo display('triptexpense');?></h4></div>
            <div class="modal-body"> 
                <table id="" class="table table-striped table-bordered table-hover">
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
                    <span class="fa fa-print" ></span>&nbsp;&nbsp;<?php echo display('print');?>
                </button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><?php echo display('close');?></button>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">

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
             "createdRow": function (row) {
                $('td', row).eq(2).addClass('red2');
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
                $(api.column(14).footer()).html(
                        '<p>Total Contact Rent : ' + rentTotal.toFixed(2) +
                        '<br/>' +
                        'Total Fare Rent : ' + rentFareTotal.toFixed(2) +
                        '<br/>' +
                        'Total Profit : ' + profitTotal.toFixed(2) +
                        '<br/>' +
                        'Total Advanced : ' + advancedTotal.toFixed(2) +
                        '<br/>' +
                        'Total Expense : ' + expenseTotal.toFixed(2) +
                        '<br/>' +
                        'Total Balance : ' + balanceTotal.toFixed(2) +
                        '<p/>'
                        );
              }
        });
    });


    $(".led_btn").click(function () {
        var url = $(this).attr("href");
        var href = url.split("#");
        jquery_ajax('ajax_query', 'get_local_expense', href[1], "#local_expense_list");
    });

</script>