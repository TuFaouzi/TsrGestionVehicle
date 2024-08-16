<div class="col-sm-12">
    <div class="panel panel-bd lobidrag">
        <div class="panel-heading">
            <div class="panel-title">
                <h4><?php
                    if (!empty($expenses->expense_id)) {
                        echo display('expensesupdate');
                    } else {
                        echo display('expensecreate');
                    }
                    ?>
                </h4>
            </div>
        </div>
        <form name="expense" class="form-horizontal" id="notice-submit" action="<?php echo base_url() . 'expense_list/save'; ?>" method="post" >
            <div class="panel-body">           

                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="expense_group"><?php echo display('expensetype'); ?>&nbsp;&nbsp;<span class="fa fa-asterisk red" style="color:red;"></span></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="col-md-12">
                            <?php echo form_dropdown('expense_group', $expense_group, set_value('expense_group', $expenses->expense_group), 'id="expense_group" required="required"  class="col-xs-12 col-sm-4 testselect1"'); ?>
                            <?php echo form_error('expense_group'); ?>
                        </div>
                    </div>
                </div>	
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="expense_name"><?php echo display('expensename'); ?>&nbsp;&nbsp;<span class="fa fa-asterisk red" style="color:red;"></span></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="col-md-12">
                            <input type="text" name="expense_name" id="company_name" class="col-xs-12 col-sm-4 form-control" placeholder="<?php echo display('expensename'); ?>"   value="<?php echo set_value('expense_name', $expenses->expense_name); ?>" />
                        </div>
                        <div class="help-block" id="title-exists"><?php echo form_error('expense_name'); ?></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="active"><?php echo display('inactive'); ?>&nbsp;&nbsp;</label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <?php echo display('yes');?> <input type="radio" name="active" id="active" value="1" <?php echo set_radio('active', '1', TRUE); ?>>&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php display('no');?> <input type="radio" name="active" id="active" value="0" <?php echo set_radio('active', '0'); ?>> 
                        </div> 
                        <div class="help-block" id="title-exists"><?php echo form_error('active'); ?></div>
                    </div>
                </div>
                <input type="hidden" name="expense_id" id="expense_id" value="<?php echo set_value('expense_id', $expenses->expense_id); ?>"  />
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

