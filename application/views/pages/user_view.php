<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <i class="fa fa-list"></i>
                    <?php echo display('viewuser'); ?> 
                </div>
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
                        <th><?php echo display('slno'); ?></th>
                        <th><?php echo display('fullname'); ?></th>
                        <th><?php echo display('username'); ?></th>
                        <th><?php echo display('lastlogin'); ?></th>
                        <th><?php echo display('status'); ?></th>
                        <?php if ($this->session->userdata('user_type') == 9){?>
                            <th><?php echo display('action'); ?></th>
                        <?php }?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($user_view)) {
                        $count = 1;
                        foreach ($user_view as $info) {
                            ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $info->fullname; ?></td>
                                <td><?php echo $info->username; ?></td>
                                <td><?php echo $info->last_log_date; ?></td>
                                <td><?php if ($info->active == 1)
                        echo "Active";
                    else
                        echo "Inactive";
                            ?></td>
                                    <?php if ($this->session->userdata('user_type') == 9) { ?>
                                    <td>
                                       <?php if ($info->type != 9) { ?>
                                            <?php if ($info->active == 0) { ?>
                                        <a title="<?php echo display('active');?>" href="<?php echo base_url() . "admin/active/" . $info->id; ?>">
                                                    <i class="green fa fa-check-circle bigger-130"></i>
                                                </a>
                                        <?php } ?>
                                            <?php if ($info->active == 1) { ?>
                                                <a title="<?php echo display('inactive');?>" href="<?php echo base_url() . "admin/inactive/" . $info->id; ?>">
                                                    <i class="red fa fa-times-circle bigger-130"></i>
                                                </a>
                                        <?php } ?>
                                            &nbsp;&nbsp;
                                            <a title="<?php echo display('delete');?>" href="<?php echo base_url() . "admin/user_delete/" . $info->id; ?>">
                                                <i class="red fa fa-trash-o bigger-130"></i>
                                            </a>
                                        <?php } else { ?>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-success"><?php echo display('superadmin');?></a>
                                       <?php }?>
                                    </td>
                            <?php }?>
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