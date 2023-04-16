

<!DOCTYPE html>

<html>

<head>

<title> </title>

<meta charset='utf-8'>

    <link href="<?php echo base_url()?>css/prints.css" rel="stylesheet" />

    <link href="<?php echo base_url()?>assets/css/custom-styles.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/print.css">

</head>

<style type="text/css" media="print">

.hide{display:none}



</style>

<script type="text/javascript">

function printpage() {

document.getElementById('printButton').style.visibility="hidden";

window.print();

document.getElementById('printButton').style.visibility="visible";  

}

</script>

<body style="background:none;">

<input name="print" type="button" value="Print" id="printButton" onClick="printpage()">



      <table width="800px" >

        <tr>
          <td>            
            <div style="width:15%;float:left;">
                <img src="<?php echo base_url();?>images/logo.png" alt="Logo" style="margin-bottom:-10px;margin-left:30px;width:100px">
            </div>
            <div style="width:85%;">
                <div style="text-align:center" >
                    <strong style="font-size:16px;color:#1e2d54;">NEW JES MACHINERY CORPORATION</strong><br>
                    <small>209 Nawabpur Road, Dhaka 1100, Bangladesh.</small><br>
                    <small>Phone: +88-02-9568926, 9580512, Mobile: +88 01711832449, +88 01756943997</small><br>
                    <small>Fax: +88-02-7113987, Email: newjesmachinery@gmail.com</small>
                </div>
            </div>
          </td>
        </tr>

        <tr>
            <td><hr><hr></td>
        </tr>
        <?php 
        $sql = mysql_query("SELECT * FROM tbl_moneyreceipt WHERE MoneyReceipt_SINo = '$id'");
        $receipr = mysql_fetch_array($sql);
        ?>
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td colspan="3" style="text-align:center;">No: <?php echo $receipr['MoneyReceipt_No']; ?></td>
                        <td colspan="3" style="border:1px solid #000;text-align:center;">Money Receipt</td>
                        <td colspan="3" style="text-align:center;">Date: <?php echo $receipr['MoneyReceipt_PayDate']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="9">Received with thanks from .... <?php echo $receipr['MoneyReceipt_Name']; ?></td>

                    </tr>
                    <tr>
                        <td colspan="9">By Cash/Cheque/Pay Order: <?php echo $receipr['MoneyReceipt_ChequeNo']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="9">Bank/Account : <?php echo $receipr['Money_receipt_accountNo']; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Amount: <?php echo $receipr['MoneyReceipt_Amount']; ?></td>
                        <td colspan="7"></td>
                    </tr>
                    
                    <tr>
                        <td colspan="9"><br><br><br></td>
                    </tr>
                    <tr>
                        <td style="border-top:1px dotted #000;">Buyer Signature</td>
                        <td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        <td style="border-top:1px dotted #000;">Authorize Signature</td>
                    </tr>
                </table>
            </td>
        </tr>
</table>

<br><br><br><br>
<table width="800px" >

    <tr>
      <td>            
        <div style="width:25%;float:left;">
            <img src="<?php echo base_url();?>images/al-wazid.jpg" alt="Logo" style="margin-bottom:-50px;margin-left:5px;width:140px">
            <p style="margin-top: 45px;margin-left:10px;font-size:11pt;"><small>Trade Licence No: 0470060</small></p>
        </div>
        <div style="width:50%;float:left;">
            <div style="text-align:center" >
                <strong style="font-size:28px;color:#1e2d54;">Al-Wazid Corporation</strong><br>
                <small>243,244,Nawabpur Road.Mullick Market, </small><br>
                <small>Dhaka 1100, Bangladesh. Phone: +88 02 57164734</small><br>
                <small>Mobile: +88 01775 733333, +88 01753 622222</small><br>
                <small>Email: alwazid@hotmail.com</small>
            </div>
        </div>
      </td>
    </tr>
    
    <tr>
        <td><hr><hr></td>
    </tr>
    <?php 
    $sql = mysql_query("SELECT * FROM tbl_moneyreceipt WHERE MoneyReceipt_SINo = '$id'");
    $receipr = mysql_fetch_array($sql);
    ?>
    <tr>
        <td>
            <table width="100%">
                <tr>
                    <td colspan="3" style="text-align:center;">No: <?php echo $receipr['MoneyReceipt_No']; ?></td>
                    <td colspan="3" style="border:1px solid #000;text-align:center;">Money Receipt</td>
                    <td colspan="3" style="text-align:center;">Date: <?php echo $receipr['MoneyReceipt_PayDate']; ?></td>
                </tr>
                <tr>
                    <td colspan="9">Received with thanks from .... <?php echo $receipr['MoneyReceipt_Name']; ?></td>

                </tr>
                <tr>
                    <td colspan="9">By Cash/Cheque/Pay Order: <?php echo $receipr['MoneyReceipt_ChequeNo']; ?></td>
                </tr>
                <tr>
                    <td colspan="9">Bank/Account : <?php echo $receipr['Money_receipt_accountNo']; ?></td>
                </tr>
                <tr>
                    <tr>
                    <td colspan="2">Amount: <?php echo $receipr['MoneyReceipt_Amount']; ?></td>
                    <td colspan="7"></td>
                </tr>
                </tr>
                
                <tr>
                    <td colspan="9"><br><br><br></td>
                </tr>
                <tr>
                    <td style="border-top:1px dotted #000;">Buyer Signature</td>
                    <td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td style="border-top:1px dotted #000;">Authorize Signature</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<div class="signature" style="width:800px;">
    <div style="width:30%;float:left;text-align:center;margin-top:0px">
        <span style="border-top:1px dotted #000;font-weight:bold;font-size: 12px;">Buyer Signature</span>
    </div>
    <div style="width:40%;float:left;text-align:center;">
        <p>Thank You for Your Business!</p>        
    </div>
    <div style="width:30%;float:left;text-align:right;margin-top:0px">
        <span style="border-top:1px dotted #000;font-weight:bold;font-size: 12px;">Authorize Signature</span>
    </div>
</div>
</body>
</html>