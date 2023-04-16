<link href="<?php echo base_url()?>css/prints.css" rel="stylesheet" />
<div class="content_scroll" style="padding:40px 20px 25px 160px">

    <table class="border" cellspacing="0" cellpadding="0" width="70%">

        <h4><a style="cursor:pointer" onclick="window.open('<?php echo base_url(); ?>reports/supplier_payment_print', 'newwindow', 'width=850, height=800,scrollbars=yes'); return false;"><img src="<?php echo base_url(); ?>images/printer.png" alt=""> Print</a></h4>
        <tr bgcolor="#89B03E">
            
            <th>Supplier ID</th>
            <th>Date</th>
            <th>Supplier Name</th>
            <th>Contact No</th>
            <th>Payment</th>
            <th>By</th>
        </tr>
        <?php
        foreach($record as $record){ ?>
        <tr>
            <td><?php echo $record['Supplier_Code'] ?></td>
            <td><?php echo $record['SPayment_date'] ?></td>
            <td><?php echo $record['Supplier_Name'] ?></td>
            <td><?php echo $record['Supplier_Mobile'] ?></td>
            <td><?php echo $record['SPayment_amount'] ?></td>
            <td><?php echo $record['SPayment_Paymentby'] ?></td>
        </tr>
        <?php } ?>
       
    </table>

</div>