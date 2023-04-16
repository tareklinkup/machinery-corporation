<style>
    .chosen-container-single {
        width: 200px !important;
    }

    /*.highlighted {*/
    /*color: #000 !important;*/
    /*}*/
</style>

<div class="content_scroll">
    <h2>Quotation Invoice</h2>
    <div style="width:100%; float:left;">
        <div style="border:1px solid #ddd">
            <table width="100%">
                <tr>

                    <!--Show All Products-->
                    <td id="productSection" style="width: 200px;">
                        <div class="side-by-side clearfix">
                            <div>
                                <select id="SaleMaster_SlNo" data-placeholder="Choose a Product..." class="chosen-select" style="width:200px;" tabindex="2" >
                                    <option value=""></option>
                                    <?php $invoices = $this->db->order_by('SaleMaster_SlNo','DESC')->get('sr_quotationmaster')->result();
                                    foreach ($invoices as $invoice):
                                        ?>
                                        <option value="<?= $invoice->SaleMaster_SlNo?>"><?= $invoice->SaleMaster_InvoiceNo?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </td>

                    <td id="invoiceSection" style="">
                        <div class="side-by-side clearfix">
                            <div>
                                <input type="button" class="buttonAshiqe" onclick="searchforreturn()" value="Show Report">
                            </div>
                        </div>
                    </td>

                </tr>
            </table>
        </div>
    </div>

</div>
<div id="QuotationInvoice"></div>



<script type="text/javascript">

    //show the invoice
    function searchforreturn(){
        var SaleMaster_SlNo = $("#SaleMaster_SlNo").val();
        if(SaleMaster_SlNo==""){
            alert('Select Invoice Number First');

            $("#SaleMaster_SlNo").css('border-color','red');
            return false;
        }else{
            $("#SaleMaster_SlNo").css('border-color','green');
        }
        var inputData = 'SaleMaster_SlNo='+SaleMaster_SlNo;
        var urldata = "<?php echo base_url(); ?>quotation/quotation_invoice_search";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputData,
            success:function(data){
                // console.log(data);
                $("#QuotationInvoice").html(data);
            }
        });
    }
</script>