<div class="col-sm-12">
    <div class="panel panel-bd lobidrag">
        <div class="panel-heading">
            <div class="panel-title">
                <h4><?php echo display('editprofile') ?></h4>
            </div>
        </div>
        <?php
        if ($this->session->flashdata('success')) {
            echo "<div class=\"alert alert-success\" role=\"alert\">" . $this->session->flashdata('success') . "</div>";
        }
        ?> 
        <?php echo form_open('admin/user_edit/'); ?>

        <div class="panel-body">           
            <div class="form-group row">
                <label for="fullname" class="col-sm-3 col-form-label"><?php echo display('fullname') ?></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" value="<?php echo $user_info->fullname; ?>" name="fullname" id="fullname" placeholder="<?php echo display('fullname') ?>">
                    <p class="help-block text-danger"><?php echo form_error('fullname'); ?></p>
                </div>
            </div>
            <div class="form-group row">
                <label for="Title" class="col-sm-3 col-form-label"><?php echo display('username') ?></label>
                <div class="col-sm-9">
                    <input type="text" name="username" class="form-control" id="username" placeholder="<?php echo display('username') ?>">
                    <p class="help-block text-danger"><?php echo form_error('username'); ?></p>
                </div>
            </div>
            <div class="form-group row">
                <label for="old_password" class="col-sm-3 col-form-label"><?php echo display('oldpassword') ?></label>
                <div class="col-sm-9">
                    <input type="password" name="old_password" class="form-control" id="old_password" placeholder="<?php echo display('oldpassword') ?>">
                    <p class="help-block text-danger"><?php echo form_error('old_password'); ?></p>
                </div>
            </div>
            <div class="form-group row">
                <label for="new_password" class="col-sm-3 col-form-label"><?php echo display('newpassword') ?></label>
                <div class="col-sm-9">
                    <input type="password" name="new_password" class="form-control" id="new_password" placeholder="<?php echo display('newpassword') ?>">
                    <p class="help-block text-danger"><?php echo form_error('new_assword'); ?></p>
                </div>
            </div>
            <div class="form-group row">
                <label for="re_password" class="col-sm-3 col-form-label"><?php echo display('repeatpassword') ?></label>
                <div class="col-sm-9">
                    <input type="password" name="re_password" class="form-control" id="re_password" placeholder="<?php echo display('repeatpassword') ?>">
                    <p class="help-block text-danger"><?php echo form_error('re_password'); ?></p>
                </div>
            </div>

            <div class="form-group row" style="margin-left: 46%;">
                <a class="btn btn-danger w-md m-b-5"><?php echo display('cancel'); ?></a>
                <button type="submit"  class="btn btn-primary w-md m-b-5"><i class="fa fa-plus"></i><?php echo display('update') ?> </button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

