<link href="<?php echo base_url()?>css/prints.css" rel="stylesheet" />
<div class="content_scroll" style="padding:120px 20px 25px 160px">
<h1 align="center">Sales Return List</h1>
    <table class="border" cellspacing="0" cellpadding="0" width="70%">

        <h4><a style="cursor:pointer" onclick="window.open('<?php echo base_url(); ?>reports/salesreturnlist', 'newwindow', 'width=850, height=800,scrollbars=yes'); return false;"><img src="<?php echo base_url(); ?>images/printer.png" alt=""> Print</a></h4>
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
            $sql = mysql_query("SELECT sr_salereturn.*,sr_salesmaster.*,sr_customer.* FROM sr_salereturn left join sr_salesmaster on sr_salesmaster.SaleMaster_InvoiceNo=sr_salereturn.SaleMaster_InvoiceNo left join sr_customer on sr_customer.Customer_SlNo = sr_salesmaster.SalseCustomer_IDNo");
            while($record = mysql_fetch_array($sql)){
                $total = $total+$record['SaleReturn_ReturnAmount'];
            ?>
        <tr>
            <td><?php echo $record['SaleMaster_InvoiceNo'] ?></td>
            <td><?php echo $record['SaleReturn_ReturnDate'] ?></td>
            <td><?php echo $record['Customer_Code'] ?></td>
            <td><?php echo $record['Customer_Name'] ?></td>
            <td><?php echo $record['SaleReturn_ReturnQuantity'] ?></td>
            <td><?php echo $record['SaleReturn_ReturnAmount'] ?></td>
            <td><?php echo $record['SaleReturn_Description'] ?></td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="5" align="right"><strong>Total </strong></td>
            <td><strong><?php echo $total; ?></strong></td>
            <td></td>
        </tr>
       
    </table>
   

</div>