<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-body">
            <div class="table-header">
                <i class="fa fa-list"></i>
                <?php echo display('companylist'); ?> 
                <div class="pull-right btn btn-info">
                    <i class="fa fa-plus "></i>
                   <a style="color:white" href="<?php echo base_url(); ?>company/create"><?php echo display('addcompany') ?></a>
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
                                <th style="align:center;">
                                    <?php echo display('slno'); ?>
                                </th>

                                <th>
                                    <?php echo display('companyname'); ?>
                                </th>
                                <th>
                                    <?php echo display('componyaddress'); ?>
                                </th> 

                                <th>
                                    <?php echo display('cellnumber'); ?>
                                </th>
                                <th>
                                    <?php echo display('email'); ?>
                                </th>
                                <th>
                                    <?php echo display('companyweb'); ?>
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
                            if (!empty($companys)) {
                                $count = 0;
                                foreach ($companys as $company) {
                                    ?>
                                    <tr>
                                        <td class="center"><?php echo $count + 1; ?></td>
                                        <td><?php echo $company->company_name; ?></td>
                                        <td><?php echo $company->company_address; ?></td>
                                        <td><?php echo $company->company_cell; ?></td>
                                        <td><?php echo $company->company_email; ?></td>
                                        <td><?php echo $company->company_web; ?></td>
                                        <td><?php if ($company->active == 1)
                                echo display('active');
                            else
                                 echo display('inactive');
                                    ?></td>

                <?php if ($this->session->userdata('user_type') == 9) { ?>
                                            <td class="no-print">
                                                <a class="green" data-toggle="tooltip" title="<?php echo display('edit'); ?>" href="<?php echo base_url() . "company/edit_company/" . $company->company_id; ?>">
                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                </a>&nbsp;&nbsp;
                                                <a class="red delete" data-toggle="tooltip" title="<?php echo display('delete'); ?>"href="<?php echo base_url() . "company/delete_company/" . $company->company_id; ?>">
                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                </a>
                                            </td> 
                                    <?php } //ends of user type check ?>

                                    </tr>
                                    <?php
                                    $count++;
                                }//foreach
                            } else {
                                echo '<tr>';
                                echo '<td colspan="7">' . display("nodatafound") . '</td>';
                                echo '</tr>';
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>