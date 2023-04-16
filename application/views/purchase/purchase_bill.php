
<div class="content_scroll">
<h2>Purchase Invoice</h2>
    <div style="width:100%; float:left;">
        <div style="border:1px solid #ddd">
            <table width="100%"> 
                <tr>
                    <td><strong>Invoice no</strong></td>
                   <td> 
                        <div class="side-by-side clearfix">
                            <div>
                                  <select id="purchasemsid" data-placeholder="Choose a Supplier..." class="chosen-select" style="width:200px;" tabindex="2" onchange="Supplier()">
                                        <option value=""></option>
                                        <?php $sql = mysql_query("SELECT * FROM sr_purchasemaster order by PurchaseMaster_InvoiceNo desc");
                                        while($row = mysql_fetch_array($sql)){ ?>
                                        <option value="<?php echo $row['PurchaseMaster_SlNo']; ?>"><?php echo $row['PurchaseMaster_InvoiceNo']; ?></option>
                                        <?php } ?>
                                  </select><input type="button" class="buttonAshiqe" onclick="searchforreturn()" value="Search">
                            </div>
                        </div>

                        <!-- <select name="" id="purchasemsid" class="inputclass" style="width:200px">
                            <option value=""></option>
                            <?php $sql = mysql_query("SELECT * FROM sr_purchasemaster order by PurchaseMaster_InvoiceNo desc");
                            while($row = mysql_fetch_array($sql)){ ?>
                            <option value="<?php echo $row['PurchaseMaster_SlNo']; ?>"><?php echo $row['PurchaseMaster_InvoiceNo']; ?></option>
                            <?php } ?>
                        </select><input type="button" class="buttonAshiqe" onclick="searchforreturn()" value="Search"> -->
                    </td>
                </tr>
            </table>
        </div>
    </div>

</div>
<div id="PurchaseBill"></div>
<script type="text/javascript">
  function searchforreturn(){
    var purchasemsid = $("#purchasemsid").val();
    if(purchasemsid==""){
      $("#purchasemsid").css('border-color','red');
      return false;
    }else{
        $("#purchasemsid").css('border-color','green');
    }
    var inputData = 'purchasemsid='+purchasemsid;
    var urldata = "<?php echo base_url(); ?>purchase/purchase_invoice_search";
    $.ajax({
        type: "POST",
        url: urldata,
        data: inputData,
        success:function(data){
            $("#PurchaseBill").html(data);
        }
    });
  }
</script>