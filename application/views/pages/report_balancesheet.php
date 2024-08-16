
<div class="row" style="border: 1px solid gainsboro;background-color: white;">
    <div class="col-xs-12">
        <div class="widget-box">
            <div class="panel-body">
             <div class="widget-header widget-header-blue widget-header-flat">
   								
                <h4 class="widget-title lighter"><?php echo display('balancesheet') ?></h4>
             </div>
                <hr>
            </div>
            <div class="widget-body">
                <div class="row">
                    <div class="col-md-12">
                        <br/>
                        <?php echo form_open('report_balancesheet', 'class="form-horizontal"'); ?>
                        <div class="form-group" id="date">
                            <label class="control-label col-xs-12 col-sm-3" for="date"><?php echo display('date') ?> </label>
                            <div class="col-xs-12 col-sm-9">
                                <?php
                                
                                echo form_input('date_1', $date->date_1, 'class="datepicker extra"');
                                echo nbs(2) . display('to') . nbs(2);
                                echo form_input('date_2', $date->date_2, 'class="datepicker extra"');
                                echo form_submit('', 'Generate', 'class="btn btn-info"');
                                ?>
                            </div>
                        </div> 
                        <?php echo form_close(); ?>
                    </div>  
                    <div class="col-md-12" id="PrintArea">						 
                        <div class="profile-user-info profile-user-info-striped text-right">
                            <div class="profile-info-row">
                                <div class="profile-info-name green"><?php echo  display('trip') ?></div>
                                <div class="profile-info-value green"><?php echo display('contactrate') ?></div>
                                <div class="profile-info-value green"><?php echo display('farerate') ?></div> 
                                <div class="profile-info-value green"><?php echo display('expense') ?></div>  
                                <div class="profile-info-value green"><?php echo display('Profit1') ?></div> 
                                <div class="profile-info-value green"><?php echo display('Profit2') ?></div>  
                                <div class="profile-info-value green"><?php echo display('totalprofit') ?></div>  
                            </div> 
                            <?php
                            // settings for trip information
                            $category = array(0 => display('local'), 1 => display('import'), 2 => display('export'), 3 => display('exportimport'));
                            $grand_cont = 0;
                            $grand_fare = 0;
                            $grand_expn = 0;
                            $grand_pro1 = 0;
                            $grand_pro2 = 0;
                            $grand_pro3 = 0;
                            foreach ($trip as $value):
                                ?>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"><?= $category[$value->trip_category]; ?></div>
                                    <div class="profile-info-value"><?= sprintf("%.2f", $value->contact_rate); ?></div>  
                                    <div class="profile-info-value"><?= sprintf("%.2f", $value->fare_rate); ?></div>  
                                    <div class="profile-info-value">
                                        <?php
                                        $this->db->select('SUM(quantity * amount) AS regular');
                                        $this->db->from('expense_data');
                                        $this->db->where('import_export', $value->trip_category);
                                        $this->db->where('expense_group', 1);
                                        if (!empty($date->date_1) && !empty($date->date_2)):
                                            $this->db->where("date BETWEEN '" . date('Y-m-d', strtotime($date->date_1)) . "' AND '" . date("Y-m-d", strtotime($date->date_2)) . "'", NULL, FALSE);
                                        endif;
                                        $this->db->group_by('import_export');
                                        $regular_expense = $this->db->get();
                                        $exp = $regular_expense->row();
                                        ?>
                                        <?= sprintf("%.2f", $exp) ?>
                                    </div>  
                                    <div class="profile-info-value"><?= sprintf("%.2f", $value->contact_rate - $value->fare_rate); ?></div>  
                                    <div class="profile-info-value"><?= sprintf("%.2f", $value->fare_rate - $exp) ?></div>  
                                    <div class="profile-info-value"><?= sprintf("%.2f", ($value->contact_rate - $value->fare_rate) + ($value->fare_rate - $exp)) ?></div> 
                                </div> 
                                <?php
                                $grand_cont = $grand_cont + $value->contact_rate;
                                $grand_fare = $grand_fare + $value->fare_rate;
                                $grand_expn = $grand_expn + $exp;
                            endforeach;
                            $grand_pro1 = $grand_cont - $grand_fare;
                            $grand_pro2 = $grand_fare - $grand_expn;
                            $grand_pro3 = $grand_pro1 + $grand_pro2;
                            ?>
                            <div class="profile-info-row text-right">
                                <div class="profile-info-name purple"><?php echo display('total');?></div>
                                <div class="profile-info-value purple"><?= sprintf("%.2f", $grand_cont) ?></div> 
                                <div class="profile-info-value purple"><?= sprintf("%.2f", $grand_fare) ?></div> 
                                <div class="profile-info-value purple"><?= sprintf("%.2f", $grand_expn) ?></div> 
                                <div class="profile-info-value purple"><?= sprintf("%.2f", $grand_pro1) ?></div> 
                                <div class="profile-info-value purple"><?= sprintf("%.2f", $grand_pro2) ?></div> 
                                <div class="profile-info-value purple"><?= sprintf("%.2f", $grand_pro3) ?></div> 
                            </div> 
                            <!-- ends of trip information  -->
                            <div class="profile-info-row">
                                <div class="profile-info-name green"><?php echo display('expense');?></div>
                                <?php
                                //setting of expense 
                                $ex_category = array(1 => display('regular'), 2 => display('maintenance'), 3 => display('others'), 4 => display('office'), 5 => display('garage'));
                                $grand_all_exp = 0;
                                ?>
                                <?php foreach ($expense as $value): ?>
                                    <div class="profile-info-value green"><?php echo $ex_category[$value->expense_category]; ?></div> 
                                <?php endforeach; ?> 
                                <div class="profile-info-value green"></div>
                                <div class="profile-info-value green"><?php echo display('totalexpense');?></div>
                            </div>  
                            <div class="profile-info-row">
                                <div class="profile-info-name purple"><?php echo display('total');?></div>
                                <?php foreach ($expense as $value): ?>
                                    <div class="profile-info-value purple"><?php echo sprintf("%.2f", $value->expense_amount); ?></div> 
                                    <?php
                                    $grand_all_exp = $grand_all_exp + round($value->expense_amount, 2);
                                endforeach;
                                ?> 
                                <div class="profile-info-value purple"><strong></strong></div> 
                                <div class="profile-info-value purple"><?= $grand_all_exp; ?></div> 
                            </div>   
                            <!-- ends of expense  -->
                            <div class="profile-info-row">
                                <div class="profile-info-name green"><?php echo display('balance');?></div>
                                <div class="profile-info-value green"><?php echo display('totalprofit');?></div>
                                <div class="profile-info-value green"></div>
                                <div class="profile-info-value green"><?php echo display('totalexpense');?></div>
                                <div class="profile-info-value green"></div>
                                <div class="profile-info-value green"></div>
                                <div class="profile-info-value green"><?php echo display('netbalanceprofit');?></div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name red"></div>
                                <div class="profile-info-value red"><?= sprintf("%.2f", $grand_pro3); ?></div>
                                <div class="profile-info-value red"></div>
                                <div class="profile-info-value red"><?= sprintf("%.2f", $grand_all_exp); ?></div>
                                <div class="profile-info-value red"></div>
                                <div class="profile-info-value red"></div>
                                <div class="profile-info-value red"><?= sprintf("%.2f", $grand_pro3 - $grand_all_exp); ?></div>
                            </div>
                        </div> 
                        <h4 class="text-center">&nbsp;</h4> 
                    </div>	 
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 no-print">
        <br> 
        <a class="btn btn-sm btn-primary pull-right" onclick="printContent('PrintArea')">
            <span class="fa fa-print"></span>&nbsp;&nbsp;<?php echo display('print');?>
        </a>    
    </div>
</div>
