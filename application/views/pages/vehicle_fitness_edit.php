<div class="row" style="border: 1px solid gainsboro;background-color: white;">
    <div class="col-xs-12">
        <div class="panel-body">
            <div class="table-header">
                <i class="fa fa-list"></i>
                <?php echo display('vehicalfitness'); ?> 
            </div>
            <hr>
        </div>
        <br/>
        <div>
            <table  class="table table-striped table-bordered table-hover">
                <form name="vehicle_fitness_form" class="form-horizontal" id="notice-submit" action="<?php echo base_url() . 'vehicle/vehicle_fitness_save'; ?>" method="post" >
                    <thead>
                        <tr>
                            <th class="center">
                                <?php echo display('particular'); ?>
                            </th>
                            <th class="center">
                                <?php echo display('issuedate'); ?>
                            </th >
                            <th class="center">
                                <?php echo display('expiredate'); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="3">
                                <div class="form-group center">
                                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="v_id"><?php echo display('vehicleregistrationno'); ?>&nbsp;&nbsp;<span class="fa fa-asterisk red" style="color:red;"></span> </label>
                                    <div class="col-xs-12 col-sm-9">
                                        <div class="clearfix" >
                                            <?php echo form_dropdown('v_id', $v_id, set_value('v_id', $vehicle_fitnes->v_id), 'id="v_id" required="required" class="form-control"'); ?>
                                            <?php echo form_error('v_id'); ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <div class="form-group center">
                                    <label class="control-label col-xs-12 col-sm-12 no-padding-right" for="datepicker"><?php echo display('registration'); ?></label>								
                                </div>
                            </td>
                            <td>										
                                <div class="clearfix col-xs-12">
                                    <input type="text" name="reg_issue" id=""  placeholder="<?php echo display('registrationdate');?>" class="col-xs-12 datepicker form-control"  value="<?php echo set_value('reg_issue', date('d-m-Y', strtotime($vehicle_fitnes->reg_issue))); ?>" />
                                </div>										
                            </td>
                            <td>										
                                <div class="clearfix col-xs-12">
                                    <input type="text" name="reg_expire" id=""  placeholder="<?php echo display('registrationdate');?>" class="col-xs-12 datepicker form-control" value="<?php echo set_value('reg_expire', date('d-m-Y', strtotime($vehicle_fitnes->reg_expire))); ?>"/>
                                </div>								
                            </td>
                        </tr>
                        <tr>								
                            <td >
                                <div class="form-group center">
                                    <label class="control-label col-xs-12 col-sm-12 no-padding-right" for="datepicker"><?php echo display('fitness'); ?></label>								
                                </div>
                            </td>
                            <td>										
                                <div class="clearfix col-xs-12 ">
                                    <input type="text" name="fitness_issue" id=""  placeholder="<?php echo display('fitnessdate');?>" class="col-xs-12 datepicker form-control" value="<?php echo set_value('fitness_issue', date('d-m-Y', strtotime($vehicle_fitnes->fitness_issue))); ?>"/>							
                                </div>										
                            </td>
                            <td>										
                                <div class="clearfix col-xs-12">
                                    <input type="text" name="fitness_expire" id=""  placeholder="<?php echo display('fitnessdate');?>" class="col-xs-12 datepicker form-control" value="<?php echo set_value('fitness_expire', date('d-m-Y', strtotime($vehicle_fitnes->fitness_expire))); ?>"/>										
                                </div>										
                            </td>
                        </tr>
                        <tr>								
                            <td >
                                <div class="form-group center">
                                    <label class="control-label col-xs-12 col-sm-12 no-padding-right" for=""><?php echo display('insurance'); ?></label>								
                                </div>									
                            </td>
                            <td>								
                                <div class="clearfix col-xs-12 ">
                                    <input type="text" name="insurance_issue" id=""  placeholder="<?php echo display('insurancedate');?>" class="col-xs-12 datepicker form-control" value="<?php echo set_value('insurance_issue', date('d-m-Y', strtotime($vehicle_fitnes->insurance_issue))); ?>"/>																		
                                </div>
                            </td>
                            <td>										
                                <div class="clearfix col-xs-12">
                                    <input type="text" name="insurance_expire" id=""  placeholder="<?php echo display('insurancedate');?>" class="col-xs-12  datepicker form-control" value="<?php echo set_value('insurance_expire', date('d-m-Y', strtotime($vehicle_fitnes->insurance_expire))); ?>"/>										
                                </div>									
                            </td>
                        </tr>
                        <tr>								
                            <td>
                                <div class="form-group center">
                                    <label class="control-label col-xs-12 col-sm-12 no-padding-right" for="datepicker"><?php echo display('taxtoken'); ?></label>								
                                </div>									
                            </td>
                            <td>								
                                <div class="clearfix col-xs-12 ">
                                    <input type="text" name="tax_issue" id=""  placeholder="<?php echo display('taxtokendate');?>" class="col-xs-12 datepicker form-control" value="<?php echo set_value('tax_issue', date('d-m-Y', strtotime($vehicle_fitnes->tax_issue))); ?>"/>																		
                                </div>
                            </td>
                            <td>										
                                <div class="clearfix col-xs-12">
                                    <input type="text" name="tax_expire" id=""  placeholder="<?php echo display('taxtokendate');?>" class="col-xs-12 datepicker form-control" value="<?php echo set_value('tax_expire', date('d-m-Y', strtotime($vehicle_fitnes->tax_expire))); ?>"/>										
                                </div>									
                            </td>
                        </tr>
                        <tr>								
                            <td >
                                <div class="form-group center">
                                    <label class="control-label col-xs-12 col-sm-12 no-padding-right" for="datepicker"><?php echo display('rootpermit'); ?></label>								
                                </div>									
                            </td>
                            <td>								
                                <div class="clearfix col-xs-12 ">
                                    <input type="text" name="root_permit_issue" id=""  placeholder="<?php echo display('rootpermitdate');?>" class="col-xs-12 datepicker form-control" value="<?php echo set_value('root_permit_issue', date('d-m-Y', strtotime($vehicle_fitnes->root_permit_issue))); ?>"/>																		
                                </div>
                            </td>
                            <td>										
                                <div class="clearfix col-xs-12">
                                    <input type="text" name="root_permit_expire" id=""  placeholder="<?php echo display('rootpermitdate');?>" class="col-xs-12 datepicker form-control" value="<?php echo set_value('root_permit_expire', date('d-m-Y', strtotime($vehicle_fitnes->root_permit_expire))); ?>"/>										
                                </div>									
                            </td>
                        </tr>
                        <tr>
                            <td >
                                <div class="form-group center">
                                    <label class="control-label col-xs-12 col-sm-12 no-padding-right" ><?php echo display('fuel'); ?></label>								
                                </div>									
                            </td> 
                        </tr>
                        <tr> 
                            <td colspan="3">
                                <div class="form-group" align="center">
                                    <div class="col-md-offset-1 col-md-9"> 
                                        <div class="clearfix">
                                            Is Active &nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php echo display('yes')?> <input type="radio" name="active" id="active" value="1" <?php echo set_radio('active', '1', TRUE); ?>>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php echo display('no')?><input type="radio" name="active" id="active" value="0" <?php echo set_radio('active', '0'); ?>> 
                                        </div> 
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr> 
                            <td colspan="3">
                                <div class="col-md-offset-1 col-md-9" style="margin-left: 35%;">
                                    <button class="btn btn-danger w-md m-b-5"><?php echo display('cancel'); ?></button>
                                    <button  type="submit"  class="btn btn-primary w-md m-b-5"><i class="fa fa-plus"></i> <?php echo display('save'); ?></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <input type="hidden" name="v_fitness_id" id="v_fitness_id" value="<?php echo set_value('v_fitness_id', $vehicle_fitnes->v_fitness_id); ?>"  />
                </form>
            </table>
        </div>
    </div>
</div>
