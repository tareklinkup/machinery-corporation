
<div class="content_scroll">
<h2>Official Expense</h2>
    <div style="width:100%; float:left;">
        <div style="border:1px solid #ddd">
            <table > 
                <tr>
                    <td><strong>Search Type</strong></td>
                   <td> 
                        <select id="searchtype" class="inputclass" style="width:200px" onchange="Selected()">
                            <option value="All"> All </option>
                            <option value="Account"> By Account </option>
                        </select>
                    </td>
                    <td><strong>Start Date</strong></td>
                    <td id="ashiqeCalender"><input name="Purchase_date" type="text" id="Sales_startdate" value="<?php echo date("Y-m-d") ?>" class="inputclass" style="width:200px"/></td>
                    <td> To </td>
                    <td id="ashiqeCalender"><input name="Purchase_date" type="text" id="Sales_enddate" value="<?php echo date("Y-m-d") ?>" class="inputclass" style="width:200px"/></td>
                    <td><input type="button" class="buttonAshiqe" onclick="searchforRecord()" value="Search Report"></td>
                </tr>
                <tr>
                    <td colspan="6">
                        <span style="display:none" id="showcustomer">
                            <table>
                                <tr>
                                    <td>Select Account</td>
                                    <td>
                                        <select name="" id="accountid" class="inputclass" style="width:200px" onchange="Supplierdata()">
                                            <option value="">  </option>
                                            <?php $sql = mysql_query("SELECT * FROM sr_account order by Acc_Name desc");
                                                while($row = mysql_fetch_array($sql)){ ?>
                                            <option value="<?php echo $row['Acc_SlNo']; ?>"><?php echo $row['Acc_Name']; ?></option>
                                            <?php } ?>
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
<div id="expense"></div>
<script type="text/javascript">
    function searchforRecord(){
        var expence_startdate = $("#Sales_startdate").val();
        var expence_enddate = $("#Sales_enddate").val();
        var accountid = $("#accountid").val();
        var searchtype = $("#searchtype").val();
        
        var inputData = 'searchtype='+searchtype+'&expence_startdate='+expence_startdate+'&expence_enddate='+expence_enddate+'&accountid='+accountid;
        var urldata = "<?php echo base_url(); ?>account/expense_search";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputData,
            success:function(data){
                $("#expense").html(data);
            }
        });
    }
    
</script>

<script type="text/javascript">
    function Selected(){
        var searchtype = $("#searchtype").val();
        if(searchtype == "Account"){
            $("#showcustomer").show();
        }
        if(searchtype == "All"){
            $("#showcustomer").hide();
        }
    }
    function Supplierdata(){
        var customerID = $("#accountid").val();
        var inputData = 'accountid='+accountid;
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
