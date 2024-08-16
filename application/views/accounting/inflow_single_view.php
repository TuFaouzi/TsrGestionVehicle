<div class="page-content">
  <div class="row-fluid">
    <div class="col-md-12">
      <!--PAGE CONTENT BEGINS-->
        <?php
         if ($this->session->flashdata('success')) {
               echo "<div class=\"alert alert-success\" role=\"alert\">" . $this->session->flashdata('success') . "</div>";
          }
         ?>
      <div class="row-fluid" id="PrintArea"> 
          <div class="widget-box transparent invoice-box">

            


        <div class="panel-body">  
        <div class="table-header">
            <i class="fa fa-list"></i>
            <?php echo display('moneyreceipt'); ?> 
            <div class="pull-right">
               <a class="white" href="<?php echo base_url(); ?>trip_information/view_all">
                    <?php echo display('serialno');?>:
                    <?php echo $inflow->inflow_id; ?>
                     <br />
                      <?php echo display('date')?>
                      <span class="blue"><?php echo date("d-m-Y"); ?></span>
                </a>
            </div>
        </div>
            <hr>
        </div>
  
            <div class="widget-body">
              <div class="widget-main padding-24">
                <div class="row-fluid"> 
                  <table width="100%">
                        <tr> 
                            <td>
                                <h3 style="margin-left: 1%;"><?php echo $company->name; ?></h3>
                                <p style="margin-left: 1%;"><?php echo $company->address; ?></p>
                            </td> 
                            <td width="200">
                              <ul class="list-unstyled" style="margin-top: 7%;">
                                <li>Mobile  : <?php echo $company->mobile_no; ?></li> 
                                <li>Phone   : <?php echo $company->phone_no; ?></li> 
                                <li>Fax     : <?php echo $company->fax_no; ?></li> 
                                <li>E-mail  : <?php echo $company->email; ?></li> 
                                <li>Website : <?php echo $company->website; ?></li> 
                              </ul>
                            </td> 
                        </tr>
                  </table> 

                  <div class="space"></div>
 
                    <table class="table">
                        <tr> 
                          <th width="200">Received Date</th>
                          <td><?php echo date("d-m-Y",strtotime($inflow->received_date)); ?></td>
                          <th width="200">Received From</th>
                          <td><?php echo $inflow->received_from; ?></td>
                        </tr>
                        <tr>
                          <th width="200">Received Type</th>
                          <td colspan="3"> 
                            <?php
                            $pay_type = array(
                              '1' =>  $this->lang->line('CASH'),
                              '2' =>  $this->lang->line('CHEQUE'),
                              '3' =>  $this->lang->line('PAY_ORDER'),
                              '4' =>  $this->lang->line('LC'),
                            );
                            echo @$pay_type[$inflow->received_type];
                            ?>  
                            </td>
                        </tr>

                        <?php if($inflow->received_type == 2 || $inflow->received_type == 3 || $inflow->received_type == 4): ?>
                        <tr>
                            <th width="200"><?php echo lang('BANK_NAME'); ?></th>
                            <td><?php echo $inflow->bank_name; ?></td>
                            <th width="200"><?php echo lang('BRANCH_NAME'); ?></th>
                            <td><?php echo $inflow->branch_name; ?></td>
                        </tr>
                        <tr>
                            <?php if($inflow->received_type == 2): ?>
                              <th width="200">Account Number</th>
                              <td><?php echo $inflow->account_number; ?></td>
                            <?php elseif($inflow->received_type == 3): ?>
                              <th width="200">Pay Order Number</th>
                              <td><?php echo $inflow->pay_order_number; ?></td>
                            <?php elseif($inflow->received_type == 4): ?>
                              <th width="200"><?php echo lang('LC'); ?></th>
                              <td><?php echo $inflow->letter_of_credit; ?></td>
                            <?php endif; ?>     
                              <th width="200">Deposit Bank Name</th>
                              <td><?php echo $inflow->deposit_bank; ?></td>
                        </tr>
                        <?php endif; ?>                          

                        <tr>
                          <th width="200">Account Name</th>
                          <td><?php echo $inflow->account_name; ?></td>
                          <th width="200">Amount</th>
                          <td><?php echo $inflow->amount; ?></td>
                        </tr>
                        <tr>
                          <th width="200">Description</th>
                          <td colspan="3"><?php echo $inflow->description; ?></td>
                        </tr> 
                    </table> 

                  <div class="hr hr8 hr-double hr-dotted"></div>
                   
                    <table width="100%" style="height: 80px;">
                        <tr> 
                          <td>
                              <p style="margin-left: 1%;">(Signature of Payment Giver)<br/>
                              Date:  
                          </td> 
                          <td style="width:200px" class="text-left">
                             (Signature of Receipient)<br/>
                               Date:  </p>
                          </td>
                        </tr>
                    </table> 
                </div>
              </div>
            </div>
          </div> 
      </div>

      <!--PAGE CONTENT ENDS-->
    </div><!--/.span-->
  </div><!--/.row-fluid-->

    <div class="col-xs-12 no-print">
    <br/> 
        <a class="btn btn-sm btn-primary pull-right" onclick="printContent('PrintArea')">
            <span class="fa fa-print" ></span>&nbsp;&nbsp;Print
        </a>  
    </div>

</div><!--/.page-content-->


<script>
  // if (navigator.appName == "Microsoft Internet Explorer"){ 
  //   var PrintCommand = '<object ID="PrintCommandObject" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></object>';
  //   document.body.insertAdjacentHTML('beforeEnd', PrintCommand); 
  //   PrintCommandObject.ExecWB(6, -1); PrintCommandObject.outerHTML = ""; 
  // }  
</script>
<script language="javascript">
// function Print(){
  // if (document.all){
  //   WebBrowser1.ExecWB(6,6); //use 6, 1 to prompt the print dialog or 6, 6 to omit it;
  //   WebBrowser1.outerHTML = "";
  // } else{
  //   window.print();
  // }
// }
</script>
 