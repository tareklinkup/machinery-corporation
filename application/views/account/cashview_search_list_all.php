<link href="<?php echo base_url()?>css/prints.css" rel="stylesheet" />



    <h3  align="center">Cash View All</h3>
    
    <table class="border" cellspacing="0" cellpadding="0" width="80%">
        <?php
        $in=$record['ina'];
        $out=$record['outa'];
        $purchase = "";
        $sql = mysql_query("SELECT * FROM sr_supplier_payment");
        while($roof = mysql_fetch_array($sql)){
            $purchase =$purchase+$roof['SPayment_amount'];
        
        }

        $sell = "";
        $sql = mysql_query("SELECT * FROM sr_customer_payment");
        while($roof = mysql_fetch_array($sql)){
            $sell =$sell+$roof['CPayment_amount'];
        
        }

        $totalreturn = "";
        $sqlx = mysql_query("SELECT * FROM sr_salereturn");
        while($rom = mysql_fetch_array($sqlx)){
            $totalreturn = $totalreturn+$rom['SaleReturn_ReturnAmount'];
        }
 
        $totalreturnP = "";
        $sqlx = mysql_query("SELECT * FROM sr_purchasereturn");
        while($rom = mysql_fetch_array($sqlx)){
          $totalreturnP = $totalreturnP+$rom['PurchaseReturn_ReturnAmount'];
        }

        ?>
        <tr bgcolor="#ccc">
            <th>Total In Amount</th>
            <th>Total Out Amount</th>
            <th>Remaining Balance</th>                       
        </tr>
        <tr>
          <td><?php echo $income = $sell+$in+$totalreturnP; ?></td>
          <td><?php echo $expenc =  $purchase+$out+$totalreturn; ?></td>
          <td><?php echo $income- $expenc; ?></td>
        </tr>
        
        
    </table>
