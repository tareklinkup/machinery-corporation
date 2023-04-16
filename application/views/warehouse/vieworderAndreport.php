<link href="<?php echo base_url()?>css/prints.css" rel="stylesheet" />
<div class="content_scroll" style="padding:120px 20px 25px 160px">
<a style="cursor:pointer" onclick="window.open('<?php echo base_url(); ?>reports/warehouse_sales_invoice', 'newwindow', 'width=850, height=800,scrollbars=yes'); return false;"><img src="<?php echo base_url(); ?>images/printer.png" alt=""> Print</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url(); ?>warehouse/pending_order" title="" class="buttonAshiqe">Go Back</a>

<?php 
  $sql = mysql_query("SELECT sr_salesmaster.*, sr_salesmaster.AddBy as served, sr_customer.* FROM sr_salesmaster left join sr_customer on sr_customer.Customer_SlNo = sr_salesmaster.SalseCustomer_IDNo where sr_salesmaster.SaleMaster_SlNo = '$SalesID'");
  $selse = mysql_fetch_array($sql);
?>
    <table  cellspacing="0" cellpadding="0" width="70%">
        <tr>
            <td colspan="2" style="background:#ddd;" align="center"><h2 >Sales Invoice</h2></td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td><strong>Customer ID </strong></td>
                        <td>:</td>
                        <td><?php echo $selse['Customer_Code']; ?></td>
                    </tr> 
                    <tr>
                        <td><strong>Customer Name </strong></td>
                        <td>:</td>
                        <td><?php echo $selse['Customer_Name']; ?></td>
                    </tr> 
                    <tr>
                        <td><strong>Customer Address </strong></td>
                        <td>:</td>
                        <td><?php echo $selse['Customer_Address']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Contact no </strong></td>
                        <td>:</td>
                        <td><?php echo $selse['Customer_Mobile']; ?></td>
                    </tr>              
                </table>
            </td>
            <td>
                <table width="100%">
                    <tr>
                        <td><strong>Invoice No </strong></td>
                        <td>:</td>
                        <td><?php echo $selse['SaleMaster_InvoiceNo']; ?></td>
                    </tr> 
                    <tr>
                        <td><strong>Sales Date </strong></td>
                        <td>:</td>
                        <td><?php echo $selse['SaleMaster_SaleDate']; ?></td>
                    </tr> 

                    <tr>
                        <td><strong>Served by </strong></td>
                        <td>:</td>
                        <td><?php echo $selse['served']; ?></td>
                    </tr> 
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2"><hr><hr></td>
            <td colspan="2"><br></td>
        </tr>
    </table>
    
    <table class="border" cellspacing="0" cellpadding="0" width="70%">
        <tr>
           <th>SI No.</th>
           <th>Pro.ID</th>
           <th>Product Information</th>
           <th>Quantity</th>
        </tr>
        <?php $i = "";
        $totalamount = "";
        $packageName ="";
        $Ptotalamount = "";
        $ssql = mysql_query("SELECT sr_saledetails.*, tbl_product.*  FROM sr_saledetails left join tbl_product on tbl_product.Product_SlNo = sr_saledetails.Product_IDNo where sr_saledetails.SaleMaster_IDNo = '$SalesID'");
        while($rows = mysql_fetch_array($ssql)){ 
           
            $packageName = '';
            if($packageName==""){
            $amount = $rows['SaleDetails_Rate']*$rows['SaleDetails_TotalQuantity'] ;
            $totalamount = $totalamount+$amount;
            $i++;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $rows['Product_Code'] ?></td>
            <td><?php echo $rows['Product_Name'] ?></td>
            <td><?php echo $rows['SaleDetails_TotalQuantity'] ?> <?php echo $rows['SaleDetails_unit'] ?></td>

        </tr>
        <?php } }?>

    </table>

</div>