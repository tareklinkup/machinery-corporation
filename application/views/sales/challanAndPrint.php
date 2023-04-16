<link href="<?php echo base_url()?>css/prints.css" rel="stylesheet" />
<div class="content_scroll" style="padding:100px 20px 25px 160px">
<a style="cursor:pointer" onclick="window.open('<?php echo base_url(); ?>reports/challan', 'newwindow', 'width=850, height=800,scrollbars=yes'); return false;"><img src="<?php echo base_url(); ?>images/printer.png" alt=""> Print</a>

<?php 
  $ChallanID = $this->session->userdata("lastchallan");
  $sql = mysql_query("SELECT sr_challanmaster.*, sr_challanmaster.AddBy as served, sr_customer.* FROM sr_challanmaster left join sr_customer on sr_customer.Customer_SlNo = sr_challanmaster.Customer_IDNo where sr_challanmaster.ChallanMaster_SlNo = '$ChallanID'");
  $selse = mysql_fetch_array($sql);
?>
    <table  cellspacing="0" cellpadding="0" width="70%">
        <tr>
            <td colspan="2" style="background:#ddd;" align="center"><h2 >Challan</h2></td>
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
                        <td><strong>Delevary Invoice No </strong></td>
                        <td>:</td>
                        <td><?php echo $selse['ChallanMaster_ChallanNo']; ?></td>
                    </tr> 
                    <tr>
                        <td><strong>Invoice Date </strong></td>
                        <td>:</td>
                        <td><?php echo $selse['ChallanDate']; ?></td>
                    </tr> 
                    <tr>
                        <td><strong>PO No </strong></td>
                        <td>:</td>
                        <td><?php echo $selse['Po_No']; ?></td>
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
        $ssql = mysql_query("SELECT sr_challandetails.*, tbl_product.*  FROM sr_challandetails left join tbl_product on tbl_product.Product_SlNo = sr_challandetails.Product_IDNo where sr_challandetails.ChallanMaster_SlNo = '$ChallanID'");
        while($rows = mysql_fetch_array($ssql)){ 
           
            $packageName = $rows['packageName'];
            if($packageName==""){
            $amount = $rows['ChallanDetails_Rate']*$rows['TotalQuantity'] ;
            $totalamount = $totalamount+$amount;
            $i++;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $rows['Product_Code'] ?></td>
            <td><?php echo $rows['Product_Name'] ?></td>
            <td><?php echo $rows['TotalQuantity'] ?> <?php echo $rows['ChallanDetails_unit'] ?></td>
        </tr>
        <?php } }
            $ssqls = mysql_query("SELECT sr_challandetails.*, tbl_product.*  FROM sr_challandetails left join tbl_product on tbl_product.Product_SlNo = sr_challandetails.Product_IDNo where sr_challandetails.ChallanMaster_SlNo = '$ChallanID' group by sr_challandetails.packageName");
            while($rows = mysql_fetch_array($ssqls)){ $i++;
                if($rows['packageName']!=""){
                $Pamount = $rows['packSellPrice']*$rows['ChallanDetails_qty'] ;
                $Ptotalamount = $Ptotalamount+$Pamount;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $rows['Product_Code'] ?></td>
                <td><?php echo $rows['packageName'] ?></td>
                <td><?php echo $rows['ChallanDetails_qty'] ?> <?php echo $rows['ChallanDetails_unit'] ?></td>
            </tr>
        <?php } }?>





        
       
    </table>
    <p><strong>Notes: </strong> <?php echo $selse['Description']; ?></p>

</div>