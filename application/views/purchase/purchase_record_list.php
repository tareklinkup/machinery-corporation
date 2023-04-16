<link href="<?php echo base_url()?>css/prints.css" rel="stylesheet" />
<div class="content_scroll" style="padding:40px 20px 25px 160px">

    <table class="border" cellspacing="0" cellpadding="0" width="70%">

        <h4><a style="cursor:pointer" onclick="window.open('<?php echo base_url(); ?>reports/search_purchase_record', 'newwindow', 'width=850, height=800,scrollbars=yes'); return false;"><img src="<?php echo base_url(); ?>images/printer.png" alt=""> Print</a></h4>
        <tr bgcolor="#89B03E">
            <th>Invoice No.</th>
            <th>Date</th>
            <th>Supplier ID</th>
            <th>Supplier Name</th>
            <th>Discount</th>
            <th>Total</th>
            <th>Paid</th>
            <th>Due</th>
            <th>Notes</th>
        </tr>
        <?php $totalpurchase = "";
        $Totalpaid = "";
        foreach($record as $record){ 
            $totalpurchase = $totalpurchase +$record['PurchaseMaster_SubTotalAmount']; 
            $Totalpaid = $Totalpaid +$record['PurchaseMaster_PaidAmount'];

            ?>
        <tr>
            <td><?php echo $record['PurchaseMaster_InvoiceNo'] ?></td>
            <td><?php echo $record['PurchaseMaster_OrderDate'] ?></td>
            <td><?php echo $record['Supplier_Code'] ?></td>
            <td><?php echo $record['Supplier_Name'] ?></td>
            <td><?php echo $record['PurchaseMaster_DiscountAmount'] ?></td>
            <td><?php echo $record['PurchaseMaster_SubTotalAmount'] ?></td>
            <td><?php echo $record['PurchaseMaster_PaidAmount'] ?></td>
            <td><?php echo $record['PurchaseMaster_DueAmount'] ?></td>
            <td><?php echo $record['PurchaseMaster_Description'] ?></td>
        </tr>
        <?php } ?>
       
    </table>
    <br>
    <br>
    <table  cellspacing="0" cellpadding="0" width="70%">
        <tr>
            <td ><strong>Total Purchase </strong><input type="text" disabled="" value="<?php echo $totalpurchase; ?>"></td>
            <td> <strong>Total Paid </strong> <input type="text" disabled="" value="<?php echo $Totalpaid; ?>"></td>
            <td><strong>Total Due </strong> <input type="text" disabled="" value="<?php echo $totalpurchase - $Totalpaid; ?>"></td>
            <td></td>
        </tr>
    </table>

</div>