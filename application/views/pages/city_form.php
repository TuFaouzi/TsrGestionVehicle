<div class="col-sm-12">
    <div class="panel panel-bd lobidrag">
        <div class="panel-heading">
            <div class="panel-title">
                <h4><?php
                    if (!empty($citys->city_id)) {
                        echo display('stationinformationupdate');
                    } else {
                        echo display('addstationinformation');
                    }
                    ?>
                </h4>
            </div>
        </div>
        <form name="city"  class="form-horizontal" id="city" action="<?php echo base_url() . 'city/city_save'; ?>" method="post">
            <div class="panel-body">           
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state_name"><?php echo display('selectstate'); ?>&nbsp;&nbsp;<span class="fa fa-asterisk red" style="color:red;"></span></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <?php echo form_dropdown('state_id', $state_id, set_value('state_id', $citys->state_id), 'id="state_id" class="col-xs-12 col-sm-4 testselect1"'); ?>
                        </div>
                        <div class="help-block" id="title-exists"><?php echo form_error('state_id'); ?></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="city_name"><?php echo display('station'); ?>&nbsp;&nbsp;<span class="fa fa-asterisk red" style="color:red;"></span></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <input type="text" name="city_name" id="city_name"  placeholder="<?php echo display('station'); ?>"class="col-xs-12 col-sm-4 form-control" value="<?php echo set_value('city_name', $citys->city_name); ?>" />
                        </div>
                        <div class="help-block" id="title-exists"><?php echo form_error('city_name'); ?></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="active"><?php echo display('isactive'); ?>&nbsp;&nbsp;</label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <?php echo display('yes'); ?> <input type="radio" name="active" id="active" value="1" <?php echo set_radio('active', '1', TRUE); ?>>&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php echo display('no'); ?> <input type="radio" name="active" id="active" value="0" <?php echo set_radio('active', '0'); ?>> 
                        </div> 
                    </div>
                </div>
                <input type="hidden" name="city_id" id="city_id" value="<?php echo set_value('city_id', $citys->city_id); ?>"  />
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