
<div class="content_scroll" style="padding: 50px 20px 25px 160px;">
<table  class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="text-align:left;width:100%;border-collapse:collapse;">
	<tr>
		<th>Product</th>
		<th>Total Qty</th>
		<th>Total Amount</th>
		<th>Already Retuned Qty</th>
		<th>Already Retuned Amount</th>
		<th>Retuned Qty</th>
		<th>Retuned Amount</th>
	</tr>
	<?php  
	$sql = mysql_query("SELECT sr_purchasedetails.*, tbl_product.*,sr_purchasemaster.*,sr_purchasereturn.*, sr_purchasereturn.PurchaseMaster_InvoiceNo as invoice FROM sr_purchasedetails left join tbl_product on tbl_product.Product_SlNo=sr_purchasedetails.Product_IDNo left join sr_purchasemaster on sr_purchasemaster.PurchaseMaster_SlNo=sr_purchasedetails.PurchaseMaster_IDNo left join sr_purchasereturn on sr_purchasereturn.PurchaseMaster_InvoiceNo = sr_purchasemaster.PurchaseMaster_InvoiceNo WHERE sr_purchasemaster.PurchaseMaster_InvoiceNo = '$proinv'");

		while($rox = mysql_fetch_array($sql)){ 
			$PackName = $rox['PackName'];
			$treteun ='';
			$tamount ='';
			if($PackName==""){
			$sprid = $rox['Product_SlNo'];
			$sprternid = $rox['PurchaseReturn_SlNo'];
			
		$sql22 = mysql_query("SELECT * FROM sr_purchasereturndetails WHERE PurchaseReturnDetailsProduct_SlNo = '$sprid' AND PurchaseReturn_SlNo='$sprternid'");

		while($rox22 = mysql_fetch_array($sql22)){
			$treteun = $rox22['PurchaseReturnDetails_ReturnQuantity']+$treteun;
			$tamount = $rox22['PurchaseReturnDetails_ReturnAmount']+$tamount ;
		}?>

	 <tr class='wrapper'>
	 	<input type="hidden" name="packname[]" value="<?php echo $PackName ?>">
	 	<input type="hidden" name="productsName[]" value="<?php echo $rox['Product_Name'] ?>">
	 	<input type="hidden" name="productsCodes[]" value="">
		<td><?php echo $rox['Product_Name'];?></td>
		<td><?php echo $rox['PurchaseDetails_TotalQuantity'];?></td>
		<td><?php echo $rox['PurchaseDetails_Rate']*$rox['PurchaseDetails_TotalQuantity'];?></td>
		<td><input type="text" id="treteun<?php echo $rox['PurchaseDetails_SlNo'];?>"readonly="" value="<?php echo $treteun;?>"></td>
		<td><input type="text" id="totalamount<?php echo $rox['PurchaseDetails_SlNo'];?>" readonly="" value="<?php echo $tamount;?>"></td>
		<td><input type="text" name="returnqty[]" id="reqty<?php echo $rox['PurchaseDetails_SlNo'];?>" onkeyup="qtycheckReturn(<?php echo $rox['PurchaseDetails_SlNo'];?>)" value="0"></td>
		<td><input type="text" name="returnamount[]" id="amount<?php echo $rox['PurchaseDetails_SlNo'];?>" value="0" onkeyup="amountcheckReturn(<?php echo $rox['PurchaseDetails_SlNo'];?>)"></td>
		<input type="hidden" name="invoice" value="<?php echo $proinv; ?>">
		<input type="hidden" name="productID[]" value="<?php echo $rox['Product_SlNo']; ?>">
		<input type="hidden" name="Supplier_No" value="<?php echo $rox['Supplier_SlNo']; ?>">
		<input type="hidden" 
		id="qtyy<?php echo $rox['PurchaseDetails_SlNo'];?>" value="<?php echo $rox['PurchaseDetails_TotalQuantity']; ?>">
		<input type="hidden" id="alredyamount<?php echo $rox['PurchaseDetails_SlNo'];?>" value="<?php echo $rox['PurchaseDetails_Rate']*$rox['PurchaseDetails_TotalQuantity']; ?>">
		
	</tr> 
	 
	<?php } } 
	$sql = mysql_query("SELECT sr_purchasedetails.*, tbl_product.*,sr_purchasemaster.*,sr_purchasereturn.*, sr_purchasereturn.PurchaseMaster_InvoiceNo as invoice FROM sr_purchasedetails left join tbl_product on tbl_product.Product_SlNo=sr_purchasedetails.Product_IDNo left join sr_purchasemaster on sr_purchasemaster.PurchaseMaster_SlNo=sr_purchasedetails.PurchaseMaster_IDNo left join sr_purchasereturn on sr_purchasereturn.PurchaseMaster_InvoiceNo = sr_purchasemaster.PurchaseMaster_InvoiceNo WHERE sr_purchasemaster.PurchaseMaster_InvoiceNo = '$proinv' group by sr_purchasedetails.PackName");
		
		while($rox = mysql_fetch_array($sql)){ 
			$PackName = $rox['PackName'];
			$treteun ='';
			$tamount ='';
			if($PackName !=""){
			$sprid = $rox['Product_SlNo'];
			$sprternid = $rox['PurchaseReturn_SlNo'];
			
		$sql22 = mysql_query("SELECT * FROM sr_purchasereturndetails WHERE PurchaseReturnDetailsProduct_SlNo = '$sprid' AND PurchaseReturn_SlNo='$sprternid'");

		while($rox22 = mysql_fetch_array($sql22)){
			$treteun = $rox22['PurchaseReturnDetails_pacQty']+$treteun;
			$tamount = $rox22['PurchaseReturnDetails_ReturnAmount']+$tamount ;
		}
		$sqlx = mysql_query("SELECT * FROM sr_package WHERE package_name ='$PackName'");
		$rom = mysql_fetch_array($sqlx);
		$sqn = mysql_query("SELECT * FROM tbl_product WHERE Product_Code = '".$rom['package_ProCode']."'");
		$ron = mysql_fetch_array($sqn);
		 
		?>
	<tr class='wrapper'>

		<input type="hidden" name="packname[]" value="<?php echo $PackName ?>">
		<input type="hidden" name="productsName[]" value="<?php echo $rox['PackName'] ?>">
		<input type="hidden" name="productsCodes[]" value="<?php echo $rom['package_ProCode'] ?>">
		<td><?php echo $rox['PackName'];?></td>
		<td><?php echo $rox['Pack_qty'];?></td>
		<td><?php echo $rox['PackPice']*$rox['Pack_qty'];?></td>
		<td><input type="text" id="treteun<?php echo $rox['PurchaseDetails_SlNo'];?>"readonly="" value="<?php echo $treteun;?>"></td>
		<td><input type="text" id="totalamount<?php echo $rox['PurchaseDetails_SlNo'];?>" readonly="" value="<?php echo $tamount;?>"></td>
		<td><input type="text" name="returnqty[]" id="reqty<?php echo $rox['PurchaseDetails_SlNo'];?>" onkeyup="qtycheckReturn(<?php echo $rox['PurchaseDetails_SlNo'];?>)" value="0"></td>
		<td><input type="text" name="returnamount[]" id="amount<?php echo $rox['PurchaseDetails_SlNo'];?>" value="0" onkeyup="amountcheckReturn(<?php echo $rox['PurchaseDetails_SlNo'];?>)"></td>
		<input type="hidden" name="invoice" value="<?php echo $proinv; ?>">
		<input type="hidden" name="productID[]" value="<?php echo $ron['Product_SlNo']; ?>">
		<input type="hidden" name="Supplier_No" value="<?php echo $rox['Supplier_SlNo']; ?>">
		<input type="hidden" id="qtyy<?php echo $rox['PurchaseDetails_SlNo'];?>" value="<?php echo $rox['Pack_qty']; ?>">
		<input type="hidden" id="alredyamount<?php echo $rox['PurchaseDetails_SlNo'];?>" value="<?php echo $rox['PackPice']*$rox['Pack_qty']; ?>">
		
	</tr> 
	<?php } } ?>
	<input type="hidden" >
	<tr>
		<td colspan="7"> 
			<table style="order: 1px solid #d8d8d8;">
				<tr>
					<td> Notes </td>
					<td>
						
						<textarea name="Notes" id="Notes" style="width:300px;height:30px "></textarea>
					</td>
					<td  align="right">
					<input type="button" class="buttonAshiqe" onclick="SubmitReturn()" value="Save">
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</div>

