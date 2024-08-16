<div class="row">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-blue widget-header-flat">                         
                <h4 class="widget-title lighter">
                    <?php echo display('expenseupdate'); ?>
                </h4>
            </div>
            <hr>
            <div class="widget-body">
                <div class="widget-main">
                    <div class="step-content pos-rel" id="step-container">
                        <div class="step-pane active" id="step1">



            <form class="form-horizontal" id="notice-submit" action="<?php echo base_url() . 'expense_entry/edit_save/'.$this->uri->segment(3); ?>" method="post" >
                <input type="hidden" name="transection_id" value="<?php echo set_value('transection_id',$expense_data->transection_id); ?>" />
            <div class="panel-body">     

                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="date"><?php echo display('date'); ?>  <span class="fa fa-asterisk red" style="color:red;"></span></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix" >
                          <input type="text" name="date" value="<?php echo date('d-m-Y',strtotime($expense_data->date)); ?>" class="datepicker  form-control">
                        </div>
                    </div>
                </div>

               
                <div class="form-group ">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="company_id"><?php echo display('expensegroup'); ?>  <span class="fa fa-asterisk red" style="color:red;"></span></label>

                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                             <?php
                                    $expense_group = array( 2=>'Maintenance',4 =>'Office',5=>'Garage',3=>'Others');
                                    echo form_dropdown('expense_group',$expense_group,$expense_data->expense_group,'class="form-control testselect1" ');  
                            ?>      
                        </div>   
                        <div class="help-block" id="title-exists"><?php echo form_error('expense'); ?></div>
                    </div>
                </div> 

                <div class="form-group" id="vehicle">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="v_id"><?php echo display('vehicleregistrationno'); ?></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix" >
                            <?php echo form_dropdown('v_id', $v_info,$expense_data->v_id,'class="testselect1" ');?>
                        </div>
                        <div class="help-block" id="title-exists"><?php echo form_error('v_id'); ?></div>
                    </div>
                </div>


                 <div class="form-group" id="vehicle">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="v_id"><?php echo display('expensename'); ?></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix"  style="border: 1px solid gainsboro;width: 25%;height: 37px;text-align: center;">
                            <p style="margin-top: 4%;"><?php echo $expense_data->expense_name; ?></p>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="vehicle">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="v_id"><?php echo display('expenseserial'); ?></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix" >
                            <input type="text" name="expense_serial" value="<?php echo $expense_data->expense_serial; ?>" class=" form-control"/>
                        </div>
                    </div>
                </div>


                <div class="form-group" id="vehicle">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="v_id"><?php echo display('quantity'); ?></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix" >
                           <input type="text" value="<?php echo $expense_data->quantity; ?>" name="qty" placeholder="Quantity" class="amount_edit form-control" id="quantity_1">
                        </div>
                    </div>
                </div>


                <div class="form-group" id="vehicle">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="v_id"><?php echo display('amount'); ?></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix" >
                          <input type="text" value="<?php echo $expense_data->amount; ?>" name="price" placeholder="Amount" class="amount_edit form-control" id="amount_1">
                        </div>
                    </div>
                </div>

                 <div class="form-group" id="vehicle">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="v_id"><?php echo display('total'); ?></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix" style="border: 1px solid gainsboro;width: 16%;height: 37px;text-align: center;">
                          <p style="margin-top: 5%;"><?php echo round($expense_data->quantity*$expense_data->amount,2); ?></p>
                        </div>
                    </div>
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
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->
        </div><!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->