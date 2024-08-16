<div class="row">
    <div class="col-sm-12 col-md-12"  id="PrintArea">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4> <?php echo display('alertcenter'); ?></h4>
                </div>
            </div>
            <div class="step-content pos-rel" id="step-container">
            <div class="panel-body" id="step1">
                <?php
                echo "<div class=\"alert text-success\" role=\"alert\">";
                $alert_days = 30; //set days range
                foreach ($result as $value) {
                    // registration expire date warning
                    $exp_date = date_create($value->reg_expire);
                    $today = date_create(date("Y-m-d"));
                    $daydiff = date_diff($today, $exp_date, FALSE);
                    $days_left = $daydiff->format("%a");
                    if($days_left == 0){
                        echo "<strong class=\"text-danger\">$value->v_registration_no registration certification will be expired today.</strong><br/>";
                    } else if ($days_left >= 1 && $days_left <= $alert_days) {
                        echo $value->v_registration_no . " registration certification is going to be expired within $days_left days.<br>";
                    }
                    //ends of registration expire date warning
                    // root certification expire date warning
                    $exp_date = date_create($value->root_permit_expire);
                    $today = date_create(date("Y-m-d"));
                    $daydiff = date_diff($today, $exp_date, FALSE);
                    $days_left = $daydiff->format("%a");
                    if ($days_left == 0) {
                        echo "<strong class=\"text-danger\">$value->v_registration_no root permit expire will be expired today.</strong><br/>";
                    } else if ($days_left >= 1 && $days_left <= $alert_days) {
                        echo $value->v_registration_no . " root permit is going to be expired within $days_left days.<br>";
                    }
                    //ends of root certification expire date warning 
                    // fitness certification expire date warning
                    $exp_date = date_create($value->fitness_expire);
                    $today = date_create(date("Y-m-d"));
                    $daydiff = date_diff($today, $exp_date, FALSE);
                    $days_left = $daydiff->format("%a");
                    if ($days_left == 0) {
                        echo "<strong class=\"text-danger\">$value->v_registration_no fitness certification will be expired today.</strong><br/>";
                    } else if ($days_left >= 1 && $days_left <= $alert_days) {
                        echo $value->v_registration_no . " fitness certification is going to be expired within $days_left days.<br>";
                    }
                    //ends of fitness certification expire date warning 
                    // tax_expire expire date warning
                    $exp_date = date_create($value->tax_expire);
                    $today = date_create(date("Y-m-d"));
                    $daydiff = date_diff($today, $exp_date, FALSE);
                    $days_left = $daydiff->format("%a");
                    if ($days_left == 0) {
                        echo "<strong class=\"text-danger\">$value->v_registration_no tax certification will be expired today.</strong><br/>";
                    } else if ($days_left >= 1 && $days_left <= $alert_days) {
                        echo "$value->v_registration_no tax certification is going to be expired within $days_left days.<br>";
                    }
                    //ends of tax_expire expire date warning
                    // insurance_expire expire date warning
                    $exp_date = date_create($value->insurance_expire);
                    $today = date_create(date("Y-m-d"));
                    $daydiff = date_diff($today, $exp_date, FALSE);
                    $days_left = $daydiff->format("%a");
                    if ($days_left == 0) {
                        echo "<strong class=\"text-danger\">$value->v_registration_no insurance certification will be expired today.</strong><br/>";
                    } else if ($days_left >= 1 && $days_left <= $alert_days) {
                        echo "$value->v_registration_no insurance certification is going to be expired within $days_left days.<br>";
                    }
                    //ends of insurance_expire expire date warning
                    // fuel_expire date warning
                    $exp_date = date_create($value->fuel_expire);
                    $today = date_create(date("Y-m-d"));
                    $daydiff = date_diff($today, $exp_date, FALSE);
                    $days_left = $daydiff->format("%a");
                    if ($days_left == 0) {
                        echo "<strong class=\"text-danger\">$value->v_registration_no fuel will be expired today.</strong><br/>";
                    } else if ($days_left >= 1 && $days_left <= $alert_days) {
                        echo "$value->v_registration_no fuel is going to be expired within $days_left days.<br>";
                    }
                    //ends of fuel_expire date warning
                }
                echo "</div>";
                ?>
            </div>
            </div>
            <div class="panel-footer">
               <?php echo display('alertcenter'); ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12 no-print">
        <br/> 
        <a class="btn btn-sm btn-primary pull-right" onclick="printContent('PrintArea')">
            <span class="fa fa-print" ></span>&nbsp;&nbsp;<?php echo display('print'); ?>
        </a>   
    </div>
</div>




