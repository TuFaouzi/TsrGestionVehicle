<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-body">
                <div class="table-header">
                    <i class="fa fa-list"></i>
                    <?php echo display('companyrentlist'); ?> 
                    <div class="pull-right btn btn-info">
                        <i class="fa fa-plus "></i>
                        <a style="color:white" href="<?php echo base_url(); ?>rent/create"><?php echo display('addcompanyrent') ?></a>
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
                                <th >
                                    <?php echo display('companyname'); ?>
                                </th>

                                <th>
                                    <?php echo display('vehicletype'); ?>
                                </th>
                                <th>
                                    <?php echo display('startpoint'); ?>
                                </th>

                                <th>
                                    <?php echo display('endpoint'); ?>
                                </th>

                                <th>
                                    <?php echo display('renttype'); ?>
                                </th>

                                <th>
                                    <?php echo display('rent'); ?>
                                </th>

                                <th>
                                    <?php echo display('vatstatus'); ?>
                                </th>

                                <th>
                                    <?php echo display('vat'); ?>
                                </th>

                                <th>
                                    <?php echo display('totalrent'); ?>
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
                            if (!empty($rents)) {
                                $count = 0;
                                foreach ($rents as $rent) {
                                    ?>
                                    <tr>
                                        <td class="center"><?php echo $count + 1; ?></td>
                                        <td><?php echo $rent->company_name; ?></td>
                                        <td><?php echo $rent->v_type; ?></td>
                                        <td><?php echo $rent->starting_st; ?></td>
                                        <td><?php echo $rent->ending_st; ?></td>
                                        <td><?php
                                            if ($rent->rent_type == 2) {
                                                echo "Export";
                                            } elseif ($rent->rent_type == 1) {
                                                echo "Import";
                                            } elseif ($rent->rent_type == 0) {
                                                echo "Local";
                                            }
                                            ?></td>
                                        <td><?php echo $rent->rent; ?></td>
                                        <td><?php
                                            if ($rent->vat_status == 0) {
                                                echo "Deactivate";
                                            } if ($rent->vat_status == 1) {
                                                echo "Included";
                                            } if ($rent->vat_status == 2) {
                                                echo "Excluded";
                                            }
                                            ?></td>
                                        <td><?php echo $rent->vat; ?></td>
                                        <td><?php
                                            #no vat include/excluede
                                            if ($rent->vat_status == 0) {
                                                $total_rent = $rent->rent;
                                            }
                                            #including vat
                                            if ($rent->vat_status == 1) {
                                                $vat = (($rent->vat / 100) * $rent->rent);
                                                $total_rent = $rent->rent + $vat;
                                            }
                                            #excluding vat
                                            if ($rent->vat_status == 2) {
                                                $vat = (($rent->vat / 100) * $rent->rent);
                                                $total_rent = $rent->rent - $vat;
                                            }
                                            echo $total_rent;
                                            ?></td>
                                        <td><?php
                                            if ($rent->active == 0)
                                                echo display('inactive');
                                            else
                                                echo display('active');
                                            ?></td>


        <?php if ($this->session->userdata('user_type') == 9) { ?>
                                            <td class="no-print">
                                                <a class="green" data-toggle="tooltip" title="<?php display('edit') ?>" href="<?php echo base_url() . "rent/edit_rent/" . $rent->company_rent_id; ?>">
                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                </a>&nbsp;&nbsp;
                                                <a class="red delete" data-toggle="tooltip" title="<?php echo display('delete'); ?>"href="<?php echo base_url() . "rent/delete_rent/" . $rent->company_rent_id; ?>">
                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                </a>
                                            </td>
        <?php } //ends of if condition  ?>

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