<script type='text/javascript'>
function SubmitReturn(){
	var inputdata = $('input[name="productsCodes[]"],input[name="productsName[]"],input[name="packname[]"],input[name="returnamount[]"],input[name="returnqty[]"],input[name="productID[]"],input[name="salseQTY[]"],textarea[name="Notes"],input[name="return_date"],input[name="invoice"],input[name="Supplier_No"]').serialize();
	var urldata = "<?php echo base_url(); ?>purchase/PurchaseReturnInsert";
	$.ajax({
	type: "POST",
	  url: urldata,
	  data: inputdata,
	  success:function(data){
	  	alert("Retuned Success");
	  	$("#PurchaseReturnList").html(data);
	  }
	});
}
function qtycheckReturn(id){
	var returnqtys = $("#reqty"+id).val();
	var qtyy = $("#qtyy"+id).val();
	var treteun = $("#treteun"+id).val();
	if(treteun==""){
		if(parseFloat(qtyy) < parseFloat(returnqtys)){
			alert('Return Qty too Large');
			$("#qtyy"+id).val("0");
			$("#reqty"+id).val("0");
			return false;
		}
	}else{
		var total = parseFloat(treteun)+parseFloat(returnqtys);
		if(parseFloat(qtyy) < parseFloat(total)){
			alert('Return Qty too Large');
			$("#qtyy"+id).val("0");
			$("#reqty"+id).val("0");
			return false;
		}
	}
	if(treteun=="0"){
		if(parseFloat(qtyy) < parseFloat(returnqtys)){
			alert('Return Qty too Large');
			$("#qtyy"+id).val("0");
			$("#reqty"+id).val("0");
			return false;
		}
	}else{
		var total = parseFloat(treteun)+parseFloat(returnqtys);
		if(parseFloat(qtyy) < parseFloat(total)){
			alert('Return Qty too Large');
			$("#qtyy"+id).val("0");
			$("#reqty"+id).val("0");
			return false;
		}
	}
}
function amountcheckReturn(id){
	var returnqtys = $("#amount"+id).val();
	var alredyamount = $("#alredyamount"+id).val();
	var totalamount = $("#totalamount"+id).val();
	if(totalamount==""){
		if(parseFloat(alredyamount) < parseFloat(returnqtys)){
			alert('Return Amount too Large');
			$("#amount"+id).val("0");
			return false;
		}
	}else{
		var total = parseFloat(totalamount)+parseFloat(returnqtys);
		if(parseFloat(alredyamount) < parseFloat(total)){
			alert('Return Amount too Large');
			$("#amount"+id).val("0");
			return false;
		}
	}
	if(totalamount=="0"){
		if(parseFloat(alredyamount) < parseFloat(returnqtys)){
			alert('Return Amount too Large');
			$("#amount"+id).val("0");
			return false;
		}
	}else{
		var total = parseFloat(totalamount)+parseFloat(returnqtys);
		if(parseFloat(alredyamount) < parseFloat(total)){
			alert('Return Amount too Large');
			$("#amount"+id).val("0");
			return false;
		}
	}
}
    

</script>