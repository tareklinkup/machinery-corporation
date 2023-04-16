<link href="<?php echo base_url()?>css/prints.css" rel="stylesheet" />
<div class="content_scroll" style="padding:40px 20px 25px 160px">
<a style="cursor:pointer" onclick="window.open('<?php echo base_url(); ?>reports/sales_invoice_due', 'newwindow', 'width=850, height=800,scrollbars=yes'); return false;"><img src="<?php echo base_url(); ?>images/printer.png" alt=""> Print</a>

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
                    <?php
                    $cusID = $selse['SalseCustomer_IDNo'];
                    if($cusID == 0){
                ?>
                    <tr>
                        <td><strong>Customer ID </strong></td>
                        <td>:</td>
                        <td><?php echo '0000'; ?></td>
                    </tr> 
                    <tr>
                        <td><strong>Customer Name </strong></td>
                        <td>:</td>
                        <td><?php echo $selse['SalseCustomer_Name']; ?></td>
                    </tr> 
                    <tr>
                        <td><strong>Customer Address </strong></td>
                        <td>:</td>
                        <td><?php echo $selse['SalseCustomer_Address']; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Contact no </strong></td>
                        <td>:</td>
                        <td><?php echo $selse['SalseCustomer_Contact']; ?></td>
                    </tr>
                    <?php
                        }else{
                    ?>
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
                    <?php
                        }
                    ?>               
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
           <th>Rate</th>
           <th>Amount</th>
        </tr>
        <?php $i = 0;
        $totalamount = 0;
        $packageName = 0;
        $Ptotalamount = 0;
        $ssql = mysql_query("SELECT sr_saledetails.*, tbl_product.*  FROM sr_saledetails left join tbl_product on tbl_product.Product_SlNo = sr_saledetails.Product_IDNo where sr_saledetails.SaleMaster_IDNo = '$SalesID'");
        while($rows = mysql_fetch_array($ssql)){ 
           
            $packageName = $rows['packageName'];
            if($packageName==""){
            $amount = $rows['SaleDetails_Rate']*$rows['SaleDetails_TotalQuantity'] ;
            $totalamount = $totalamount+$amount;
            $i++;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $rows['Product_Code'] ?></td>
            <td><?php echo $rows['Product_Name'] ?></td>
            <td style="text-align: center;"><?php echo $rows['SaleDetails_TotalQuantity'] ?> <?php echo $rows['SaleDetails_unit'] ?></td>
            <td style="text-align: right;"><?php echo number_format($rows['SaleDetails_Rate'], 2); ?></td>
            <td align="right"><?php echo number_format($amount, 2); ?></td>
        </tr>
        <?php } }
            $ssqls = mysql_query("SELECT sr_saledetails.*, tbl_product.*  FROM sr_saledetails left join tbl_product on tbl_product.Product_SlNo = sr_saledetails.Product_IDNo where sr_saledetails.SaleMaster_IDNo = '$SalesID' group by sr_saledetails.packageName");
            while($rows = mysql_fetch_array($ssqls)){ $i++;
                if($rows['packageName']!=""){
                $Pamount = $rows['packSellPrice']*$rows['SeleDetails_qty'] ;
                $Ptotalamount = $Ptotalamount+$Pamount;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $rows['Product_Code'] ?></td>
                <td><?php echo $rows['packageName'] ?></td>
                <td><?php echo $rows['SeleDetails_qty'] ?> <?php echo $rows['SaleDetails_unit'] ?></td>
                <td><?php echo $rows['packSellPrice'] ?></td>
                <td align="right"><?php echo $Pamount; ?></td>
            </tr>
        <?php } }?>
        <tr>
            <td colspan="4" style="border:0px"></td>
            <td style="border:0px"><strong>Sub Total :</strong> </td>
            <td style="border:0px"align="right"><?php $totalamount =$totalamount+$Ptotalamount; echo number_format($totalamount,2); ?></td>
        </tr>
        <tr><td  style="border:0px"></td>
            <td  style="border:0px"><strong>Previous Due</strong></td>
            <td  style="border:0px;color:red;text-align: right;">
                <!-- Previous Due Customer -->
                <?php $cusotomerID = $selse['Customer_SlNo']; 
                    $Customerpaid='';
                    $Customerpurchase='';
                    $sql = mysql_query("SELECT * FROM sr_customer_payment WHERE CPayment_customerID = '".$cusotomerID."'");
                    while($row = mysql_fetch_array($sql)){
                        $Customerpaid = $Customerpaid+$row['CPayment_amount'];    
                    }
                    $sqls = mysql_query("SELECT * FROM sr_salesmaster WHERE SalseCustomer_IDNo = '".$cusotomerID."'");
                    while($rows = mysql_fetch_array($sqls)){
                        $Customerpurchase = $Customerpurchase +$rows['SaleMaster_SubTotalAmount']; 
                    }
                    $vat = $selse['SaleMaster_TaxAmount'];  $vat = ($totalamount*$vat)/100;
                    $all = $totalamount-$selse['SaleMaster_TotalDiscountAmount']+ $selse['SaleMaster_Freight']+$vat;  $CurrenDue = $all-$selse['SaleMaster_PaidAmount'];
                     $previousdue= $Customerpurchase-$Customerpaid;
                     $previousdue = $previousdue-$CurrenDue;
                    if($previousdue==''){echo'0.00';}else{echo number_format($previousdue, 2);}
                ?>
                <!-- Previous Due Customer End -->
            </td>
            <td style="border:0px"></td>
            <td style="border:0px"><strong>Tax/Vat :</strong> </td>
            <td style="border:0px" align="right"><?php $Frieght = $selse['SaleMaster_Freight']; echo number_format($Frieght,2) ?></td>
        
        </tr>
        <tr>
            <td style="border:0px"></td>
            <td style="border:0px"><strong>Current Due</strong></td>
            <td style="border:0px;color:red;text-align: right;"><?php if($CurrenDue==''){echo '0.00';}else{echo number_format($CurrenDue, 2);} ?></td>
            <td style="border:0px"></td>
            <td style="border:0px"><strong>Discount :</strong> </td>
            <td style="border:0px" align="right"><?php $discount = $selse['SaleMaster_TotalDiscountAmount'];echo number_format($discount,2) ?></td>
        
        </tr>
        <tr>
            <td style="border:0px"></td>
            <td style="border-top: 1px solid #999;border-left: 0px ;border-right: 0px ;border-bottom: 0px ;"><strong>Total Due</strong> </td>
            <td style="color:red;border-top: 1px solid #999;border-left: 0px ;border-right: 0px ;border-bottom: 0px ;text-align: right;"><?php if($previousdue+$CurrenDue==''){echo '0.00';}else{echo number_format(($previousdue+$CurrenDue), 2);} ?></td>
            <td style="border:0px"></td>
            <td style="border-top: 2px solid #999;border-left: 0px ;border-right: 0px ;border-bottom: 0px ;"><strong>Total :</strong> </td>
            <td style="border-top: 2px solid #999;border-left: 0px ;border-right: 0px ;border-bottom: 0px ;" align="right"><strong><?php $grandtotal = $totalamount-$discount+ $Frieght+$vat; echo number_format($grandtotal,2)?></strong></td>
        
        </tr>
         <tr>
            <td colspan="4" style="border:0px"></td>
            <td style="border:0px"><strong>Paid by <?php echo $selse['SaleMaster_paidby']; ?>:</strong> </td>
            <td style="border:0px" align="right"><?php if($selse['SaleMaster_paidby']=="Check"){$paid = "0";}else {$paid = $selse['SaleMaster_PaidAmount'];}; echo number_format($paid,2);?></td>
        
        </tr>
        <tr>
            <td colspan="4" style="border:0px"></td>
            <td colspan="2"align="right" style="border-top: 2px solid #999;border-left: 0px ;border-right: 0px ;border-bottom: 0px ;"></td>
           
        </tr>
        <tr>
            <td colspan="4" style="border:0px"></td>
            <td style="border:0px"><strong>Due :</strong> </td>
            <td style="border:0px" align="right"><?php echo number_format($grandtotal-$paid,2); ?></td>
        
        </tr>
        
       
    </table>
    <p><strong>Total (in word): </strong>
