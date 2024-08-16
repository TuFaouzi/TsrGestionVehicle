<div class="col-sm-12">
    <div class="panel panel-bd lobidrag">
        <div class="panel-heading">
            <div class="panel-title">
                <h4>
                <?php
                if (!empty($districts->state_id)) {
                    echo display('stateinformationupdate');
                } else {
                    echo display('addstate');
                }
               ?>
                </h4>
            </div>
        </div>
       <form name="district_information"  class="form-horizontal" id="notice-submit" action="<?php echo base_url() . 'district/district_save'; ?>" method="post" >
        <div class="panel-body">           
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state_name"><?php echo display('state'); ?>&nbsp;&nbsp;<span class="fa fa-asterisk red" style="color:red;"></span></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" name="state_name" id="state_name"  placeholder="<?php echo display('state');?>"class="col-xs-12 col-sm-4 form-control" required="required" value="<?php echo set_value('state_name', $districts->state_name); ?>" />
                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('state_name'); ?></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="vehicle_type" class="col-sm-3 col-form-label"><?php echo display('inactive'); ?></label>
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
            </div>
           <input type="hidden" name="state_id" id="state_id" value="<?php echo set_value('state_id', $districts->state_id); ?>"  />
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

