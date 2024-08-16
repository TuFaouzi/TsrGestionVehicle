<style>
    th{padding: 9px;}
    .bg-info {
    background-color: gainsboro;
}
</style>
<div class="row">
	<div class="col-xs-12" id="PrintArea">
		<div class="table-header">
			<i class="fa fa-list"></i>
			<?php echo display('triplist'); ?> 
		</div>
            <hr>
		<div class="col-xs-12 "> 
		<?php 
		#starts of trip type
		$trip_type = array(
                    '1' => display('ownsingle'),
                    '2' => display('owndouble'),
                    '3' => display('hiresingle'),
                    '4' => display('hiredouble'),
                    '5' => display('rentsingle'),
                    '6' => display('rentdouble')
                    );  
		#starts of trip type
		$import_export = array(    
                     '0' => display('local'),
                     '1' => display('export'),
                     '2' => display('import'),
                     '3' => display('exportimport')
			);  	
		$serial = 1;// set serial = 1
		$total_income = 0;
		$total_advance = 0;

			foreach ($single_trip as $value) { 
				echo "<table  class=\"display compact cell-border\" cellspacing=\"0\" width=\"100%\">";
					if($value->import_export == 3){ 
						if($serial==1){
						echo "<tr class=\"bg-info\"><th align='left'>".display('exportimport')."</th>";
						echo "<th align=\"left\" colspan=\"3\">display('export')</th></tr>";
						}else{
						echo "<tr class=\"bg-info\"><th align='left'>".display('exportimport')."</th>";
						echo "<th align=\"left\" colspan=\"3\">display('import')</th></tr>";
						}
					}if($value->import_export == 1){
						echo "<tr class=\"bg-info\"><th align='left'>".display('exportimport')."</th>";
						echo "<th align=\"left\" colspan=\"3\">display('import')</th></tr>";
					}if($value->import_export == 2){
						echo "<tr class=\"bg-info\"><th align='left'>".display('exportimport')."</th>";
						echo "<th align=\"left\" colspan=\"3\">".display('export')."</th></tr>";
					}
					#ends of setup title of view page
				
					echo "<tr>";
						echo "<th align='left'>".display('date')."</th>";
						echo "<td>".date('d-m-Y',strtotime($value->date))."</td>";
						echo "<th align='left'>".display('triplinkid')."</th>";
						echo "<td>$value->trip_link_id</td>";
					echo "</tr>";
					
					echo "<tr>";
						echo "<th align='left'>".display('companyname')."</th>";
						if(!empty($value->others_company)):
						echo "<td>$value->others_company</td>";
						else:
							echo "<td>$value->company_name</td>";
						endif;
						echo "<th align='left'>".display('drivername')."</th>";
						echo "<td>$value->driver_name</td>";
					echo "</tr>";
					
					echo "<tr>";
						echo "<th align='left'>".display('vehicleregno')."</th>";
						echo "<td>";
                            if(!empty($value->hire_v_id)): 
                                echo $value->hire_v_id;
                            else:
                                echo $value->v_registration_no;
                            endif;
						echo "</td>";
						echo "<th align='left'>".display('triptype')."</th>";
						echo "<td>".$trip_type[$value->trip_type]."</td>";
					echo "</tr>";
 
					echo "<tr>";
						echo "<th align='left'>".display('triplocation')."</th>";
						echo "<td colspan=\"3\">$value->start_point to $value->end_point</td>";
					echo "</tr>";
					
					echo "<tr>";
						print "<th align='left'>".display('rent')."</th>";
						echo "<td>$value->rent</td>";
						echo "<th align='left'>".display('advance')."</th>";
						echo "<td>$value->advance</td>"; 
					echo "</tr>";
					
				echo "</table>";
			$total_income = $total_income + $value->rent;
			$total_advance = $total_advance + $value->advance;
			$serial++;//increment serial
			}
			#ends of foreach
		?> 

 
		<!-- STARTS OF EXPENSE DATA -->
		<table id="sample-table-2" class="display compact cell-border" border="1" cellspacing="0" width="100%" style="margin-top: 3%;">
			<thead>
				<tr><th colspan="5"  class="bg-info"><?php echo display('expense');?></th></tr>
				<tr>
					<th align='left'><?php echo display('slno');?></th> 
					<th align='left'><?php echo display('expensename');?></th>   
					<th align='left'><?php echo display('quantity');?></th>     
					<th align='left'><?php echo display('amount');?></th>       
					<th align='left'><?php echo display('total');?></th>  
				</tr> 
			</thead>
			<tbody>
			<?php 
            if (!empty($expense_data)) { 
                $count = 0; //counter initialization
                $grand_total = 0; //amount set 0

                foreach ($expense_data as $expense) {
                    ?>
                    <tr>
                        <td><?php echo $count + 1; ?></td>  
                        <td><?php echo $expense->expense_name; ?></td> 
                        <td><?php echo $expense->quantity; ?></td>
                        <td><?php echo $expense->amount; ?></td> 
                        <td><?php echo $total_amount = $expense->quantity*$expense->amount; ?></td>
                    </tr>
                    <?php
                    $grand_total = $grand_total + $total_amount; // calculate grand total amount
                    $count++;
                }//foreach
                echo "<tr><th align='right' class='text-right' colspan=\"4\">Grand Total  </th><th align='left'>$grand_total</th></tr>"; 
            }
			?>
			</tbody>
			<tfoot>
				<tr class="bg-info">
					<th align='left'><?php echo display('totalrent');?>=<?php echo $total_income;?></th>
					<th align='left'><?php echo display('totaladvance');?>=<?php echo $total_advance;?></th>
 					<th align='left'><?php echo display('totalbalance');?>=<?php echo ($total_income - $total_advance); ?></th>
					<th align='left'><?php echo display('totalexpens');?>=<?php echo (isset($grand_total))?($grand_total):0;?></th>
					<th align='left'></th>
 				</tr>				
			</tfoot>
		</table>
 		

 		</div>
		<!-- ENDS OF EXPENSE DATA --> 
	</div><!-- /.col -->

    <div class="col-xs-12">
    <br/> 
        <a class="btn btn-sm btn-primary pull-right" onclick="printContent('PrintArea')">
            <span class="fa fa-print" ></span>&nbsp;&nbsp;<?php echo display('print');?>
        </a> 
        <a class="btn btn-sm btn-danger pull-right" href="<?php echo base_url(); ?>trip_information/view_trip_by_trip_link_id/<?php echo (!empty($value->trip_link_id))?$value->trip_link_id:0; ?>/pdf" target="_blank">
            <span class="fa fa-file-pdf-o" ></span>&nbsp;&nbsp;<?php echo display('pdf');?>
        </a>    
    </div>

</div><!-- /.row -->
<!-- PAGE CONTENT ENDS -->



