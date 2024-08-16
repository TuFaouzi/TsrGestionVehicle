<div id="PrintArea"> 
    <h3> <?php display('companybill');?></h3>

    <?php if(isset($company_info)): ?> 
        <table  width="100%" cellspacing="0" cellpadding="0">
            <tr align='left'>
                <th style="width:160px;"><?php display('companyname');?></th>
                <td><?php if(isset($company_info->company_name)) echo $company_info->company_name; echo "&nbsp;"; ?></td>
            </tr>  
            <tr align='left'> 
                <th><?php display('address');?></th>
                <td><?php if(isset($company_info->company_address)) echo $company_info->company_address; echo "&nbsp;"; ?></td>
            </tr>  
            <tr align='left'> 
                <th><?php display('mobileno');?></th>
                <td><?php if(isset($company_info->company_cell)) echo $company_info->company_cell; echo "&nbsp;"; ?></td>
            </tr>  
            <tr align='left'> 
                <th><?php display('emailaddress');?></th>
                <td><?php if(isset($company_info->company_email)) echo $company_info->company_email; echo "&nbsp;"; ?></td>
            </tr>  
            <tr align='left'> 
                <th><?php display('website');?></th>
                <td><?php if(isset($company_info->company_web)) echo $company_info->company_web; echo "&nbsp;"; ?></td>
            </tr>  
            <tr align='left'> 
                <th><?php display('date');?></th>
                <td>
                <?php 
                    echo date('d-m-Y',strtotime ($this->input->get("d1")));
                    echo " to ";
                    echo date('d-m-Y',strtotime ($this->input->get("d2")));
                ?>
                </td>  
            </tr>     
        </table> 
        <br/>
    <?php endif; ?>

    <table border='1' class="display compact cell-border" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th><?php echo display('slno'); ?></th>
                <th><?php echo display('date'); ?></th>
                <th><?php echo display('exportimport'); ?></th> 
                <th><?php echo display('trip'); ?></th> 
                <th><?php echo display('amount'); ?></th> 
            </tr>
        </thead>

        <tbody>
            <?php 
            $import_export = array(0=>display('local'),1=>display('import'),2=>display('export'),3=>display('exportimport'));
            $sl = 1;  
            if(!empty($bill)){  
            $grand_total = 0; 
                foreach ($bill as $value) {
                    echo "<tr>";
                    echo "<td>".$sl++."</td>";
                    echo "<td>".date('d-m-Y',strtotime($value->date))."</td>";
                    echo "<td>".$import_export[$value->import_export]."</td>";
                    echo "<td>$value->start_city to $value->end_city </td>";
                    echo "<td>$value->rent</td>";  
                    echo "</tr>"; 
                    $grand_total = round($grand_total+$value->rent,2);
                }
            } 
            ?>
        </tbody> 

        <tfoot>
            <tr>
                <th colspan="4" align="right"><?php echo display('grandtotal'); ?> : </th>  
                <th align="left"><?php if(isset($grand_total)) echo $grand_total; ?></th>  
            </tr>
        </tfoot>
    </table>
</div> 