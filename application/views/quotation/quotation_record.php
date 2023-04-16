<div class="content_scroll">
<h2></h2>
    <div style="width:100%; float:left;">
        <div style="border:1px solid #ddd">
            <table > 
               <form method="post" action="<?php //echo base_url(); ?>Administrator/sales/search_sales_record">
			   <tr>
                    <td><strong>Search Type</strong></td>
                    <td> 
                        <select id="searchtype" class="inputclass" name="searchtype" style="width:200px" onchange="Selected()">
                            <option value="All"> All </option>
                            <option value="invoice"> Memo Record By Invoice </option>
                            <option value="Customer"> By Customer </option>
                        </select>
                    </td>
                    <td style="display:none;"><strong>Memo Type</strong></td>
                    <td style="display:none;"> 
                        <select id="Salestype" class="inputclass" name="Salestype" style="width:200px">
                            <option value="All"> All </option>
                            <!-- <option value="W"> Whole Sales </option>
                            <option value="R"> Retail Sales </option> -->
                        </select>
                    </td>
                    <td><strong>Date</strong></td>
                    <td id="ashiqeCalender"><input name="Sales_startdate" type="text" id="Sales_startdate" value="<?php echo date("Y-m-d") ?>" class="inputclass" style="width:200px"/></td>
                    <td> To </td>
                    <td id="ashiqeCalender" ><input name="Sales_enddate" type="text" id="Sales_enddate" value="<?php echo date("Y-m-d") ?>" class="inputclass" style="width:200px"/></td>
                    <td><input type="button" class="buttonAshiqe" onclick="searchforRecord()" value="Search Report"></td>
                    <!---<td><input type="submit" class="buttonAshiqe" value="Search Report"></td>--->
                </tr>
				</form>
				<input type="hidden" name="type" value="<?php echo $type; ?>">
                <tr>
                    <td colspan="6">
					
                        <span style="display:none" id="showcustomer">
                            <table>
                            <tr>
                                <td>Select Customer</td>
                                <td>
                                    <select name="" id="customerID" class="inputclass" style="width:200px" >
                                        <option value="">  </option>
                                        <?php 
										//$sql = mysql_query("SELECT * FROM tbl_quotaion_customer where quation_customer_branchid = '".$this->sbrunch."' order by customer_name asc");
										if($type == 'q'){
										$sql = mysql_query("SELECT * FROM tbl_quotaion_customer where status='q' order by customer_name asc");
                                        }else{
											$sql = mysql_query("SELECT * FROM tbl_quotaion_customer where status='m' order by customer_name asc");
										}
										while($row = mysql_fetch_array($sql)){ ?>
                                        <option value="<?php echo $row['quotation_customer_id']; ?>"><?php echo $row['customer_name']; ?> (<?php echo $row['quotation_customer_id']; ?>)</option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <!-- <td>
                                    <span id="customerName">
                                        <input type="text" disabled="" class="inputclass" value="">
                                    </span>
                                </td> -->
                            </tr>
                        </table>
                        </span>
						
                        <span style="display:none" id="showinvoice">
                            <table>
                            <tr>
                                <td>Select Invoice</td>
                                <td>
                                    <select name="" id="Invoice" class="inputclass" style="width:200px" >
                                        <option value="">  </option>
                                        <?php
										//$sql = mysql_query("SELECT * FROM tbl_quotation_master where SaleMaster_branchid = '".$this->sbrunch."' order by SaleMaster_SlNo asc");
										if($type == 'q'){
											$sql = mysql_query("SELECT * FROM tbl_quotation_master where Status='q' order by SaleMaster_SlNo asc");
                                        }else{
											$sql = mysql_query("SELECT * FROM tbl_quotation_master where Status='m' order by SaleMaster_SlNo asc");
										}
                                        while($row = mysql_fetch_array($sql)){ ?>
                                        <option value="<?php echo $row['SaleMaster_SlNo']; ?>"> <?php echo $row['SaleMaster_InvoiceNo']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <!-- <td>
                                    <span id="customerName">
                                        <input type="text" disabled="" class="inputclass" value="">
                                    </span>
                                </td> -->
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
        var type = $("#type").val();
        var searchtype = $("#searchtype").val();
        var Sales_startdate = $("#Sales_startdate").val();
        var Sales_enddate = $("#Sales_enddate").val();
        var customerID = $("#customerID").val();
        var Invoice = $("#Invoice").val();
        var Salestype = $("#Salestype").val();
        //alert(customerID);
        var inputData = 'Salestype='+Salestype+'&searchtype='+searchtype+'&Sales_startdate='+Sales_startdate+'&Sales_enddate='+Sales_enddate+'&customerID='+customerID+'&Invoice='+Invoice+'&type='+type;
        var urldata = "<?php echo base_url(); ?>Administrator/quotation/search_quotation_record";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputData,
            success:function(data){
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
			$("#showinvoice").hide();
        }
		
        if(searchtype == "All"){
            $("#showcustomer").hide();
            $("#showinvoice").hide();
        }
		if(searchtype == "invoice"){
            $("#showinvoice").show();
			$("#showcustomer").hide();
        }
    }
    function Supplierdata(){
        var customerID = $("#customerID").val();
        var inputData = 'customerID='+customerID;
        var urldata = "<?php echo base_url();?>Administrator/sales/sales_customerName";
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