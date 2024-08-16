<div class="col-sm-12">
    <div class="panel panel-bd lobidrag">
        <div class="panel-heading">
            <div class="panel-title">
                <h4><?php echo display('outflow'); ?>
                </h4>
            </div>
        </div>
        <form name="outflow"  class="form-horizontal" action="<?php echo base_url() . 'accounting/outflow/create'; ?>" method="post" >
            <?php echo form_hidden('outflow_id', $outflow->outflow_id); ?>
            <div class="panel-body">           
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="payment_date"><?php echo display('paymentdate'); ?></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <input type="text" name="payment_date" id="payment_date"  placeholder="<?php echo display('paymentdate'); ?>" class="col-xs-12 col-sm-4 form-control datepicker"/>
                        </div>
                        <div class="help-block" id="title-exists"><?php echo form_error('payment_date'); ?></div>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="payment_to"><?php echo display('paymentto'); ?></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <input type="text" name="payment_to" id="payment_to"  placeholder="<?php echo display('paymentto'); ?>" class="col-xs-12 col-sm-4 form-control"/>
                        </div>
                        <div class="help-block" id="title-exists"><?php echo form_error('payment_to'); ?></div>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="payment_type"><?php echo display('paymenttype'); ?></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <?php
                            $pay_type = array(
                                '1' => display('cash'),
                                '2' => display('cheque'),
                                '3' => display('payorder'),
                                '4' => display('lc')
                            );
                            echo form_dropdown('payment_type', $pay_type, $outflow->payment_type, 'class="col-xs-12 col-sm-4 testselect1" id="payment_type"');
                            ?>
                        </div>
                        <div class="help-block" id="title-exists"><?php echo form_error('payment_type'); ?></div>
                    </div>
                </div> 
                <div id="payment_type_cheque" style="display:none">
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="bank_name"><?php echo display('bankname'); ?></label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix"> 
                                <input type="text" name="bank_name" id="bank_name"  placeholder="<?php echo display('bankname'); ?>" class="col-xs-12 col-sm-4 form-control"/>
                            </div>
                            <div class="help-block" id="title-exists"><?php echo form_error('bank_name'); ?></div>
                        </div>
                    </div> 	
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="branch_name"><?php echo display('branchname'); ?></label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix"> 
                                <input type="text" name="branch_name" id="branch_name"  placeholder="<?php echo display('branchname'); ?>" class="col-xs-12 col-sm-4 form-control"/>
                            </div>
                            <div class="help-block" id="title-exists"><?php echo form_error('branch_name'); ?></div>
                        </div>
                    </div> 	
                    <!-- ---------------- -->
                    <div class="form-group" id="cheque" style="display:none">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="account_number"><?php echo display('accountname'); ?></label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix"> 
                                <input type="text" name="account_number" id="account_number"  placeholder="<?php echo display('accountname'); ?>" class="col-xs-12 col-sm-4 form-control" />
                            </div>
                            <div class="help-block" id="title-exists"><?php echo form_error('account_number'); ?></div>
                        </div>
                    </div> 
                    <div class="form-group" id="pay_order" style="display:none">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="pay_order_number"><?php echo display('payordernumber'); ?></label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix"> 
                                <input type="text" name="pay_order_number" id="pay_order_number"  placeholder="<?php echo display('payordernumber'); ?>" class="col-xs-12 col-sm-4 form-control"/>
                            </div>
                            <div class="help-block" id="title-exists"><?php echo form_error('pay_order_number'); ?></div>
                        </div>
                    </div> 	
                    <div class="form-group" id="letterOfCredit" style="display:none">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="letter_of_credit"><?php echo display('lc'); ?></label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix"> 
                                <input type="text" name="letter_of_credit" id="letter_of_credit"  placeholder="<?php echo display('lc'); ?>" class="col-xs-12 col-sm-4 form-control"/>
                            </div>
                            <div class="help-block" id="title-exists"><?php echo form_error('letter_of_credit'); ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="deposit_bank_id"><?php echo display('depositbankname'); ?></label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix"> 
                                <?php echo form_dropdown('deposit_bank_id', $bank_dropdown, $outflow->deposit_bank_id, 'class="col-xs-12 col-sm-4 testselect1" id="deposit_bank_id"'); ?>
                            </div>
                            <div class="help-block" id="title-exists"><?php echo form_error('deposit_bank_id'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="account_name"><?php echo display('accountname'); ?></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix"> 
                            <?php echo form_dropdown('account_name', $dropdown, $outflow->account_name, 'class="col-xs-12 col-sm-4 testselect1" id="account_name"'); ?>
                        </div>
                        <div class="help-block" id="title-exists"><?php echo form_error('account_name'); ?></div>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="amount"><?php echo display('amount'); ?></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix"> 
                            <input type="text" name="amount" id="amount"  placeholder="<?php echo display('amount'); ?>" class="col-xs-12 col-sm-4 form-control"/>
                        </div>
                        <div class="help-block" id="title-exists"><?php echo form_error('amount'); ?></div>
                    </div>
                </div> 
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="description"><?php echo display('description'); ?></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix"> 
                            <textarea name="description" id="description" placeholder="<?php echo display('description'); ?>" class="col-xs-12 col-sm-4 form-control"></textarea>    
                        </div>
                        <div class="help-block" id="title-exists"><?php echo form_error('DESCRIPTION'); ?></div>
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
                        <a class="btn btn-danger w-md m-b-5"><?php echo display('cancel'); ?></a>
                        <button  type="submit"  class="btn btn-primary w-md m-b-5"><i class="fa fa-plus"></i> <?php echo display('save'); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $("#payment_type").change(function () {
            var payment_type = $(this).val();
            if (payment_type == 1) {
                $("#payment_type_cheque").slideUp(300);
                $("#bank_name").val('');
                $("#branch_name").val('');
                $("#pay_order_number").val('');
                $("#letter_of_credit").val('');
                $("#account_number").val('');
            }
            else if (payment_type == 2 || payment_type == 3 || payment_type == 4) {
                $("#payment_type_cheque").slideDown(300);
                if (payment_type == 2) {
                    $("#cheque").slideDown(300);
                    $("#pay_order").slideUp(300);
                    $("#letterOfCredit").slideUp(300);
                    $("#pay_order_number").val('');
                    $("#letter_of_credit").val('');
                } else if (payment_type == 3) {
                    $("#pay_order").slideDown(300);
                    $("#letterOfCredit").slideUp(300);
                    $("#cheque").slideUp(300);
                    $("#account_number").val('');
                    $("#letter_of_credit").val('');
                } else if (payment_type == 4) {
                    $("#letterOfCredit").slideDown(300);
                    $("#pay_order").slideUp(300);
                    $("#cheque").slideUp(300);
                    $("#account_number").val('');
                    $("#pay_order_number").val('');
                }
            }
        });

// ------------------------------------------------------
//EDIT MODE
        var x = '<?php if (isset($outflow->payment_type)) echo $outflow->payment_type; ?>';
        if (x == 1) {
            $("#payment_type_cheque").slideUp(300);
        }
        else if (x == 2 || x == 3 || x == 4) {
            $("#payment_type_cheque").slideDown(300);
            if (x == 2) {
                $("#cheque").slideDown(300);
                $("#pay_order").slideUp(300);
                $("#letterOfCredit").slideUp(300);
            } else if (x == 3) {
                $("#pay_order").slideDown(300);
                $("#cheque").slideUp(300);
                $("#letterOfCredit").slideUp(300);
            } else if (x == 4) {
                $("#letterOfCredit").slideDown(300);
                $("#cheque").slideUp(300);
                $("#pay_order").slideUp(300);
            }
        }
//------------------------------------------------------

    });
</script>



