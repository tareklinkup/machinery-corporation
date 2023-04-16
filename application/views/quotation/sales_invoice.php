<!DOCTYPE html>
<html>
<head>
    <title> </title>
    <meta charset='utf-8'>
    <link href="<?php echo base_url()?>css/prints.css" rel="stylesheet" />
    <link href="<?php echo base_url()?>assets/css/custom-styles.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/print.css">
</head>
<style type="text/css" media="print">
    .hide{display:none;}
</style>
<script type="text/javascript">

    function printpage() {
        document.getElementById('printButton').style.visibility="hidden";
        window.print();
        document.getElementById('printButton').style.visibility="visible";
    }

</script>
<body style="background:none;">
<input name="print" type="button" value="Print" id="printButton" onClick="printpage()">
<table width="800px" >
    <tr>
        <td>
            <div style="width:15%;float:left;">
                <img src="<?php echo base_url();?>images/logo.png" alt="Logo" style="margin-bottom:-10px;margin-left:30px;width:100px">
            </div>
            <div style="width:85%;">
                <div style="text-align:center" >
                    <strong style="font-size:16px;color:#1e2d54;">NEW JES MACHINERY CORPORATION</strong><br>
                    <small>209 Nawabpur Road, Dhaka 1100, Bangladesh.</small><br>
                    <small>Phone: +88-02-9568926, 9580512, Mobile: +88 01711832449, +88 01756943997</small><br>
                    <small>Fax: +88-02-7113987, Email: newjesmachinery@gmail.com</small>
                </div>
            </div>
        </td>
    </tr>

    <tr>

        <td style="float:right">

            <table width="100%"  border="0" cellspacing="0" cellpadding="0">

                <tr>

                    <td width="250px" style="text-align:right;"><strong></td>

                </tr>

            </table>

        </td>

    </tr>

    <tr>

        <td colspan="2"><hr><hr></td>

        <td colspan="2"><br></td>

    </tr>

    <tr>

        <td colspan="2" style="background:#ddd;" align="center"><h2 >Quotation Invoice</h2></td>

    </tr>

    <tr>

        <td>

            <!-- Page Body -->

            <?php
            $id = $this->session->userdata('SalesID');
            $sql = mysql_query("SELECT sr_quotationmaster.*, sr_quotationmaster.AddBy as served, tbl_quotaion_customer.* FROM sr_quotationmaster left join tbl_quotaion_customer on tbl_quotaion_customer.quotation_customer_id = sr_quotationmaster.SalseCustomer_IDNo where sr_quotationmaster.SaleMaster_SlNo = '$id'");

            $selse = mysql_fetch_array($sql);?>

            <table  cellspacing="0" cellpadding="0" width="100%">

                <tr>

                    <td style="width:50%;">

                        <table width="100%">

                            <?php
                            $cusID = $selse['SalseCustomer_IDNo'];
                            if($cusID == 0){
                                ?>

                                <tr>

                                    <td style="border:0px;font-size:11pt;width:135px;"><strong>Customer ID </strong></td>

                                    <td style="border:0px;font-size:11pt;">:</td>

                                    <td style="border:0px;font-size:11pt;"><?php echo '0000'; ?></td>

                                </tr>

                                <tr>

                                    <td style="border:0px;font-size:11pt;width:135px;"><strong>Customer Name </strong></td>

                                    <td style="border:0px;font-size:11pt;">:</td>

                                    <td style="border:0px;font-size:11pt;"><?php echo $selse['SalseCustomer_Name']; ?></td>

                                </tr>

                                <tr>

                                    <td style="border:0px;font-size:11pt;width:135px;"><strong>Customer Address </strong></td>

                                    <td style="border:0px;font-size:11pt;">:</td>

                                    <td style="border:0px;font-size:11pt;"><?php echo $selse['SalseCustomer_Address']; ?></td>

                                </tr>

                                <tr>

                                    <td style="border:0px;font-size:11pt;width:135px;"><strong>Contact no </strong></td>

                                    <td style="border:0px;font-size:11pt;">:</td>

                                    <td style="border:0px;font-size:11pt;"><?php echo $selse['SalseCustomer_Contact']; ?></td>

                                </tr>

                                <?php
                            }else{
                                ?>
                                <tr>

                                    <td style="border:0px;font-size:11pt;width:135px;"><strong>Customer ID </strong></td>

                                    <td style="border:0px;font-size:11pt;">:</td>

                                    <td style="border:0px;font-size:11pt;"><?php echo $selse['SalseCustomer_IDNo']; ?></td>

                                </tr>

                                <tr>

                                    <td style="border:0px;font-size:11pt;width:135px;"><strong>Customer Name </strong></td>

                                    <td style="border:0px;font-size:11pt;">:</td>

                                    <td style="border:0px;font-size:11pt;"><?php echo $selse['customer_name']; ?></td>

                                </tr>

                                <tr>

                                    <td style="border:0px;font-size:11pt;width:135px;"><strong>Customer Address </strong></td>

                                    <td style="border:0px;font-size:11pt;">:</td>

                                    <td style="border:0px;font-size:11pt;"><?php echo $selse['customer_address']; ?></td>

                                </tr>

                                <tr>

                                    <td style="border:0px;font-size:11pt;width:135px;"><strong>Contact no </strong></td>

                                    <td style="border:0px;font-size:11pt;">:</td>

                                    <td style="border:0px;font-size:11pt;"><?php echo $selse['contact_number']; ?></td>

                                </tr>
                                <?PHP
                            }
                            ?>

                        </table>

                    </td>

                    <td style="width:50%;">

                        <table width="100%">

                            <tr>

                                <td style="border:0px;font-size:11pt;width:135px;"><strong>Invoice No </strong></td>

                                <td style="border:0px;font-size:11pt;">:</td>

                                <td style="border:0px;font-size:11pt;"><?php echo $selse['SaleMaster_InvoiceNo']; ?></td>

                            </tr>

                            <tr>

                                <td style="border:0px;font-size:11pt;width:135px;"><strong>Date </strong></td>

                                <td style="border:0px;font-size:11pt;">:</td>

                                <td style="border:0px;font-size:11pt;"><?php echo $selse['SaleMaster_SaleDate']; ?></td>

                            </tr>





                            <tr>

                                <td style="border:0px;font-size:11pt;width:135px;"><strong>Served by </strong></td>

                                <td style="border:0px;font-size:11pt;">:</td>

                                <td style="border:0px;font-size:11pt;"><?php echo $selse['served']; ?></td>

                            </tr>

                        </table>

                    </td>

                </tr>

            </table>

        </td>



        <!-- Page Body end -->

    </tr>

    <tr>

        <td colspan="2"><br></td>

    </tr>

    <tr>

        <td>

            <table class="border" cellspacing="0" cellpadding="0" width="100%">

                <tr>

                    <th align="center">SI No.</th>

                    <th>Pro.ID</th>

                    <th>Product Information</th>
                    <th>Product Description</th>

                    <th align="center">Quantity</th>

                    <th align="center">Rate</th>

                    <th>Amount</th>

                </tr>

                <?php $i = 0;

                $totalamount = 0;

                $packageName =0;

                $Ptotalamount = 0;

                $ssql = mysql_query("SELECT sr_quotationdetails.*, tbl_product.*  FROM sr_quotationdetails left join tbl_product on tbl_product.Product_SlNo = sr_quotationdetails.Product_IDNo where sr_quotationdetails.SaleMaster_IDNo = '$id'");

                while($rows = mysql_fetch_array($ssql)){



                    $packageName = $rows['packageName'];

                    if($packageName==""){

                        $amount = $rows['SaleDetails_Rate']*$rows['SaleDetails_TotalQuantity'] ;

                        $totalamount = $totalamount+$amount;

                        $i++;

                        ?>

                        <tr>

                            <td align="center"><?php echo $i; ?></td>

                            <td><?php echo $rows['Product_Code'] ?></td>

                            <td><?php echo $rows['Product_Name'] ?></td>
                            <td><?php echo $rows['product_description'] ?></td>

                            <td align="center"><?php echo $rows['SaleDetails_TotalQuantity'] ?> <?php echo $rows['SaleDetails_unit'] ?></td>

                            <td style="text-align: right;"><?php echo $rows['SaleDetails_Rate'] ?></td>

                            <td style="text-align: right;"><?php echo number_format($amount, 2); ?></td>

                        </tr>

                    <?php } }

                $ssqls = mysql_query("SELECT sr_quotationdetails.*, tbl_product.*  FROM sr_quotationdetails left join tbl_product on tbl_product.Product_SlNo = sr_quotationdetails.Product_IDNo where sr_quotationdetails.SaleMaster_IDNo = '$id' group by sr_quotationdetails.packageName");

                while($rows = mysql_fetch_array($ssqls)){ $i++;

                    if($rows['packageName']!=""){

                        $Pamount = $rows['packSellPrice']*$rows['SeleDetails_qty'] ;

                        $Ptotalamount = $Ptotalamount+$Pamount;

                        ?>

                        <tr>

                            <td align="center"><?php echo $i; ?></td>

                            <td><?php echo $rows['Product_Code'] ?></td>

                            <td><?php echo $rows['packageName'] ?></td>

                            <td align="center"><?php echo $rows['SeleDetails_qty'] ?> <?php echo $rows['SaleDetails_unit'] ?></td>

                            <td align="center"><?php echo $rows['packSellPrice'] ?></td>

                            <td align="right"><?php echo $Pamount; ?></td>

                        </tr>

                    <?php } }?>

                <tr>

                    <td colspan="4" style="border:0px"></td>

                    <td style="border:0px"><strong>Sub Total :</strong> </td>

                    <td style="border:0px"align="right"><?php $totalamount =$totalamount+$Ptotalamount; echo number_format($totalamount,2); ?></td>

                </tr>

                <tr><td  style="border:0px"></td>

                    <td  style="border:0px"><!--<strong>Previous Due</strong>--></td>

                    <td  style="border:0px;color:red;text-align: right;">

                        <!-- Previous Due Customer -->

                        <?php $cusotomerID = $selse['quotation_customer_id'];

                        $Customerpaid='';

                        $Customerpurchase='';

                        $sql = mysql_query("SELECT * FROM sr_customer_payment WHERE CPayment_customerID = '".$cusotomerID."'");

                        while($row = mysql_fetch_array($sql)){

                            $Customerpaid = $Customerpaid+$row['CPayment_amount'];

                        }

                        $sqls = mysql_query("SELECT * FROM sr_quotationmaster WHERE SalseCustomer_IDNo = '".$cusotomerID."'");

                        while($rows = mysql_fetch_array($sqls)){

                            $Customerpurchase = $Customerpurchase +$rows['SaleMaster_TotalSaleAmount'];

                        }

                        $vat = $selse['SaleMaster_TaxAmount'];
                        $vat = ($totalamount*$vat)/100;

                        $all = $totalamount-$selse['SaleMaster_TotalDiscountAmount']+ $selse['SaleMaster_Freight']+$vat;  $CurrenDue = $all-$selse['SaleMaster_PaidAmount'];

                        $previousdue= $Customerpurchase-$Customerpaid;

                        $previousdue = $previousdue-$CurrenDue;

                     //   if($previousdue==''){echo'0.00';}else{echo number_format($previousdue, 2);}

                        ?>

                        <!-- Previous Due Customer End -->

                    </td>

                    <td style="border:0px"></td>

                    <td style="border:0px"><strong>Transport :</strong> </td>

                    <td style="border:0px" align="right"><?php $Frieght = $selse['SaleMaster_Freight']; echo number_format($Frieght,2) ?></td>
                </tr>

                <tr><td  style="border:0px"></td>

                    <td  style="border:0px"><strong></strong></td>

                    <td  style="border:0px;color:red;"></td>

                    <td style="border:0px"></td>

                    <td style="border:0px"><strong>Vat/Tax :</strong> </td>

                    <td style="border:0px" align="right"><?php echo number_format($vat,2) ?></td>
                </tr>

                <tr>

                    <td style="border:0px"></td>

                    <td style="border:0px"><!--<strong>Current Due</strong>--></td>

                    <td style="border:0px;color:red;text-align: right;"><?php //if($CurrenDue==''){echo '0.00';}else{echo number_format($CurrenDue, 2);} ?></td>

                    <td style="border:0px"></td>

                    <td style="border:0px"><strong>Discount :</strong> </td>

                    <td style="border:0px" align="right"><?php $discount = $selse['SaleMaster_TotalDiscountAmount'];echo number_format($discount,2) ?></td>



                </tr>

                <tr>

                    <td style="border:0px"></td>

                    <td style="border-top: 1px solid #999;border-left: 0px ;border-right: 0px ;border-bottom: 0px ;"><!--<strong>Total Due</strong> --></td>

                    <td style="color:red;border-top: 1px solid #999;border-left: 0px ;border-right: 0px ;border-bottom: 0px ;text-align: right;"><?php //if($previousdue+$CurrenDue==''){echo '0.00';}else{echo number_format(($previousdue+$CurrenDue), 2);} ?></td>

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

        </td>

    </tr>

    <tr>

        <td>

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



                    // http://www.phpbuilder.com/board/showthread.php?t=10350901

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

            <h4>Notes: <?php echo $selse['SaleMaster_Description']; ?></h4>



        </td>

    </tr>



</table></td>

</tr>
</table>
<div class="signature" style="width:800px;">
    <div style="width:30%;float:left;text-align:center;margin-top:0px">
        <span style="border-top:1px dotted #000;font-weight:bold;font-size: 12px;">Buyer Signature</span>
    </div>
    <div style="width:40%;float:left;text-align:center;">
        <p>Thank You for Your Business!</p>
    </div>
    <div style="width:30%;float:left;text-align:right;margin-top:0px">
        <span style="border-top:1px dotted #000;font-weight:bold;font-size: 12px;">Authorize Signature</span>
    </div>
</div>
</body>
</html>