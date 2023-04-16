
<div class="content_scroll">
<h2>Daily Summery</h2>
    <div style="width:100%; float:left;">
        <div style="border:1px solid #ddd">
            <table > 
                <tr>
                    <td><strong>Start Date</strong></td>
                    <td id="ashiqeCalender"><input name="Purchase_date" type="text" id="Sales_startdate" value="<?php echo date("Y-m-d") ?>" class="inputclass" style="width:200px"/></td>
                    <td> To </td>
                    <td id="ashiqeCalender"><input name="Purchase_date" type="text" id="Sales_enddate" value="<?php echo date("Y-m-d") ?>" class="inputclass" style="width:200px"/></td>
                    <td><input type="button" class="buttonAshiqe" onclick="searchforRecord()" value="Search"></td>
                </tr>
            </table>
        </div>
    </div>

</div>
<div id="expense"></div>
<script type="text/javascript">
    function searchforRecord(){
        var startdate = $("#Sales_startdate").val();
        var enddate = $("#Sales_enddate").val();        
        var inputData = 'startdate='+startdate+'&enddate='+enddate;
        var urldata = "<?php echo base_url(); ?>account/summery_search";
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
