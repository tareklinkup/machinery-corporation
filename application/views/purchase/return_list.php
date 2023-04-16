<link href="<?php echo base_url()?>css/prints.css" rel="stylesheet" />
<div class="content_scroll" style="padding:120px 20px 25px 160px">
<h1 align="center">Purchase Return List</h1>
    <table class="border" cellspacing="0" cellpadding="0" width="70%">

        <h4><a style="cursor:pointer" onclick="window.open('<?php echo base_url(); ?>reports/purchase_returnlist', 'newwindow', 'width=850, height=800,scrollbars=yes'); return false;"><img src="<?php echo base_url(); ?>images/printer.png" alt=""> Print</a></h4>
        <tr bgcolor="#ccc">
            <th>Invoice No.</th>
            <th>Date</th>
            <th>Customer Code</th>
            <th>Customer Name</th>
            <th>Return Qty</th>
            <th>Return Amount</th>
            <th>Notes</th>
        </tr>
        <?php $total = "";
            $sql = mysql_query("SELECT sr_purchasereturn.*,sr_purchasemaster.*,sr_supplier.* FROM sr_purchasereturn left join sr_purchasemaster on sr_purchasemaster.PurchaseMaster_InvoiceNo=sr_purchasereturn.PurchaseMaster_InvoiceNo left join sr_supplier on sr_supplier.Supplier_SlNo = sr_purchasemaster.Supplier_SlNo");
            while($record = mysql_fetch_array($sql)){
                $total = $total+$record['PurchaseReturn_ReturnAmount'];
            ?>
        <tr>
            <td><?php echo $record['PurchaseMaster_InvoiceNo'] ?></td>
            <td><?php echo $record['PurchaseReturn_ReturnDate'] ?></td>
            <td><?php echo $record['Supplier_Code'] ?></td>
            <td><?php echo $record['Supplier_Name'] ?></td>
            <td><?php echo $record['PurchaseReturn_ReturnQuantity'] ?></td>
            <td><?php echo $record['PurchaseReturn_ReturnAmount'] ?></td>
            <td><?php echo $record['PurchaseReturn_Description'] ?></td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="5" align="right"><strong>Total </strong></td>
            <td><strong><?php echo $total; ?></strong></td>
            <td></td>
        </tr>
       
    </table>
   

</div>