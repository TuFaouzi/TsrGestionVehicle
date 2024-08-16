<div class="panel panel-bd lobidrag">
    <div class="row">
        <div class="col-xs-12">
            <div class="widget-box">
                
                <div class="panel-body">
                    <div class="widget-header widget-header-blue widget-header-flat">
                        <h4 class="widget-title lighter">
                           <?php echo display('companybill'); ?>
                        </h4>
                    </div>
                </div>  
                <div class="widget-body">
                    <div class="widget-main">
                        <div class="step-content pos-rel" id="step-container">
                            <div class="step-pane active" id="step1"> 
                                <form name="expense_entry" class="form-horizontal" id="notice-submit" action="<?php echo base_url() . 'report_company/generate/'; ?>" method="post" >
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="company_option"><?php echo display('selectanoption'); ?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix"> 
                                                <select class="col-xs-12 col-sm-4 testselect1" name="company_option" id="company_option">
                                                    <option value=""><?php echo display('selectcompanytype'); ?></option>
                                                    <option value="1"><?php echo display('contactcompany'); ?></option>
                                                    <option value="2"><?php echo display('otherscompany'); ?></option>
                                                </select>
                                            </div>
                                            <div class="help-block" id="title-exists"><?php echo form_error('company_option'); ?></div>
                                        </div>
                                    </div>
                                    <!-- #company type# -->
                                    <div class="form-group"  id="contact_company"  style="display:none">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="company_id"><?php echo display('companyname'); ?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix"> 
                                                <?php echo form_dropdown('company_id', $company, '', 'class="col-xs-12 col-sm-4 testselect1"'); ?>
                                            </div> 
                                        </div>
                                    </div>                                    
                                    <div class="form-group" id="OthersCompany"  style="display:none">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="others_company"><?php echo display('othercompany'); ?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix">
                                                <input type="text" id="others_company" name="others_company" value="<?php echo $report->others_company; ?>" placeholder="<?php echo display('othercompany'); ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- #ends of company type# --> 
                                    <div class="form-group" id="ImportExport" style="display:none">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="others_company"><?php echo display('exportimport'); ?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix">
                                                <select id="import_export"  name="import_export" class="col-xs-12 col-sm-4 testselect1">
                                                    <option value=""><?php echo display('exportimportlocal');?></option>
                                                    <option value="4"><?php echo display('local');?></option>
                                                    <option value="2"><?php echo display('export');?></option>
                                                    <option value="1"><?php echo display('import');?></option>
                                                    <option value="3"><?php echo display('exportimport');?></option>           
                                                </select>                            
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="date">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="others_company"><?php echo display('date'); ?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix">



                                                <div class="col-xs-12 col-sm-5">
                                                    <input type="text" name="date_1" class="datepicker form-control" value="<?php echo date("d-m-Y"); ?>">
                                                </div>
                                                <div class="col-xs-12 col-sm-2" style="margin-left:-8%;">
                                                    <div class=" col-xs-12 col-md-1"><?php echo nbs(3) . display('to') . nbs(3); ?></div>
                                                </div>
                                                <div class="col-xs-12 col-sm-5" style="margin-left:-6.4%;">
                                                    <input type="text" name="date_2" class="datepicker form-control" value="<?php echo date("d-m-Y"); ?>">
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="company_id"><?php echo display('companyname'); ?></label>
                                        <div class="col-xs-12 col-sm-9">
                                            <div class="clearfix" >
                                                <button class="btn btn-sm btn-info" type="submit">
                                                    <i class="ace-icon fa fa-check"></i>
                                                    <?php echo display('generate'); ?>
                                                </button>
                                            </div>
                                            <div class="help-block" id="title-exists"><?php echo form_error('company_id'); ?></div>
                                        </div> 
                                    </div> 
                                </form> 


                                <!--  --------------------------- 
                                -------ENDS OF FORM------------
                                --------------------------------  --> 

                                <div id="PrintArea" style="border: 1px solid gainsboro;"> 
                                    <div class="panel-body">
                                        <legend> <?php echo display('companybill'); ?></legend><hr>
                                    </div>
                                    
                                    <?php if (isset($company_info)): ?> 
                                    
                                    
                                    
                                    
                                        <table class="compact cell-border" cellspacing="0" width="40%">
                                            <tr align='left'>
                                                <th style="width:160px;"><p style="margin-left:8%;margin-top: 13%;"><?php echo display('companyname'); ?></p></th>
                                                <td><?php
                                                    if (isset($company_info->company_name))
                                                        echo $company_info->company_name;
                                                    echo "&nbsp;";
                                                    ?></td>
                                            </tr>  
                                            <tr align='left'> 
                                                <th><p style="margin-left:8%;"><?php echo display('address'); ?></p></th>
                                                <td><?php
                                                    if (isset($company_info->company_address))
                                                        echo $company_info->company_address;
                                                    echo "&nbsp;";
                                                    ?></td>
                                            </tr>  
                                            <tr align='left'> 
                                                <th><p style="margin-left:8%;"><?php echo display('mobileno'); ?></p></th>
                                                <td><?php
                                                    if (isset($company_info->company_cell))
                                                        echo $company_info->company_cell;
                                                    echo "&nbsp;";
                                                    ?></td>
                                            </tr>  
                                            <tr align='left'> 
                                                <th><p style="margin-left:8%;"><?php echo display('emailaddress'); ?></p></th>
                                                <td><?php
                                                    if (isset($company_info->company_email))
                                                        echo $company_info->company_email;
                                                    echo "&nbsp;";
                                                    ?></td>
                                            </tr>  
                                            <tr align='left'> 
                                                <th><p style="margin-left:8%;"><?php echo display('website'); ?></p></th>
                                                <td><?php
                                                    if (isset($company_info->company_web))
                                                        echo $company_info->company_web;
                                                    echo "&nbsp;";
                                                    ?></td>
                                            </tr>  
                                            <tr align='left'> 
                                                <th><p style="margin-left:8%;"><?php echo display('date'); ?></p></th>
                                                <td>
                                                    <?php
                                                    echo date('d-m-Y', strtotime($this->input->post("date_1")));
                                                    echo " to ";
                                                    echo date('d-m-Y', strtotime($this->input->post("date_2")));
                                                    ?>
                                                </td>  
                                            </tr>     
                                        </table> 
                                        <br/>
                                    <?php endif; ?>

                                    <table id="rep_comp" class="table table-responsive display compact cell-border" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th><?php echo display('slno'); ?></th>
                                                <th><?php echo display('date'); ?></th>
                                                <th><?php echo display('exprtimport'); ?></th> 
                                                <th><?php echo display('trip'); ?></th> 
                                                <th><?php echo display('amount'); ?></th> 
                                            </tr>
                                        </thead>

                                        <tfoot>
                                            <tr>
                                                <th colspan="4" class="text-right"><?php echo display('grandtotal'); ?> : </th>  
                                                <th></th>  
                                            </tr>
                                        </tfoot>

                                        <tbody>
                                            <?php
                                            $import_export = array(0 => display('local'), 1 => display('import'), 2 => display('export'), 3 => display('exportimport'));
                                            $sl = 1;
                                            if (!empty($bill)) {
                                                foreach ($bill as $value) {
                                                    echo "<tr>";
                                                    echo "<td>" . $sl++ . "</td>";
                                                    echo "<td>" . date('d-m-Y', strtotime($value->date)) . "</td>";
                                                    echo "<td>" . $import_export[$value->import_export] . "</td>";
                                                    echo "<td>$value->start_city to $value->end_city </td>";
                                                    echo "<td>" . round($value->rent, 2) . "</td>";
                                                    echo "</tr>";
                                                } //ends of foreach 
                                            }
                                            ?>
                                        </tbody> 
                                    </table>
                                </div> 
                            </div>
                        </div>  
                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->

                <div class="col-xs-12 no-print">
                    <br/> 
                    <a class="btn btn-sm btn-primary pull-right" onclick="printContent('PrintArea')">
                        <span class="fa fa-print" ></span>&nbsp;&nbsp;<?php echo display('print'); ?>
                    </a> 
                    <?php
                    $url = '?i=' . $this->input->post('import_export') .
                            '&c=' . $this->input->post('company_id') .
                            '&o=' . $this->input->post('others_company') .
                            '&d1=' . date("Y-m-d", strtotime($this->input->post('date_1'))) .
                            '&d2=' . date("Y-m-d", strtotime($this->input->post('date_2')))
                    ;
                    if (isset($url))
                        
                        ?>     
                    <a href="<?php echo base_url(); ?>report_company/pdf/<?php echo $url; ?>" target="_blank" class="btn btn-sm btn-danger pull-right">
                        <span class="fa fa-file-pdf-o" ></span>&nbsp;&nbsp;<?php echo display('pdf'); ?> 
                    </a>  
                </div>

            </div><!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->


</div>

<script type="text/javascript">
    $(document).ready(function () {

        $("#company_option").on('change', function () {
            var x = $(this).val();
            if (x == 1) {
                $("#contact_company, #ImportExport").show();
                $("#OthersCompany").hide();
                $("#others_company").val('');
            } else if (x == 2) {
                $("#OthersCompany, #ImportExport").show();
                $("#contact_company").hide();
                $("#company_id").val('');
            } else {
                $("#contact_company, #OthersCompany, #ImportExport").hide();
                $("#others_company").val('');
                $("#company_id").val('');
            }
        });


        // $(".remove-result").on('click',function(){
        //     alert($(this).parent().parent().remove());
        // });


        $('#rep_comp').DataTable({
            paging: false,
            searching: false,
            "lengthMenu": [[15, 50, 100, -1], [15, 50, 100, "All"]],
            "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };
                //#----------- Total over this page------------------#
                grandTotal = api.column(4, {page: 'current'}).data().reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                //#-----------ends of Total over this page------------------#

                // Update footer
                $(api.column(4).footer()).html(grandTotal.toFixed(2));
            }
        });
    });
</script>