<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-body">
                <div class="table-header">
                    <i class="fa fa-list"></i>
                    <?php echo display('expenselist'); ?> 
                    <div class="pull-right btn btn-info">
                        <i class="fa fa-plus "></i>
                       <a style="color:white" href="<?php echo base_url(); ?>expense_entry/create"><?php echo display('expenseentry') ?></a>
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
                    <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                        <thead>
                    <tr>
                        <th>
                            <?php echo display('slno'); ?>
                        </th>

                        <th>
                            <?php echo display('date'); ?>
                        </th>
                        <th> 
                            <?php echo display('vehicleregistrationno'); ?>
                        </th>	  
                        <th>
                            <?php echo display('expensegroup'); ?>
                        </th>       
                        <th>
                            <?php echo display('expensename'); ?>
                        </th>     
                        <th>
                            <?php echo display('expenseserial'); ?>
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

                        <?php if ($this->session->userdata('user_type') == 9) { ?>
                            <th class="no-print"><?php echo display('action'); ?></th>
                        <?php } //ends of if condition?>
                    </tr>
                </thead>
                 <tbody>
                    <?php
                    $v_owner_arry = array(1 => 'Regular', 2 => 'Maintenance', 3 => 'Others', 4 => 'Office', 5 => 'Garage');
                    if (!empty($expenses)) {
                        $count = 0;
                        foreach ($expenses as $expense) {
                            $type = $v_owner_arry[$expense->expense_group]
                            ?>
                            <tr>
                                <td><?php echo $count + 1; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($expense->date)); ?></td>
                                <td><?php echo $expense->v_registration_no; ?></td>
                                <td><?php echo $type; ?></td>
                                <td><?php echo $expense->expense_name; ?></td>
                                <td><?php echo $expense->expense_serial; ?></td>
                                <td><?php echo $expense->quantity; ?></td>
                                <td><?php echo $expense->amount; ?></td>
                                <td><?php echo $total_amount = $expense->quantity * $expense->amount; ?></td>

                                <?php if ($this->session->userdata('user_type') == 9) { ?>
                                    <td class="no-print">
                                        <a class="green " data-toggle="tooltip" title="<?php echo display('edit');?>" href="<?php echo base_url() . "expense_entry/expense_entry_edit/" . $expense->transection_id; ?>">
                                            <i class="ace-icon fa fa-pencil bigger-130 "></i>
                                        </a>&nbsp;&nbsp;
                                        <a class="red delete" data-toggle="tooltip" title="<?php echo display('delete');?>" href="<?php echo base_url() . "expense_entry/delete/" . $expense->transection_id; ?>">
                                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                        </a>
                                    </td>
                                <?php } //ends of if condition?>
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
