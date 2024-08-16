<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="table-header">    
                <div class="panel-heading">
                    <i class="fa fa-list"></i>
                     <?php echo display('bankinformation'); ?> 
                   <div class="btn btn-info panel-title pull-right">      
                        <a class="white" href="<?php echo base_url() . "accounting/bank/create/" ?>">   
                            <strong><i class="fa fa-plus"></i>
                                <?php echo display('addbank'); ?></strong>
                        </a>
                   </div>
                </div>
                <hr>
            </div>
            <?php
                if ($this->session->flashdata('success')) {
                      echo "<div class=\"alert alert-success\" role=\"alert\">" . $this->session->flashdata('success') . "</div>";
                 }
                ?>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th><?php echo display('slno'); ?></th>
                                <th><?php echo display('bankname'); ?></th>
                                <th><?php echo display('branchname'); ?></th>
                                <th><?php echo display('accountnumber'); ?></th>
                                <th><?php echo display('openingcredit'); ?></th>
                                <th><?php echo display('status'); ?></th>
                                <?php if ($this->session->userdata('user_type') == 9): ?>
                                    <th class="no-print"><?php echo display('action'); ?></th>
                                <?php endif; //ends of if condition ?>
                            </tr>
                        </thead>
                        <tfoot>
                    <tr>
                        <th colspan="4" class="text-right"><?php echo display('grandtotal');?> :</th>
                        <th colspan="3"></th>
                    </tr>
                </tfoot>
                <tbody> 
                    <?php
                    if (!empty($banks)):
                        $searial = 1;
                        foreach ($banks as $value):
                            ?>
                            <tr>
                                <td><?php echo $searial++; ?></td>
                                <td><?php echo $value->bank_name; ?></td>
                                <td><?php echo $value->branch_name; ?></td>
                                <td><?php echo $value->account_number; ?></td>
                                <td><?php echo $value->opening_credit; ?></td>
                                
                                <td><?php echo ($value->status == 1) ? display('active') : display('inactive'); ?></td>
                                
                                <?php if ($this->session->userdata('user_type') == 9): ?>
                                    <td class="no-print">
                                        <a class="green" data-toggle="tooltip" title="<?php echo display('edit'); ?>" href="<?php echo base_url() . "accounting/bank/edit/" . $value->bank_id ?>">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>&nbsp;&nbsp; 
                                        <a class="red delete" data-toggle="tooltip" title="<?php echo display('delete'); ?>" href="<?php echo base_url() . "accounting/bank/delete/" . $value->bank_id ?>">
                                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                        </a>
                                    </td> 
                                <?php endif; //ends of if condition ?>
                            </tr> 
                            <?php
                        endforeach;
                    endif;
                    ?> 
                </tbody>
                    </table>
                </div>
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
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };

                //#----------- Total over this page------------------#
                grandTotal = api.column(4, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                //#-----------ends of Total over this page------------------#
                // Update footer
                $(api.column(5).footer()).html(
                        '<i class="fa fa-try"></i> ' + grandTotal
                        );
            }
        });
});
</script>