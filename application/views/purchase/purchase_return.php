
<div class="content_scroll">
<h2>Purchase Return</h2>
    <div style="width:100%; float:left;">
        <div style="border:1px solid #ddd">
            <table width="100%"> 
                <tr>
                    <td>Invoice no</td>
                    <td> 
                        <div class="side-by-side clearfix">
                            <div>
                                <select id="invoiceno" data-placeholder="Choose a Product..." class="chosen-select" style="width:250px;" tabindex="2" >
                                     <option value=""></option>
                                    <?php $sql = mysql_query("SELECT * FROM sr_purchasemaster order by PurchaseMaster_InvoiceNo desc");
                                    while($row = mysql_fetch_array($sql)){ ?>
                                    <option value="<?php echo $row['PurchaseMaster_SlNo']; ?>"><?php echo $row['PurchaseMaster_InvoiceNo']; ?></option>
                                    <?php } ?>
                                </select><input type="button" class="buttonAshiqe" onclick="searchforreturn()" value="Search">
                            </div>
                        </div>  
                        <!-- <select name="" id="invoiceno" class="inputclass" style="width:200px">
                            <option value=""></option>
                            <?php $sql = mysql_query("SELECT * FROM sr_purchasemaster order by PurchaseMaster_InvoiceNo desc");
                            while($row = mysql_fetch_array($sql)){ ?>
                            <option value="<?php echo $row['PurchaseMaster_SlNo']; ?>"><?php echo $row['PurchaseMaster_InvoiceNo']; ?></option>
                            <?php } ?>
                        </select><input type="button" class="buttonAshiqe" onclick="searchforreturn()" value="Search"> -->
                    </td>
                    
                    <td> 
                        
                    </td>
                    <td>&nbsp;</td>
                    <td>Return Date</td>
                    <td id="ashiqeCalender"><input name="return_date" id="return_date" type="text" value="<?php echo date("Y-m-d") ?>" id="em_Joint_date" class="inputclass" style="width:200px"/></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div id="PurchaseReturnList"></div>
<script type="text/javascript">
    function searchforreturn(){
        var invoiceno = $("#invoiceno").val();
        var inputData = 'invoiceno='+invoiceno;
        var urldata = "<?php echo base_url(); ?>purchase/PurchasereturnSearch";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputData,
            success:function(data){
                $("#PurchaseReturnList").html(data);
            }
        });
    }
 </script>