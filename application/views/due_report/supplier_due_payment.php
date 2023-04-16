<?php 
$totalpurchase = "";
$Totalpaid = "";
$due="";
foreach($record as $record){ 
	$supid = $record['Supplier_SlNo'];
    $paid = "";
    $sql = mysql_query("SELECT * FROM sr_supplier_payment WHERE SPayment_customerID = '".$supid."'");
    while($row = mysql_fetch_array($sql)){
        $paid = $paid+$row['SPayment_amount'];    
    } 
    $purch = "";
    $sqls = mysql_query("SELECT * FROM sr_purchasemaster WHERE Supplier_SlNo = '".$supid."'");
    while($rows= mysql_fetch_array($sqls)){
        $purch = $purch+$rows['PurchaseMaster_SubTotalAmount'];    
    }

        $totalpurchase = $totalpurchase +$purch; 
        $Totalpaid = $Totalpaid +$paid;
 
  $CName = $record['Supplier_Name'];
  $Cid = $record['Supplier_Code'];
  $sid = $record['Supplier_SlNo'];
  $inv = $record['PurchaseMaster_InvoiceNo'];

} $due = $totalpurchase-$Totalpaid?>
<table>
	<h2>Supplier Due Payment</h2>
	<h4 id="success"></h4>
	<tr>
		<td>Payment Date : </td>
		<td id="ashiqeCalender"><input type="text" value="<?php echo date("Y-m-d") ?>" id="paymentDate" /></td>
	</tr>
	<tr>
		<td>Invoice No: </td>
		<td><input type="text" id="invoice" value="<?php if(isset($inv))echo $inv; ?>" disabled=""></td>
	</tr>
	<tr>
		<td>Supplier ID : </td>
		<td><input type="text" id="SuppID__" value="<?php if(isset($Cid))echo $Cid; ?>"  disabled="">
		<input type="hidden" id="SuppID" value="<?php if(isset($sid))echo $sid; ?>" ></td>
	</tr>
	<tr>
		<td>Supplier Name : </td>
		<td><input type="text" value="<?php if(isset($CName))echo $CName; ?>" disabled=""></td>
	</tr>
	<tr>
		<td>Total Due : </td>
		<td><input type="text" id="totaldue" value="<?php if(isset($due)) echo $due;?>" disabled=""></td>
	</tr>
	<tr>
		<td>Paid Amount : </td>
		<td><input type="text"  id="paidAmount" onkeyup="remainddue()" selected>
		<input type="hidden"  id="Paymentby" value="By Cash"></td>
	</tr>
	<!-- <tr>
		<td>Payment By : </td>
		<td>
			<select id="Paymentby" style="width:157px;">
				<option value=""></option>
				<option value="By Cash">By Cash</option>
				<option value="By Bkash">By Bkash</option>
			</select>
		</td>
	</tr> -->
	<tr>
		<td>Remainded Due : </td>
		<td><input type="text" id="remainddue" disabled=""></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="button" value="Payment" onclick="Submitdata()" id="remainddue"></td>
	</tr>

</table>
<script type="text/javascript">
	function Submitdata(){
		var paymentDate = $('#paymentDate').val();
		var invoice = $('#invoice').val();
		var SuppID = $('#SuppID').val();
		
		var regex = /^[0-9]+$/;
		var paidAmount = $('#paidAmount').val();
		if(paidAmount=="0"){
			$("#paidAmount").css('border-color','red');
            return false;
		}else{
			if(!regex.test(paidAmount)){
	            $("#paidAmount").css('border-color','red');
	            return false;
	        }else{
	            $("#paidAmount").css('border-color','gray');
	        }
		}
        var Paymentby = $('#Paymentby').val();
        if(Paymentby==""){
            $("#Paymentby").css('border-color','red');
            return false;
        }else{
            $("#Paymentby").css('border-color','gray');
        }
		var succes = "";
		if(succes == ""){
			var inputdata = 'Paymentby='+Paymentby+'&paymentDate='+paymentDate+'&invoice='+invoice+'&SuppID='+SuppID+'&paidAmount='+paidAmount;
			//alert(inputdata);
			var urldata = "<?php echo base_url();?>supplier/supplier_PaymentAmount/";
			$.ajax({
				type: "POST",
				url: urldata,
				data: inputdata,
				success:function(data){
					$('#success').html('Payment Success').css("color","green");
					$('#Supplier_Results_Duepayment').html(data);
					setTimeout(function() {$.fancybox.close()}, 2000);
				}
			});
		}
	}
	function remainddue(){
		var totaldue = $("#totaldue").val();
		var paidAmount = $("#paidAmount").val();
		var Remainded = parseFloat(totaldue) - parseFloat(paidAmount);
		$("#remainddue").val(Remainded);
	}
</script>