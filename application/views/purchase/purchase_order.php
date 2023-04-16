<div id="AllRefresh">
<div class="content_scroll">
<h2>Product Purchase</h2>
    <div style="width:78%; float:left;">
        <div style="border:1px solid #ddd">
            <table width="100%"> 
                <tr>
                    <td>Invoice no</td>
                    <td>
                    <div class="full clearfix">
                        <input type="text"  id="purchInvoice" class="inputclass" disabled="" style="width:170px" value="<?php 
                        $maxid = mysql_result(mysql_query("SELECT MAX(PurchaseMaster_SlNo) FROM sr_purchasemaster"), 0);
                        $sn = ($maxid+1);
                        echo date('Y-m-d')."-".str_pad($sn, 2, "0", STR_PAD_LEFT);
                        ?>">
                    </div></td>
                    <td>For</td>
                    <td>
                    <div class="full clearfix">
                        <select id="PurchaseFor" data-placeholder="Purchase For..." class="chosen-select" style="width:170px;" tabindex="2">
                            <option value=""></option>
                            <option value="Shop">Shop</option>
                            <option value="Warehouse">Warehouse</option>
                            <option value="Warehouse2">Warehouse Two</option>
                        </select>
                    </div></td>
                    <td>Date</td>
                    <td>
                    <div class="full clearfix" id="ashiqeCalender">
                        <input name="Purchase_date" type="text" id="Purchase_date" value="<?php echo date("Y-m-d") ?>" class="inputclass" style="width:120px"/>
                    </div></td>
                </tr>
            </table>
        </div><br>
        <div style="width:100%; ">
            <table width="100%" > 
                <tr>
                    <td style="border: 1px solid #ddd;"><!-- Customer area -->
                        <table class="purchestable"> 
                            <tr>
                                <td>Supplier</td>
                                <td style="width:200px">
                                    <div class="side-by-side clearfix">
                                        <div>
                                              <select id="SupplierID" data-placeholder="Choose a Supplier..." class="chosen-select" style="width:200px;" tabindex="2" onchange="Supplier()">
                                                     <option value=""></option>
                                                    <?php $sql = mysql_query("SELECT * FROM sr_supplier order by Supplier_Code asc");
                                                    while($row = mysql_fetch_array($sql)){ ?>
                                                    <option value="<?php echo $row['Supplier_SlNo'] ?>"><?php echo $row['Supplier_Name']; ?> -(<?php echo $row['Supplier_Code']; ?>)</option>
                                                    <?php } ?>
                                              </select>
                                        </div>
                                    </div>
                                </td>
                                <td><span id="SupplierResult">
                                    <table>
                                        <tr>
                                            <td>Name</td>
                                            <td style="width:200px">
                                                <div class="full clearfix">
                                                    <input type="text" class="inputclass" disabled="" value="">
                                                </div>
                                            </td>
                                            <td>Address</td>
                                            <td style="width:200px">
                                                <div class="full clearfix">
                                                    <input type="text" class="inputclass" disabled="" value="">
                                                </div>
                                            </td>
                                        </tr>
                                    </table></span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd;"><!-- Product area -->
                        <table class="purchestable"> 
                            <tr>
                                <td>Category</td>
                                <td style="width:100px">
                             
                                    <div class="side-by-side clearfix">
                                        <div>
											 <select name="pCategory" id="pCategory" data-placeholder="Choose a Category..." class="chosen-select" style="width:150px;" onchange="showProduct(this.value)" required>
												 <option value=""></option>
												 <?php $sql = mysql_query("SELECT * FROM sr_productcategory order by ProductCategory_Name asc");
												while($row = mysql_fetch_array($sql)){ ?>
												<option value="<?php echo $row['ProductCategory_SlNo'] ?>"><?php echo $row['ProductCategory_Name'] ?></option>
												<?php } ?>
											</select> 
                                        </div>
                                    </div>
                                </td>
								
								<td>Product</td>
                                <td style="width:100px">
                             
                                    <div class="side-by-side clearfix">
                                        <div id="Search_Results_product">
                                              <select id="ProID" data-placeholder="Choose a Product..." class="chosen-select" style="width:150px;" tabindex="2" onchange="Products()">
                                                     <option value=""></option>
                                                    <?php $sql = mysql_query("SELECT tbl_product.*, sr_productcategory.* FROM tbl_product left join sr_productcategory on sr_productcategory.ProductCategory_SlNo= tbl_product.ProductCategory_ID order by tbl_product.Product_Name asc");
                                                    while($row = mysql_fetch_array($sql)){ 
                                                        $proname = $row['Product_Name'];?>
                                                    <option value="<?php echo $row['Product_SlNo'] ?>"><?php echo $row['Product_Code'] ?></option>
                                                    <?php } ?>
                                              </select>
                                        </div>
                                    </div>
                                </td>

                                <td id="ProductsResult">
                                    <table>
                                        <tr>
                                            <td> Name </td>
                                                <td style="width:200px">
                                                    <div class="full clearfix" >
                                                        <input type="text" id="productName" disabled="" class="inputclass">
                                                    </div>
                                                </td>
                                                <td> Quantity </td>
                                                <td style="width:100px">
                                                    <div class="full clearfix">
                                                        <input type="text" id="PurchaseQTY" class="inputclass">
                                                    </div>
                                                </td>
                                                <td> Rate </td>
                                                <td style="width:100px">
                                                    <div class="full clearfix">
                                                        <input type="text" id="ProductRATE" class="inputclass">
                                                    </div>
                                                </td>
                                                 <td style="width:80px;padding-left:20px">
                                                    <input class="buttonAshiqe" type="button" onclick="AddToPurchaseCart()" value="Add Cart">
                                                </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
                <div class="row_section clearfix" style="margin-top:20px;padding-bottom:0px;">
                    <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="width:100%;border-collapse:collapse;">
                        <thead>
                            <tr class="header">
                                <th style="width:2%"></th>
                                <th style="width:20%">Product Name</th>
                                <th style="width:10%">Unit</th>
                                <th style="width:10%">Rate</th>
                                <th style="width:10%">Qty</th>
                                <th style="width:10%">Total Amount</th>
                                <th style="width:10%"></th>                                                      
                            </tr>
                        </thead>
                    </table>                    
                </div> 
            <span id="ShowcarTProduct">
                <div class="clearfix moderntabs" style="width:330px;width:100%;max-height:150px;min-height:150px;overflow:auto;">
                        
                        <?php  if ($cart = $this->cart->contents()): ?>
                        <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="text-align:left;width:100%;border-collapse:collapse;">
                            <tbody>
                            <?php
                                //echo form_open('shopping/update_cart');packagecode
                                $grand_total = 0;
                                $count = "";
                                $i = 1;
                                foreach ($cart as $item):
                                    $count++;
                                    echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                                    echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                                    echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                                    echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                                    echo form_hidden('cart[' . $item['id'] . '][purchaserate]', $item['purchaserate']);
                                    echo form_hidden('cart[' . $item['id'] . '][packagename]', $item['packagename']);
                                    echo form_hidden('cart[' . $item['id'] . '][packagecode]', $item['packagecode']);
                                    echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                                    echo form_hidden('cart[' . $item['id'] . '][image]', $item['image']); 
                            ?> 
                                <tr>

                                    <td style="width:2%"> <input name="proID[]" type="hidden" value="<?php echo $item['id']; ?>"></td>
                                    <td style="width:20%"><?php echo $item['name']; ?> <?php if(!empty($item['packagename'])){  ?> <input name="cartpackagename" type="hidden" value="<?php echo $item['packagename']; ?>"> <?php } ?></td>
                                    <td style="width:10%"><?php echo $item['image']; ?></td>
                                    <td style="width:10%" ><?php echo $item['price']; ?>
                                    </td>
                                    <td style="width:10%"><?php echo $item['qty']; ?></td>
                                    <td style="width:10%"><?php $grand_total = $grand_total + $item['subtotal']; ?> <?php echo number_format($item['subtotal'], 2) ?>
                                    <input type="hidden" id="PriCe_<?php echo $item['rowid'];?>" value="<?php echo $item['subtotal'];?>"></td>
                                    <td style="width:10%">
                                        <span style="cursor:pointer" onclick="cartRemove(a='<?php echo $item['rowid'];?>')">
                                        <input type="hidden" id="rowid<?php echo $item['rowid'];?>" value="<?php echo $item['rowid'];?>">
                                        <img src='<?php echo base_url() ?>images/cart_cross.jpg' width='20px' height='15px'></span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>    
                        </table> 
                        <?php endif; ?>
                </div>
                <table width="100%">
                    <tr>
                        <td width="40%" >
                            <fieldset style="height:65px">
                                <legend>Notes</legend>
                                <input type="text" name="PurchNotes" id="PurchNotes" style="width:100%;height:50px">
                            </fieldset>
                        </td>
                        <td width="60%">
                            <fieldset style="height:65px">
                                <legend>Total</legend>
                                <h2>
                                    <span>Total</span>
                                    <div style="float:right">
                                        <span style="color:red"><?php if(isset($grand_total)) {echo $grand_total;}else{echo 0;} ?></span>
                                        <input type="hidden" value="<?php if(isset($grand_total)) {echo $grand_total;}else{echo 0;} ?>" id="grand_total">

                                        <span>tk</span>
                                    </div>
                                </h2>
                            </fieldset>
                        </td>

                    </tr>
                </table> 
            </span> 
        </div>
    </div>
    <div style="width:20%; float:left">
        <fieldset>
            <legend>Amount Details</legend>
            <table width="100%"> 
                <tr>
                    <td>Sub Total<br>
                    <div class="full clearfix">
                        <input type="text" id="subTotalDisabled" disabled="" class="inputclass" value="0">
                        <input type="hidden" id="subTotal"  class="inputclass" value="0">
                    </div></td>
                </tr>
                <!-- <tr>
                    <td>Vat<br>
                    <div class="full clearfix">
                        <input type="text" id="vatPersent"  onkeyup="vatonkeyup()" class="inputclass" style="width:50px" value="0"> % 
                        <input type="text" id="purchVat" readonly="" class="inputclass" style="width:86px" value="0">
                    </div></td>
                </tr> -->
                
                <tr>
                    <td>Transport<br>
                    <div class="full clearfix">
                        <input type="hidden" id="vatPersent"  onkeyup="vatonkeyup()" class="inputclass" style="width:50px" value="0"> 
                        <input type="hidden" id="purchVat" readonly="" class="inputclass" style="width:86px" value="0">
                        <input type="text" class="inputclass" id="purchFreight" onkeyup="Freightonkeyup()" value="0">
                    </div></td>
                </tr>
                <tr>
                    <td>Discount<br>
                    <div class="full clearfix">
                        <input type="text" class="inputclass" id="purchDiscount" onkeyup="Discountonkeyup()" value="0">
                    </div></td>
                </tr>
                <tr>
                    <td>Total<br>
                    <div class="full clearfix">
                        <input type="text" id="purchTotaldisabled" value="0" disabled="" class="inputclass">
                        <input type="hidden" id="purchTotal" value="" class="inputclass">
                    </div></td>
                </tr>
                <tr>
                    <td>Paid<br>
                     <div class="full clearfix">
                        <input type="text" id="PurchPaid" class="inputclass" value="0" onkeyup="PaidAmount()">
                    </div></td>
                </tr>
                <tr>
                    <td>Due<br>
                    <div class="full clearfix">
                        <input type="text" class="inputclass" value="0" disabled="" id="purchaseDue2">
                        <input type="hidden" id="purchaseDue" class="inputclass" value="0">
                    </div></td>
                </tr>
                <tr>
                    <td><input type="button" class="buttonAshiqe" onclick="ProductPurchase()" value="Purchase">
                    </td>
                </tr>
            </table>
        </fieldset>
    </div>
     
