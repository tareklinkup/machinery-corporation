
<div class="content_scroll">
<h2>Service</h2>
    <div style="width:100%; float:left;">
        <div style="border:1px solid #ddd">
            <table width="100%"> 
                <tr>
                    <td><strong>Invoice no</strong></td>
                    <td>
                        <div class="side-by-side clearfix">
                            <div>
                                <select id="ServiceMasterID" data-placeholder="Choose a Invoice..." class="chosen-select" style="width:250px;" tabindex="2" >
                                     <option value=""></option>
                                <?php $sql = mysql_query("SELECT * FROM sr_servicemaster ORDER BY ServiceMaster_SlNo DESC");
                                while($row = mysql_fetch_array($sql)){ ?>
                                <option value="<?php echo $row['ServiceMaster_SlNo']; ?>"><?php echo $row['ServiceMaster_InvoiceNo']; ?></option>
                                <?php } ?>
                            </select><input type="button" class="buttonAshiqe" onclick="searchforreturn()" value="Show Report">
                            </div>
                        </div>  
                    </td>
                </tr>
            </table>
        </div>
    </div>

</div>
<div id="SalesService"></div>
<script type="text/javascript">
  function searchforreturn(){
    var ServiceMasterID = $("#ServiceMasterID").val();
    if(ServiceMasterID==""){
      $("#ServiceMasterID").css('border-color','red');
      return false;
    }else{
        $("#ServiceMasterID").css('border-color','green');
    }
    var inputData = 'ServiceMasterID='+ServiceMasterID;
    var urldata = "<?php echo base_url(); ?>service/service_search";
    $.ajax({
        type: "POST",
        url: urldata,
        data: inputData,
        success:function(data){
            $("#SalesService").html(data);
        }
    });
  }
</script>