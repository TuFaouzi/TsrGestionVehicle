<div class="row">
<div class="col-sm-12">
    <div class="panel panel-bd lobidrag">
        <div class="panel-body">
            <div class="table-header">
                <i class="fa fa-list"></i>
                <?php echo display('fitnessinformation'); ?> 
                <div class="pull-right btn btn-info">
                    <i class="fa fa-plus "></i>
                   <a style="color:white" href="<?php echo base_url() . 'vehicle/vehicle_fitness_add'; ?>"><?php echo display('addvehiclefitness') ?></a>
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
                <table id="dataTableExample2" class="display compact cell-border" cellspacing="0"  width="100%">
                   <thead>
                        <tr>
                            <th><?php echo display('slno'); ?></th>
                            <th><?php echo display('vehicleregistrationno'); ?></th>
                            <th><?php echo display('regissue'); ?>	</th>
                            <th><?php echo display('reg_expire'); ?></th>
                            <th><?php echo display('fitnessissue'); ?></th>
                            <th><?php echo display('fitnessexpire'); ?></th>
                            <th><?php echo display('insuranceissue'); ?></th>
                            <th><?php echo display('insuranceexpire'); ?></th>
                            <th><?php echo display('taxissue'); ?></th>
                            <th><?php echo display('tax_expire'); ?></th>
                            <th><?php echo display('permitissue'); ?></th>
                            <th><?php echo display('permitexpire'); ?></th>
                           
                            <th><?php echo display('status'); ?></th>
                            <?php if ($this->session->userdata('user_type') == 9) { ?>
                                <th class="no-print"><?php echo display('action'); ?></th>
                            <?php } //ends of if condition?>
                        </tr>	
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($vehicle_fitnes)) {
                            $count = 0;
                            foreach ($vehicle_fitnes as $vehicle_fitne) {
                                ?>
                                <tr>
                                    <td class="center"><?php echo $count + 1; ?></td>
                                    <td><?php echo $vehicle_fitne->reg; ?></td>
                                    <td><?php echo date("d M Y", strtotime($vehicle_fitne->reg_issue)); ?></td>
                                    <td><?php echo date("d M Y", strtotime($vehicle_fitne->reg_expire)) ?></td>
                                    <td><?php echo date("d M Y", strtotime($vehicle_fitne->fitness_issue)) ?></td>
                                    <td><?php echo date("d M Y", strtotime($vehicle_fitne->fitness_expire)); ?></td>
                                    <td><?php echo date("d M Y", strtotime($vehicle_fitne->insurance_issue)); ?></td>
                                    <td><?php echo date("d M Y", strtotime($vehicle_fitne->insurance_expire)); ?></td>
                                    <td><?php echo date("d M Y", strtotime($vehicle_fitne->tax_issue)); ?></td>
                                    <td><?php echo date("d M Y", strtotime($vehicle_fitne->tax_expire)); ?></td>
                                    <td><?php echo date("d M Y", strtotime($vehicle_fitne->root_permit_issue)); ?></td>
                                    <td><?php echo date("d M Y", strtotime($vehicle_fitne->root_permit_expire)); ?></td>
                                    
                                    <td>
                                        <?php 
                                        if ($vehicle_fitne->active == 1)
                                          echo display('active');
                                        else
                                         echo display('inactive');
                                ?></td>

            <?php if ($this->session->userdata('user_type') == 9) { ?>
                                        <td class="no-print">
                                            <a class="green" data-toggle="tooltip" title="<?php echo display('edit')?>" href="<?php echo base_url() . "vehicle/vehicle_fitness_edit/" . $vehicle_fitne->v_fitness_id; ?>">
                                                <i class="ace-icon fa fa-pencil bigger-130"></i>
                                            </a>&nbsp;&nbsp;

                                            <a class="red delete" data-toggle="tooltip" title="<?php echo display('delete');?>"href="<?php echo base_url() . "vehicle/vehicle_fitness_delect/" . $vehicle_fitne->v_fitness_id; ?>">
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
