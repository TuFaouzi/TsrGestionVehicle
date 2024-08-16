<div class="col-sm-12">
    <div class="panel panel-bd lobidrag">
        <div class="panel-heading">
            <div class="panel-title">
                <h4>
                    <?php
                    if (!empty($companys->company_id)) {
                        echo display('companyupdate');
                    } else {
                        echo display('companycreate');
                    }
                    ?>
                </h4>
            </div>
        </div>
        <form name="notice" class="form-horizontal" id="notice-submit" action="<?php echo base_url() . 'company/save'; ?>" method="post">
            <div class="panel-body">           
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="company_name"><?php echo display('name'); ?>&nbsp;&nbsp;<span class="fa fa-asterisk red" style="color: red;"></span></label>

                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <input type="text" name="company_name" id="company_name" class="form-control" placeholder="<?php echo display('name'); ?>"   value="<?php echo set_value('company_name', $companys->company_name); ?>" />
                        </div>
                        <div class="help-block" id="title-exists"><?php echo form_error('company_name'); ?></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="company_address"><?php echo display('address'); ?> &nbsp;&nbsp; </label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <textarea class="form-control" id="company_address"  placeholder="<?php echo display('address'); ?>" name="company_address"  value=""><?php echo set_value('company_address', $companys->company_address); ?></textarea>
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="company_cell"><?php echo display('cellnumber'); ?></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <input type="text" name="company_cell" id="company_cell"  placeholder="<?php echo display('cellnumber'); ?>" class="form-control" value="<?php echo set_value('company_cell', $companys->company_cell); ?>" />
                        </div>
                        <div class="help-block" id="title-exists"><?php echo form_error('company_cell'); ?></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="route_fare"><?php echo display('email'); ?></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <input type="email" name="company_email" id="company_email" placeholder="<?php echo display('email'); ?>" class="form-control"  value="<?php echo set_value('company_email', $companys->company_email); ?>" /></span>
                        </div>
                        <div class="help-block" id="title-exists"><?php echo form_error('company_email'); ?></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="route_fare"><?php echo display('companyweb'); ?>&nbsp;&nbsp;</label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <input type="text" name="company_web" id="company_email" placeholder="<?php echo display('companyweb'); ?>" class="form-control"  value="<?php echo set_value('company_web', $companys->company_web); ?>" /></span>
                        </div> 
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="active"><?php echo display('isactive'); ?>&nbsp;&nbsp;</label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <?php echo display('yes'); ?> <input type="radio" name="active" id="active" value="1" <?php echo set_radio('active', '1', TRUE); ?>>&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php echo display('no'); ?> <input type="radio" name="active" id="active" value="0" <?php echo set_radio('active', '0'); ?>> 
                        </div> 
                        <div class="help-block" id="title-exists"><?php echo form_error('active'); ?></div>
                    </div>
                </div>
                <br/>
                
                <input type="hidden" name="company_id" id="company_id" value="<?php echo set_value('company_id', $companys->company_id); ?>"  />
                <div class="form-group row">
                    <div class="col-md-offset-1 col-md-9" style="margin-left: 40%;">
                        <button class="btn btn-danger w-md m-b-5"><?php echo display('cancel'); ?></button>
                        <button type="submit" class="btn btn-primary w-md m-b-5"><i class="fa fa-plus"></i> <?php echo display('save'); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

