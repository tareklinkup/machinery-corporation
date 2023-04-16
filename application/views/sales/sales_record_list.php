
<link href="<?php echo base_url()?>css/prints.css" rel="stylesheet" />
<div class="content_scroll" style="padding:40px 20px 25px 160px">

    <?php
    $totalpurchase='';
    $Totalpaid='';
    if($type == "Product"):
        ?>
        <table class="border" cellspacing="0" cellpadding="0" width="70%">

            <h4><a style="cursor:pointer" onclick="window.open('<?php echo base_url(); ?>reports/search_sales_record', 'newwindow', 'width=850, height=800,scrollbars=yes'); return false;"><img src="<?php echo base_url(); ?>images/printer.png" alt=""> Print</a></h4>
            <tr bgcolor="#89B03E">
                <th>Date</th>
                <th>Invoice No.</th>
                <th>Product</th>
                <th>Customer</th>
                 <th>Purchase Rate</th>
                <th>Sale Rate</th>
                <th>Unit</th>
                <th>Quantity</th>
                <th>Amount</th>
            </tr>
            <?php
            foreach($products as $product):

                ?>
                <tr>
                    <td><?=$product->SaleMaster_SaleDate ?></td>
                    <td><?=$product->SaleMaster_InvoiceNo ?></td>
                    <td> <?=$product->Product_Name ?> (<?=$product->Product_IDNo ?>)</td>
                    <td> <?=$product->Customer_Name!=''?$product->Customer_Name:'No Name' ?> - <?=$product->SalseCustomer_IDNo ?></td>
                    <td><?=$product->Purchase_Rate ?></td>
                    <td><?=$product->SaleDetails_Rate ?></td>
                    <td><?=$product->SaleDetails_unit ?></td>
                    <td><?=$product->SaleDetails_TotalQuantity ?></td>
                    <td><?=$product->SaleDetails_TotalQuantity  * $product->SaleDetails_Rate?></td>

                </tr>
            <?php endforeach; ?>

        </table>

    <?php else:?>
    <table class="border" cellspacing="0" cellpadding="0" width="70%">

        <h4><a style="cursor:pointer" onclick="window.open('<?php echo base_url(); ?>reports/search_sales_record', 'newwindow', 'width=850, height=800,scrollbars=yes'); return false;"><img src="<?php echo base_url(); ?>images/printer.png" alt=""> Print</a></h4>
        <tr bgcolor="#89B03E">
            <th>Invoice No.</th>
            <th>Date</th>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Discount</th>
            <!-- <th>Purchase Rate</th> -->
            <th>Total</th>
            <th>Paid</th>
            <th>Due</th>
            <th>Notes</th>
        </tr>
        <?php $totalpurchase = "";
        $Totalpaid = "";
        foreach($record as $record){ 
            $totalpurchase = $totalpurchase +$record['SaleMaster_SubTotalAmount']; 
            $Totalpaid = $Totalpaid +$record['SaleMaster_PaidAmount'];

            ?>
        <tr>
            <td><?php echo $record['SaleMaster_InvoiceNo'] ?></td>
            <td><?php echo $record['SaleMaster_SaleDate'] ?></td>
            <td><?php echo $record['Customer_Code'] ?></td>
            <td><?php echo $record['Customer_Name'] ?></td>
            <td><?php echo $record['SaleMaster_TotalDiscountAmount'] ?></td>
            <!-- <td>
            <?php  
            $sqll = mysql_query("SELECT * FROM sr_saledetails WHERE SaleMaster_IDNo ='".$record['SaleMaster_SlNo']."'");
            $pruRate = "0";
            while($roww = mysql_fetch_array($sqll)){
               $Purchase_Rate = $roww['SaleDetails_TotalQuantity']*$roww['Purchase_Rate'];
               $pruRate = $pruRate +$Purchase_Rate;
            }echo $pruRate;
            ?>

            </td> -->
            <td><?php echo $record['SaleMaster_SubTotalAmount'] ?></td>
            <td><?php echo $record['SaleMaster_PaidAmount'] ?></td>
            <td><?php echo $record['SaleMaster_DueAmount'] ?></td>
            <td><?php echo $record['SaleMaster_Description'] ?></td>
        </tr>
        <?php } ?>
       
    </table>

    <br>
    <br>
    <table  cellspacing="0" cellpadding="0" width="70%">
        <tr>
            <td ><strong>Total Sales </strong><input type="text" disabled="" value="<?php  echo $totalpurchase; ?>"></td>
            <td> <strong>Total Paid </strong> <input type="text" disabled="" value="<?php  echo $Totalpaid; ?>"></td>
            <td><strong>Total Due </strong> <input type="text" disabled="" value="<?php  echo $totalpurchase - $Totalpaid; ?>"></td>
            <td></td>
        </tr>
    </table>
    <?php endif;?>
</div>