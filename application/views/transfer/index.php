<span id="TranscartRefresh">
<div class="content_scroll">
    <h2>Product Transfer</h2>
    <div style="width:100%; float:left;">
        <div style="border:1px solid #ddd">
            <table width="100%"> 
                <tr>
                    <td>Invoice no</td>
                    <td>
                    <div class="full clearfix">

                        <input type="text" disabled="" id="Invoiceno" class="inputclass" value="<?php 
                        $maxid = mysql_result(mysql_query("SELECT MAX(TransferMaster_SiNo) FROM sr_transfermaster"), 0);
                        $sn = ($maxid+1);
                        echo date('Y-m-d')."-".str_pad($sn, 2, "0", STR_PAD_LEFT);
                        ?>" style="width:200px">
                    </div></td>
                    <td>Transfer To</td>
                    <td>
                    <div class="full clearfix">
                        <select id="SalesFrom" data-placeholder="Choose Transfer Point..." class="chosen-select" style="width:200px;">
                            <option value=""></option>
                            <option value="Shop">Shop</option>
                            <option value="Warehouse">Warehouse</option>
                            <option value="Warehouse2">Warehouse Two</option>
                        </select>
                    </div></td>
                    <td>Date</td>
                    <td>
                    <div class="full clearfix" id="ashiqeCalender">
                        <input id="TransDate" type="text" value="<?php echo date("Y-m-d") ?>" class="inputclass" style="width:200px"/>
                    </div></td>
                </tr>
            </table>
        </div><br>
        <div style="width:100%; ">
        <table width="100%" style="float-left"> 
            <tr>
                <td style="border: 1px solid #ddd;"><!-- Product area -->
                    <table> 
                        <tr>
                            <td>Product</td>
                            <td style="width:200px">
                                <div class="side-by-side clearfix">
                                <div>
                                    <select id="ProID" autofocus name="ProID" data-placeholder="Choose a Product..." class="chosen-select" style="width:200px;" tabindex="2" onchange="Products()">
                                        <option value=""></option>
                                        <?php $sql = mysql_query("SELECT tbl_product.*, sr_productcategory.* FROM tbl_product left join sr_productcategory on sr_productcategory.ProductCategory_SlNo= tbl_product.ProductCategory_ID order by tbl_product.Product_Code asc");
                                        while($row = mysql_fetch_array($sql)){ ?>
                                        <option value="<?php echo $row['Product_SlNo'] ?>">
                                        <?php echo $row['Product_Name'] ?>
                                        - <?php echo $row['Product_Code'] ?></option>
                                        <?php } ?>
                                    </select>
                                    </div>
                                </div>
                                
                            </td>
                            <td>Quantity</td>
                            
                            <td style="width:200px">
                            <span id="ProductsResult">
                                <div class="full clearfix">
                                    <input type="text" id="proQTY" class="inputclass" onkeyup="CheckStock()">
                                </div>
                            </span>
                            </td>
                            
                            <td>
                                <input type="button" class="buttonAshiqe" value="Add Cart" id="addCart" onclick="ADDTOCART()">
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
                            <th style="width:5%;text-align: center;">S/N</th>
                            <th style="width:10%;text-align: center;">Product ID</th>
                            <th style="width:20%;text-align: left;

                            ">Product Information</th>
                            <th style="width:10%;text-align: center;">Qty</th>
                            <th style="width:10%;text-align: center;">Unit</th>
                            <th style="width:10%;text-align: center;">Action</th>                                                      
                        </tr>
                    </thead>
                </table>                    
            </div> 
            <span id="Transfercartlist">
            <div class="clearfix moderntabs" style="width:330px;width:100%;max-height:100px;min-height:100px;overflow:auto;">
                
               <?php  if ($cart = $this->cart->contents()): ?>
                        <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="text-align:left;width:100%;border-collapse:collapse;">
                            <tbody>
                            <?php
                                //echo form_open('shopping/update_cart');purchaserate
                                $grand_total = 0;
                                $count = "";
                                $i = 0;
                                foreach ($cart as $item):
                                    $i++;
                                    $count = $item['qty'];
                                    echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                                    echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                                    echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                                    echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                                    echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                                    echo form_hidden('cart[' . $item['id'] . '][image]', $item['image']); 
                            ?> 
                                <tr>
                                    <td style="width:2%"><?php echo $i; ?></td>
                                    <td style="width:20%"><?php echo $item['name']; ?></td>
                                    <td style="width:10%"><?php echo $item['image']; ?></td>
                                    <td style="width:10%"><?php echo $item['price']; ?></td>
                                    <td style="width:10%"><?php echo $item['qty']; ?></td>
                                    <td style="width:10%"><?php $grand_total = $grand_total + $item['subtotal']; ?> <?php echo number_format($item['subtotal'], 2) ?>
                                    <input type="hidden" id="PriCe_<?php echo $item['rowid'];?>" value="<?php echo $item['subtotal']; ?>"></td>
                                    <td style="width:10%">
                                        <span style="cursor:pointer" onclick="cartRemove(a='<?php echo $item['rowid'];?>')">
                                        <input type="hidden" id="rowid<?php echo $item['rowid'];?>" value="<?php echo $item['rowid'];?>">
                                        <img src='<?php echo base_url() ?>images/cart_cross.jpg' width='20px' height='15px'></span>
                                    </td>
                                </tr>


                                <?php endforeach; ?>
                            </tbody>    
                        </table> 
                        <input type="hidden" id="ckqty" value="<?php echo $count; ?>">
                        <?php endif; ?>
                    
            </div>
            
        </span>  
        <table width="100%">
            <tr>
                <td width="80%" >
                    <fieldset style="height:65px">
                        <legend>Notes</legend>
                        <textarea id="TransNote" rows="2" style="width:100%"></textarea>
                    </fieldset>
                </td>
                <td width="20%">
                    <fieldset style="height:65px;text-align: center;">
                        <input type="button" class="buttonAshiqe" onclick="TransferToCart()" value="Transfer" style="margin-top: 20px" id="sellbtn">
                    </fieldset>
                </td>

            </tr>
        </table> 
    </div>
    </div>
