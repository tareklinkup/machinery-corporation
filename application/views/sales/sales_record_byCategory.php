
<div class="content_scroll">
<h2>Sales Record by Category</h2>
    <div style="width:100%; float:left;">
        <div style="border:1px solid #ddd">
            <table > 
                <tr>
                    <td><strong>Customer</strong></td>
                    <td>
                        <select id="customerID" data-placeholder="Choose a Customer..." class="chosen-select" style="width:200px;" tabindex="2">
                            <option value=""></option>
                             <?php $sql = mysql_query("SELECT * FROM sr_customer order by Customer_Name desc");
                            while($row = mysql_fetch_array($sql)){ ?>
                            <option value="<?php echo $row['Customer_SlNo']; ?>"><?php echo $row['Customer_Name']; ?> (<?php echo $row['Customer_Code']; ?>)</option>
                            <?php } ?>
                        </select>
                    </td>
                    <td><strong>Category</strong></td>
                    <td> 
                        <select id="Categoryid" data-placeholder="Choose a Category..." class="chosen-select" style="width:200px;" tabindex="2">
                            <option value="">  </option>
                            <?php $sql = mysql_query("SELECT * FROM sr_productcategory order by ProductCategory_Name desc");
                            while($row = mysql_fetch_array($sql)){ ?>
                            <option value="<?php echo $row['ProductCategory_SlNo']; ?>"><?php echo $row['ProductCategory_Name']; ?></option>
                            <?php } ?>
                      </select>
                    </td>
                    <td><strong>Date</strong></td>
                    <td id="ashiqeCalender"><input name="Purchase_date" type="text" id="Sales_startdate" value="<?php echo date("Y-m-d") ?>" class="inputclass" style="width:150px"/></td>
                    <td> To </td>
                    <td id="ashiqeCalender" ><input name="Purchase_date" type="text" id="Sales_enddate" value="<?php echo date("Y-m-d") ?>" class="inputclass" style="width:150px"/></td>
                    <td><input type="button" class="buttonAshiqe" onclick="searchforRecord()" value="Search Report"></td>
                </tr>
               
            </table>
        </div>
    </div>

</div>
<div id="SalesRecordCategory"></div>
<script type="text/javascript">
    function searchforRecord(){
        var Categoryid = $("#Categoryid").val();
        var Sales_startdate = $("#Sales_startdate").val();
        var Sales_enddate = $("#Sales_enddate").val();
        var customerID = $("#customerID").val();
        
        var inputData = 'Categoryid='+Categoryid+'&Sales_startdate='+Sales_startdate+'&Sales_enddate='+Sales_enddate+'&customerID='+customerID;
        var urldata = "<?php echo base_url(); ?>sales/search_sales_recordbyCategory";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputData,
            success:function(data){
                $("#SalesRecordCategory").html(data);
            }
        });
    }
    
</script>
<script type="text/javascript">
    function Selected(){
        var searchtype = $("#searchtype").val();
        if(searchtype == "Customer"){
            $("#showcustomer").show();
        }
        if(searchtype == "All"){
            $("#showcustomer").hide();
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