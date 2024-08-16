<div class="row" style="background-color: white">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-blue widget-header-flat">                              
                <h4 class="widget-title lighter">
                    <?php echo display('updatelocaltripentry');?>
                </h4>
            </div>
            <hr>
            <div class="widget-body">
                <div class="widget-main">
                    <div class="step-content pos-rel" id="step-container">
                        <div class="step-pane active" id="step1">
                            <form class="form-horizontal" id="notice-submit" action="<?php echo base_url() . 'trip_local/edit'; ?>" method="post" >
                               <?php echo form_hidden('id',$trip_info->id);?>
                                <div class="form-group ">
                                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="trip_type"><?php echo display('triptype'); ?>&nbsp;&nbsp;<span class="fa fa-asterisk red"></span></label>
                                    <div class="col-xs-12 col-sm-9">
                                        <div class="clearfix">
                                        <?php
                                        $trip_type = array(1=>'Own Single',3=>'Hire Single',5=>'Rent Sigle');
                                        echo form_dropdown('trip_type',$trip_type,$trip_info->trip_type,'class="col-xs-12 col-sm-4 testselect1" id="trip_type"')
                                        ?>
                                        </div>                                      
                                        <div class="help-block" id="title-exists"><?php echo form_error('trip_type'); ?></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="import_export"><?php echo display('localtrip'); ?> &nbsp;&nbsp;<span class="fa fa-asterisk red"></span> </label>
                                    <div class="col-xs-12 col-sm-9">
                                        <div class="clearfix">
                                            <select id="import_export"  name="import_export" class="col-xs-12 col-sm-4 testselect1" >
                                                <option value="0"><?php echo display('local'); ?> </option>    
                                            </select>
                                        </div>
                                        <div class="help-block" id="title-exists"><?php echo form_error('import_export'); ?></div>
                                    </div>
                                </div>

                                <div class="form-group"> 
                                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="driver_id"><?php echo display('drivername'); ?></label>
                                    <div class="col-xs-12 col-sm-9">
                                        <div class="clearfix"> 
                                            <?php echo form_dropdown('driver_id',$driver_info,$trip_info->driver_id,'class="col-xs-12 col-sm-4 testselect1"');?>
                                        </div>
                                    </div>
                                </div>

                                <!-- STARTS OF VEHICLE INFO -->
                                <div class="form-group" id="own_vehicle">
                                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="v_id"><?php echo display('vehicleregistrationno'); ?> </label>
                                    <div class="col-xs-12 col-sm-9">
                                        <div class="clearfix">
                                        <?php echo form_dropdown('v_id',$vehicle_info,$trip_info->v_id,'class="col-xs-12 col-sm-4 testselect1"');?>
                                        </div>
                                        <div class="help-block" id="title-exists"><?php echo form_error('v_id'); ?></div>
                                    </div>
                                </div>
                                <div class="form-group" id="hire_vehicle">
                                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="hire_v_id"><?php echo display('hirevehicleregno'); ?></label>
                                    <div class="col-xs-12 col-sm-9">
                                        <div class="clearfix">
                                            <input type="text" name="hire_v_id" value="<?php echo $trip_info->hire_v_id; ?>" placeholder="<?php echo display('hirevehicleregno'); ?>" class="col-xs-12 col-sm-4 form-control" id="hire_v_id" >
                                        </div>
                                     </div>
                                </div>
                                <!-- ENDS OF VEHICLE INFO -->

                                
                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="city_start"><?php echo display('startpoint'); ?></label>
                                    <div class="col-xs-12 col-sm-9">

                                          <div class="row">
                                            <div class="col-xs-12 col-sm-5">
                                                <div class="clearfix"  style="width:106%"> 
                                                <?php echo form_dropdown('start_dist_id',$state, $trip_info->start_dist_id,'id="city_start" class="testselect1"');?>
                                                 </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-5">
                                                <div class="clearfix"  style="width:106%">
                                                   <select name="start_point" class="form-control">
                                                        <option value="<?php echo $trip_info->start_station_id; ?>"><?php echo display('selectstation'); ?></option>
                                                        <optgroup id="start_point"></optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                          </div>
                                     </div>
                                </div>



                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="city_end"><?php echo display('endpoint'); ?></label>
                                    <div class="col-xs-12 col-sm-9">
                                     <div class="row">
                                            <div class="col-xs-12 col-sm-5">
                                                 <div class="clearfix" style="width:106%">
                                                     <?php echo form_dropdown('end_dist_id', $state, $trip_info->start_dist_id,'id="city_end" class="testselect1"');?>
 
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-5">
                                                <div class="clearfix" style="width:106%">
                                                    <select name="end_point" class="form-control"> 
                                                        <option value="<?php echo $trip_info->end_station_id; ?>"><?php echo display('selectstation'); ?></option>
                                                        <optgroup id="end_point"></optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                     </div>
                                    </div>
                                </div> 

                                <div class="export box" id="export_box">
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for=""><?php echo display('date'); ?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix"> 
                                                <input type="text" name="trip_date" class="col-xs-12 col-sm-4 datepicker form-control" value="<?php echo date('d-m-Y',strtotime($trip_info->date)); ?>">
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="company_option"><?php echo display('selectanoption'); ?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix"> 
                                            <select class="col-xs-12 col-sm-4 testselect1" id="company_option">
                                                <option><?php echo display('selectanoption'); ?></option>
                                                <option value="1"><?php echo display('contactcompany'); ?></option>
                                                <option value="2"><?php echo display('otherscompany'); ?></option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- #company type# -->
                                    <div class="form-group"  id="contact_company"  style="display:none">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="company_id"><?php echo display('companyname'); ?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix"> 
                                                <?php echo form_dropdown('company_id',$company_info,$trip_info->company_id,'class="col-xs-12 col-sm-4 testselect1"');?>
                                            </div>
                                        </div>
                                    </div>                                    

                                    <div class="form-group" id="OthersCompany"  style="display:none">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="others_company"><?php echo display('othercompany'); ?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix">
                                                <input type="text" id="others_company" name="others_company" value="<?php echo $trip_info->others_company ?>" placeholder="<?php echo display('othercompany'); ?>" class="col-xs-12 col-sm-4 form-control">
                                            </div>
                                         </div>
                                    </div>
                                    <!-- #ends of company type# --> 


                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="imp_rate"><?php echo display('contactrent'); ?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix">
                                                <input type="text" name="rent"  value="<?php echo $trip_info->rent ?>"  placeholder="<?php echo display('contactrent'); ?>" class="col-xs-12 col-sm-4 form-control">
                                            </div>
                                         </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="fare_rent"><?php echo display('farerent'); ?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix">
                                                <input type="text" id="fare_rent" name="fare_rent" value="<?php echo $trip_info->fare_rent; ?>" placeholder="<?php echo display('farerent'); ?>" class="col-xs-12 col-sm-4 form-control">
                                            </div>
                                         </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="imp_rate"><?php echo display('advance'); ?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix">
                                                <input type="text" name="advance" value="<?php echo $trip_info->advance; ?>" placeholder="<?php echo display('advance'); ?>" class="col-xs-12 col-sm-4 form-control" >
                                            </div>
                                         </div>
                                    </div>

                                </div> 

                                <div>
                                <legend><?php echo display('tripexpense'); ?> </legend>
                                    <table class="table table-striped table-bordered responsive">
                                        <thead>
                                            <tr>
                                                <th><?php echo display('particular'); ?> </th>
                                                <th><center><?php echo display('expensegroup'); ?></center></th> 
                                                <th><center><?php echo display('quanity'); ?></center></th>    
                                                <th><center><?php echo display('amount'); ?></center></th>  
                                                <th><center><?php echo display('total'); ?></center></th>
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
                                        echo "<input type=\"hidden\" name=\"expense_group[]\"  value=\"$value->expense_group\"  />";
                                        echo "<input type=\"hidden\" name=\"transection_id[]\"  value=\"$value->transection_id\"  />";        
                                        echo "</td>";
                                            echo "<td>";
                                                if($value->expense_group == 1){echo "Regular";}
                                            echo "</td>";
                                        echo "<td><center><input type=\"text\" name=\"qty[]\" value=\"$value->quantity\" placeholder=\"Quantity\" class=\"span6 typeahead amount_edit\" id=".'quantity_'.$sl."></td>";
                                        echo "<td><center><input type=\"text\" name=\"price[]\" value=\"$value->amount\" placeholder=\"Amount\" class=\"span6 typeahead amount_edit\" id=".'amount_'.$sl." ></center></td>";                                                                                      
                                        echo "<td><center id=".'total_'.$sl." name=\"total[]\"></center></td>";                                                                                      
                                        echo "</tr>";
                                        $sl++;
                                        } //ends of foreach
                                    ?>
                                            </tr> 
                                        </tbody>
                                    </table>

                                </div>

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
    // var c = '<?php if(isset($trip_info->others_company)) echo $trip_info->others_company; ?>';
    // if(c){
    //     $("#contact_company").show(); 
    // }else{
    //     $("#others_company").show(); 
    // }

    var t = '<?php if(isset($trip_info->trip_type)) echo $trip_info->trip_type; ?>';
    if(t == 3){
        $("#hire_vehicle").show();
    }else if(t==1 || t==5){
        $("#own_vehicle").show();
    }
    
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
});
</script>