</div> 
</div>
<script type="text/javascript">
    function Supplier()   {
        var sid = $("#SupplierID").val();
        var inputdata = 'sid='+sid;
        var urldata = "<?php echo base_url(); ?>purchase/Selectsuplier";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#SupplierResult").html(data);
            }
        });
    }
    function Products()   {
        var ProID = $("#ProID").val();
        var inputdata = 'ProID='+ProID;
        var urldata = "<?php echo base_url(); ?>purchase/SelectPruduct";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#ProductsResult").html(data);
                $('input[name=PurchaseQTY]').focus();
            }
        });
    }
    function AddToPurchaseCart()   {
        var id = $("#ProID").val();
        if(id == ""){
            //$("#ProID").css("border-color","red")
            alert("Select Product");
            return false;
        }
        var grand_total = $("#grand_total").val();
        var qty = $("#PurchaseQTY").val();
        if(qty == ""){
            $("#PurchaseQTY").css("border-color","red")
            return false;
        }
        var name = $("#productName").val();
        var price = $("#ProductRATE").val();
        var image = $("#ProductUnit").val();

        var packageprice = $("#packageprice").val();
        var packagename = $("#packagename").val();
        var packagecode = $("#packagecode").val();

        var inputdata = 'id='+id+'&qty='+qty+'&name='+name+'&price='+price+'&image='+image+'&packagename='+packagename+'&packagecode='+packagecode;
        //alert(inputdata);
        var urldata = "<?php echo base_url(); ?>addcart/purchaseTOcart";

        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#ShowcarTProduct").html(data);
                document.getElementById('ProID').value="";
                document.getElementById('PurchaseQTY').value="";
                document.getElementById('productName').value="";
                document.getElementById('ProductRATE').value="";
                document.getElementById('productName2').value="";
            }
        });
        var TotalPrice = parseFloat(price)*parseFloat(qty);
        var subToTal = $("#grand_total").val();
        var TotalAmount = parseFloat(TotalPrice)+parseFloat(subToTal);
        //var grTotal = $("#subTotalDisabled").val(TotalAmount);
        var grTotal = $("#subTotalDisabled").val(TotalAmount);
        $("#subTotal").val(TotalAmount);
        //
        var subTotal = $("#subTotal").val();
        var vatPersent = $("#vatPersent").val();
        var vattotal = parseFloat(subTotal) * parseFloat(vatPersent);
        var grtotal = parseFloat(vattotal) / 100;
        $('#purchVat').val(grtotal);
        //
        var purchVat = $("#purchVat").val();
        var purchFreight = $("#purchFreight").val();
        var purchDiscount = $("#purchDiscount").val();
        var totalAmOuNT = parseFloat(TotalAmount)+ parseFloat(purchVat)+ parseFloat(purchFreight)+parseFloat(purchDiscount);
        $('#purchTotal').val(totalAmOuNT);
        $('#purchTotaldisabled').val(totalAmOuNT);
        $('#PurchPaid').val(totalAmOuNT);
        //due
        var total = $("#purchTotaldisabled").val();
        var PurchPaid = $("#PurchPaid").val();
        var purchaseDue = $("#purchaseDue").val();
        var totalDUE = parseFloat(total)- parseFloat(PurchPaid);
        $('#purchaseDue').val(totalDUE);
        $('#purchaseDue2').val(totalDUE);

    }
    function cartRemove(aid)   {
        var rowid = $("#rowid"+aid).val();
        var RemoveID = $("#PriCe_"+aid).val();

        var inputdata = 'rowid='+rowid;
        var urldata = "<?php echo base_url(); ?>addcart/ajax_cart_remove/";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#ShowcarTProduct").html(data);
            }
        });
        //alert(RemoveID);
        var subToTal = $("#subTotal").val();
        var rastAmount = parseFloat(subToTal)-parseFloat(RemoveID); 
        $("#subTotalDisabled").val(rastAmount);
        $("#subTotal").val(rastAmount);
        //
        var subTotal = $("#subTotal").val();
        var vatPersent = $("#vatPersent").val();
        var vattotal = parseFloat(subTotal) * parseFloat(vatPersent);
        var grtotal = parseFloat(vattotal) / 100;
        $('#purchVat').val(grtotal);
        //
        var purchVat = $("#purchVat").val();
        var purchFreight = $("#purchFreight").val();
        var purchDiscount = $("#purchDiscount").val();
        var totalAmOuNT = parseFloat(subTotal)+ parseFloat(purchVat)+ parseFloat(purchFreight)-parseFloat(purchDiscount);
        $('#purchTotal').val(totalAmOuNT);
        $('#purchTotaldisabled').val(totalAmOuNT);
        $('#PurchPaid').val(totalAmOuNT);
        //due
        var total = $("#purchTotaldisabled").val();
        var PurchPaid = $("#PurchPaid").val();
        var purchaseDue = $("#purchaseDue").val();
        var totalDUE = parseFloat(total)- parseFloat(PurchPaid);
        $('#purchaseDue').val(totalDUE);
        $('#purchaseDue2').val(totalDUE);
        // Null Value


    }
    function vatonkeyup(){
        var subtotal = $("#subTotal").val();
        var vatPersent = $("#vatPersent").val();
        var vattotal = parseFloat(subtotal) * parseFloat(vatPersent);
        var grtotal = parseFloat(vattotal) / 100;
        $('#purchVat').val(grtotal);
        //
        var purchVat = $("#purchVat").val();
        var purchFreight = $("#purchFreight").val();
        var purchDiscount = $("#purchDiscount").val();
        var totalAmOuNT = parseFloat(subtotal)+ parseFloat(purchVat)+ parseFloat(purchFreight)-parseFloat(purchDiscount);
        $('#purchTotal').val(totalAmOuNT);
        $('#purchTotaldisabled').val(totalAmOuNT);
        $('#PurchPaid').val(totalAmOuNT);
        //due
        var total = $("#purchTotaldisabled").val();
        var PurchPaid = $("#PurchPaid").val();
        var purchaseDue = $("#purchaseDue").val();
        var totalDUE = parseFloat(total)- parseFloat(PurchPaid);
        $('#purchaseDue').val(totalDUE);
        $('#purchaseDue2').val(totalDUE);
    }
    function Freightonkeyup(){
        var subtotal = $("#subTotal").val();
        var purchVat = $("#purchVat").val();
        var purchFreight = $("#purchFreight").val();
        var purchDiscount = $("#purchDiscount").val();
        var totalAmOuNT = parseFloat(subtotal)+ parseFloat(purchVat)+ parseFloat(purchFreight)-parseFloat(purchDiscount);
        $('#purchTotal').val(totalAmOuNT);
        $('#purchTotaldisabled').val(totalAmOuNT);
        $('#PurchPaid').val(totalAmOuNT);
        //due
        var total = $("#purchTotaldisabled").val();
        var PurchPaid = $("#PurchPaid").val();
        var purchaseDue = $("#purchaseDue").val();
        var totalDUE = parseFloat(total)- parseFloat(PurchPaid);
        $('#purchaseDue').val(totalDUE);
        $('#purchaseDue2').val(totalDUE);

    }
    function Discountonkeyup(){
        var subtotal = $("#subTotal").val();
        var purchVat = $("#purchVat").val();
        var purchFreight = $("#purchFreight").val();
        var purchDiscount = $("#purchDiscount").val();
        var totalAmOuNT = parseFloat(subtotal)+ parseFloat(purchVat)+ parseFloat(purchFreight)-parseFloat(purchDiscount);
        $('#purchTotal').val(totalAmOuNT);
        $('#purchTotaldisabled').val(totalAmOuNT);
        $('#PurchPaid').val(totalAmOuNT);
        //due
        var total = $("#purchTotaldisabled").val();
        var PurchPaid = $("#PurchPaid").val();
        var purchaseDue = $("#purchaseDue").val();
        var totalDUE = parseFloat(total)- parseFloat(PurchPaid);
        $('#purchaseDue').val(totalDUE);
        $('#purchaseDue2').val(totalDUE);
    }
    function PaidAmount(){
        var total = $("#purchTotaldisabled").val();
        var PurchPaid = $("#PurchPaid").val();
        var purchaseDue = $("#purchaseDue").val();
        var totalDUE = parseFloat(total)- parseFloat(PurchPaid);
        $('#purchaseDue').val(totalDUE);
        $('#purchaseDue2').val(totalDUE);
       
    }

