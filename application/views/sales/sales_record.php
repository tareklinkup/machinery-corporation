<style>
    .chosen-container-single {
        width: 200px !important;
    }

    /*.highlighted {*/
    /*color: #000 !important;*/
    /*}*/
</style>
<div class="content_scroll">
<h2>Sales Record</h2>
    <div style="width:100%; float:left;">
        <div style="border:1px solid #ddd">
            <table > 
                <tr>
                    <td><strong>Search Type</strong></td>
                   <td> 
                        <select id="searchtype" class="inputclass" style="width:200px" onchange="Selected()">
                            <option value="All"> All </option>
                            <option value="Customer"> By Customer </option>
                            <option value="Product"> By Product </option>
                        </select>
                    </td>
                    <td><strong>Date</strong></td>
                    <td id="ashiqeCalender"><input name="Purchase_date" type="text" id="Sales_startdate" value="<?php echo date("Y-m-d") ?>" class="inputclass" style="width:200px"/></td>
                    <td> To </td>
                    <td id="ashiqeCalender" ><input name="Purchase_date" type="text" id="Sales_enddate" value="<?php echo date("Y-m-d") ?>" class="inputclass" style="width:200px"/></td>
                    <td><input type="button" class="buttonAshiqe" onclick="searchforRecord()" value="Search Report"></td>
                </tr>
                <tr>
                    <td colspan="6">
                        <span style="display:none" id="showcustomer">
                            <table>
                            <tr>
                                <td>Select Customer</td>
                                <td>
                                    <select name="" id="customerID" class="chosen-select inputclass" style="width:200px" >
                                        <option value=""></option>
                                        <?php
                                           $customers = $this->db->order_by('Customer_Name','DESC')->get('sr_customer')->result();
                                           foreach ($customers as $customer):
                                           ?>
                                        <option value="<?= $customer->Customer_SlNo?>"><?= $customer->Customer_Name?> (<?= $customer->Customer_Code?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        </span>

                        <span style="display:none" id="showProducts">
                            <table>
                            <tr>
                                <td>Select Product</td>
                                <td>
                                     <select id="productID" data-placeholder="Choose a Product..." class="chosen-select" style="width:200px;" tabindex="2" >
                                    <option value=""></option>
                                    <?php $products = $this->db->order_by('Product_SlNo','DESC')->get('tbl_product')->result();
                                    foreach ($products as $product):
                                        ?>
                                        <option value="<?= $product->Product_SlNo?>"><?= $product->Product_Name?></option>
                                    <?php endforeach;?>
                                </select>
                                </td>
                            </tr>
                        </table>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</div>
<div id="SalesRecord"></div>
<script type="text/javascript">
    function searchforRecord(){
        var searchtype = $("#searchtype").val();
        var Sales_startdate = $("#Sales_startdate").val();
        var Sales_enddate = $("#Sales_enddate").val();
        var customerID = $("#customerID").val();
        var productID = $("#productID").val();

        
        var inputData = 'searchtype='+searchtype+'&Sales_startdate='+Sales_startdate+'&Sales_enddate='+Sales_enddate+'&customerID='+customerID+'&productID='+productID;
        var urldata = "<?php echo base_url(); ?>sales/search_sales_record";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputData,
            success:function(data){
                console.log(data);
                $("#SalesRecord").html(data);
            }
        });
    }
    
</script>
<script type="text/javascript">
    function Selected(){
        var searchtype = $("#searchtype").val();
        if(searchtype == "Customer"){
            $("#showcustomer").show();
            $("#showProducts").hide();
        }
        if(searchtype == "All"){
            $("#showcustomer").hide();
            $("#showProducts").hide();
        }
        if(searchtype == "Product"){
            $("#showcustomer").hide();
            $("#showProducts").show();
        }
    }
    function Supplierdata(){
        var customerID = $("#customerID").val();
        var inputData = 'customerID='+customerID;
        var urldata = "<?php echo base_url(); ?>sales/sales_customerName";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputData,
            success:function(data){
                $("#customerName").html(data);
            }
        });
    }
</script>