<div class="col-sm-12">
    <div class="panel panel-bd lobidrag">
        <div class="panel-heading">
            <div class="panel-title">
                <h4><?php
                    if (!empty($rents->company_rent_id)) {
                        echo display('updatecompanyre');
                    } else {
                        echo display('addcompanyrent');
                    }
                    ?>
                </h4>
            </div>
        </div>
        <form name="notice" class="form-horizontal" id="notice-submit" action="<?php echo base_url() . 'rent/save'; ?>" method="post" >
            <div class="panel-body">           
                <div class="form-group ">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="company_id"><?php echo display('companyname'); ?></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <?php echo form_dropdown('company_id', $company_id, set_value('company_id', $rents->company_id), 'id="company_id" required="required"  class="col-xs-12 col-sm-4 testselect1"'); ?>
                            <?php echo form_error('company_id'); ?>
                        </div>										
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="v_type_id"><?php echo display('vehicletype'); ?>  </label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <?php echo form_dropdown('v_type_id', $v_type_id, set_value('v_type_id', $rents->v_type_id), 'id="v_type_id" class="col-xs-12 col-sm-4 testselect1" required="required"'); ?>
                            <?php echo form_error('v_type_id'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="starting_station_id"><?php echo display('startpoint'); ?>  </label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <?php echo form_dropdown('starting_station_id', $starting_station_id, set_value('starting_station_id', $rents->starting_station_id), 'id="starting_station_id" class="col-xs-12 col-sm-4 testselect1" required="required"'); ?>
                            <?php echo form_error('starting_station_id'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="ending_station_id"><?php echo display('endpoint'); ?>  </label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <?php echo form_dropdown('ending_station_id', $ending_station_id, set_value('ending_station_id', $rents->ending_station_id), 'id="ending_station_id" class="col-xs-12 col-sm-4 testselect1" required="required"'); ?>
                            <?php echo form_error('ending_station_id'); ?>
                        </div>										
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="rent_type"><?php echo display('renttype'); ?></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix" >
                            <label for="local-radio">
                                <input id="local-radio" name="rent_type" type="radio" value="0" required="required" <?php if ($rents->rent_type == '0') echo 'checked="checked"'; ?>>
                                <span class="lbl"><?php echo display('local'); ?></span>
                            </label>
                            <label for="export-radio">
                                <input id="export-radio"name="rent_type" type="radio" value="2" required="required" <?php if ($rents->rent_type == '2') echo 'checked="checked"'; ?>>
                                <span class="lbl"><?php echo display('export'); ?></span>
                            </label>
                            <label for="import-radio">
                                <input id="import-radio" name="rent_type" type="radio" value="1" required="required" <?php if ($rents->rent_type == '1') echo 'checked="checked"'; ?>>
                                <span class="lbl"><?php echo display('import'); ?></span>
                            </label> 
                            <?php echo form_error('rent_type'); ?>
                        </div>
                    </div>
                </div>	
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="rent"><?php echo display('rent'); ?></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <input type="text"  class="vat_calculator col-xs-12 col-sm-4 form-control"  name="rent" id="rent"  placeholder="<?php echo display('rent'); ?>" required="required" value="<?php echo set_value('rent', $rents->rent); ?>" />
                        </div>
                        <div class="help-block" id="title-exists"><?php echo form_error('rent'); ?></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="vat_status"><?php echo display('vatstatus'); ?></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <select name="vat_status" id="vat_status" class="vat_calculator col-xs-12 col-sm-4 testselect1">
                                <option value="0"><?php echo display('deactivate');?></option>
                                <option value="1"><?php echo display('vatincluded');?></option>
                                <option value="2"><?php echo display('vatexcluded');?></option>
                            </select>
                        </div>
                        <div class="help-block" id="title-exists"><?php echo form_error('vat_status'); ?></div>
                    </div>
                </div>
                <div id="vat_option">  
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="vat"><?php echo display('vat');?></label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="text" name="vat" id="vat" class="vat_calculator col-xs-12 col-sm-4 form-control"  placeholder="<?php echo display('vat'); ?>" value="<?php echo set_value('vat', $rents->vat); ?>" />
                            </div>
                            <div class="help-block" id="title-exists"><?php echo form_error('vat'); ?></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="total_rent_amount"><?php echo display('totalrent'); ?></label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="text" class="col-xs-12 col-sm-4 form-control" id="total_rent" readonly="readonly" value="0" />
                            </div>
                        </div>
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
                <br/>
                
                <input type="hidden" name="company_rent_id" id="company_rent_id" value="<?php echo set_value('company_rent_id', $rents->company_rent_id); ?>"  />
            <div class="form-group row">
                <div class="col-md-offset-1 col-md-9" style="margin-left: 40%;">
                    <button class="btn btn-danger w-md m-b-5"><?php echo display('cancel'); ?></button>
                    <button  type="submit"  class="btn btn-primary w-md m-b-5"><i class="fa fa-plus"></i> <?php echo display('save'); ?></button>
                </div>
            </div>
            </div>
        </form>
    </div>
</div>

