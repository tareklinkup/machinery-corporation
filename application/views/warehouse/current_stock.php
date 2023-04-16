<link href="<?php echo base_url()?>css/prints.css" rel="stylesheet" />
<div class="content_scroll" style="padding:120px 20px 25px 160px">
<h2>Current Stock</h2>
<table class="border" cellspacing="0" cellpadding="0" width="70%">

        <h4><a style="cursor:pointer" onclick="window.open('<?php echo base_url(); ?>reports/warehouse_current_stock', 'newwindow', 'width=850, height=800,scrollbars=yes'); return false;"><img src="<?php echo base_url(); ?>images/printer.png" alt=""> Print</a></h4>
        <tr>
            <td colspan="3" align="center"><h2>Current Stock</h2></td>
        </tr>
        <tr bgcolor="#ccc">
            <th>Product Name</th>
            <th>Qty</th>
            <th>Unit</th>
        </tr>
        <?php $totalqty = "";$sellTOTALqty = ""; $subtotal = "";
        $sql = mysql_query("SELECT sr_purchaseinventory.*,tbl_product.*,sr_purchasedetails.* FROM sr_purchaseinventory left join tbl_product on tbl_product.Product_SlNo = sr_purchaseinventory.purchProduct_IDNo left join sr_purchasedetails on sr_purchasedetails.Product_IDNo = tbl_product.Product_SlNo WHERE sr_purchaseinventory.PurchaseInventory_Store = 'Warehouse' group by sr_purchasedetails.Product_IDNo");

        while($record = mysql_fetch_array($sql)){
                $totalqty = $record['PurchaseInventory_TotalQuantity'] -$record['PurchaseInventory_ReturnQuantity'];
                $totalqty = $totalqty-$record['PurchaseInventory_DamageQuantity'];
                
                $PID = $record['purchProduct_IDNo'];
                // Sell qty
                $sqq = mysql_query("SELECT * FROM sr_saleinventory WHERE sellProduct_IdNo = '$PID' AND SaleInventory_Store = 'Warehouse'");
                $or = mysql_fetch_array($sqq);
                if($or['SaleInventory_packname'] ==""){
                $sellTOTALqty = $or['SaleInventory_TotalQuantity'];
               
                $sellTOTALqty = $sellTOTALqty-$or['SaleInventory_DamageQuantity'];
                $totalqty = $totalqty -$sellTOTALqty+$or['SaleInventory_ReturnQuantity'];
                if($totalqty !="0"){
                    $rate = $totalqty*$record['PurchaseDetails_Rate'];
                    $subtotal = $subtotal+$rate;
                ?>
                <tr>
                    <td><?php echo $record['Product_Name'] ?></td>
                    <td><?php echo $totalqty; ?></td>
                    <td><?php if($record['PurchaseDetails_Unit']==""){echo "pcs";} else{echo $record['PurchaseDetails_Unit']; }?></td>
                </tr>
        <?php }}}
        ?>
       
    </table>

</div>