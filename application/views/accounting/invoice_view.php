<div class="row">
	<div class="col-xs-12" id="PrintArea">
		<div class="table-header">
			<i class="fa fa-list"></i>
			<?php echo $this->lang->line('INVOICE_INFORMATION'); ?> 
            <span class="add-new-record">
                <i class="fa fa-plus"></i>
                <a class="white" href="<?php echo base_url() . "accounting/invoice/create/" ?>">
                    <strong><?php echo $this->lang->line('ADD_INVOICE'); ?></strong>
                </a>
            </span>
		</div>
		<div class="table-responsive">
			<table class="DataTable display compact cell-border" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th><?php echo $this->lang->line('SL_NO'); ?></th>
						<th><?php echo $this->lang->line('RECEIVED_DATE'); ?></th>
						<th><?php echo $this->lang->line('RECEIVED_FROM'); ?></th>
						<th><?php echo $this->lang->line('RECEIVED_TYPE'); ?></th>
						<th><?php echo $this->lang->line('BANK_NAME'); ?></th>
						<th><?php echo $this->lang->line('BRANCH_NAME'); ?></th>
						<th><?php echo $this->lang->line('ACCOUNT_NUMBER'); ?></th>
						<th><?php echo $this->lang->line('PAY_ORDER_NUMBER'); ?></th>
						<th><?php echo $this->lang->line('DEPOSIT_BANK_NAME'); ?></th>
						<th><?php echo $this->lang->line('ACCOUNT_NAME'); ?></th>
						<th><?php echo $this->lang->line('AMOUNT'); ?></th>
						<th><?php echo $this->lang->line('DESCRIPTION'); ?></th>
						<th><?php echo $this->lang->line('STATUS'); ?></th>
                        <?php if($this->session->userdata('user_type') == 9):?>
                        <th class="no-print"><?php echo $this->lang->line('ACTION'); ?></th>
                        <?php endif; //ends of if condition ?>
					</tr>
				</thead>

				<tbody> 
					<?php
					if(!empty($inflow)):
						$searial = 1;
						foreach ($inflow as $value):
					?>
					<tr>
						<td><?php echo $searial++; ?></td>
						<td><?php echo date("d-m-Y",strtotime($value->received_date)); ?></td>
						<td><?php echo $value->received_from; ?></td>
						<td>
							<?php
								$pay_type = array(
									'1'	=>	$this->lang->line('CASH'),
									'2'	=>	$this->lang->line('CHEQUE'),
									'3'	=>	$this->lang->line('PAY_ORDER'),
								); 
								echo $pay_type[$value->received_type]; 
							?>
						 </td>
						<td><?php echo $value->bank_name; ?></td>
						<td><?php echo $value->branch_name; ?></td>
						<td><?php echo $value->account_number; ?></td>
						<td><?php echo $value->pay_order_number; ?></td>
						<td><?php echo $value->deposit_bank; ?></td>
						<td><?php echo $value->account_name; ?></td>
						<td><?php echo $value->amount; ?></td>
						<td><?php echo $value->description; ?></td>
						<td><?php echo ($value->status==1)?"Active":"Inactive"; ?></td>
                        <?php if($this->session->userdata('user_type') == 9):?>
						<td class="no-print">
							<a class="blue" data-toggle="tooltip" title="View" href="<?php echo base_url()."accounting/inflow/single_view/".$value->inflow_id ?>">
								<i class="ace-icon fa fa-eye bigger-130"></i>
							</a>&nbsp;&nbsp; 
							<a class="green" data-toggle="tooltip" title="Edit" href="<?php echo base_url()."accounting/inflow/edit/".$value->inflow_id ?>">
								<i class="ace-icon fa fa-pencil bigger-130"></i>
							</a>&nbsp;&nbsp; 
							<a class="red delete" data-toggle="tooltip" title="Delete" href="<?php echo base_url()."accounting/inflow/delete/".$value->inflow_id ?>">
								<i class="ace-icon fa fa-trash-o bigger-130"></i>
							</a>
						</td> 
                        <?php endif; //ends of if condition ?>
					</tr> 
					<?php 
						endforeach;
					endif; 
					?> 
				</tbody>
			</table>
		</div>
	</div><!-- /.col -->
 
    <div class="col-xs-12 no-print">
    <br/> 
        <a class="btn btn-sm btn-primary pull-right" onclick="printContent('PrintArea')">
            <span class="fa fa-print" ></span>&nbsp;&nbsp;Print
        </a>    
    </div>
	
</div><!-- /.row -->
<!-- PAGE CONTENT ENDS -->

 