
<div class="content_scroll">
<h2>Sales Challan</h2>
    <div style="width:100%; float:left;">
        <div style="border:1px solid #ddd">
            <table width="100%"> 
                <tr>
                    <td><strong>Challan no</strong></td>
                    <td>
                        <div class="side-by-side clearfix">
                            <div>
                                <select id="ChallanMasterID" data-placeholder="Choose a Challan..." class="chosen-select" style="width:250px;" tabindex="2" >
                                     <option value=""></option>
                                <?php $sql = mysql_query("SELECT * FROM sr_challanmaster ORDER BY ChallanMaster_SlNo DESC");
                                while($row = mysql_fetch_array($sql)){ ?>
                                <option value="<?php echo $row['ChallanMaster_SlNo']; ?>"><?php echo $row['ChallanMaster_ChallanNo']; ?></option>
                                <?php } ?>
                            </select><input type="button" class="buttonAshiqe" onclick="searchChallan()" value="Show Report">
                            </div>
                        </div>  
                    </td>
                </tr>
            </table>
        </div>
    </div>

</div>
<div id="SalesInvoice"></div>
<script type="text/javascript">
  function searchChallan(){
    var ChallanMasterID = $("#ChallanMasterID").val();
    if(ChallanMasterID==""){
      $("#ChallanMasterID").css('border-color','red');
      return false;
    }else{
        $("#ChallanMasterID").css('border-color','green');
    }
    var inputData = 'ChallanMasterID='+ChallanMasterID;
    var urldata = "<?php echo base_url(); ?>sales/sales_challan_search";
    $.ajax({
        type: "POST",
        url: urldata,
        data: inputData,
        success:function(data){
            $("#SalesInvoice").html(data);
        }
    });
  }
</script>