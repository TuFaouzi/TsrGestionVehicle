<div class="row">
 <div class="panel-body">
    <div class="col-xs-12" id="PrintArea" style="background: white;border: 1px solid gainsboro;">
       <div class="panel-heading">
            <div class="panel-title">
                <h4>
                    <i class="fa fa-list"></i>
                    <?php echo display('driverinformation'); ?> 
                </h4>
            </div>
            <hr>
        </div>
        <br/><br/>
        <div class="col-xs-12 col-sm-10 col-md-10 col-sm-offset-1 col-md-offset-1"> 
            <div class="col-sm-6 col-md-3">
                <img src="<?php echo base_url() . 'assets/driver/' . $informations->d_picture; ?>" alt="" class="img-rounded img-responsive">
            </div>
            <div class="col-sm-6 col-md-9">
                <h4><?php echo display('drivername') . " - " . $informations->driver_name; ?></h4> 
                <p>   
                    <?php echo display('mobileno'); ?>&nbsp;&nbsp; - &nbsp;&nbsp;<?php echo $informations->d_mobile; ?><br/>
                    <?php echo display('vehicleregistrationno'); ?>&nbsp;&nbsp; - &nbsp;&nbsp;<?php echo $informations->v_reg; ?><br/>
                    <?php echo display('licensenumber'); ?>&nbsp;&nbsp; - &nbsp;&nbsp;<?php echo $informations->d_license_no; ?><br/>
                    <?php echo display('licenseexpiredate'); ?>&nbsp;&nbsp; - &nbsp;&nbsp;<?php echo date('d-m-Y', strtotime($informations->d_license_expire_date)); ?><br/>
                    <?php echo display('fathername'); ?>&nbsp;&nbsp; - &nbsp;&nbsp;<?php echo $informations->d_father_name; ?><br/>
                    <?php echo display('mothername'); ?>&nbsp;&nbsp; - &nbsp;&nbsp;<?php echo $informations->d_mother_name; ?><br/>
                    <?php echo display('nid'); ?>&nbsp;&nbsp; - &nbsp;&nbsp;<?php echo $informations->d_nid; ?><br/>
                    <?php echo display('presentaddress'); ?>&nbsp;&nbsp; - &nbsp;&nbsp;<?php echo $informations->d_address_present; ?><br/>
                    <?php echo display('permanentaddress'); ?>&nbsp;&nbsp; - &nbsp;&nbsp;<?php echo $informations->d_address_permanent; ?><br/>
                    <?php echo display('joiningdate'); ?>&nbsp;&nbsp; - &nbsp;&nbsp;<?php echo date('d-m-Y', strtotime($informations->d_join_date)); ?><br/>
                    <?php echo display('releasedate'); ?>&nbsp;&nbsp; - &nbsp;&nbsp;<?php echo date('d-m-Y', strtotime($informations->d_release_date)); ?><br/>
                    <?php echo display('referenceperson'); ?>&nbsp;&nbsp; - &nbsp;&nbsp;<?php echo $informations->d_emergency_contact_person; ?><br/>
                    <?php echo display('referencecellnumber'); ?>&nbsp;&nbsp; - &nbsp;&nbsp;<?php echo $informations->d_emergency_cell; ?>  
                </p>
            </div> 
        </div>
    </div><!-- /.col -->
    </div><!-- /.col -->

    <div class="col-xs-12 no-print">
        <br/> 
        <a class="btn btn-sm btn-primary pull-right" onclick="printContent('PrintArea')">
            <span class="fa fa-print" ></span>&nbsp;&nbsp;<?php echo display('print'); ?>
        </a>     
    </div>

</div><!-- /.row -->
<!-- PAGE CONTENT ENDS -->