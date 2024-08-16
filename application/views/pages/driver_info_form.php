<div class="col-sm-12">
    <div class="panel panel-bd lobidrag">
        <div class="panel-heading">
            <div class="panel-title">
                <h4> 
                    <?php
                    if (!empty($informations->driver_id)) {
                        echo display('driverinformationupdate');
                    } else {
                        echo display('adddriverinformation');
                    }
                    ?>
                </h4>
            </div>
        </div>
        
      <?php
      if ($this->session->flashdata('error')) {
            echo "<div class=\"alert alert-danger\" role=\"alert\">" . $this->session->flashdata('error') . "</div>";
       }
      ?>
        <?php echo form_open_multipart('driver_info/save', array("class" => 'form-horizontal', 'id' => 'notice-submit')); ?>
        <div class="panel-body">           
           <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="driver_name"><?php echo display('drivername'); ?>&nbsp;&nbsp;<span class="fa fa-asterisk red" style="color:red;"></span></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" name="driver_name" id="driver_name"  placeholder="<?php echo display('drivername'); ?>" class="col-xs-12 col-sm-4 form-control"  value="<?php echo set_value('driver_name', $informations->driver_name); ?>" />
                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('driver_name'); ?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="d_mobile"><?php echo display('mobilenumber'); ?>&nbsp;&nbsp;<span class="fa fa-asterisk red" style="color:red;"></span></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" name="d_mobile" id="d_mobile"  placeholder="<?php echo display('mobilenumber'); ?>"class="col-xs-12 col-sm-4 form-control"  value="<?php echo set_value('d_mobile', $informations->d_mobile); ?>" />
                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('d_mobile'); ?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="v_registration_no"><?php echo display('vehicleregistrationno'); ?>&nbsp;&nbsp;<span class="fa fa-asterisk red" style="color:red;"></span></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">  
                        <?php
                           echo form_dropdown('v_registration_no', $v_reg_no, set_value('v_registration_no', $informations->v_registration_no), 'class="col-xs-12 col-sm-4 testselect1"');
                        ?>
                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('v_registration_no'); ?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="d_license_no"><?php echo display('licensenumber'); ?>&nbsp;&nbsp;<span class="fa fa-asterisk red" style="color:red;"></span></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" name="d_license_no" id="d_license_no"  placeholder="<?php echo display('licensenumber'); ?>"class="col-xs-12 col-sm-4 form-control"  value="<?php echo set_value('d_license_no', $informations->d_license_no); ?>" />
                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('d_license_no'); ?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="d_license_expire_date"><?php echo display('licenseexpiredate'); ?></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" name="d_license_expire_date" id="d_license_expire_date"  placeholder="<?php echo display('licenseexpiredate'); ?>"class="col-xs-12 col-sm-4 datepicker form-control"  value="<?php echo set_value('d_license_expire_date', $informations->d_license_expire_date); ?>" />

                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('d_license_expire_date'); ?></div>
                </div>
            </div>
            <!-- new -->
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="d_father_name"><?php echo display('fathername'); ?></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" name="d_father_name" id="d_father_name"  placeholder="<?php echo display('fathername'); ?>" class="col-xs-12 col-sm-4 form-control"  value="<?php echo set_value('d_father_name', $informations->d_father_name); ?>" />
                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('d_father_name'); ?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="d_mother_name"><?php echo display('mothername'); ?></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" name="d_mother_name" id="d_mother_name"  placeholder="<?php echo display('mothername'); ?>" class="col-xs-12 col-sm-4 form-control"  value="<?php echo set_value('d_mother_name', $informations->d_mother_name); ?>" />
                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('d_mother_name'); ?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="d_nid"><?php echo display('nid'); ?></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" name="d_nid" id="d_nid"  placeholder="<?php echo display('nid'); ?>" class="col-xs-12 col-sm-4 form-control"  value="<?php echo set_value('d_nid', $informations->d_nid); ?>" />
                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('d_nid'); ?></div>
                </div>
            </div>
            <!-- ends -->
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="d_address_present"><?php echo display('presentaddress'); ?></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <textarea class="col-xs-12 col-sm-4 form-control" id="d_address_present"  placeholder="<?php echo display('presentaddress'); ?>" name="d_address_present"  value=""><?php echo set_value('d_address_present', $informations->d_address_present); ?></textarea>
                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('d_address_present'); ?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="d_address_permanent"><?php echo display('permanentaddress'); ?>&nbsp;&nbsp;<span class="fa fa-asterisk red" style="color:red;"></span></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <textarea class="col-xs-12 col-sm-4 form-control" id="d_address_permanent"  placeholder="<?php echo display('permanentaddress'); ?>" name="d_address_permanent"  value=""><?php echo set_value('d_address_permanent', $informations->d_address_permanent); ?></textarea>
                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('d_address_permanent'); ?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="d_join_date"><?php echo display('joiningdate'); ?></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" name="d_join_date" id="d_join_date"  placeholder="<?php echo display('joiningdate'); ?>" class="col-xs-12 col-sm-4 datepicker form-control"  value="<?php echo set_value('d_join_date', $informations->d_join_date); ?>" />
                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('d_join_date'); ?></div>
                </div>
            </div> 
            <!-- starts of release date -->
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="d_release_date"><?php echo display('releasedate'); ?></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" name="d_release_date" id="d_release_date"  placeholder="<?php echo display('releasedate'); ?>" class="col-xs-12 col-sm-4 datepicker form-control"  value="<?php echo set_value('d_release_date', $informations->d_release_date); ?>" />
                    </div> 
                    <div class="help-block" id="title-exists"><?php echo form_error('d_release_date'); ?></div>
                </div>
            </div> 
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="d_emergency_contact_person"><?php echo display('referenceperson'); ?></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" name="d_emergency_contact_person" id="v_fuel_rate"  placeholder="<?php echo display('referenceperson'); ?>" class="col-xs-12 col-sm-4 form-control"  value="<?php echo set_value('d_emergency_contact_person', $informations->d_emergency_contact_person); ?>" />
                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('d_emergency_contact_person'); ?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="d_emergency_cell"><?php echo display('cellnumber'); ?></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="text" name="d_emergency_cell" id="v_fuel_rate"  placeholder="<?php echo display('cellnumber'); ?>" class="col-xs-12 col-sm-4 form-control"  value="<?php echo set_value('d_emergency_cell', $informations->d_emergency_cell); ?>" />
                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('d_emergency_cell'); ?></div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="d_emergency_cell"><?php echo display('driverpicture'); ?></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="file" name="d_picture" id="v_fuel_rate"  class="col-xs-12 col-sm-4 form-control" />
                    </div> 
                </div>
            </div>
            <div class="form-group row">
                <label for="vehicle_type" class="col-sm-3 col-form-label"><?php echo display('inactive'); ?></label>
                <div class="col-sm-9">
                    <fieldset>
                        <div class="checkbox-circle">
                            <input name="active" type="radio" value="1" <?php echo set_radio('active', '1', TRUE); ?>>
                            <label for="checkbox7"><?php echo display('yes')?></label>

                            <input name="active" type="radio" value="0" <?php echo set_radio('active', '0'); ?>>
                            <label for="checkbox8"><?php echo display('no')?></label>
                        </div>

                    </fieldset>
                </div>
                <div class="help-block" id="title-exists"><?php echo form_error('active'); ?></div>
            </div> 
            <input type="hidden" name="driver_id" id="driver_id" value="<?php echo set_value('driver_id', $informations->driver_id); ?>"  />
            <div class="form-group row">
                <div class="col-md-offset-1 col-md-9" style="margin-left: 35%;">
                    <button class="btn btn-danger w-md m-b-5"><?php echo display('cancel'); ?></button>
                    <button type="submit" class="btn btn-primary w-md m-b-5"><i class="fa fa-plus"></i> <?php echo display('save'); ?></button>
                </div>
            </div>
        </div>
      <?php echo form_close(); ?>
    </div>
</div>

