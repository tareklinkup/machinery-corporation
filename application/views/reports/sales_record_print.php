

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

            <td colspan="2" style="background:#ddd;" align="center"><h2 >Sales Record</h2></td>

        </tr>

        <tr>

            <td>

            <!-- Page Body -->

          

              <table class="border" cellspacing="0" cellpadding="0" width="100%">

                <tr>

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

            </td>

            

            <!-- Page Body end -->

        </tr>

          <tr>

            <td colspan="2"><br></td>

        </tr>

        <tr>

          <td>

            <table  cellspacing="0" cellpadding="0" width="70%">

              <tr>

                  <td ><strong>Total Sales </strong><input type="text" disabled="" value="<?php echo $totalpurchase; ?>"></td>

                  <td> <strong>Total Paid </strong> <input type="text" disabled="" value="<?php echo $Totalpaid; ?>"></td>

                  <td><strong>Total Due </strong> <input type="text" disabled="" value="<?php echo $totalpurchase - $Totalpaid; ?>"></td>

                  <td></td>

              </tr>

            </table>

          </td>

        </tr>

       

       

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