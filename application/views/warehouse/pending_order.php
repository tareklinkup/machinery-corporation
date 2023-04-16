
<?php
    $userType = $this->session->userdata('accountType');
?>
<span id="OrderDetails">
<link href="<?php echo base_url()?>css/prints.css" rel="stylesheet" />
<div class="content_scroll" style="padding:120px 20px 25px 160px">
<h2></h2>

<table class="border" cellspacing="0" cellpadding="0" width="70%">

    <h4><a style="cursor:pointer" onclick="window.open('<?php echo base_url(); ?>reports/current_stock', 'newwindow', 'width=850, height=800,scrollbars=yes'); return false;"><img src="<?php echo base_url(); ?>images/printer.png" alt=""> Print</a></h4>
    <tr>
        <td colspan="5" align="center"><h2>Warehouse Pending Order List</h2></td>
    </tr>
    <tr bgcolor="#ccc">
        <th>Date</th>
        <th>Invoice</th>
        <th>Customer</th>
        <th>Action</th>
    </tr>
    <?php
        $SPL = mysql_query("SELECT sr_salesmaster.*, sr_customer.* FROM sr_salesmaster LEFT JOIN sr_customer ON sr_customer.Customer_SlNo = sr_salesmaster.SalseCustomer_IDNo WHERE sr_salesmaster.SaleMaster_Dalivery_Status = 'P' ORDER BY sr_salesmaster.SaleMaster_SlNo ASC");
        while ($row = mysql_fetch_array($SPL)) {
    ?>
    <tr>
        <td><?php echo $row['SaleMaster_SaleDate']; ?></td>
        <td><?php echo $row['SaleMaster_InvoiceNo']; ?></td>
        <td><?php echo $row['Customer_Name']; ?></td>
        <td style="padding:10px 10px;">
            <span class="buttonAshiqe"  style="margin:5px 5px;" onclick="View(<?php echo $row['SaleMaster_SlNo'] ?>)">View</span>
            <?php
                if($userType == 'Warehouse Manager'){
            ?>
            <span class="buttonAshiqe"  style="margin:5px 5px;" onclick="Delivery(<?php echo $row['SaleMaster_SlNo'] ?>)">Delivery</span>
            <?php
                }
            ?>
        </td>
    </tr>
    <?php
        }
    ?>
       
</table>

</div>
</span>
<script type="text/javascript">
    function View(id) {
        var SMID = id;
        var inputdata = 'SMID='+SMID;
        var urldata = "<?php echo base_url();?>warehouse/view_pending_order";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#OrderDetails").html(data);
            }
        });
    }

    function Delivery(id){
        var SMID = id;
        var inputdata = 'SMID='+SMID;
        var urldata = "<?php echo base_url();?>warehouse/delivery_pending_order";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                if(data){
                    $("#OrderDetails").html(data);
                    alert('Order Delivered Successfully');
                }else{
                    alert("Oops Something Wrong");
                }
                
            }
        });
    }
</script>