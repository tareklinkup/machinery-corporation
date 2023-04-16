<?php
$userType = $this->session->userdata('accountType');
?>

    <table class="border" cellspacing="0" cellpadding="0" width="70%">

        <h4><a style="cursor:pointer" onclick="window.open('<?php echo base_url(); ?>reports/current_stock', 'newwindow', 'width=850, height=800,scrollbars=yes'); return false;"><img src="<?php echo base_url(); ?>images/printer.png" alt=""> Print</a></h4>
        <tr>
            <td colspan="5" align="center"><h2>Current Stock</h2></td>
        </tr>
        <tr bgcolor="#ccc">
            <th>Product Name</th>
            <th>Qty</th>
            <?php
              if($userType == 'Admin'){
            ?>
            <th>Purchase Price</th>
            <th>Total Price</th>
            <?php
            }
            ?>
            <th>Unit</th>
        </tr>
        <?php
        $totalqty = 0;$sellTOTALqty = 0; $subtotal = 0;
        if($CatID == ''){
            $sql = mysql_query("SELECT sr_purchaseinventory.*,tbl_product.*,sr_purchasedetails.* FROM sr_purchaseinventory left join tbl_product on tbl_product.Product_SlNo = sr_purchaseinventory.purchProduct_IDNo left join sr_purchasedetails on sr_purchasedetails.Product_IDNo = tbl_product.Product_SlNo WHERE sr_purchaseinventory.PurchaseInventory_Store = '$Store' group by sr_purchasedetails.Product_IDNo");
        }else{
            $sql = mysql_query("SELECT sr_purchaseinventory.*,tbl_product.*,sr_purchasedetails.* FROM sr_purchaseinventory left join tbl_product on tbl_product.Product_SlNo = sr_purchaseinventory.purchProduct_IDNo left join sr_purchasedetails on sr_purchasedetails.Product_IDNo = tbl_product.Product_SlNo WHERE sr_purchaseinventory.PurchaseInventory_Store = '$Store' AND tbl_product.ProductCategory_ID = '$CatID' group by sr_purchasedetails.Product_IDNo");
        }
        while($record = mysql_fetch_array($sql)){
                $totalqty = $record['PurchaseInventory_TotalQuantity'] + $record['PurchaseInventory_ReturnQuantity'];
                $totalqty = $totalqty-$record['PurchaseInventory_DamageQuantity'];
                
                $PID = $record['purchProduct_IDNo'];

                // Sell qty
                $sqq = mysql_query("SELECT * FROM sr_saleinventory WHERE sellProduct_IdNo = '$PID' AND SaleInventory_Store = '$Store'");
                $or = mysql_fetch_array($sqq);
                if($or['SaleInventory_packname'] ==""){
                $sellTOTALqty = $or['SaleInventory_TotalQuantity'];
               
                $sellTOTALqty = $sellTOTALqty-$or['SaleInventory_DamageQuantity'];
                $totalqty = $totalqty -$sellTOTALqty+$or['SaleInventory_ReturnQuantity'];
                if($totalqty !="0"){
                    $rate = $totalqty*$record['Product_Purchase_Rate'];
                    $subtotal = $subtotal+$rate;
                ?>
                <tr>
                    <td><?php echo $record['Product_Name'] ?></td>
                    <td style="text-align: center;"><?php echo $totalqty; ?></td>
                    <?php
                      if($userType == 'Admin'){
                    ?>
                    <td style="text-align: right;"><?php echo number_format($record['Product_Purchase_Rate'], 2); ?></td>
                    <td style="text-align: right;"><?php echo number_format($rate, 2); ?></td>
                    <?php
                    }
                    ?>
                    <td><?php if($record['PurchaseDetails_Unit']==""){echo "pcs";} else{echo $record['PurchaseDetails_Unit']; }?></td>
                </tr>
        <?php }}}
        ?>
        <?php
        if($userType == 'Admin'){
        ?>
        <tr>
            <td style="border:0px"></td>
            <td style="border:0px"></td>
            <td><strong>Sub Total:</strong> </td>
            <td style="text-align: right;"><strong><?php echo number_format($subtotal, 2); ?> Tk</strong></td>
            <td style="border:0px"></td>
        </tr>
        <?php
        }
        ?>


    </table>

