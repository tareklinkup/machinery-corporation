<table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="text-align:left;width:100%;">
    <tbody>
    <?php 
        foreach($records as $record){ 
    ?>
        <tr>
            <td style="width:100px"><?php echo $record['SalesInvoiceno'] ?></td>
            <td style="width:200px"><?php echo $record['CompanyName'] ?></td>
            <td style="width:200px"><?php echo $record['CheckNo'] ?></td>
            <td style="width:200px"><?php echo $record['BankName'] ?></td>
            <td style="width:200px"><?php echo $record['BrunchName'] ?></td>
            <td style="width:200px"><?php echo $record['CheckDate'] ?></td>
            <td style="width:100px">
                <input type="button" class="btn btn-primary" value="Cashed" onclick="cashed(<?php echo $record['CheckPay_SINo'] ?>)"/>
            </td>
        </tr>  
    <?php } ?>                                                     
    </tbody>
</table>