<?php 
    error_reporting(E_ALL);
    //error_reporting(0);

    class Currency
    {

    function __construct()
    {
    //do nothing for now
    }

    function get_bd_money_format($amount)
    {
    $output_string = '';
    $fraction = '';
    $tokens = explode('.', $amount);
    $number = $tokens[0];
    if(count($tokens) > 1)
    {
    $fraction = (double)('0.' . $tokens[1]);
    $fraction = $fraction * 100;
    $fraction = round($fraction, 0);
    $fraction = '.' . $fraction;
    }

    $number = $number . '';
    $spl=str_split($number);
    $lpcount=count($spl);
    $rem=$lpcount-3;
    //echo "rem".$rem."

    //even one
    if($lpcount%2==0)
    {
    for($i=0;$i<=$lpcount-1;$i++)
    {

    if($i%2!=0 && $i!=0 && $i!=$lpcount-1)
    {
    $output_string .= ",";
    }
    $output_string .= $spl[$i];
    }
    }
    //odd one
    if($lpcount%2!=0)
    {
    for($i=0;$i<=$lpcount-1;$i++)
    {
    if($i%2==0 && $i!=0 && $i!=$lpcount-1)
    {
    $output_string .= ",";
    }
    $output_string .= $spl[$i];
    }
    }
    return $output_string . $fraction;
    }

    // http://efreedom.com/Question/1-3181945/Convert-Money-Text-PHP
    function translate_to_words($number)
    {

    // zero is a special case, it cause problems even with typecasting if we don't deal with it here
    $max_size = pow(10,18);
    if (!$number) return "zero";
    if (is_int($number) && $number < abs($max_size))
    {
    $prefix = '';
    $suffix = '';
    switch ($number)
    {
    // set up some rules for converting digits to words
    case $number < 0:
    $prefix = "negative";
    $suffix = $this->translate_to_words(-1*$number);
    $string = $prefix . " " . $suffix;
    break;
    case 1:
    $string = "one";
    break;
    case 2:
    $string = "two";
    break;
    case 3:
    $string = "three";
    break;
    case 4:
    $string = "four";
    break;
    case 5:
    $string = "five";
    break;
    case 6:
    $string = "six";
    break;
    case 7:
    $string = "seven";
    break;
    case 8:
    $string = "eight";
    break;
    case 9:
    $string = "nine";
    break;
    case 10:
    $string = "ten";
    break;
    case 11:
    $string = "eleven";
    break;
    case 12:
    $string = "twelve";
    break;
    case 13:
    $string = "thirteen";
    break;
    // fourteen handled later
    case 15:
    $string = "fifteen";
    break;
    case $number < 20:
    $string = $this->translate_to_words($number%10);
    // eighteen only has one "t"
    if ($number == 18)
    {
    $suffix = "een";
    } else
    {
    $suffix = "teen";
    }
    $string .= $suffix;
    break;
    case 20:
    $string = "twenty";
    break;
    case 30:
    $string = "thirty";
    break;
    case 40:
    $string = "forty";
    break;
    case 50:
    $string = "fifty";
    break;
    case 60:
    $string = "sixty";
    break;
    case 70:
    $string = "seventy";
    break;
    case 80:
    $string = "eighty";
    break;
    case 90:
    $string = "ninety";
    break;
    case $number < 100:
    $prefix = $this->translate_to_words($number-$number%10);
    $suffix = $this->translate_to_words($number%10);
    //$string = $prefix . "-" . $suffix;
    $string = $prefix . " " . $suffix;
    break;
    // handles all number 100 to 999
    case $number < pow(10,3):
    // floor return a float not an integer
    $prefix = $this->translate_to_words(intval(floor($number/pow(10,2)))) . " hundred";
    if ($number%pow(10,2)) $suffix = " and " . $this->translate_to_words($number%pow(10,2));
    $string = $prefix . $suffix;
    break;
    case $number < pow(10,6):
    // floor return a float not an integer
    $prefix = $this->translate_to_words(intval(floor($number/pow(10,3)))) . " thousand";
    if ($number%pow(10,3)) $suffix = $this->translate_to_words($number%pow(10,3));
    $string = $prefix . " " . $suffix;
    break;
    }
    } else
    {
    echo "ERROR with - $number
    Number must be an integer between -" . number_format($max_size, 0, ".", ",") . " and " . number_format($max_size, 0, ".", ",") . " exclussive.";
    }
    return $string;
    }

    function get_bd_amount_in_text($amount)
    {
    $output_string = '';

    $tokens = explode('.', $amount);
    $current_amount = $tokens[0];
    $fraction = '';
    if(count($tokens) > 1)
    {
    $fraction = (double)('0.' . $tokens[1]);
    $fraction = $fraction * 100;
    $fraction = round($fraction, 0);
    $fraction = (int)$fraction;
    $fraction = $this->translate_to_words($fraction) . ' paisa';
    $fraction = ' Taka & ' . $fraction;
    }

    $crore = 0;
    if($current_amount >= pow(10,7))
    {
    $crore = (int)floor($current_amount / pow(10,7));
    $output_string .= $this->translate_to_words($crore) . ' crore ';
    $current_amount = $current_amount - $crore * pow(10,7);
    }

    $lakh = 0;
    if($current_amount >= pow(10,5))
    {
    $lakh = (int)floor($current_amount / pow(10,5));
    $output_string .= $this->translate_to_words($lakh) . ' lakh ';
    $current_amount = $current_amount - $lakh * pow(10,5);
    }

    $current_amount = (int)$current_amount;
    $output_string .= $this->translate_to_words($current_amount);

    $output_string = $output_string . $fraction . ' only';
    $output_string = ucwords($output_string);
    return $output_string;
    }

    }

    $currency_object = new Currency();
    $amount = $grandtotal;
    echo $currency_object->get_bd_amount_in_text($amount);
?>
    </p><br>
    <p><strong>Notes: </strong> <?php echo $selse['SaleMaster_Description']; ?></p>

</div>