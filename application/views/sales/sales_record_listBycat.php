<link href="<?php echo base_url()?>css/prints.css" rel="stylesheet" />
<div class="content_scroll" style="padding:40px 20px 25px 160px">

    <table class="border" cellspacing="0" cellpadding="0" width="70%">

        <h4><a style="cursor:pointer" onclick="window.open('<?php echo base_url(); ?>reports/search_sales_recordbyCate', 'newwindow', 'width=850, height=800,scrollbars=yes'); return false;"><img src="<?php echo base_url(); ?>images/printer.png" alt=""> Print</a></h4>
        <tr bgcolor="#89B03E">
            <th>Invoice No.</th>
            <th>Date</th>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Category</th>
            <th>QTY</th>
            <th>Rate</th>
            <th>Total</th>
        </tr>
        <?php $totalpurchase = "";
        $Totalpaid = "";
        $total = "";
        foreach($record as $record){ 
            $totalpurchase = $totalpurchase +$record['SaleMaster_SubTotalAmount']; 
            $Totalpaid = $Totalpaid +$record['SaleMaster_PaidAmount'];

            ?>
        <tr>
            <td><?php echo $record['SaleMaster_InvoiceNo'] ?></td>
            <td><?php echo $record['SaleMaster_SaleDate'] ?></td>
            <td><?php echo $record['Customer_Code'] ?></td>
            <td><?php echo $record['Customer_Name'] ?></td>
            <td><?php echo $record['ProductCategory_Name'] ?></td>
            <td><?php echo $record['SaleDetails_TotalQuantity'].$record['SaleDetails_unit'] ?></td>
            <td><?php echo $record['SaleDetails_Rate'] ?></td>
            <td><?php echo $total = $total+ $record['SaleDetails_Rate']*$record['SaleDetails_TotalQuantity'] ?></td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="7" align="right"><strong>Total</strong></td>
            <td><?php echo $total ?></td>
        </tr>
       
    </table>

</div>