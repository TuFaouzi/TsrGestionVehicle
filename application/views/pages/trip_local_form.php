<div class="col-sm-12">
    <div class="panel panel-bd lobidrag">
        <div class="panel-heading">
            <div class="panel-title">
                <h4> 
                    <?php echo display('createlocaltripentry'); ?>
                </h4>
            </div>
        </div>

        <?php if ($this->session->flashdata('message')): ?>                 
            <div class="alert alert-success"><?php echo $this->session->flashdata('message'); ?></div>
        <?php elseif ($this->session->flashdata('exception')): ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('exception'); ?></div>
        <?php endif; ?>

        <form class="form-horizontal" id="notice-submit" action="<?php echo base_url() . 'trip_local/create'; ?>" method="post" >
                                <?php echo form_hidden('id', $trip_info->id, '', ''); ?>
            <div class="panel-body">           
                <div class="form-group ">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="trip_type"><?php echo display('triptype'); ?>&nbsp;&nbsp;<span class="fa fa-asterisk red" style="color:red;"></span></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <select id="trip_type" name="trip_type" class="col-xs-12 col-sm-4 testselect1">
                                <option value=" "><?php echo display('selectanoption');?></option>
                                <option value="1"><?php echo display('ownsingle');?></option>
                                <option value="3"><?php echo display('hiresingle');?></option>
                                <option value="5"><?php echo display('rentsingle');?></option>
                            </select>
                        </div>                                      
                        <div class="help-block" id="title-exists"><?php echo form_error('trip_type'); ?></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="import_export"><?php echo display('localtrip'); ?> &nbsp;&nbsp;<span class="fa fa-asterisk red" style="color:red;"></span> </label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <select id="import_export"  name="import_export" class="col-xs-12 col-sm-4 testselect1" >
                                <option value="" ><?php echo display('selectanoption');?></option>
                                <option value="0"><?php echo display('local');?></option> 	
                            </select>
                        </div>
                        <div class="help-block" id="title-exists"><?php echo form_error('import_export'); ?></div>
                    </div>
                </div>

                <div class="form-group"> 
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="driver_id"><?php echo display('drivername'); ?></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix"> 
                            <?php echo form_dropdown('driver_id', $driver_info, $trip_info->driver_id, 'class="col-xs-12 col-sm-4 testselect1"'); ?>
                        </div>
                    </div>
                </div>

                <!-- STARTS OF VEHICLE INFO -->
                <div class="form-group" id="own_vehicle">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="driver_id"><?php echo display('vehicleregistrationno'); ?> </label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <?php echo form_dropdown('v_id', $vehicle_info, $trip_info->v_id, 'class="col-xs-12 col-sm-4 testselect1"'); ?>
                        </div>
                        <div class="help-block" id="title-exists"><?php echo form_error('v_id'); ?></div>
                    </div>
                </div>
                <div class="form-group" id="hire_vehicle">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="hire_v_id"><?php echo display('hirevehicleregno');?></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <input type="text" name="hire_v_id" value="<?php echo $trip_info->hire_v_id; ?>" placeholder="<?php echo display('hirevehicleregno');?>" class="form-control" id="hire_v_id" >
                        </div>
                    </div>
                </div>
                <!-- ENDS OF VEHICLE INFO -->

                <!-- trip destination -->
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="city_start"><?php echo display('startpoint'); ?></label>
                    <div class="col-xs-12 col-sm-9"> 
                        <div class="row">
                            <div class="col-xs-12 col-sm-5">
                                <div class="clearfix" style="width: 106%;">
                                    <select class="testselect1" id="city_start" name="start_dist_id">
                                        <option value=""><?php echo display('selectdistrict'); ?></option>
                                        <?php foreach ($state_info as $state) { ?>
                                            <option value="<?php echo $state->state_id; ?>"><?php echo $state->state_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>  
                            </div>
                            <div class="col-xs-12 col-sm-5">
                                <div class="clearfix" style="width: 106%;">
                                    <select class="form-control" name="start_point">
                                        <option value=""><?php echo display('selectstation'); ?></option>
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
                                <div class="clearfix" style="width: 106%;">
                                    <select class="testselect1" id="city_end" name="end_dist_id">
                                        <option value=""><?php echo display('selectdistrict'); ?></option>
                                        <?php foreach ($state_info as $state) { ?>
                                            <option value="<?php echo $state->state_id; ?>"><?php echo $state->state_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>  
                            </div>
                            <div class="col-xs-12 col-sm-5">
                                <div class="clearfix" style="width: 106%;">
                                    <select class="form-control" name="end_point">
                                        <option value=""><?php echo display('selectstation'); ?></option>
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
                                <input type="text" name="trip_date" class="form-control datepicker" value="<?php echo date("d-m-Y"); ?>">
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
                                <?php echo form_dropdown('company_id', $company_info, $trip_info->company_id, 'class="col-xs-12 col-sm-4 testselect1"'); ?>
                            </div>
                        </div>
                    </div>                                    

                    <div class="form-group" id="OthersCompany"  style="display:none">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="others_company"><?php echo display('othercompany'); ?></label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="text" id="others_company" name="others_company" value="<?php echo $trip_info->others_company ?>" placeholder="<?php echo display('othercompany'); ?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <!-- #ends of company type# --> 


                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="imp_rate"><?php echo display('contactrent'); ?></label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="text" name="rent"  value="<?php echo $trip_info->rent ?>"  placeholder="<?php echo display('contactrent'); ?>" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="fare_rent"><?php echo display('farerent'); ?></label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="text" id="fare_rent" name="fare_rent" value="<?php echo $trip_info->fare_rent; ?>" placeholder="<?php echo display('farerent'); ?>" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="imp_rate"><?php echo display('advance'); ?></label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="text" name="advance" value="<?php echo $trip_info->advance; ?>" placeholder="<?php echo display('advance'); ?>" class="form-control" >
                            </div>
                        </div>
                    </div>

                </div> 

                <div id="trip_expense_list"> <legend><?php echo display('tripexpens');?></legend>
                    <hr>
                    <table class="table table-striped table-bordered responsive">
                        <thead>
                            <tr>
                                <th><?php echo display('particular'); ?> </th>
                                <th><center><?php echo display('expensegroup'); ?></center></th> 
                                <th><center><?php echo display('quanity'); ?> </center></th>    
                                <th><center><?php echo display('amount'); ?> </center></th>  
                               <th><center><?php echo display('total'); ?> </center></th>
                           </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sl = 1;
                            foreach ($expense as $value) {
                                echo "<tr>";
                                echo "<td>";
                                echo "<label>$value->expense_name</label>";
                                echo "<input type=\"hidden\" name=\"expense_id[]\"  value=\"$value->expense_id\"  />";
                                echo "</td>";
                                echo "<td>";
                                if ($value->expense_group == 1) {
                                    echo "Regular";
                                }
                                echo "<input type=\"hidden\" name=\"expense_group[]\"  value=\"$value->expense_group\"  />";
                                echo "</td>";
                                echo "<td><center><input type=\"text\" name=\"qty[]\" placeholder=\"Quantity\" class=\"span6 typeahead amount_edit\" id=" . 'quantity_' . $sl . "></td>";
                                echo "<td><center><input type=\"text\" name=\"price[]\" placeholder=\"Amount\" class=\"span6 typeahead amount_edit\" id=" . 'amount_' . $sl . " ></center></td>";
                                echo "<td><center id=" . 'total_' . $sl . " name=\"total[]\"></center></td>";
                                echo "</tr>";
                                $sl++;
                            } //ends of foreach
                            ?>
                        </tbody>
                    </table>
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

<script type="text/javascript">
    $(document).ready(function () {
        var c = '<?php if (isset($trip_info->others_company)) echo $trip_info->others_company; ?>';
        if (c) {
            $("#contact_company").show();
        } else {
            $("#others_company").show();
        }


        $("#company_option").on('change', function () {
            var x = $(this).val();
            if (x == 1) {
                $("#contact_company").show();
                $("#OthersCompany").hide();
                $("#others_company").val('');
            } else if (x == 2) {
                $("#OthersCompany").show();
                $("#contact_company").hide();
                $("#company_id").val('');
            } else {
                $("#contact_company").hide();
                $("#OthersCompany").hide();
                $("#others_company").val('');
                $("#company_id").val('');
            }
        });
    });
</script>
