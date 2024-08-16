<div class="col-sm-12">
    <div class="panel panel-bd lobidrag">
        <div class="panel-heading">
            <div class="panel-title">
                <h4><?php echo display('setting'); ?> </h4>
            </div>
        </div>
        <?php
            if ($this->session->flashdata('success')) {
                  echo "<div class=\"alert alert-success\" role=\"alert\">" . $this->session->flashdata('success') . "</div>";
             }
        ?>
        <form class="form-horizontal" id="notice-submit" action="<?php echo base_url() . 'setting/update'; ?>" method="post" >
            <div class="panel-body">           
                <div class="form-group ">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="trip_type"><?php echo display('selectanoption'); ?>&nbsp;&nbsp;<span class="fa fa-asterisk red" style="color:red;"></span></label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <select id="trip_type" name="values" class="col-xs-12 col-sm-4 testselect1">
                                <option value=" "><?php echo display('selectanoption'); ?></option>
                                <option value="1"><?php echo display('ltr');?></option>
                                <option value="2"><?php echo display('rtr');?></option> 
                            </select>
                        </div>                                      
                    </div>
                </div>
                <div class="form-group" align="center">
                    <?php
                    foreach ($setting_id as $setting_iddata) {
                        ?>
                        <input type="hidden" name="id" id="company_id" value="<?php echo $setting_iddata->id; ?>"/>
                        <?php
                    }
                    ?>   
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

