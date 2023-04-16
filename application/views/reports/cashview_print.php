

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

          <td style="float:right">

            <table width="100%"  border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td width="250px" style="text-align:right;"><strong></td>

              </tr>

          </table>

          </td>

        </tr>

        <tr>

            <td colspan="2"><hr><hr></td>

            <td colspan="2"><br></td>

        </tr>

        <tr>

            <td colspan="2" style="background:#ddd;" align="center"><h2 >Cash View</h2></td>

        </tr>

        <tr>

            <td>

            <!-- Page Body -->

          

              <table class="border" cellspacing="0" cellpadding="0" width="100%">

                <tr >

                  <th>Account Name</th>

                  <th>Description</th>

                  <th>In Amount</th>                      

                  <th>Out Amount</th> 

                </tr>

                <?php

        $in="";$out="";

        foreach($record as $row){ 

            $in=$in+$row['In_Amount'];

            $out=$out+$row['Out_Amount'];

            ?>

        <tr>

            <td><?php echo $row['Acc_Name'] ?></td>

            <td><?php echo $row['Tr_Description'] ?></td>

            <td><?php if($row['In_Amount']==""){echo "0";}else{ echo $row['In_Amount'];} ?></td>

            <td><?php if($row['Out_Amount']==""){echo "0";}else{ echo $row['Out_Amount'];} ?></td>

        </tr>

        <?php } 

        $expence_startdate = $this->session->userdata('expence_startdate');

        $expence_enddate = $this->session->userdata('expence_enddate');

        $purchase = "";

        $sql = mysql_query("SELECT * FROM sr_supplier_payment  where SPayment_date between '$startdate' AND '$enddate' ");

        while($roof = mysql_fetch_array($sql)){

            $purchase =$purchase+$roof['SPayment_amount'];

        

        }?>

         <tr>

            <td>Purchase</td>

            <td>Purducts</td>

            <td>0</td>

            <td><?php echo $purchase; ?></td>

        </tr>

        <?php  

        $expence_startdate = $this->session->userdata('expence_startdate');

        $expence_enddate = $this->session->userdata('expence_enddate');

        $sell = "";

        $sql = mysql_query("SELECT * FROM sr_customer_payment where CPayment_date between '$startdate' AND '$enddate'");

        while($roof = mysql_fetch_array($sql)){

            $sell =$sell+$roof['CPayment_amount'];

        

        }?>

        <tr>

            <td>Sales</td>

            <td>Purducts</td>

            <td><?php echo $sell; ?></td>

            <td>0</td>

        </tr>

        <?php $totalreturn = "";

            $sqlx = mysql_query("SELECT * FROM sr_salereturn where SaleReturn_ReturnDate between '$startdate' AND '$enddate'");

            while($rom = mysql_fetch_array($sqlx)){

                $totalreturn = $totalreturn+$rom['SaleReturn_ReturnAmount'];

        }?>

        <tr>

            <td>Sales Return</td>

            <td>Purducts</td>

            <td>0</td>

            <td><?php echo $totalreturn; ?></td>

        </tr>

        <?php $totalreturnP = "";

            $sqlx = mysql_query("SELECT * FROM sr_purchasereturn where PurchaseReturn_ReturnDate between '$startdate' AND '$enddate'");

            while($rom = mysql_fetch_array($sqlx)){

                $totalreturnP = $totalreturnP+$rom['PurchaseReturn_ReturnAmount'];

        }?>

        <tr>

            <td>Pruchase Return</td>

            <td>Purducts</td>

            <td><?php echo $totalreturnP; ?></td>

            <td>0</td>

        </tr>

        <tr>

            <td colspan="2" align="right"><strong>Total</strong></td>

            <td><strong><?php echo $income = $sell+$in+$totalreturnP; ?></strong></td>

            <td><strong><?php echo $expenc =  $purchase+$out+$totalreturn; ?></strong></td>

        </tr>

        <tr>

            <td colspan="3" align="right"><strong>Remainder Balance</strong></td>

            <td><strong><?php echo $income- $expenc; ?></strong></td>

        </tr>

              </table>

            </td>

            <!-- Page Body end -->

       

    </table></td>

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