<div class="col-sm-12">
    <div class="panel panel-bd lobidrag">
        <div class="panel-heading">
            <div class="panel-title">
                <h4><?php echo display('expensescreate'); ?></h4>
            </div>
        </div>
        <?php if ($this->session->flashdata('success')): ?>                 
            <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php elseif ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <form name="expense_entry" class="form-horizontal" id="notice-submit" action="<?php echo base_url() . 'expense_entry/save/'; ?>" method="post">
            <div class="panel-body">           
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="date"><?php echo display('date'); ?>  <span class="fa fa-asterisk red" style="color:red;"></span></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix" >
                            <input type="text" name="date" class="form-control  datepicker" value="<?php echo date("d-m-Y"); ?>">
                        </div>
                    </div>
                </div>
                <?php $e_group = array('' => 'Select an Option', 2 => 'Maintenance', 3 => 'Others', 4 => 'Office', 5 => 'Garage'); ?>
                <div class="form-group ">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="company_id"><?php echo display('expensegroup'); ?>  <span class="fa fa-asterisk red" style="color:red;"></span></label>

                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <?php echo form_dropdown('expense', $e_group, '', 'class="col-xs-12 col-sm-4 testselect1" id="expense_group"'); ?>      
                        </div>   
                        <div class="help-block" id="title-exists"><?php echo form_error('expense'); ?></div>
                    </div>
                </div>                                
                <div class="form-group" id="vehicle">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="v_id"><?php echo display('vehicleregistrationno'); ?></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix" >
                            <?php echo form_dropdown('v_id', $v_info, '', 'class="col-xs-12 col-sm-4 testselect1"'); ?>
                        </div>
                        <div class="help-block" id="title-exists"><?php echo form_error('v_id'); ?></div>
                    </div>
                </div>
                <fieldset> 
                    <legend><?php echo display('tripexpense');?> </legend>
                    <hr>
                    <table id="output" class="table table-striped table-bordered responsive">

                    </table>
                </fieldset>
                <br/>
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
<script type="text/javascript">
$(document).ready(function(){
    $('#expense_group').on('change',function(){
        // if($(this).val()==2){
        //     $('#vehicle').show();
        // }else{
        //     $('#vehicle').hide();
        // }

        var controller = 'expense_entry';
        var method = 'LoadAjax';
        var type =  $(this).val();
        var output = '#output';
        jquery_ajax(controller,method,type,output);
    });  
}); 

function jquery_ajax(controller,method,type,output) {  
    $.ajax({ 
        'url': '<?php echo base_url(); ?>index.php/' + controller + '/' + method + '/' + type,
        'type': 'POST',  
        'data': {'expense_group': type},
        'cache': false,
        'success': function (data) {  
            var container = $(output);  
            if (data) {
                container.html(data);
            } 
        }
    });
}

</script>