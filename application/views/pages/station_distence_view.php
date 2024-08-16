<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-body">  
                <div class="table-header">
                    <i class="fa fa-list"></i>
                    <?php echo display('stationtostationdistanceinformation'); ?> 
                    <div class="pull-right btn btn-info">
                        <i class="fa fa-plus "></i>
                        <a style="color:white" href="<?php echo base_url(); ?>station_distence/station_distence_create"><?php echo display('addstationdistense')?></a>
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
                            <?php echo display('startpoint'); ?>
                        </th>

                        <th>
                            <?php echo display('endpoint'); ?>
                        </th>
                        <th>
                            <?php echo display('distense'); ?>
                        </th>
                        <th>
                            <?php echo display('measurementscale'); ?>
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
                    $measurement_scale = array(1 => display('kilometers'), 2 => display('miles'));
                    if (!empty($distance_values)) {
                        $count = 0;
                        foreach ($distance_values as $value) {
                            $result = $measurement_scale[$value->measurement_scale]
                            ?>
                            <tr>
                                <td><?php echo $count + 1; ?></td>
                                <td><?php echo $value->start_point; ?></td>
                                <td><?php echo $value->end_point; ?></td>
                                <td><?php echo $value->distance; ?></td>
                                <td><?php echo $result; ?></td>
                                <td><?php if ($value->active == 1)
                        echo display('active');
                    else
                        echo display('inactive');
                            ?></td>

                    <?php if ($this->session->userdata('user_type') == 9) { ?>
                                    <td class="no-print">
                                        <a class="green" data-toggle="tooltip" title="<?php echo display('edit'); ?>" href="<?php echo base_url() . "station_distence/station_distence_edit/" . $value->distance_id; ?>">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i> 
                                        </a>&nbsp;&nbsp;
                                        <a class="red delete" data-toggle="tooltip" title="<?php echo display('delete'); ?>" href="<?php echo base_url() . "station_distence/station_distence_delete/" . $value->distance_id; ?>">
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
