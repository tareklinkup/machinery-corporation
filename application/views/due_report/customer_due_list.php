<span id="Search_Results_Duepayment">
<link href="<?php echo base_url()?>css/prints.css" rel="stylesheet" />
<div class="content_scroll" style="padding:40px 20px 25px 160px">

    <table class="border" cellspacing="0" cellpadding="0" width="70%">

        <h4><a style="cursor:pointer" onclick="window.open('<?php echo base_url(); ?>reports/search_customer_due', 'newwindow', 'width=850, height=800,scrollbars=yes'); return false;"><img src="<?php echo base_url(); ?>images/printer.png" alt=""> Print</a></h4>
        <tr bgcolor="#89B03E">
          
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Total</th>
            <th>Paid</th>
            <th>Return</th>
            <th>Due</th>
            <th></th>
        </tr>
        <?php 
        $totalpurchase = "";
        $Totalpaid = "";
        $totalreturn = "";
        $due = "";
        foreach($record as $record){ 
            //if($record['SaleMaster_DueAmount'] > 0){
            $Custid = $record['SalseCustomer_IDNo'];
            $paid='';
            $sql = mysql_query("SELECT * FROM sr_customer_payment WHERE CPayment_customerID = '".$Custid."'");
            while($row = mysql_fetch_array($sql)){
                $paid = $paid+$row['CPayment_amount'];    
            }
            $purchase="";
            $customerReturnAmount = "";
            $sqls = mysql_query("SELECT * FROM sr_salesmaster WHERE SalseCustomer_IDNo = '".$Custid."'");
            while($rows = mysql_fetch_array($sqls)){
                $purchase = $purchase +$rows['SaleMaster_SubTotalAmount']; 
                $returninvoice = $rows['SaleMaster_InvoiceNo'];
                $returnSQL = mysql_query("SELECT * FROM sr_salereturn WHERE SaleMaster_InvoiceNo = '".$returninvoice."'");
                $returnRow = mysql_fetch_array($returnSQL);
                $customerReturnAmount = $customerReturnAmount + $returnRow['SaleReturn_ReturnAmount'];
                $totalreturn = $totalreturn + $returnRow['SaleReturn_ReturnAmount'];
            }
            if($purchase- $paid !="0"){
            $totalpurchase = $totalpurchase+$purchase;
            $Totalpaid = $Totalpaid+$paid;
            ?>
        <tr>
          
            <td><?php echo $record['Customer_Code'] ?></td>
            <td><?php echo $record['Customer_Name'] ?></td>
            <td><?php echo $purchase ?></td>
            <td><?php echo $paid ?></td>
            <td><?php echo $customerReturnAmount ?></td>
            <td><?php echo $purchase - $paid - $customerReturnAmount ?></td>
            <td><a class="btn-add fancybox fancybox.ajax" href="<?php echo base_url() ?>customer/customer_due_payment/<?php echo $record['SalseCustomer_IDNo']; ?>">
                <input type="button" name="country_button" value="Due Payment"  class="button" style="padding:7px 10px;font-size:16px;"/>                                
            </a></td>
        </tr>

        <?php } }?>
       
    </table>
    <br>
    <br>
    <table  cellspacing="0" cellpadding="0" width="70%">
        <tr>
            <td ><strong>Total Sales </strong><input type="text" disabled="" value="<?php echo $totalpurchase; ?>"></td>
            <td> <strong>Total Paid </strong> <input type="text" disabled="" value="<?php echo $Totalpaid; ?>"></td>
            <td> <strong>Total Return </strong> <input type="text" disabled="" value="<?php echo $totalreturn; ?>"></td>
            <td align="right"> <strong>Total Due </strong> <input type="text" disabled="" value="<?php echo ($totalpurchase - $Totalpaid - $totalreturn); ?>"></td>
            <td></td>
        </tr>
        <tr><td colspan="4">&nbsp;</td></tr>
       <!--  <tr>
           <td ></td>
           <td> </td>
           <td align="right"><a class="btn-add fancybox fancybox.ajax" href="<?php echo base_url() ?>customer/customer_due_payment">
               <input type="button" name="country_button" value="Due Payment"  class="button" style="padding:7px 10px;font-size:16px;"/>                                
           </a> </td>
           <td></td>
       </tr> -->
    </table>

</div>
</span>