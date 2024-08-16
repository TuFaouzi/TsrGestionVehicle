<div class="col-sm-12">
    <div class="panel panel-bd lobidrag">
        <div class="panel-heading">
            <div class="panel-title">
                <h4><?php
                    if (!empty($vehicle_infos->v_id)) {
                        echo display('vehicleinformationupdate');
                    } else {
                        echo display('vehicleinformationcreate');
                    }
                    ?>
                </h4>
            </div>
        </div>
        
      
        <form name="vehicle_information_form" class="form-horizontal" id="notice-submit" action="<?php echo base_url() . 'vehicle/vehicle_information_save'; ?>" method="post"> 
            <div class="panel-body">           
                <div class="form-group row">
                    <label for="v_registration_no" class="col-sm-3 col-form-label"><?php echo display('registrationnumber'); ?></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="v_registration_no" id="v_registration_no" placeholder="Vehicle Registration No" value="<?php echo set_value('v_registration_no', $vehicle_infos->v_registration_no); ?>">
                        <div class="help-block" id="title-exists"><?php echo form_error('v_registration_no'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="v_chassis_no" class="col-sm-3 col-form-label"><?php echo display('chassisno'); ?></label>
                    <div class="col-sm-9">
                        <input type="text" name="v_chassis_no" class="form-control" id="v_chassis_no" placeholder="Vehicle Chessis No" value="<?php echo set_value('v_chassis_no', $vehicle_infos->v_chassis_no); ?>">
                        <div class="help-block" id="title-exists"><?php echo form_error('v_chassis_no'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="v_model_no" class="col-sm-3 col-form-label"><?php echo display('modelno'); ?></label>
                    <div class="col-sm-9">
                        <input type="text" name="v_model_no" class="form-control" id="v_chassis_no" placeholder="Vehicle Model No" value="<?php echo set_value('v_model_no', $vehicle_infos->v_model_no); ?>">
                        <div class="help-block" id="title-exists"><?php echo form_error('v_model_no'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="v_engine_no" class="col-sm-3 col-form-label"><?php echo display('engineno'); ?></label>
                    <div class="col-sm-9">
                        <input type="text" name="v_engine_no" class="form-control" id="v_chassis_no" placeholder="Vehicle Engine No" value="<?php echo set_value('v_engine_no', $vehicle_infos->v_engine_no); ?>">
                        <div class="help-block" id="title-exists"><?php echo form_error('v_engine_no'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="v_type" class="col-sm-3 col-form-label"><?php echo display('vehicletype'); ?></label>
                    <div class="col-sm-9">
                        <?php echo form_dropdown('v_type', $v_type, set_value('v_type', $vehicle_infos->v_type), 'id="v_type"   class="col-md-4 col-xs-12 testselect1"'); ?>
                        <div class="help-block" id="title-exists"><?php echo form_error('v_type'); ?></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="v_owner" class="col-sm-3 col-form-label"><?php echo display('ownershiphire'); ?></label>
                    <div class="col-sm-9">
                        <?php echo form_dropdown('v_owner', $v_owner, set_value('v_owner', $vehicle_infos->v_owner), 'id="v_owner"   class="col-md-4 col-xs-12 testselect1"'); ?>
                        <div class="help-block" id="title-exists"><?php echo form_error('v_owner'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="vehicle_type" class="col-sm-3 col-form-label"><?php echo display('isactive'); ?></label>
                    <div class="col-sm-9">
                        <fieldset>
                            <div class="checkbox-circle">
                                <input name="active" type="radio" value="1" <?php echo set_radio('active', '1', TRUE); ?>>
                                <label for="checkbox7"><?php echo display('yes'); ?></label>
                                <input name="active" type="radio" value="0" <?php echo set_radio('active', '0'); ?>>
                                <label for="checkbox8"><?php echo display('no'); ?></label>
                            </div>
                        </fieldset>
                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('active'); ?></div>
                </div> 
                <input type="hidden" name="v_id" id="v_id" value="<?php echo set_value('v_id', $vehicle_infos->v_id); ?>"  />
                <div class="form-group row">
                    <div class="col-md-offset-1 col-md-9" style="margin-left: 35%;">
                        <button class="btn btn-danger w-md m-b-5"><?php echo display('cancel'); ?></button>
                        <button  type="submit"  class="btn btn-primary w-md m-b-5"><i class="fa fa-plus"></i> <?php echo display('save'); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

