<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-body">
                <div class="table-header">
                    <i class="fa fa-list"></i>
                    <?php echo display('expensetype'); ?> 
                    <div class="pull-right btn btn-info">
                        <i class="fa fa-plus "></i>
                       <a style="color:white" href="<?php echo base_url(); ?>expense_list/create"><?php echo display('addexpensetype') ?></a>
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
                            <?php echo display('expensegroup'); ?>
                        </th>   
                        <th>
                            <?php echo display('expensename'); ?>
                        </th>		

                        <th>
                            <?php echo display('status'); ?>
                        </th>
                        <?php if ($this->session->userdata('user_type') == 9) { ?>
                            <th class="no-print"><?php echo display('action'); ?></th>
                        <?php } //ends of if condition?>
                    </tr>
                </thead>
                  <tbody>
                    <?php
                    $v_owner_arry = array(1 => display('regular'), 2 => display('maintenance'), 3 => display('others'), 4 => display('office'), 5 => display('garage'));
                    if (!empty($expenses)) {
                        $count = 0;
                        foreach ($expenses as $expense) {
                            $type = $v_owner_arry[$expense->expense_group]
                            ?>
                            <tr>
                                <td><?php echo $count + 1; ?></td>
                                <td><?php echo $type; ?></td>
                                <td><?php echo $expense->expense_name; ?></td>
                                <td>
                                  <?php 
                                    if ($expense->active == 1) 
                                     echo display ('active');
                                    else 
                                     echo display ('inactive');
                                  ?>
                                </td>
                            <?php if ($this->session->userdata('user_type') == 9) { ?>
                                    <td class="no-print">
                                        <a class="green " data-toggle="tooltip" title="<?php echo display('edit');?>" href="<?php echo base_url() . "expense_list/expense_list_edit/" . $expense->expense_id; ?>">
                                            <i class="ace-icon fa fa-pencil bigger-130 "></i>
                                        </a>&nbsp;&nbsp;
                                        <a class="red delete" data-toggle="tooltip" title="<?php echo display('delete');?>" href="<?php echo base_url() . "expense_list/expense_list_delete/" . $expense->expense_id; ?>">
                                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                        </a>
                                    </td>
                            <?php } //ends of if condition ?>
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
