<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-body">
            <div class="table-header">
                <i class="fa fa-list"></i>
                <?php echo display('vehiclefuelrate'); ?> 
                <div class="pull-right btn btn-info">
                    <i class="fa fa-plus "></i>
                   <a style="color:white" href="<?php echo base_url().'fule_rate/create'; ?>"><?php echo display('addvehiclefuelrate') ?></a>
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
                            <?php echo display('registrationno'); ?>
                        </th>
                        <th>
                            <?php echo display('engineno'); ?>
                        </th>

                        <th>
                            <?php echo display('fuelperkilo'); ?>
                        </th>
                        <th>
                            <?php echo display('vehiclefuelrate'); ?>
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
                    if (!empty($rates)) {
                        $count = 0;
                        foreach ($rates as $rate) {
                            ?>
                            <tr>
                                <td class="center"><?php echo $count + 1; ?></td>
                                <td><?php echo $rate->v_model_no; ?></td>
                                <td><?php echo $rate->v_registration_no; ?></td>
                                <td><?php echo $rate->v_engine_no; ?></td>
                                <td><?php echo $rate->v_fuel_per_kilo_litter; ?></td>
                                <td><?php echo $rate->v_fuel_rate; ?></td>
                                <td><?php if ($rate->active == 1)
                        echo "Active";
                    else
                        echo "Inactive";
                            ?></td>

                         <?php if ($this->session->userdata('user_type') == 9) { ?>
                                    <td class="no-print">
                                        <a class="green" data-toggle="tooltip" title="<?php echo display('edit');?>" href="<?php echo base_url() . "fule_rate/rate_edit/" . $rate->v_fuel_id; ?>">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>&nbsp;&nbsp;
                                        <a class="red delete" data-toggle="tooltip" title="<?php echo display('delete');?>"href="<?php echo base_url() . "fule_rate/delete_rate/" . $rate->v_fuel_id; ?>">
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