</div> 
</span>
<script type="text/javascript">
    function Products()   {
        var ProID = $("#ProID").val();
        var SalesFrom = $("#SalesFrom").val();
        if(SalesFrom == ''){
            alert("Select Sales From");
            return false;
        }
        var inputdata = 'ProID='+ProID+'&SalesFrom='+SalesFrom;
        var urldata = "<?php echo base_url(); ?>transfer/select_product";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#ProductsResult").html(data);
                $("#proQTY").focus();
            }
        });
        
    }
    function CheckStock(){
        var proQTY = $("#proQTY").val();
        var STock = $("#STock").val();
        if(parseFloat(proQTY) > parseFloat(STock)){
            alert('Stock Not Available');
            return false;
        }
    }
</script>
<script type="text/javascript">
    function ADDTOCART(){
        var ProID = $("#ProID").val();
        var proCode = $("#proCode").val();
        var proName = $("#proName").val();
        var proQTY = $("#proQTY").val();
        var proUnit = $("#proUnit").val();
        var inputdata = 'ProID='+ProID+'&proCode='+proCode+'&proName='+proName+'&proQTY='+proQTY+'&proUnit='+proUnit;
        var urldata = "<?php echo base_url(); ?>addcart/product_transfer_tocart";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#Transfercartlist").html(data);
                $("#proCode").val('');
                $("#proName").val('');
                $("#proQTY").val('');
                $("#proUnit").val('');
            }
        });
       
    }
    function cartRemove(aid)   {
        var rowid = $("#rowid"+aid).val();
        var RemoveID = $("#PriCe_"+aid).val();

        var inputdata = 'rowid='+rowid;
        var urldata = "<?php echo base_url(); ?>addcart/product_transfer_remove/";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#Salescartlist").html(data);
            }
        });
        
    }

    function TransferToCart(){
        var Invoiceno = $("#Invoiceno").val();
        var SalesFrom = $("#SalesFrom").val();
        if(SalesFrom == ''){
            alert('Choose Transfer To');
            return false;
        }
        var TransDate = $("#TransDate").val();
        var TransNote = $("#TransNote").val();

        var inputdata = 'Invoiceno='+Invoiceno+'&SalesFrom='+SalesFrom+'&TransDate='+TransDate+'&TransNote='+TransNote;
        var urldata = "<?php echo base_url(); ?>transfer/transfer_order";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                if(data){
                    $("#TranscartRefresh").html(data);
                    alert("Product Transfer Success");
                }else{
                    alert("Something Wrong");
                }
                
            }
        });

    }
