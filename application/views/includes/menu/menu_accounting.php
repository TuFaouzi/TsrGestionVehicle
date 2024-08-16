<li class="red2" title='Accounting'>
	<a data-toggle="dropdown" class="dropdown-toggle " href="javascript:void(0)">
		<i class="ace-icon fa fa-try"></i>
		<?php echo $this->lang->line('ACCOUNTING'); ?>
		<span class="badge badge-grey"></span>
	</a>

	<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
		<li class="dropdown-header">
			<?php echo $this->lang->line('ACCOUNTING') ?>
		</li> 
		<li>
			<a href="<?php echo base_url(); ?>accounting/bank/" > 
				<?php echo $this->lang->line('BANK_INFORMATION') ?>
			</a>
		</li>
		<li>
			<a href="<?php echo base_url(); ?>accounting/account/" > 
				<?php echo $this->lang->line('ACCOUNT_INFORMATION') ?>
			</a>
		</li>
		<li>
			<a href="<?php echo base_url(); ?>accounting/company/" > 
				<?php echo $this->lang->line('COMPANY_INFORMATION') ?>
			</a>
		</li>
<!-- 		<li>
			<a href="<?php echo base_url(); ?>accounting/invoice/" > 
				<?php echo $this->lang->line('INVOICE_INFORMATION') ?>
			</a>
		</li> -->
		<li>
			<a href="<?php echo base_url(); ?>accounting/inflow/" > 
				<?php echo $this->lang->line('INFLOW') ?>
			</a>
		</li>
		<li>
			<a href="<?php echo base_url(); ?>accounting/outflow/" > 
				<?php echo $this->lang->line('OUTFLOW') ?>
			</a>
		</li>
		<li>
			<a href="<?php echo base_url(); ?>accounting/report/" > 
				<?php echo $this->lang->line('REPORTS') ?>
			</a>
		</li>
	</ul>
</li> 
