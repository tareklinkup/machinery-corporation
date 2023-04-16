
<div class="content_scroll">
<h2>Money Receipt</h2>
    <div style="width:100%; float:left;">
        <div style="border:1px solid #ddd">
            <table width="100%"> 
                <tr>
                    <td><strong>Receipt No</strong></td>
                    <td>
                        <div class="side-by-side clearfix">
                            <div>
                                <select id="receiptID" data-placeholder="Choose a Receipt..." class="chosen-select" style="width:250px;" tabindex="2" >
                                     <option value=""></option>
                                <?php $sql = mysql_query("SELECT * FROM tbl_moneyreceipt ORDER BY MoneyReceipt_SINo DESC");
                                while($row = mysql_fetch_array($sql)){ ?>
                                <option value="<?php echo $row['MoneyReceipt_SINo']; ?>"><?php echo $row['MoneyReceipt_No']; ?></option>
                                <?php } ?>
                            </select><input type="button" class="buttonAshiqe" onclick="searchreceipt()" value="Show Report">
                            </div>
                        </div>  
                    </td>
                </tr>
            </table>
        </div>
    </div>

</div>
<div id="moneyReceipt"></div>
<script type="text/javascript">
  function searchreceipt(){
    var receiptID = $("#receiptID").val();
    if(receiptID==""){
      $("#receiptID").css('border-color','red');
      return false;
    }else{
        $("#receiptID").css('border-color','green');
    }
    var inputData = 'receiptID='+receiptID;
    var urldata = "<?php echo base_url(); ?>sales/money_receipt_search_result";
    $.ajax({
        type: "POST",
        url: urldata,
        data: inputData,
        success:function(data){
            $("#moneyReceipt").html(data);
        }
    });
  }
</script>