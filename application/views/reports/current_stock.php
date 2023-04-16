<?php
$userType = $this->session->userdata('accountType');
?>
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

            <td colspan="2" style="background:#ddd;" align="center"><h2 >Current Stock (<?php
                $Store = $this->session->userdata('Store');
                $CatID = $this->session->userdata('CatID');
                echo $Store;
            ?>)</h2></td>

        </tr>

        <tr>

            <td>

            <!-- Page Body -->

          

              <table class="border" cellspacing="0" cellpadding="0" width="100%">

                <tr>

                  <th>Product Name</th>

                  <th>Qty</th>
                  <?php
                  if($userType == 'Admin'){
                  ?>
                  <th>Purchase Price</th>

                  <th>Total Price</th>
                  <?php
                    }
                  ?>
                  <th>Unit</th>

                </tr>

              <?php $totalqty = 0;$sellTOTALqty = 0; $subtotal = 0;
                if($CatID == ''){
                    $sql = mysql_query("SELECT sr_purchaseinventory.*,tbl_product.*,sr_purchasedetails.* FROM sr_purchaseinventory left join tbl_product on tbl_product.Product_SlNo = sr_purchaseinventory.purchProduct_IDNo left join sr_purchasedetails on sr_purchasedetails.Product_IDNo = tbl_product.Product_SlNo WHERE sr_purchaseinventory.PurchaseInventory_Store = '$Store' group by sr_purchasedetails.Product_IDNo");
                }else{
                    $sql = mysql_query("SELECT sr_purchaseinventory.*,tbl_product.*,sr_purchasedetails.* FROM sr_purchaseinventory left join tbl_product on tbl_product.Product_SlNo = sr_purchaseinventory.purchProduct_IDNo left join sr_purchasedetails on sr_purchasedetails.Product_IDNo = tbl_product.Product_SlNo WHERE sr_purchaseinventory.PurchaseInventory_Store = '$Store' AND tbl_product.ProductCategory_ID = '$CatID' group by sr_purchasedetails.Product_IDNo");
                }

                while($record = mysql_fetch_array($sql)){

                    

                        $totalqty = $record['PurchaseInventory_TotalQuantity'] -$record['PurchaseInventory_ReturnQuantity'];

                        $totalqty = $totalqty-$record['PurchaseInventory_DamageQuantity'];

                        

                        $PID = $record['purchProduct_IDNo'];

                        // Sell qty

                        $sqq = mysql_query("SELECT * FROM sr_saleinventory WHERE sellProduct_IdNo = '$PID' AND SaleInventory_Store = '$Store'");

                        $or = mysql_fetch_array($sqq);

                        if($or['SaleInventory_packname'] ==""){

                        $sellTOTALqty = $or['SaleInventory_TotalQuantity'];

                       

                        $sellTOTALqty = $sellTOTALqty-$or['SaleInventory_DamageQuantity'];

                        $totalqty = $totalqty -$sellTOTALqty+$or['SaleInventory_ReturnQuantity'];

                        if($totalqty !="0"){

                            $rate = $totalqty*$record['Product_Purchase_Rate'];

                            $subtotal = $subtotal+$rate;

                        ?>

                        <tr>

                            <td><?php echo $record['Product_Name'] ?></td>

                            <td style="text-align: center;"><?php echo $totalqty; ?></td>
                            <?php
                          if($userType == 'Admin'){
                          ?>
                            <td style="text-align: right;"><?php echo number_format($record['Product_Purchase_Rate'], 2); ?></td>

                            <td style="text-align: right;"><?php echo number_format($rate, 2); ?></td>
                            <?php
                            }
                            ?>
                            <td><?php if($record['PurchaseDetails_Unit']==""){echo "pcs";} else{echo $record['PurchaseDetails_Unit']; }?></td>

                        </tr>

                <?php } }}

                ?>
                <?php
                  if($userType == 'Admin'){
                  ?>
                <tr>

                    <td style="border:0px"></td>

                    <td style="border:0px"></td>

                    <td><strong>Sub Total:</strong> </td>

                    <td style="text-align: right;"><strong><?php echo number_format($subtotal, 2); ?> Tk</strong></td>

                    <td style="border:0px"></td>

                </tr>
                <?php
                }
                ?>

              </table>

            </td>

            <!-- Page Body end -->

       

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