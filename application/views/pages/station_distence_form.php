<div class="col-sm-12">
    <div class="panel panel-bd lobidrag">
        <div class="panel-heading">
            <div class="panel-title">
                <h4>
                    <?php
                    if (!empty($distance_values->distance_id)) {
                        echo display('citytocitydistenceupdate');
                    } else {
                        echo display('citytocitydistencecreate');
                    }
                    ?>
                </h4>
            </div>
        </div>
        <form name="station_distence" class="form-horizontal"  action="<?php echo base_url() . 'station_distence/distence_save'; ?>" method="post" >
            <div class="panel-body">           
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="city_start"><?php echo display('startpoint'); ?></label>
                    <div class="col-xs-12 col-sm-9 ">     
                        <div class="row">
                            <div class="col-xs-12 col-sm-5">
                                <div class="clearfix" style="width: 106%;">
                                    <select id="city_start" class="testselect1">
                                        <option><?php echo display('selectstate');?> </option>
                                        <?php foreach ($city as $value) { ?>
                                            <option value="<?php echo $value->state_id; ?>"><?php echo $value->state_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>  
                            </div>
                            <div class="col-xs-12 col-sm-5">
                                <div class="clearfix" style="width: 106%;">
                                    <select name="start_point" class="form-control" id="start_point">
                                        <option><?php echo display('selectstate');?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="help-block" id="title-exists"><?php echo form_error('start_point'); ?></div>
                        </div> 
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="city_start"><?php echo display('endpoint'); ?></label>
                    <div class="col-xs-12 col-sm-9 ">     
                        <div class="row">
                            <div class="col-xs-12 col-sm-5">
                                <div class="clearfix" style="width: 106%;">
                                    <select id="city_end" class="testselect1">
                                        <option ><?php echo display('selectstate'); ?></option>
                                        <?php foreach ($city as $value) { ?>
                                            <option value="<?php echo $value->state_id; ?>"><?php echo $value->state_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>  
                            </div>
                            <div class="col-xs-12 col-sm-5">
                                <div class="clearfix" style="width: 106%;">
                                    <select class="form-control" name="end_point"  id="end_point">
                                        <option><?php echo display('selectstate'); ?></option>   
                                    </select>
                                </div>
                            </div>
                            <div class="help-block" id="title-exists"><?php echo form_error('end_point'); ?></div>
                        </div> 
                    </div>
                </div>
                <div class="form-group row">
                    <label for="distance" class="col-sm-3 col-form-label"><?php echo display('measurementscale'); ?></label>
                    <div class="col-sm-9">
                        <?php echo form_dropdown('measurement_scale', $measurement_scale, set_value('measurement_scale', $distance_values->measurement_scale), 'id="measurement_scale" required="required"  class="col-xs-12 col-sm-4 testselect1"'); ?>
                        <?php echo form_error('measurement_scale'); ?>
                    </div>
                </div>   
                <div class="form-group row">
                    <label for="distance" class="col-sm-3 col-form-label"><?php echo display('distence'); ?></label>
                    <div class="col-sm-9">
                        <input type="text" name="distance" class="form-control" id="v_chassis_no" placeholder="<?php echo display('distence'); ?>" value="<?php echo set_value('distance', $distance_values->distance); ?>">
                        <div class="help-block" id="title-exists"><?php echo form_error('distance'); ?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="vehicle_type" class="col-sm-3 col-form-label"><?php echo display('isactive'); ?></label>
                    <div class="col-sm-9">
                        <fieldset>
                            <div class="checkbox-circle">
                                <input name="active" type="radio" value="1" <?php echo set_radio('active', '1', TRUE); ?>>
                                <label for="checkbox7"><?php echo display('yes'); ?></label>

                                <input name="active" type="radio" value="0" <?php echo set_radio('active', '0'); ?>>
                                <label for="checkbox8"><?php echo display('no'); ?></label>
                            </div>

                        </fieldset>
                    </div>
                    <div class="help-block" id="title-exists"><?php echo form_error('active'); ?></div>
                </div> 
                <input type="hidden" name="distance_id" id="distance_id" value="<?php echo set_value('distance_id', $distance_values->distance_id); ?>"/>
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
        //**starts of first city**//
        $('#city_start').change(function () {
            var controller = 'ajax_query';
            var method = 'station_start';
            var type = $('#city_start').val();
            var result_loc = '#start_point';
            //alert(type);
            jquery_ajax(controller, method, type, result_loc);
        });
        //**ends of first city**//

        //**starts of second city**//
        $('#city_end').change(function () {
            var controller = 'ajax_query';
            var method = 'station_start';
            var type = $('#city_end').val();
            var result_loc = '#end_point';
            jquery_ajax(controller, method, type, result_loc);
        });
        //**ends of second city**//
    });

    function jquery_ajax(controller, method, type, restul_loc) {
        $.ajax({
            //if remove $config['index_page'] = 'index.php' add index.php with url
            'url': '<?php echo base_url(); ?>index.php/' + controller + '/' + method + '/' + type,
            'type': 'POST', //the way you want to send data to your URL
            'data': {'type': type},
            'cache': false,
            'success': function (data) { //probably this request will return anything, it'll be put in var "data"
                var container = $(restul_loc); //jquery selector (get element by id)
                if (data) {
                    container.html(data);
                }
            }
            //,error: function (data) {
            //alert('failed');
            //}
        });
    }
</script>