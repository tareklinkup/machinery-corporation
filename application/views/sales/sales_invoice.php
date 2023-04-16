<style>
    .chosen-container-single {
        width: 200px !important;
    }

    /*.highlighted {*/
        /*color: #000 !important;*/
    /*}*/
</style>

<div class="content_scroll">
<h2>Sales Invoice</h2>
    <div style="width:100%; float:left;">
        <div style="border:1px solid #ddd">
            <table width="100%">
                <tr>
                    <!--Search By Option For Select What type of Search Will be??-->
                    <td style="width: 200px">
                        <div class="side-by-side clearfix">
                            <div>
                                <select id="searchType" data-placeholder="Choose a Type..." class="chosen-select" style="width:200px;" tabindex="2" >
                                    <option value=""></option>
                                    <option value="byInvoice">Invoice</option>
                                    <option value="byProduct">Product</option>
                                </select>
                            </div>
                        </div>
                    </td>
                    <!--Show All Products-->
                    <td id="productSection" style="width: 200px; display: none">
                        <div class="side-by-side clearfix">
                            <div>
                                <select id="productID" data-placeholder="Choose a Product..." class="chosen-select" style="width:200px;" tabindex="2" >
                                    <option value=""></option>
                                    <?php $products = $this->db->order_by('Product_SlNo','DESC')->get('tbl_product')->result();
                                              foreach ($products as $product):
                                    ?>
                                    <option value="<?= $product->Product_SlNo?>"><?= $product->Product_Name?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </td>

                    <td id="invoiceSection" style="display:none;">
                        <div class="side-by-side clearfix">
                            <div>
                                <select id="SaleMasteriD" data-placeholder="Choose a Invoice..." class="chosen-select" style="width:250px;" tabindex="2" >
                                </select>
                                <input type="button" class="buttonAshiqe" onclick="searchforreturn()" value="Show Report">
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
//    show and hide product select option by serach Type
//    as well as getting all invoices when type is invoice
   $("#searchType").on('change',function () {
       var searchBy = $(this).val();
       if (searchBy === "byProduct"){
            $("#productSection").show();
           $("#invoiceSection").show();
       }else {//byInvoice
           $("#invoiceSection").show();
           $.ajax({
               type: "GET",
               url: '<?= base_url()?>sales/getAllInvoices',
               dataType:'JSON',
               success:function(invoices){
                   var html ='';
                   $.each(invoices,function (key,value) {
                       html += '<option value="'+value.SaleMaster_SlNo+'">'+value.SaleMaster_InvoiceNo+'</option>';
                   });
                   $("#SaleMasteriD").html(html);
                   $('.chosen-select').trigger('chosen:updated');
               }
           });

           $("#productSection").hide();
       }
   });
//get Invoice By Product Id
$("#productID").on('change',function () {
        var productID = $(this).val();
        $.ajax({
            type: "GET",
            url: '<?= base_url()?>sales/getInvoiceByProductId',
            dataType:'JSON',
            data: 'productID='+productID,
            success:function(invoices){
                var html ='';
                $.each(invoices,function (key,value) {
                    html += '<option value="'+value.SaleMaster_SlNo+'">'+value.SaleMaster_InvoiceNo+'</option>';
                });
                $("#SaleMasteriD").html(html);
                $('.chosen-select').trigger('chosen:updated');
            }
        });
});


//show the invoice
  function searchforreturn(){
    var SaleMasteriD = $("#SaleMasteriD").val();
    if(SaleMasteriD==""){
        alert('Select Invoice Number First');

      $("#SaleMasteriD").css('border-color','red');
      return false;
    }else{
        $("#SaleMasteriD").css('border-color','green');
    }
    var inputData = 'SaleMasteriD='+SaleMasteriD;
    var urldata = "<?php echo base_url(); ?>sales/sales_invoice_search";
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