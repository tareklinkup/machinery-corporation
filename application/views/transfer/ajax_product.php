<?php  
$SP = mysql_query("SELECT tbl_product.*,sr_unit.* FROM tbl_product left join sr_unit on sr_unit.Unit_SlNo = tbl_product.Unit_ID where tbl_product.Product_SlNo = '$ProID'");
$Product = mysql_fetch_array($SP);
?>


<div class="full clearfix">
    <input type="hidden" id="proName" value="<?php echo $Product['Product_Name']; ?>">
    <input type="hidden" id="proCode" value="<?php echo $Product['Product_Code']; ?>">
    <input type="text" id="proQTY" name="proQTY" class="inputclass" value="" placeholder="0" onkeyup="CheckStock()">
</div>


<?php
if($SalesFrom == 'Shop'){
	$store = 'Warehouse';
}else{
	$store = 'Shop';
}

$stock = "";
$sqlss = mysql_query("SELECT * FROM sr_purchaseinventory WHERE purchProduct_IDNo = '$ProID' AND PurchaseInventory_Store = '$store'");
$roxx = mysql_fetch_array($sqlss);
$stock += $roxx['PurchaseInventory_TotalQuantity'];
$returnQty = $roxx['PurchaseInventory_ReturnQuantity'];
$damageQty = $roxx['PurchaseInventory_DamageQuantity'];

$sqll = mysql_query("SELECT * FROM sr_saleinventory WHERE sellProduct_IdNo = '$ProID' AND SaleInventory_Store = '$store'");
$rox = mysql_fetch_array($sqll);
$curentstock = $stock - $rox['SaleInventory_TotalQuantity'] + $rox['SaleInventory_ReturnQuantity'];

$curentstock = $curentstock+$returnQty;
$curentstock = $curentstock-$damageQty;
?>
<center>
    <input type="hidden" id="STock" value="<?php if(isset($curentstock)) {echo $curentstock;} ?>">

    <input type="hidden" id="proUnit" value="<?php echo $Product['Unit_Name']; ?>">  
</center>


