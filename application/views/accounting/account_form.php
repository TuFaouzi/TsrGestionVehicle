<div class="col-sm-12">
    <div class="panel panel-bd lobidrag">
        <div class="panel-heading">
            <div class="panel-title">
                <h4><?php echo display('accountinformation'); ?></h4>
            </div>
        </div>
      <form name="inflow"  class="form-horizontal" action="<?php echo base_url() . 'accounting/account/create'; ?>" method="post" >
             <?php echo form_hidden('account_id', $account->account_id); ?>
        <div class="panel-body">           
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="sector_name"><?php echo display('sectorname'); ?></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix"> 
                        <input type="text" name="sector_name" id="sector_name"  placeholder="<?php echo display('sectorname'); ?>" class="col-xs-12 col-sm-4 form-control"  value="<?php echo set_value('sector_name', $account->sector_name); ?>" />
                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('sector_name'); ?></div>
                </div>
            </div> 
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="sector_type"><?php echo display('sectortype'); ?></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix"> 
                        <?php
                        $sector_type = array(
                            'Credit (+)' => 'Credit (+)',
                            'Debit (-)' => 'Debit (-)'
                        );
                        echo form_dropdown('sector_type', $sector_type, $account->sector_type, 'class="col-xs-12 col-sm-4 testselect1" id="sector_type"');
                        ?>
                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('sector_type'); ?></div>
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

