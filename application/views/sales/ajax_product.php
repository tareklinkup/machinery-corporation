<?php  
$SP = mysql_query("SELECT tbl_product.*,sr_unit.* FROM tbl_product left join sr_unit on sr_unit.Unit_SlNo = tbl_product.Unit_ID where tbl_product.Product_SlNo = '$ProID'");
$Product = mysql_fetch_array($SP);
?>


<table>
    <tr>
        <td style="width:100px">Name</td>
        <td style="width:200px">
            <div class="full clearfix">
                <input type="text" id="proName" class="inputclass" value="<?php echo $Product['Product_Name'] ?>">
            </div>
        </td>
    </tr>
    <tr>
        <td>Quantity</td>
        <td style="width:200px">
            <div class="full clearfix">
                <input type="text" id="proQTY" name="proQTY" onkeyup="keyUPAmount()" class="inputclass" value="" placeholder="0">
            </div>
        </td>
    </tr>
    <tr>
        <td>Rate</td>
        <td style="width:200px">
            <div class="full clearfix">
                <input type="text" id="ProRATe" onkeyup="keyupamount2()" class="inputclass" value="<?php echo $Product['Product_SellingPrice'] ?>">
                <input type="hidden" id="ProPurchaseRATe" value="<?php echo $Product['Product_Purchase_Rate'] ?>">
            </div>
        </td>
    </tr>
    <tr>
        <td>Amount</td>
        <td style="width:200px">
            <div class="full clearfix">
                <input type="text" id="ProductAmont" class="inputclass" value="" readonly="">
            </div>
        </td>
    </tr>
</table>


<?php

$stock = "";
$sqlss = mysql_query("SELECT * FROM sr_purchaseinventory WHERE purchProduct_IDNo = '$ProID' AND PurchaseInventory_Store = '$SalesFrom'");
$roxx = mysql_fetch_array($sqlss);
$stock += $roxx['PurchaseInventory_TotalQuantity'];
$returnQty = $roxx['PurchaseInventory_ReturnQuantity'];
$damageQty = $roxx['PurchaseInventory_DamageQuantity'];

$sqll = mysql_query("SELECT * FROM sr_saleinventory WHERE sellProduct_IdNo = '$ProID' AND SaleInventory_Store = '$SalesFrom'");
$rox = mysql_fetch_array($sqll);
$curentstock = $stock + $rox['SaleInventory_ReturnQuantity'] - $rox['SaleInventory_TotalQuantity'];

$curentstock = $curentstock+$returnQty;
$curentstock = $curentstock-$damageQty;
?>
<center>
<?php if(!empty($packagname)){ ?>
    <input type="hidden" id="STock" value="<?php echo $bulbstock; ?>">
    <?php }else {?>
    <input type="hidden" id="STock" value="<?php if(isset($curentstock)) {echo $curentstock;} ?>">
    <?php } ?>
    <input type="hidden" id="unitPro" value="<?php echo $Product['Unit_Name']; ?>">  
</center>


