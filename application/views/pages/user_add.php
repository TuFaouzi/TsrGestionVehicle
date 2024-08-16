<div class="col-sm-12">
    <div class="panel panel-bd lobidrag">
        <div class="panel-body">  
        <div class="panel-heading">
            <div class="panel-title">
                <h4><?php echo display('adduser') ?></h4>
            </div>
            <hr>
        </div>
        <?php echo form_open('admin/user_add/'); ?>
        <?php
        $this->session->userdata('isLogin');
        ?>  
        <div class="panel-body">           
            <div class="form-group row">
                <label for="fullname" class="col-sm-3 col-form-label"><?php echo display('fullname');?></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="fullname" id="fullname" placeholder="<?php echo display('fullname');?>">
                    <p class="help-block text-danger"><?php echo form_error('fullname'); ?></p>
                </div>
            </div>
            <div class="form-group row">
                <label for="Title" class="col-sm-3 col-form-label"><?php echo display('username');?></label>
                <div class="col-sm-9">
                    <input type="text" name="username" class="form-control" id="username" placeholder="<?php echo display('username');?>">
                    <p class="help-block text-danger"><?php echo form_error('username'); ?></p>
                </div>
            </div>
            <div class="form-group row">
                <label for="Title" class="col-sm-3 col-form-label"><?php echo display('password');?></label>
                <div class="col-sm-9">
                    <input type="password" name="password" class="form-control" id="password" placeholder="<?php echo display('password');?>">
                    <p class="help-block text-danger"><?php echo form_error('password'); ?></p>
                </div>
            </div>
            <div class="form-group row">
                <label for="Title" class="col-sm-3 col-form-label"><?php echo display('repeatpassword');?></label>
                <div class="col-sm-9">
                    <input type="password" name="re_password" class="form-control" id="re_password" placeholder="<?php echo display('repeatpassword');?>">
                    <p class="help-block text-danger"><?php echo form_error('re_password'); ?></p>
                </div>
            </div> 
            <div class="form-group row">
                <label for="Title" class="col-sm-3 col-form-label"><?php echo display('usertype');?></label>
                <div class="col-sm-9">
                    <select name="type" class="form-control testselect1" id="type">
                        <option value=""><?php echo  display('selecttype');?></option>
                        <option value="9"><?php echo display('admin');?></option>
                        <option value="1"><?php echo display('operator');?></option>
                    </select> 
                </div>
                <p class="help-block text-danger"><?php echo form_error('type'); ?></p>
            </div> 
            <div class="form-group row">
                <div class="col-md-offset-1 col-md-9" style="margin-left: 40%;">
                    <button class="btn btn-danger w-md m-b-5"><?php echo display('cancel'); ?></button>
                    <button  type="submit"  class="btn btn-primary w-md m-b-5"><i class="fa fa-plus"></i> <?php echo display('save'); ?></button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

