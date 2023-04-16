<link href="<?php echo base_url()?>css/prints.css" rel="stylesheet" />
<div class="content_scroll" style="padding:120px 20px 25px 160px">
<a style="cursor:pointer" onclick="window.open('<?php echo base_url(); ?>reports/money_receipt', 'newwindow', 'width=850, height=800,scrollbars=yes'); return false;"><img src="<?php echo base_url(); ?>images/printer.png" alt=""> Print</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url(); ?>sales/money_receipt" title="" class="buttonAshiqe">Back To Receipt</a>

<?php 
    $receiptID = $this->session->userdata("receiptID");
  $sql = mysql_query("SELECT * FROM tbl_moneyreceipt WHERE MoneyReceipt_SINo = '$receiptID'");
  $receipt = mysql_fetch_array($sql);
?>
    <table  cellspacing="0" cellpadding="0" width="70%">
        <tr>
            <td colspan="2" style="background:#ddd;" align="center"><h2 >Money Receipt</h2></td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td>Receipt No</td>
                        <td>: </td>
                        <td><?php echo $receipt['MoneyReceipt_No']; ?></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>: </td>
                        <td><?php echo $receipt['MoneyReceipt_Name']; ?></td>
                    </tr>
                    <tr>
                        <td>Receipt Type</td>
                        <td>: </td>
                        <td><?php echo $receipt['Money_receipt_Paytype']; ?></td>
                    </tr>
                    <tr>
                        <td>Account No</td>
                        <td>: </td>
                        <td><?php echo $receipt['Money_receipt_accountNo']; ?></td>
                    </tr>
                    <tr>
                        <td>Cheque No</td>
                        <td>: </td>
                        <td><?php echo $receipt['MoneyReceipt_ChequeNo']; ?></td>
                    </tr>
                    <tr>
                        <td>Total Amount</td>
                        <td>: </td>
                        <td><?php echo $receipt['MoneyReceipt_Amount']; ?></td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td>: </td>
                        <td><?php echo $receipt['MoneyReceipt_PayDate']; ?></td>
                    </tr>
                </table>
            </td>

        </tr>

    </table>

</div>