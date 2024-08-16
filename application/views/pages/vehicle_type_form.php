<div class="col-sm-12">
    <div class="panel panel-bd lobidrag">
        <div class="panel-heading">
            <div class="panel-title">
                <h4>
                    <?php
                    if (!empty($vehicle_types->v_type_id)) {
                         echo display('addvehicletype');
                    } else {
                        echo display('vehicletypecreate');
                    }
                    ?>
                </h4>
            </div>
        </div>
        <form name="notice" class="form-horizontal" id="notice-submit" action="<?php echo base_url() . 'vehicle/vehicle_type_save'; ?>" method="post">
            <?php
            $this->session->userdata('isLogin');
            ?>  
            <div class="panel-body">           
                <div class="form-group row">
                    <label for="vehicle_type" class="col-sm-3 col-form-label"><?php echo display('addvehicletype'); ?></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="v_type" id="vehicle_type" value="<?php echo set_value('v_type', $vehicle_types->v_type); ?>" placeholder="<?php echo display('addvehicletype'); ?>">
                        <p class="help-block text-danger"><?php echo form_error('fullname'); ?></p>
                    </div>
                </div>  
                <div class="form-group row">
                    <label for="vehicle_type" class="col-sm-3 col-form-label"><?php echo display('isactive'); ?></label>
                    <div class="col-sm-9">
                        <fieldset>
                            <div class="checkbox-circle">
                                <input name="active" type="radio" value="1" <?php echo set_radio('active', '1', TRUE); ?>>
                                <label for="checkbox7"><?php echo display('yes');?></label>

                                <input name="active" type="radio" value="0" <?php echo set_radio('active', '0'); ?>>
                                <label for="checkbox8"><?php echo display('no');?></label>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <input type="hidden" name="v_type_id" id="v_type_id" value="<?php echo set_value('v_type_id', $vehicle_types->v_type_id); ?>"  />
                <div class="form-group row">
                    <div class="col-md-offset-1 col-md-9" style="margin-left: 35%;">
                        <a  class="btn btn-danger w-md m-b-5"><?php echo display('cancel'); ?></a>
                        <button  type="submit"  class="btn btn-primary w-md m-b-5"><i class="fa fa-plus"></i> <?php echo display('save'); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

