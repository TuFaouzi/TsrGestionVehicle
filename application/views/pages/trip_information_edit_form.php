<div class="row" style="background-color: white;">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-blue widget-header-flat">                            
                <h4 class="widget-title lighter">
                    <?php echo display('updatetripentry');?>
                </h4>
                <hr>
            </div>
            <div class="widget-body">
                <div class="widget-main">
                    <div class="step-content pos-rel" id="step-container">
                        <div class="step-pane active" id="step1">
                            <form class="form-horizontal" id="notice-submit" action="<?php echo base_url() . 'trip_information/save_edit'; ?>" method="post" >
                                <div class="col-md-12">
                                    <div class="col-md-8 col-md-offset-2">
                                        <dl class="dl-horizontal">
                                            <dt><?php echo display('triptype'); ?></dt>
                                            <dd>
                                                <?php
                                                    $trip_type = array(
                                                            '1' => display('ownsingle'),
                                                            '2' => display('owndouble'),
                                                            '3' => display('hiresingle'),
                                                            '4' => display('hiredouble'),
                                                            '5' => display('rentsingle'),
                                                            '6' => display('rentdouble')
                                                        );
                                                    echo $trip_type[$trip_info->trip_type];
                                                ?>
                                            </dd>
                                            <dt><?php echo display('exportimport'); ?></dt>
                                            <dd>
                                                <?php 
                                                    $export_import = array(
                                                            '0' => display('local'),
                                                            '1' => display('export'),
                                                            '2' => display('import'),
                                                            '3' => display('exportimport')
                                                        );
                                                    echo $export_import[$trip_info->import_export];
                                                ?>
                                            </dd>
                                            <dt><?php echo display('vehicleregistrationno'); ?></dt>
                                            <dd>
                                            <?php 
                                                if(!empty($trip_info->hire_v_id)){ 
                                                    echo $trip_info->hire_v_id;
                                                }else{
                                                    echo $trip_info->v_registration_no;
                                                }
                                            ?>
                                            </dd> 
                                        </dl>
                                    </div>
                                </div>
 
                                <input type="hidden" name="id" value="<?php echo $trip_info->id; ?>">
                                <input type="hidden" name="import_export" value="<?php echo $trip_info->import_export; ?>">
                                 

                                <div class="import box" id="import_box"><legend>  </legend>
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for=""><?php echo display('date'); ?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix"> 
                                                <input type="text" name="trip_date" class="col-xs-12 col-sm-4 form-control datepicker" value="<?php echo date('d-m-Y',strtotime($trip_info->date)); ?>">
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="form-group"> 
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="driver_id"><?php echo display('drivername'); ?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix"> 
                                                <?php echo form_dropdown('driver_id',$driver_info,set_value('driver_id',$trip_info->driver_id),'class="col-xs-12 col-sm-4 testselect1"');?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="company_id"><?php echo display('selectanoption'); ?></label>
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
                                                <?php echo form_dropdown('company_id',$company_info,set_value('company_id',$trip_info->company_id),'class="col-xs-12 col-sm-4 testselect"');?>
                                            </div>
                                        </div>
                                    </div>                                    

                                    <div class="form-group" id="OthersCompany"  style="display:none">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="others_company"><?php echo display('othercompany'); ?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix">
                                                <input type="text" id="others_company" name="others_company" placeholder="<?php echo display('othercompany'); ?>" class="col-xs-12 col-sm-4 form-control" value="<?php echo $trip_info->others_company?>">
                                            </div>
                                         </div>
                                    </div>
                                    <!-- #ends of company type# --> 


                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="imp_rate"><?php echo display('contactrent'); ?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix">
                                                <input type="text" name="rent"  value="<?php echo $trip_info->rent; ?>" placeholder="<?php echo display('contactrent'); ?>" class="col-xs-12 col-sm-4 form-control">
                                            </div>
                                         </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="fare_rent"><?php echo display('farerent'); ?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix">
                                                <input type="text" id="fare_rent" name="fare_rent"   value="<?php echo $trip_info->fare_rent; ?>" placeholder="<?php echo display('farerent'); ?>" class="col-xs-12 col-sm-4 form-control">
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





                                  






                                <div class="form-group">
                                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="city_start"><?php echo display('startpoint'); ?></label>
                                    <div class="col-xs-12 col-sm-9">

                                          <div class="row">
                                            <div class="col-xs-12 col-sm-5">
                                                <div class="clearfix"  style="width:106%"> 
                                                <?php echo form_dropdown('start_dist_id',$state, set_value('start_dist_id',$trip_info->start_dist_id),'class="testselect1" id="city_start_2"');?>
                                                 </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-5">
                                                <div class="clearfix"  style="width:106%">
                                                    <select name="start_point" class="form-control">
                                                        <option value="<?php echo $trip_info->start_station_id; ?>"><?php echo display('selectstation');?></option>
                                                        <optgroup id="start_point_2"></optgroup>
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
                                                    <?php echo form_dropdown('end_dist_id',$state, set_value('end_dist_id',$trip_info->end_dist_id),'class="testselect1" id="city_end_2"');?> 
                                                </div>

                                            </div>
                                            <div class="col-xs-12 col-sm-5">
                                                <div class="clearfix" style="width:106%">
                                                    <select name="end_point" class="form-control">
                                                        <option value="<?php echo $trip_info->end_station_id; ?>"><?php echo display('selectstation');?></option>
                                                        <optgroup id="end_point_2"></optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                     </div>
                                    </div>
                                </div>
                                </div>



 
                                <div> 
                                    <legend><?php echo display('tripexpense');?>  </legend>
                                    <table class="table table-striped table-bordered responsive">
                                        <thead>
                                            <tr>
                                                <th><?php echo display('particular');?> </th>
                                                <th><center><?php echo display('expensegroup');?> </center></th> 
                                                <th><center><?php echo display('quanity');?> </center></th>    
                                                <th><center><?php echo display('amount');?> </center></th>  
                                                <th><center><?php echo display('total');?> </center></th>
                                            
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
                                                echo "<input type=\"hidden\" name=\"transection_id[]\"  value=\"$value->transection_id\"  />";
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

                                <br/>

                                <div class="form-group" align="center">
                                    <div class="col-md-offset-1 col-md-9">
                                        <button class="btn btn-sm btn-info" type="submit">
                                            <i class="ace-icon fa fa-check"></i>
                                            <?php echo display('update'); ?>
                                        </button>
                                        &nbsp; &nbsp;
                                        <button class="cancel btn btn-sm" type="button">
                                            <i class="ace-icon fa fa-times"></i>
                                            <?php echo display('cancel'); ?>
                                        </button>
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
    // if(c == NULL){
    //     $("#contact_company").show(); 
    // }else{
    //     $("#others_company").show(); 
    // }



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
        $(window).reload();
    }); 
});
</script>