</script>
<script type="text/javascript">
    function SalseToCart(){
        var packagename = $("#packagename").val();
        var salesInvoiceno = $("#salesInvoiceno").val();
        var SalesFrom = $("#SalesFrom").val();
        var sales_date = $("#sales_date").val();
        var customerID = $("#customerID").val();
        if(customerID == ""){
            //$("#customerID").css("border-color","red");
            alert("Select Customer");
            return false;
        }
        var CusName = $("#CusName").val();
        var CusMobile = $("#CusMobile").val();
        var CusAddress = $("#CusAddress").val();
        var SelesNotes = $("#SelesNotes").val();

        var subTotal = $("#subTotal").val();
        if(subTotal=="0"){
            $("#subTotal").css("border-color","red");
            return false;
        }else{
            $("#subTotal").css("border-color","gray");
        }
        var vatPersent = $("#vatPersent").val();
        if(vatPersent==""){
            $("#vatPersent").css("border-color","red");
            return false;
        }else{
            $("#vatPersent").css("border-color","gray");
        }
        var SellsFreight = $("#SellsFreight").val();
        if(SellsFreight==""){
            $("#SellsFreight").css("border-color","red");
            return false;
        }else{
            $("#SellsFreight").css("border-color","gray");
        }
        var SellsDiscount = $("#SellsDiscount").val();
        if(SellsDiscount==""){
            $("#SellsDiscount").css("border-color","red");
            return false;
        }else{
            $("#SellsDiscount").css("border-color","gray");
        }
        var SellTotals = $("#SellTotals").val();
        var SellsPaid = $("#SellsPaid").val();
        var regex = /^[0-9.]+$/;
        if(!regex.test(SellsPaid)){
            $("#SellsPaid").css('border-color','red');
            return false;
        }else{
            $("#SellsPaid").css('border-color','gray');
        }

        var SellsDue = $("#SellsDue").val();
        if(customerID == 0 && SellsDue != 0){
            alert('Credit Limited');
            return false;
        }
        var paidby = $("#paidby").val();

        var customerdue = $("#customerdue").val();
        var craditlimits = $("#craditlimits").val();
        var totaldue = parseFloat(SellsDue)+parseFloat(customerdue);
        if(craditlimits < totaldue){
            alert('Cradit Limit');
            return false;
        }
        var inputdata = 'salesInvoiceno='+salesInvoiceno+'&SalesFrom='+SalesFrom+'&sales_date='+sales_date+'&customerID='+customerID+'&CusName='+CusName+'&CusMobile='+CusMobile+'&CusAddress='+CusAddress+'&SelesNotes='+SelesNotes+'&subTotal='+subTotal+'&vatPersent='+vatPersent+'&SellsFreight='+SellsFreight+'&SellsDiscount='+SellsDiscount+'&SellTotals='+SellTotals+'&SellsPaid='+SellsPaid+'&SellsDue='+SellsDue;
        var urldata = "<?php echo base_url(); ?>sales/sales_order/";

        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                
                var err = data;
                if(err){
                    if(confirm('Show Report')){
                        window.location.href='<?php echo base_url(); ?>sales/sellAndPrint';
                    }else{
                        alert('Sell Success');
                        window.location.href='<?php echo base_url(); ?>sales';
                        return false;
                    }
                }
                    
            }
        });
    }

</script>
