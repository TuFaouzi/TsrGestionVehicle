<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-body">  
                <div class="table-header">
                    <i class="fa fa-list"></i>
                    <?php echo display('vehicleinformation'); ?> 
                    <div class="pull-right btn btn-info">
                        <i class="fa fa-plus "></i>
                        <a style="color:white" href="<?php echo base_url(); ?>vehicle/vehicle_information_create"><?php echo display('addvehicle') ?></a>
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
                                    <?php echo display('modelno'); ?>
                                </th>
                                <th>
                                    <?php echo display('registrationnumber'); ?>
                                </th>

                                <th>
                                    <?php echo display('chassisno'); ?>
                                </th>
                                <th>
                                    <?php echo display('engineno'); ?>
                                </th>
                                <th>
                                    <?php echo display('vehicletype'); ?>
                                </th>		
                                <th>
                                    <?php echo display('owner'); ?>
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
                            $v_owner_arry = array(0 => 'Hire', 1 => 'Own');
                            if (!empty($vehicle_infos)) {
                                $count = 0;
                                foreach ($vehicle_infos as $vehicle_info) {
                                    $owner = $v_owner_arry[$vehicle_info->v_owner]
                                    ?>
                                    <tr>
                                        <td class="center"><?php echo $count + 1; ?></td>
                                        <td><?php echo $vehicle_info->v_model_no; ?></td>
                                        <td><?php echo $vehicle_info->v_registration_no; ?></td>
                                        <td><?php echo $vehicle_info->v_chassis_no; ?></td>
                                        <td><?php echo $vehicle_info->v_engine_no; ?></td>
                                        <td><?php echo $vehicle_info->v; ?></td>
                                        <td><?php echo $owner; ?></td>
                                        <td><?php
                                            if ($vehicle_info->active == 1)
                                                echo display('active');
                                            else
                                                echo display('inactive');
                                            ?></td>

                                           <?php if ($this->session->userdata('user_type') == 9) { ?>
                                            <td class="no-print">
                                                <a class="green " data-toggle="tooltip" title="<?php echo display('edit'); ?>" href="<?php echo base_url() . "vehicle/vehicle_info_edit/" . $vehicle_info->v_id; ?>">
                                                    <i class="ace-icon fa fa-pencil bigger-130 "></i>
                                                </a>&nbsp;&nbsp;
                                                <a class="red delete" data-toggle="tooltip" title="<?php echo display('delete'); ?>" href="<?php echo base_url() . "vehicle/vehicle_info_delete/" . $vehicle_info->v_id; ?>">
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