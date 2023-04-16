
<div class="content_scroll">
<h2>Sales Invoice Delete</h2>
    <div style="width:100%; float:left;">
        <div style="border:1px solid #ddd">
            <table width="100%"> 
                <tr>
                    <td><strong>Invoice no</strong></td>
                    <td>
                        <div class="side-by-side clearfix">
                            <div>
                                <select id="SaleMasteriD" data-placeholder="Choose a Invoice..." class="chosen-select" style="width:250px;" tabindex="2" >
                                     <option value=""></option>
                                    <?php $sql = mysql_query("SELECT * FROM sr_salesmaster order by SaleMaster_InvoiceNo desc");
                                    while($row = mysql_fetch_array($sql)){ ?>
                                    <option value="<?php echo $row['SaleMaster_SlNo']; ?>"><?php echo $row['SaleMaster_InvoiceNo']; ?></option>
                                    <?php } ?>
                                </select>
                                <input type="button" class="buttonAshiqe" onclick="invoicedelte()" value="Delete Invoice">
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
  function invoicedelte(){
    var SaleMasteriD = $("#SaleMasteriD").val();
    
    var inputData = 'SaleMasteriD='+SaleMasteriD;
    var urldata = "<?php echo base_url(); ?>invoice_delete/sales_invoice_delete_process";
    $.ajax({
        type: "POST",
        url: urldata,
        data: inputData,
        success:function(data){
            //$("#SalesInvoice").html(data);
            alert('Delete Success');
        }
    });
  }
</script>