</script>
<script type="text/javascript">
    function ProductPurchase(){

        var packagename = $("#packagename").val();
        var purchInvoice = $("#purchInvoice").val();
        var PurchaseFor = $("#PurchaseFor").val();
        if(PurchaseFor == ''){
            alert("Select Purchase For");
            return false;
        }
        var Purchase_date = $("#Purchase_date").val();

        var SupplierID = $("#SupplierID").val();
        if(SupplierID==""){
            //$("#SupplierID").css('border-color','red');
            alert("Select Supplier");
            return false;
        }
        //
        var subTotal = $("#subTotal").val();
        if(subTotal==0){
            return false;
        }
        var vatPersent = $("#vatPersent").val();
        if(vatPersent==""){
            $("#vatPersent").css('border-color','red');
            return false;
        }else{
            $("#vatPersent").css('border-color','gray');
        }
        var purchFreight = $("#purchFreight").val();
        if(purchFreight==""){
            $("#purchFreight").css('border-color','red');
            return false;
        }else{
            $("#purchFreight").css('border-color','gray');
        }
        var purchDiscount = $("#purchDiscount").val();
        if(purchDiscount==""){
            $("#purchDiscount").css('border-color','red');
            return false;
        }else{
            $("#purchDiscount").css('border-color','gray');
        }
        var purchTotal = $("#purchTotal").val();

        var PurchPaid = $("#PurchPaid").val();
        
        var purchaseDue = $("#purchaseDue").val();
        var Notes = $("#PurchNotes").val();
        var inputdata = 'packagename='+packagename+'&purchInvoice='+purchInvoice+'&PurchaseFor='+PurchaseFor+'&Purchase_date='+Purchase_date+'&SupplierID='+SupplierID+'&subTotal='+subTotal+'&vatPersent='+vatPersent+'&purchFreight='+purchFreight+'&purchDiscount='+purchDiscount+'&purchTotal='+purchTotal+'&PurchPaid='+PurchPaid+'&purchaseDue='+purchaseDue+'&Notes='+Notes;
        var urldata = "<?php echo base_url(); ?>purchase/Purchase_order";

        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                var err = data;
                if(err){
                    if(confirm('Show Report')){
                        window.location.href='<?php echo base_url(); ?>purchase/purchase_to_report';
                    }else{
                        alert('Purchase Success');
                        window.location.href='<?php echo base_url(); ?>purchase/order';

                        return false;
                    }
                }
            }
        });
    }
	
	function showProduct(str) {
	//alert(str);
			var categoryid = $('#pCategory').val();
            var inputdata = 'pCategory='+pCategory;
            var urldata = "<?php echo base_url();?>sales/select_product_by_category/"+str;
            $.ajax({
                type: "POST",
                url: urldata,
                data: inputdata,
                success:function(data){
                    $('#Search_Results_product').html(data);
					var config = {
			  '.chosen-select'           : {},
			  '.chosen-select-deselect'  : {allow_single_deselect:true},
			  '.chosen-select-no-single' : {disable_search_threshold:10},
			  '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
			  '.chosen-select-width'     : {width:"95%"}
			}
			for (var selector in config) {
			  $(selector).chosen(config[selector]);
			}
					}
				});
	} 
</script>
