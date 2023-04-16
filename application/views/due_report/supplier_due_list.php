<span id="Supplier_Results_Duepayment">
<link href="<?php echo base_url()?>css/prints.css" rel="stylesheet" />
<div class="content_scroll" style="padding:40px 20px 25px 160px">

    <table class="border" cellspacing="0" cellpadding="0" width="70%">

        <h4><a style="cursor:pointer" onclick="window.open('<?php echo base_url(); ?>reports/search_supplier_due', 'newwindow', 'width=850, height=800,scrollbars=yes'); return false;"><img src="<?php echo base_url(); ?>images/printer.png" alt=""> Print</a></h4>
        <tr bgcolor="#89B03E">
            
            <th>Supplier ID</th>
            <th>Supplier Name</th>
            <th>Contact</th>
            <th>Total</th>
            <th>Paid</th>
            <th>Return</th>
            <th>Due</th>
            <th></th>
        </tr>
        <?php $totalpurchase = "";
        $Totalpaid = "";
        $totalReturn = "";

        foreach($record as $record){ 
                $supid = $record['Supplier_SlNo'];
            //if($record['PurchaseMaster_DueAmount'] >0){
                $paid = "";
                $sql = mysql_query("SELECT * FROM sr_supplier_payment WHERE SPayment_customerID = '".$supid."'");
                while($row = mysql_fetch_array($sql)){
                    $paid = $paid+$row['SPayment_amount'];    
                } 
                $purch = "";
                $returnAmount = "";
                $sqls = mysql_query("SELECT * FROM sr_purchasemaster WHERE Supplier_SlNo = '".$supid."'");
                while($rows= mysql_fetch_array($sqls)){
                    $purch = $purch+$rows['PurchaseMaster_SubTotalAmount']; 
                    $returnInv = $rows['PurchaseMaster_InvoiceNo'];
                    $returnSQL = mysql_query("SELECT * FROM sr_purchasereturn WHERE PurchaseMaster_InvoiceNo = '".$returnInv."'");
                    $returnRow = mysql_fetch_array($returnSQL);
                    $returnAmount = $returnAmount + $returnRow['PurchaseReturn_ReturnAmount'];
                    $totalReturn = $totalReturn + $returnRow['PurchaseReturn_ReturnAmount'];
                }
                $totalpurchase = $totalpurchase +$purch; 
                $Totalpaid = $Totalpaid +$paid;
            ?>
        <tr>
            <td><?php echo $record['Supplier_Code'] ?></td>
            <td><?php echo $record['Supplier_Name'] ?></td>
            <td><?php echo $record['Supplier_Mobile'] ?></td>
            <td><?php echo $purch ?></td>
            <td><?php echo $paid ?></td>
            <td><?php echo $returnAmount ?></td>
            <td><?php echo ($purch-$paid-$returnAmount); ?></td>
            <td><a class="btn-add fancybox fancybox.ajax" href="<?php echo base_url() ?>supplier/supplier_due_payment/<?php echo $supid; ?>">
                <input type="button" name="country_button" value="Due Payment"  class="button" style="padding:7px 10px;font-size:16px;"/>                                
            </a></td>
        </tr>
        <?php } //}?>
       
    </table>
    <br>
    <br>
    <table  cellspacing="0" cellpadding="0" width="70%">
        <tr>
            <td ><strong>Total Purchase </strong><input type="text" disabled="" value="<?php echo $totalpurchase; ?>"></td>
            <td> <strong>Total Paid </strong> <input type="text" disabled="" value="<?php echo $Totalpaid; ?>"></td>
            <td> <strong>Total Return </strong> <input type="text" disabled="" value="<?php echo $totalReturn; ?>"></td>
            <td align="right"><strong>Total Due </strong> <input type="text" disabled="" value="<?php echo ($totalpurchase - $Totalpaid -$totalReturn); ?>"></td>
            <td></td>
        </tr>
    </table>

</div>
</span>