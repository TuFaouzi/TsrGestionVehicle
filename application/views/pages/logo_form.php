<div class="col-sm-12">
    <div class="panel panel-bd lobidrag">
        <div class="panel-heading">
            <div class="panel-title">
                <h4> 
                    <?php echo display('updatelogo');?>
                </h4>
            </div>
        </div>
        
        <?php
          if($this->session->flashdata('success')){
            echo "<div class=\"alert alert-success\" id=\"successMessage\" role=\"alert\">" . $this->session->flashdata('success') . "</div>";
          }
        ?>
        <?php
          if($this->session->flashdata('error')){
            echo "<div class=\"alert alert-danger\" id=\"successMessage\" role=\"alert\">" . $this->session->flashdata('error') . "</div>";
          }
        ?>
        
        <?php echo form_open_multipart('logo/update', array("class" => 'form-horizontal', 'id' => 'notice-submit')); ?>
        <div class="panel-body">        
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="d_emergency_cell"><?php echo display('logo'); ?></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="file" name="d_picture" id="v_fuel_rate"  class="col-xs-12 col-sm-4 form-control" />
                    </div> 
                     <img src="<?php echo base_url().'assets/logo/' . $logo[0]->d_picture; ?>" width="80" height="80"/> 
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="d_emergency_cell"><?php echo display('favicon'); ?></label>
                <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                        <input type="file" name="f_picture" id="v_fuel_rate"  class="col-xs-12 col-sm-4 form-control" />
                    </div> 
                    <img src="<?php echo base_url().'assets/logo/' . $logo[0]->f_picture; ?>" width="80" height="80"/> 
                </div>
            </div>
            <input name="logo_id" type="hidden" id="logo_id" value="<?php echo $logo[0]->logo_id;?>" />
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

