<div class="row" style="background-color: white">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-blue widget-header-flat">						
                <h4> 
                    <?php
                    if (!empty($trip_informations->trip_id)){
                        echo display('updatetripentry');
                    } else {
                        echo display('createtripintry');
                    }
                    ?>
                </h4>
            </div>
            <hr>
            <div class="widget-body">
                <div class="widget-main">
                    <div class="step-content pos-rel" id="step-container">
                    <!-- STARTS OF ALERT MESSAGE -->
                    <?php if($this->session->flashdata('message')): ?>                 
                    <div class="alert alert-success"><?php echo $this->session->flashdata('message'); ?></div>
                    <?php elseif($this->session->flashdata('exception')): ?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata('exception'); ?></div>
                    <?php endif; ?>
                    <!-- ENDS OF ALERT MESSAGE -->
                        <div class="step-pane active" id="step1">
                            <form name="trip_information" class="form-horizontal" id="notice-submit" action="<?php echo base_url() . 'trip_information/save_trip'; ?>" method="post" >
                                <div class="form-group ">
                                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="trip_type"><?php echo display('triptype');?>&nbsp;&nbsp;<span class="fa fa-asterisk red"></span></label>
                                    <div class="col-xs-12 col-sm-9">
                                        <div class="clearfix">
                                            <select id="trip_type" name="trip_type" class="col-xs-12 col-sm-4 testselect1">
                                                <option value=" ">Select an option</option>
                                                <option value="1"><?php echo display('Ownsingle');?></option>
                                                <option value="2"><?php echo display('Owndouble');?></option>
                                                <option value="3"><?php echo display('hiresingle');?></option>
                                                <option value="4"><?php echo display('hiredouble');?></option>
                                                <option value="5"><?php echo display('rentsingle');?></option>
                                                <option value="6"><?php echo display('rentdouble');?></option>
                                            </select>
                                        </div>										
                                            <div class="help-block" id="title-exists"><?php echo form_error('trip_type'); ?></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="import_export"><?php echo display('importexport');?>&nbsp;&nbsp;<span class="fa fa-asterisk red"></span> </label>
                                    <div class="col-xs-12 col-sm-9">
                                        <div class="clearfix">
                                            <select id="import_export"  name="import_export" class="col-xs-12 col-sm-4 testselect1" >
                                                <option value=""><?php echo display('selectanoption');?></option>
                                                <option value="2"><?php echo display('export');?></option>
                                                <option value="1"><?php echo display('import');?></option>
                                                <option value="3"><?php echo display('importexport');?></option>		
                                            </select>
                                        </div>
                                        <div class="help-block" id="title-exists"><?php echo form_error('import_export'); ?></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="driver_id"><?php echo display('drivername');?></label>
                                    <div class="col-xs-12 col-sm-9">
                                        <div class="clearfix">
                                            <select id="driver_id" name="driver_id" class="col-xs-12 col-sm-4 testselect1">
                                                <option><?php echo display('drivername');?></option>
                                                <?php
                                                    foreach ($driver_info as $value) {
                                                        echo "<option value=\"$value->driver_id\">$value->driver_name</option>";
                                                    }
                                                ?>
                                            </select>
                                            <div class="help-block" id="title-exists"><?php echo form_error('driver_id'); ?></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- STARTS OF VEHICLE INFO -->
                                <div class="form-group" id="own_vehicle">
                                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="v_id"><?php echo display('vehicleregistrationno');?></label>
                                    <div class="col-xs-12 col-sm-9">
                                        <div class="clearfix">
                                            <select id="v_id" name="v_id" class="col-xs-12 col-sm-4 testselect1">
                                                <option value=""><?php echo display('vehicleregistrationno');?></option>
                                                <?php
                                                    foreach ($vehicle_info as $value) {
                                                        echo "<option value=\"$value->v_id\">$value->v_registration_no</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                            <div class="help-block" id="title-exists"><?php echo form_error('v_id'); ?></div>
                                    </div>
                                </div>
                                <div class="form-group" id="hire_vehicle">
                                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="hire_v_id"><?php echo display('hirevehicleregno');?></label>
                                    <div class="col-xs-12 col-sm-9">
                                        <div class="clearfix">
                                            <input type="text" name="hire_v_id" placeholder="<?php echo display('hirevehicleregno');?>" class="col-xs-12 col-sm-4 form-control" id="hire_v_id" >
                                        </div>
                                     </div>
                                </div>
                                <!-- ENDS OF VEHICLE INFO -->



                            <!-- ---------------------------------------------
                                ------------STARTS OF EXPORT BOX-----------------
                                ------------------------------------------------ -->
  
                                <div class="export box" id="export_box"><legend> <?php echo display('import');?></legend>
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="trip_date1"><?php echo display('date');?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix"> 
                                                <input type="text" id="trip_date1" name="trip_date[]" placeholder="<?php echo display('date');?>" class="col-xs-12 col-sm-4 datepicker form-control" >
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="company_id"><?php echo display('selectanoption');?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix"> 
                                            <select class="col-xs-12 col-sm-4 testselect1" id="company_option">
                                                <option><?php echo display('selectanoption');?></option>
                                                <option value="1"><?php echo display('contactcompany');?></option>
                                                <option value="2"><?php echo display('otherscompany');?></option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- #company type# -->
                                    <div class="form-group" id="contact_company" style="display:none;">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="company_id"><?php echo display('companyname');?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix"> 
                                                <?php echo form_dropdown('company_id[]',$company_info,'','class="col-xs-12 col-sm-4 testselect1" id="company_id"');?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" id="OthersCompany"  style="display:none">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="others_company"><?php echo display('companyname');?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix">
                                                <input type="text" id="others_company" name="others_company[]" placeholder="<?php echo display('companyname');?>" class="col-xs-12 col-sm-4 form-control" value="">
                                            </div>
                                         </div>
                                    </div>
                                    <!-- #ends of company type# --> 

                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="rate"><?php echo display('ratecontactrate');?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix">
                                                <input type="text" id="rate" name="rent[]" placeholder="<?php echo display('ratecontactrate');?>" class="col-xs-12 col-sm-4 form-control" id="imp_rate"  data-provide="" data-items="4" data-source='[]'>
                                            </div>
                                         </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="fare_rent"><?php echo display('farerate');?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix">
                                                <input type="text" id="fare_rent" name="fare_rent[]" placeholder="<?php echo display('farerate');?>" class="col-xs-12 col-sm-4 form-control" id="imp_rate"  data-provide="" data-items="4" data-source='[]'>
                                            </div>
                                         </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="advanced"><?php echo display('advance');?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix">
                                                <input type="text" id="advanced" name="advance[]" placeholder="<?php echo display('advance');?>" class="col-xs-12 col-sm-4 form-control" id="imp_rate"  data-provide="" data-items="4" data-source='[]'>
                                            </div>
                                         </div>
                                    </div>

                                    <!-- export destination -->
                                 <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="city_start"><?php echo display('startpoint');?></label>
                                    <div class="col-xs-12 col-sm-9">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-5">
                                                <div class="clearfix" style="width:106%">
                                                    <select id="city_start" name="start_dist_id[]" class="testselect1">
                                                        <option value=""><?php echo display('selectstate');?></option>
                                                        <?php foreach ($state_info as $value) { ?>
                                                            <option value="<?php echo $value->state_id; ?>"><?php echo $value->state_name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-5">
                                                <div class="clearfix" style="width: 106%;"> 
                                                    <select name="start_point[]" class="form-control">
                                                        <option  value=""><?php echo display('selectstation');?></option>
                                                        <optgroup id="start_point"></optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>  

                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="city_end"><?php echo display('endpoint');?></label>
                                    <div class="col-xs-12 col-sm-9">    
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-5">
                                                <div class="clearfix"  style="width: 106%;">
                                                    <select id="city_end" name="end_dist_id[]" class="testselect1">
                                                        <option value=""><?php echo display('selectstate');?></option>
                                                        <?php foreach ($state_info as $value) { ?>
                                                            <option value="<?php echo $value->state_id; ?>"><?php echo $value->state_name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-5">
                                                <div class="clearfix"  style="width: 106%;"> 
                                                    <select name="end_point[]" class="form-control">
                                                        <option value=""><?php echo display('selectstation');?> </option>
                                                        <optgroup id="end_point"></optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div> 
                                </div> 


                            <!-- ---------------------------------------------
                                ------------ENDS OF EXPORT BOX-----------------
                                ------------------------------------------------ -->



                            <!-- ---------------------------------------------
                                ------------STARTS OF IMPORT BOX-----------------
                                ------------------------------------------------ -->

                                <div class="import box" id="import_box"><legend><?php echo display('import');?></legend>
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="trip_date2"><?php echo display('date');?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix"> 
                                                <input type="text" id="trip_date2" name="trip_date[]" placeholder="<?php echo display('date');?>" class="col-xs-12 col-sm-4 datepicker form-control" >
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="company_id2"><?php echo display('selectanoption');?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix"> 
                                            <select class="col-xs-12 col-sm-4 testselect1" id="company_option2">
                                                <option><?php echo display('selectanoption');?></option>
                                                <option value="1"><?php echo display('contactcompany');?></option>
                                                <option value="2"><?php echo display('otherscompany');?></option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- #company type# -->
                                    <div class="form-group" id="contact_company2"  style="display:none">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="company_id2"><?php echo display('companyname');?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix"> 
                                                <?php echo form_dropdown('company_id[]',$company_info,'','class="col-xs-12 col-sm-4 testselect1" id="company_id2"');?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" id="OthersCompany2"  style="display:none">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="others_company2"><?php echo display('companyname');?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix">
                                                <input type="text" id="others_company2" name="others_company[]" placeholder="<?php echo display('companyname');?>" class="col-xs-12 col-sm-4 form-control">
                                            </div>
                                         </div>
                                    </div>
                                    <!-- #ends of company type# -->

                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="rate2"><?php echo display('ratecontactrate');?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix">
                                                <input type="text" id="rate2" name="rent[]" placeholder="Rate" class="col-xs-12 col-sm-4 form-control" id="imp_rate"  data-provide="" data-items="4" data-source='[]'>
                                            </div>
                                         </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="fare_rent2"><?php echo display('farerate');?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix">
                                                <input type="text" id="fare_rent2" name="fare_rent[]" placeholder="Fare Rate" class="col-xs-12 col-sm-4 form-control" id="imp_rate"  data-provide="" data-items="4" data-source='[]'>
                                            </div>
                                         </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="advanced2"><?php echo display('advance');?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix">
                                                <input type="text" id="advanced2" name="advance[]" placeholder="Advance if have" class="col-xs-12 col-sm-4 form-control" id="imp_rate"  data-provide="" data-items="4" data-source='[]'>
                                            </div>
                                         </div>
                                    </div>

                                    <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="city_start_2"><?php echo display('startpoint');?></label>
                                    <div class="col-xs-12 col-sm-9">     
                                        <div class="row">
                                             <div class="col-xs-12 col-sm-5">
                                                <div class="clearfix"  style="width: 106%;">
                                                    <select id="city_start_2" name="start_dist_id[]" class="testselect1">
                                                        <option value=""> <?php echo display('selectstate');?> </option>
                                                        <?php foreach ($state_info as $value) { ?>
                                                            <option value="<?php echo $value->state_id; ?>"><?php echo $value->state_name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                             </div>
                                            <div class="col-xs-12 col-sm-5">
                                                <div class="clearfix"  style="width: 106%;"> 
                                                    <select name="start_point[]" class="form-control">
                                                        <option value=""><?php echo display('selectstation');?></option>
                                                        <optgroup id="start_point_2"></optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                </div>  

                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="city_end_2"><?php echo display('endpoint');?></label>
                                    <div class="col-xs-12 col-sm-9">    
                                     <div class="row">
                                             <div class="col-xs-12 col-sm-5">
                                                  <div class="clearfix"  style="width: 106%;">
                                                      <select id="city_end_2" name="end_dist_id[]" class="testselect1">
                                                            <option value=""><?php echo display('selectstate');?></option>
                                                            <?php foreach ($state_info as $value) { ?>
                                                                <option value="<?php echo $value->state_id; ?>"><?php echo $value->state_name; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                             </div>
                                            <div class="col-xs-12 col-sm-5">
                                                 <div class="clearfix"  style="width: 106%;">
                                                     <select name="end_point[]" class="form-control">
                                                        <option value=""><?php echo display('selectstation');?></option>
                                                        <optgroup id="end_point_2"></optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            <!-- ---------------------------------------------
                                ------------ENDS  OF IMPORT BOX-----------------
                                ------------------------------------------------ -->
 
                                <div  id="trip_expense_list"> <legend><?php echo display('tripexpense');?>  </legend>
                                    <table class="table table-striped table-bordered responsive">
                                        <thead>
                                            <tr>
                                                <th> <?php echo display('particular');?></th>
                                                <th><center><?php echo display('expensegroup');?></center></th> 
                                                <th><center><?php echo display('quantity');?></center></th>    
                                                <th><center><?php echo display('amount');?></center></th>  
                                                <th><center><?php echo display('total');?></center></th>
											
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                    <?php 
                                        $sl = 1;
                                        foreach ($expense as $value) {
                                        echo "<tr>";
                                        echo "<td>";
                                        echo "<label>$value->expense_name</label>";  
                                        echo "<input type=\"hidden\" name=\"expense_id[]\"  value=\"$value->expense_id\"  />";                 
                                        echo "</td>";
                                            echo "<td>";
                                                if($value->expense_group == 1){echo "Regular";}
                                                echo "<input type=\"hidden\" name=\"expense_group[]\"  value=\"$value->expense_group\"  />";
                                            echo "</td>";
                                        echo "<td><center><input type=\"text\" name=\"qty[]\" placeholder=\"Quantity\" class=\"span6  amount_edit\" id=".'quantity_'.$sl."></td>";
                                        echo "<td><center><input type=\"text\" name=\"price[]\" placeholder=\"Amount\" class=\"span6  amount_edit\" id=".'amount_'.$sl." ></center></td>";                                                                                      
                                        echo "<td><center id=".'total_'.$sl." name=\"total[]\"></center></td>";                                                                                      
                                        echo "</tr>";
                                        $sl++;
                                        } //ends of foreach
                                    ?>
                                            </tr> 
                                        </tbody>
                                    </table>

                                </div>

                                <br/>
                                <div class="form-group row">
                                    <div class="col-md-offset-1 col-md-9" style="margin-left: 35%;">
                                        <button class="btn btn-danger w-md m-b-5"><?php echo display('cancel'); ?></button>
                                        <button type="submit" class="btn btn-primary w-md m-b-5"><i class="fa fa-plus"></i> <?php echo display('save'); ?></button>
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




<script type="text/javascript">
$(document).ready(function(){
    $("#company_option").on('change',function(){
        var x = $(this).val();
        if(x==1){
            $("#contact_company").show();  
            $("#OthersCompany").hide();
            $("#others_company").val(''); 
        }else if(x==2){
            $("#OthersCompany").show(); 
            $("#contact_company").hide(); 
            $("#company_id").val('');
        }else{  
            $("#contact_company").hide(); 
            $("#OthersCompany").hide();
            $("#others_company").val(''); 
            $("#company_id").val(''); 
        } 
    });

    $("#company_option2").on('change',function(){
        var x = $(this).val(); 
        if(x==1){
            $("#contact_company2").show();
            $("#OthersCompany2").hide(); 
            $("#others_company").val('');
        }else if(x==2){
            $("#OthersCompany2").show();
            $("#contact_company2").hide(); 
            $("#company_id2").val('');
        }else{
            $("#contact_company2").hide();
            $("#OthersCompany2").hide(); 
            $("#company_id2").val('');
        }
    });
});
</script>











