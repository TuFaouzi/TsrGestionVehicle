<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-body">  
            <div class="table-header">
                <i class="fa fa-list"></i>
                <?php echo display('vehicletypelist'); ?> 
                <div class="pull-right btn btn-info">
                    <i class="fa fa-plus "></i>
                    <a style="color:white" href="<?php echo base_url(); ?>vehicle/vehicle_type_create"><?php echo display('addvehicletype') ?></a>
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
                                    <?php echo display('vehicletype'); ?>
                                </th>
                                <th>
                                    <?php echo display('status'); ?>
                                </th>
                                <?php if ($this->session->userdata('user_type') == 9) { ?>
                                    <th class="no-print"><?php echo display('action'); ?></th>
                                <?php } //ends of if condition ?>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                    if (!empty($vehicle_types)) {
                        $count = 0;
                        foreach ($vehicle_types as $vehicle_type) {
                            ?>
                            <tr>
                                <td><?php echo $count + 1; ?></td>
                                <td><?php echo $vehicle_type->v_type; ?></td>
                                <td><?php
                    if ($vehicle_type->active == 1)
                        echo display('active');
                    else
                        echo display('inactive');
                            ?></td>

                                <?php
                                if ($this->session->userdata('user_type') == 9) {
                                    ?>
                                    <td class="no-print">
                                        <a class="green" data-toggle="tooltip" title="<?php echo display('edit'); ?>" href="<?php echo base_url() . "vehicle/vehicle_type_edit/" . $vehicle_type->v_type_id; ?>">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>&nbsp;&nbsp;
                                        <a class="red delete" data-toggle="tooltip" title="<?php echo display('delete'); ?>" href="<?php echo base_url() . "vehicle/vehicle_type_delete/" . $vehicle_type->v_type_id; ?>">
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

