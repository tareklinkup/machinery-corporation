<div class="content_scroll">
<link href="<?php echo base_url()?>css/prints.css" rel="stylesheet" />

    <h3 style="text-align: center;background-color: #ddd;padding: 5px 0px;">Summery From <?php echo $startdate; ?> To <?php echo $enddate; ?></h3>
    
    <table class="border" cellspacing="0" cellpadding="0" width="80%">
        
        <h4><a style="cursor:pointer" onclick="window.open('<?php echo base_url(); ?>reports/summery_print', 'newwindow', 'width=850, height=800,scrollbars=yes'); return false;"><img src="<?php echo base_url(); ?>images/printer.png" alt=""> Print</a></h4>
        <tr bgcolor="#ccc">
            <th>Sales</th> 
            <th>Customer Payment</th> 
        </tr>
        <tr>
            <td style="width: 50%;vertical-align: top;">
                <table width="100%" class="border">
                    <tr>
                        <th>S/N</th>
                        <th>Customer</th>
                        <th>Amount</th>
                    </tr>
                    <?php
                        $i = 0;
                        $totalSales = 0;
                        $SQ = mysql_query("SELECT sr_salesmaster.*, sr_customer.* FROM sr_salesmaster LEFT JOIN sr_customer ON sr_customer.Customer_SlNo = sr_salesmaster.SalseCustomer_IDNo WHERE sr_salesmaster.SaleMaster_SaleDate BETWEEN '$startdate' AND '$enddate'");
                        while ($srow = mysql_fetch_array($SQ)) {
                            $i++;
                            $totalSales += $srow['SaleMaster_SubTotalAmount'];
                    ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $i; ?></td>
                        <td style="text-align: left;"><?php echo $srow['Customer_Name']; ?> - <?php echo $srow['Customer_Code']; ?></td>
                        <td style="text-align: right;"><?php echo number_format($srow['SaleMaster_SubTotalAmount'], 2); ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                    <tr>
                        <td colspan="2" style="text-align: right;"><strong>Total</strong></td>
                        <td style="text-align: right;"><strong><?php echo number_format($totalSales, 2); ?></strong></td>
                    </tr>
                </table>
            </td>
            <td style="width: 50%;vertical-align: top;">
                <table width="100%" class="border">
                    <tr>
                        <th>S/N</th>
                        <th>Custoner</th>
                        <th>Amount</th>
                    </tr>
                    <?php
                        $k = 0;
                        $totalCP = 0;
                        $SCP = mysql_query("SELECT sr_customer_payment.*, sr_customer.* FROM sr_customer_payment LEFT JOIN sr_customer ON sr_customer.Customer_SlNo = sr_customer_payment.CPayment_customerID WHERE sr_customer_payment.CPayment_date BETWEEN '$startdate' AND '$enddate'");
                        while ($cprow = mysql_fetch_array($SCP)) {
                            if($cprow['CPayment_amount'] != 0){
                                $k++;
                                $totalCP += $cprow['CPayment_amount'];
                    ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $k; ?></td>
                        <td style="text-align: left;"><?php echo $cprow['Customer_Name']; ?> - <?php echo $cprow['Customer_Code']; ?></td>
                        <td style="text-align: right;"><?php echo number_format($cprow['CPayment_amount'], 2); ?></td>
                    </tr>
                    <?php
                            }
                        }
                    ?>
                    <tr>
                        <td colspan="2" style="text-align: right;"><strong>Total</strong></td>
                        <td style="text-align: right;"><strong><?php echo number_format($totalCP, 2); ?></strong></td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr bgcolor="#ccc">
            <th>Purchase</th> 
            <th>Supplier Payment</th> 
        </tr>
        <tr>
            <td style="width: 50%;vertical-align: top;">

                <table width="100%" class="border">
                    <tr>
                        <th>S/N</th>
                        <th>Supplier</th>
                        <th>Amount</th>
                    </tr>
                    <?php
                        $j = 0;
                        $totalPurchase = 0;
                        $SP = mysql_query("SELECT sr_purchasemaster.*, sr_supplier.* FROM sr_purchasemaster LEFT JOIN sr_supplier ON sr_supplier.Supplier_SlNo = sr_purchasemaster.Supplier_SlNo WHERE sr_purchasemaster.PurchaseMaster_OrderDate BETWEEN '$startdate' AND '$enddate'");
                        while ($prow = mysql_fetch_array($SP)) {
                                $j++;
                                $totalPurchase += $prow['PurchaseMaster_SubTotalAmount'];
                    ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $j; ?></td>
                        <td style="text-align: left;"><?php echo $prow['Supplier_Name']; ?> - <?php echo $prow['Supplier_Code']; ?></td>
                        <td style="text-align: right;"><?php echo number_format($prow['PurchaseMaster_SubTotalAmount'], 2); ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                    <tr>
                        <td colspan="2" style="text-align: right;"><strong>Total</strong></td>
                        <td style="text-align: right;"><strong><?php echo number_format($totalPurchase, 2); ?></strong></td>
                    </tr>
                </table>
            </td>
            <td style="width: 50%;vertical-align: top;">
                <table width="100%" class="border">
                    <tr>
                        <th>S/N</th>
                        <th>Supplier</th>
                        <th>Amount</th>
                    </tr>
                    <?php
                        $l = 0;
                        $totalSP = 0;
                        $SSP = mysql_query("SELECT sr_supplier_payment.*, sr_supplier.* FROM sr_supplier_payment LEFT JOIN sr_supplier ON sr_supplier.Supplier_SlNo = sr_supplier_payment.SPayment_customerID WHERE sr_supplier_payment.SPayment_date BETWEEN '$startdate' AND '$enddate'");
                        while ($sprow = mysql_fetch_array($SSP)) {
                            if($sprow['SPayment_amount'] != 0){
                                $l++;
                                $totalSP += $sprow['SPayment_amount'];
                    ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $l; ?></td>
                        <td style="text-align: left;"><?php echo $sprow['Supplier_Name']; ?> - <?php echo $sprow['Supplier_Code']; ?></td>
                        <td style="text-align: right;"><?php echo number_format($sprow['SPayment_amount'], 2); ?></td>
                    </tr>
                    <?php
                        }}
                    ?>
                    <tr>
                        <td colspan="2" style="text-align: right;"><strong>Total</strong></td>
                        <td style="text-align: right;"><strong><?php echo number_format($totalSP, 2); ?></strong></td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr bgcolor="#ccc">
            <th>Bank Deposit</th> 
            <th>Bank Withdraw</th> 
        </tr>
        <tr>
            <td style="width: 50%;vertical-align: top;">
                <table width="100%" class="border">
                    <tr>
                        <th>S/N</th>
                        <th>Account</th>
                        <th>Amount</th>
                    </tr>
                    <?php 
                        $m = 0;
                        $totalBD = 0;
                        $SBD = mysql_query("SELECT sr_cashtransaction.*, sr_account.* FROM sr_cashtransaction LEFT JOIN   sr_account ON sr_account.Acc_SlNo = sr_cashtransaction.Acc_SlID WHERE sr_cashtransaction.Tr_Type = 'Deposit To Bank' AND sr_cashtransaction.Tr_date BETWEEN '$startdate' AND '$enddate'");
                        while ($bdrow = mysql_fetch_array($SBD)) {
                            $m++;
                            $totalBD += $bdrow['In_Amount'];
                    ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $m; ?></td>
                        <td style="text-align: left;"><?php echo $bdrow['Acc_Name']; ?> - <?php echo $bdrow['Acc_Code']; ?></td>
                        <td style="text-align: right;"><?php echo number_format($bdrow['In_Amount'], 2); ?></td>
                    </tr>
                    <?php        
                        }

                    ?>
                    <tr>
                        <td colspan="2" style="text-align: right;"><strong>Total</strong></td>
                        <td style="text-align: right;"><strong><?php echo number_format($totalBD, 2); ?></strong></td>
                    </tr>
                </table>
            </td>
            <td style="width: 50%;vertical-align: top;">
                <table width="100%" class="border">
                    <tr>
                        <th>S/N</th>
                        <th>Account</th>
                        <th>Amount</th>
                    </tr>
                    <?php 
                        $m = 0;
                        $totalBW = 0;
                        $SBD = mysql_query("SELECT sr_cashtransaction.*, sr_account.* FROM sr_cashtransaction LEFT JOIN   sr_account ON sr_account.Acc_SlNo = sr_cashtransaction.Acc_SlID WHERE sr_cashtransaction.Tr_Type = 'Withdraw Form Bank' AND sr_cashtransaction.Tr_date BETWEEN '$startdate' AND '$enddate'");
                        while ($bdrow = mysql_fetch_array($SBD)) {
                            $m++;
                            $totalBW += $bdrow['Out_Amount'];
                    ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $m; ?></td>
                        <td style="text-align: left;"><?php echo $bdrow['Acc_Name']; ?> - <?php echo $bdrow['Acc_Code']; ?></td>
                        <td style="text-align: right;"><?php echo number_format($bdrow['Out_Amount'], 2); ?></td>
                    </tr>
                    <?php        
                        }

                    ?>
                    <tr>
                        <td colspan="2" style="text-align: right;"><strong>Total</strong></td>
                        <td style="text-align: right;"><strong><?php echo number_format($totalBW, 2); ?></strong></td>
                    </tr>
                </table>
            </td>
        </tr>
        
    </table>
</div>