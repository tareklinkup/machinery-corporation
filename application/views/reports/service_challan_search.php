

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

            <td colspan="2" style="background:#ddd;" align="center"><h2 >Delivery Invoice</h2></td>

        </tr>

        <tr>

            <td>

            <!-- Page Body -->

           <?php 

            $sql = mysql_query("SELECT sr_servicechallanmaster.*, sr_servicechallanmaster.AddBy as served, sr_customer.* FROM sr_servicechallanmaster left join sr_customer on sr_customer.Customer_SlNo = sr_servicechallanmaster.Customer_IDNo where sr_servicechallanmaster.ChallanMaster_SlNo = '$id'");

            $selse = mysql_fetch_array($sql);?>

              <table  cellspacing="0" cellpadding="0" width="100%">

                <tr>

                  <td style="width:50%">

                    <table width="100%">

                      <tr>

                          <td style="font-size:11pt;width:135px;"><strong>Customer ID </strong></td>

                          <td style="font-size:11pt;">:</td>

                          <td style="font-size:11pt;"><?php echo $selse['Customer_Code']; ?></td>

                      </tr> 

                      <tr>

                          <td style="font-size:11pt;width:135px;"><strong>Customer Name </strong></td>

                          <td style="font-size:11pt;">:</td>

                          <td style="font-size:11pt;"><?php echo $selse['Customer_Name']; ?></td>

                      </tr> 

                      <tr>

                          <td style="font-size:11pt;width:135px;"><strong>Customer Address </strong></td>

                          <td style="font-size:11pt;">:</td>

                          <td style="font-size:11pt;"><?php echo $selse['Customer_Address']; ?></td>

                      </tr>

                      <tr>

                          <td style="font-size:11pt;width:135px;"><strong>Contact no </strong></td>

                          <td style="font-size:11pt;">:</td>

                          <td style="font-size:11pt;"><?php echo $selse['Customer_Mobile']; ?></td>

                      </tr>              

                  </table>

                  </td>

                  <td style="width:50%">

                   <table width="100%">

                    <tr>

                        <td style="font-size:11pt;width:135px;"><strong>Delivery Invoice No </strong></td>

                        <td style="font-size:11pt;">:</td>

                        <td style="font-size:11pt;"><?php echo $selse['ChallanMaster_ChallanNo']; ?></td>

                    </tr> 

                    <tr>

                        <td style="font-size:11pt;width:135px;"><strong>Date </strong></td>

                        <td style="font-size:11pt;">:</td>

                        <td style="font-size:11pt;"><?php echo $selse['ChallanDate']; ?></td>

                    </tr>

                    <tr>

                        <td style="font-size:11pt;width:135px;"><strong>PO No </strong></td>

                        <td style="font-size:11pt;">:</td>

                        <td style="font-size:11pt;"><?php echo $selse['Po_No']; ?></td>

                    </tr> 

                    <tr>

                        <td style="font-size:11pt;width:135px;"><strong>Served by </strong></td>

                        <td style="font-size:11pt;">:</td>

                        <td style="font-size:11pt;"><?php echo $selse['served']; ?></td>

                    </tr> 

                </table>

                  </td>

                </tr>

              </table>

            </td>

            

            <!-- Page Body end -->

        </tr>

          <tr>

            <td colspan="2"><br></td>

        </tr>

        <tr>

          <td>

            <table class="border" cellspacing="0" cellpadding="0" width="100%">

                <tr>

                   <th align="center">SI No.</th>

                   <th>Pro.ID</th>

                   <th>Product Information</th>

                   <th align="center">Quantity</th>

                </tr>

                <?php $i = "";

        $totalamount = "";

        $packageName ="";

        $Ptotalamount = "";

        $ssql = mysql_query("SELECT sr_servicechallandetails.*, tbl_product.*  FROM sr_servicechallandetails left join tbl_product on tbl_product.Product_SlNo = sr_servicechallandetails.Product_IDNo where sr_servicechallandetails.ChallanMaster_SlNo = '$id'");

        while($rows = mysql_fetch_array($ssql)){            

            $packageName = $rows['packageName'];

            if($packageName==""){

            $amount = $rows['ChallanDetails_Rate']*$rows['TotalQuantity'] ;

            $totalamount = $totalamount+$amount;

            $i++;

        ?>

        <tr>

            <td align="center"><?php echo $i; ?></td>

            <td><?php echo $rows['Product_Code'] ?></td>

            <td><?php echo $rows['Product_Name'] ?></td>

            <td align="center"><?php echo $rows['TotalQuantity'] ?> <?php echo $rows['ChallanDetails_unit'] ?></td>

        </tr>

        <?php } }

            $ssqls = mysql_query("SELECT sr_servicechallandetails.*, tbl_product.*  FROM sr_servicechallandetails left join tbl_product on tbl_product.Product_SlNo = sr_servicechallandetails.Product_IDNo where sr_servicechallandetails.ChallanMaster_SlNo = '$id' group by sr_servicechallandetails.packageName");

            while($rows = mysql_fetch_array($ssqls)){ $i++;

                if($rows['packageName']!=""){

                $Pamount = $rows['packSellPrice']*$rows['ChallanDetails_qty'] ;

                $Ptotalamount = $Ptotalamount+$Pamount;

            ?>

            <tr>

                <td align="center"><?php echo $i; ?></td>

                <td><?php echo $rows['Product_Code'] ?></td>

                <td><?php echo $rows['packageName'] ?></td>

                <td align="center"><?php echo $rows['ChallanDetails_qty'] ?> <?php echo $rows['ChallanDetails_unit'] ?></td>

            </tr>

        <?php } }?>

            </table>

          </td>

        </tr>

        <tr>

          <td><br>

    <h4>Notes: <?php echo $selse['Description']; ?></h4>



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



