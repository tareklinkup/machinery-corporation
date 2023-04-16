<table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="text-align:left;width:100%;">
    <tbody>
    <?php $sql = mysql_query("SELECT * FROM tbl_check_pay WHERE CheckStatus = 'P' ORDER BY CheckDate ASC");
    while($row = mysql_fetch_array($sql)){ ?>
        <tr>
            <td style="width:100px"><?php echo $row['SalesInvoiceno'] ?></td>
            <td style="width:200px"><?php echo $row['CompanyName'] ?></td>
            <td style="width:200px"><?php echo $row['CheckNo'] ?></td>
            <td style="width:200px"><?php echo $row['BankName'] ?></td>
            <td style="width:200px"><?php echo $row['BrunchName'] ?></td>
            <td style="width:200px"><?php echo $row['CheckDate'] ?></td>
            <td style="width:100px">
                <input type="button" class="btn btn-primary" value="Cashed" onclick="cashed(<?php echo $row['CheckPay_SINo'] ?>)"/>
            </td>
        </tr>  
    <?php } ?>                                                     
    </tbody>
</table>