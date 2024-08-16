<div class="row">
    <div class="col-xs-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-body">  
                <div class="table-header">
                    <i class="fa fa-list"></i>
                    <?php echo display('driverinformation'); ?> 
                    <div class="pull-right btn btn-info">
                        <i class="fa fa-plus "></i>
                        <a style="color:white" href="<?php echo base_url(); ?>driver_info/create"><?php echo display('adddriver') ?></a>
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
                    <table id="dataTableExample2" class="display compact cell-border" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                        <th>
                            <?php echo display('sl'); ?>
                        </th>
                        <th>
                            <?php echo display('drivername'); ?>
                        </th>
                        <th>
                            <?php echo display('mobilenumber'); ?>
                        </th>
                        <th>
                            <?php echo display('vehicleregistrationno'); ?>
                        </th>
                        <th>
                            <?php echo display('licensenumber'); ?>
                        </th>
                        <th>
                            <?php echo display('licenseexpiredate'); ?>
                        </th> 
                        <th>
                            <?php echo display('nid'); ?>
                        </th> 
                        <th>
                            <?php echo display('presentaddress'); ?>
                        </th>
                        <th>
                            <?php echo display('permanentaddress'); ?>
                        </th>

                        <th>
                            <?php echo display('joiningdate'); ?>
                        </th> 
                        <th>
                            <?php echo display('driverpicture'); ?>
                        </th>
                        <th>
                            <?php echo display('status'); ?>
                        </th>

                        <th class="no-print"><?php echo display('action'); ?></th>
                    </tr>
                        </thead>
                        <tbody>
                    <?php
                    if (!empty($informations)) {
                        $count = 1;
                        foreach ($informations as $information) {
                            ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $information->driver_name; ?></td>
                                <td><?php echo $information->d_mobile; ?></td>
                                <td><?php echo $information->v_reg; ?></td>
                                <td><?php echo $information->d_license_no; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($information->d_license_expire_date)); ?></td>
                                <td><?php echo $information->d_nid; ?></td>
                                <td><?php echo $information->d_address_present; ?></td>
                                <td><?php echo $information->d_address_permanent; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($information->d_join_date)); ?></td>
                                <td><img src="<?php echo base_url() . '/assets/driver/' . $information->d_picture; ?>" width="80" height="80"/></td>
                                <td><?php
                                    if ($information->active == 1)
                                        echo display('active');
                                    else
                                        echo display('inactive');;
                                    ?></td>

                                <td class="no-print">
                                    <a class="green" data-toggle="tooltip" title="<?php echo display('view'); ?>" href="<?php echo base_url() . "driver_info/driver_by_id/" . $information->driver_id; ?>">
                                        <i class="ace-icon fa fa-eye bigger-130"></i>
                                    </a>&nbsp;&nbsp;
        <?php if ($this->session->userdata('user_type') == 9) { ?>
                                        <a class="green" data-toggle="tooltip" title="<?php echo display('view'); ?>" href="<?php echo base_url() . "driver_info/edit/" . $information->driver_id; ?>">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>&nbsp;&nbsp;
                                        <a class="red delete" data-toggle="tooltip" title="<?php echo display('delete'); ?>"href="<?php echo base_url() . "driver_info/delete_info/" . $information->driver_id; ?>">
                                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                        </a>
        <?php } ?>	
                                </td>

                            </tr>
                            <?php
                            $count++;
                        }
                    }
                    ?>
                </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>