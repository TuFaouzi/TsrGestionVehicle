<div class="col-sm-12">
    <div class="panel panel-bd lobidrag">
        <div class="panel-heading">
            <div class="panel-title">
                <h4><?php
                    if (!empty($company->company_id)) {
                        echo $this->lang->line('COMPANY_UPDATE');
                    } else {
                        echo $this->lang->line('COMPANY_CREATE');
                    }
                    ?>
                </h4>
            </div>
        </div>
       <form class="form-horizontal" id="notice-submit" action="<?php echo base_url() . 'accounting/company/create'; ?>" method="post" >
          <?php echo form_hidden('company_id', $company->company_id); ?>
        <div class="panel-body">           
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name"><?php echo $this->lang->line('COMPANY_NAME'); ?>&nbsp;&nbsp;<span class="fa fa-asterisk red" style="color:red;"></span></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" name="name" id="name" class="col-xs-12 col-sm-4 form-control" placeholder="<?php echo $this->lang->line('COMPANY_NAME'); ?>"   value="<?php echo set_value('name', $company->name); ?>" />
                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('name'); ?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="address"><?php echo $this->lang->line('COMPANY_ADDRESS'); ?> &nbsp;&nbsp; </label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <textarea class="col-xs-12 col-sm-4  form-control" id="address"  placeholder="<?php echo $this->lang->line('COMPANY_ADDRESS'); ?>" name="address"> <?php echo $company->address; ?> </textarea>
                    </div> 
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="mobile_no"><?php echo $this->lang->line('MOBILE_NUMBER'); ?></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" name="mobile_no" id="mobile_no"  placeholder="<?php echo $this->lang->line('MOBILE_NUMBER'); ?>" class="col-xs-12 col-sm-4 form-control" value="<?php echo set_value('mobile_no', $company->mobile_no); ?>" />
                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('mobile_no'); ?></div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="phone_no"><?php echo $this->lang->line('PHONE_NUMBER'); ?></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" name="phone_no" id="phone_no"  placeholder="<?php echo $this->lang->line('PHONE_NUMBER'); ?>" class="col-xs-12 col-sm-4  form-control" value="<?php echo set_value('phone_no', $company->phone_no); ?>" />
                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('phone_no'); ?></div>
                </div>
            </div> 
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="fax_no"><?php echo $this->lang->line('FAX_NUMBER'); ?></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" name="fax_no" id="fax_no"  placeholder="<?php echo $this->lang->line('FAX_NUMBER'); ?>" class="col-xs-12 col-sm-4  form-control" value="<?php echo set_value('fax_no', $company->fax_no); ?>" />
                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('fax_no'); ?></div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email"><?php echo $this->lang->line('COMPANY_EMAIL'); ?></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="email" name="email" id="email" placeholder="<?php echo $this->lang->line('COMPANY_EMAIL'); ?>" class="col-xs-12 col-sm-4  form-control"  value="<?php echo set_value('email', $company->email); ?>" /></span>
                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('email'); ?></div>
                </div>
            </div> 
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="website"><?php echo $this->lang->line('COMPANY_WEB'); ?>&nbsp;&nbsp;</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" name="website" id="website" placeholder="<?php echo $this->lang->line('COMPANY_WEB'); ?>" class="col-xs-12 col-sm-4  form-control"  value="<?php echo set_value('website', $company->website); ?>" /></span>
                    </div> 
                </div>
            </div> 
            <div class="form-group row">
                <div class="col-md-offset-1 col-md-9" style="margin-left: 35%;">
                    <button class="btn btn-danger w-md m-b-5"><?php echo $this->lang->line('CANCEL'); ?></button>
                    <button  type="submit"  class="btn btn-primary w-md m-b-5"><i class="fa fa-plus"></i> <?php echo $this->lang->line('SAVE'); ?></button>
                </div>
            </div>
        </div>
       </form>
    </div>
</div>

