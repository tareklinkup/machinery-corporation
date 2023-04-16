    <?php
$invoiceId = $_POST['invoiceId'];
$sql2 = "Select sr_salesmaster.*,sr_customer.* from sr_salesmaster left join sr_customer on sr_customer.Customer_SlNo=sr_salesmaster.SalseCustomer_IDNo where sr_salesmaster.SaleMaster_SlNo = '".$invoiceId."'";
$result2 = mysql_query($sql2);
$row2 = mysql_fetch_array($result2);
$selcustome = $row2['Customer_SlNo'];
$salesInvoiceno = $row2['SaleMaster_InvoiceNo'];


?>

    <div style="width:78%; float:left;" >
        <div style="width:100%;" >
            <table  width="100%">
                <tr>
                    <td>PO No </td>
                    <td>
                        <div class="full clearfix">
                            <input type="text" id="PoNo" class="inputclass" value="<?php echo $row2['Po_No']; ?>" style="width:200px">
                        </div>
                    </td>
                    <td>Delivery Invoice No </td>
                    <td>
                        <div class="full clearfix">
                            <input type="text" class="inputclass" id="DelevaryInvoiceNo" value="<?php echo $row2['Delevary_Invoice_No']; ?>" style="width:200px">
                        </div>
                    </td>
                </tr>
            </table>
            <table width="100%" style="float-left"> 
            
            <tr>
                <td style="border: 1px solid #ddd;"><!-- Customer area -->
                <input type="hidden" id="saleMasterId" value="<?php echo $invoiceId; ?>">
                <input type="hidden" id="salesInvoiceno" value="<?php echo $salesInvoiceno; ?>">
               
                    <table > 
                        <tr>
                            <td style="width:100px">Customer </td>
                           
                            <td>
                                <div class="side-by-side clearfix">
                                    <div>
                                          <select id="customerID" data-placeholder="Choose a Customer..." class="chosen-select" style="width:200px;" tabindex="2" onchange="Customer()">
                        <option value=""></option>
                        <?php $sql = mysql_query("SELECT * FROM sr_customer order by Customer_Code asc");
                        while($row = mysql_fetch_array($sql)){
                            ?>
                        <option value="<?php echo $row['Customer_SlNo'] ?>" <?php if($selcustome ==  $row['Customer_SlNo']){ echo "selected";}?>> <?php echo $row['Customer_Name']; ?>(<?php echo $row['Customer_Code']; ?>) </option>
                        <?php } ?>
                  </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </table>
                        
                            <table>
                                <tr>
                                    <td style="width:100px">Name</td>
                                    <td style="width:200px">
                                        <div class="full clearfix">
                                            <input type="text" class="inputclass" disabled="" value="<?php echo $row2['Customer_Name']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td style="width:200px">
                                        <div class="full clearfix">
                                            <textarea name="" id="" rows="2" disabled="" class="inputclass"><?php echo $row2['Customer_Address']; ?></textarea>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Contact No</td>
                                    <td style="width:200px">
                                        <div class="full clearfix">
                                            <input type="text" disabled="" class="inputclass" value="<?php echo $row2['Customer_Mobile']; ?>">
                                        </div>
                                    </td>
                                </tr>
                                
                            </table>
                       
                </td>
                <td style="border: 1px solid #ddd;"><!-- Product area -->
                    <table > 
                        <tr>
                            <td style="width:100px">Product </td>
                            <td style="width:200px">
                                <div class="side-by-side clearfix">
                                    <div>
                                          <select id="ProID" data-placeholder="Choose a Product..." class="chosen-select" style="width:200px;" tabindex="2" onchange="Products()">
                                                <option value=""></option>
                                                <?php $sql = mysql_query("SELECT tbl_product.*, sr_productcategory.* FROM tbl_product left join sr_productcategory on sr_productcategory.ProductCategory_SlNo= tbl_product.ProductCategory_ID order by tbl_product.Product_Code asc");
                                                while($row = mysql_fetch_array($sql)){ ?>
                                                <option value="<?php echo $row['Product_SlNo'] ?>"><?php echo $row['Product_Code'] ?> - <?php echo $row['Product_Name'] ?></option>
                                                <?php } ?>
                                          </select>
                                    </div>
                                </div>
                                
                            </td>
                        </tr>
                    </table>
                    <span id="ProductsResult">
                    <table>
                        <tr>
                            <td  style="width:100px">Name</td>
                            <td style="width:200px">
                                <div class="full clearfix">
                                    <input type="text" id="proName" class="inputclass">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td style="width:200px">
                                <div class="full clearfix">
                                    <input type="text" id="proQTY" onkeyup="keyUPAmount()" class="inputclass">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Rate</td>
                            <td style="width:200px">
                                <div class="full clearfix">
                                    <input type="text" id="ProRATe" onkeyup="keyupamount2()" class="inputclass">
                                    <input type="hidden" id="ProPurchaseRATe" >
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Amount</td>
                            <td style="width:200px">
                                <div class="full clearfix">
                                    <input type="text" id="ProductAmont" class="inputclass" readonly="">
                                </div>
                            </td>
                        </tr>
                    </table>

                    </span>
                </td>
                <td> <!-- Stock  area -->
                    <table>
                        <tr>
                            <td>
                                <span style="color:red">Stock Available</span>
                            </td>
                        </tr>
                        <tr style="height:150px" >
                            <td align="center">
                                <input type="text" id="stockpro" readonly style="border:none;font-size:20px;width:79px;text-align:center;color:green"><br>
                                <input type="text" id="Prounit" readonly style="border:none;font-size:12px;width:80px">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="button" class="buttonAshiqe" value="Add Cart" onclick="ADDTOCART()">
                            </td>
                        </tr>
                    </table>
                </td>
                </tr>
        </table>
            <div class="row_section clearfix" style="margin-top:20px;padding-bottom:0px;">      
                <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="width:100%;border-collapse:collapse;">
                    <thead>
                        <tr class="header">
                            <th style="width:2%"></th>
                            <th style="width:20%">Product Information</th>
                            <th style="width:10%">Unit</th>
                            <th style="width:10%">Rate</th>
                            <th style="width:10%">Qty</th>
                            <th style="width:10%">Total</th>
                            <th style="width:10%"></th>                                                      
                        </tr>
                    </thead>
                </table>                    
            </div> 



            <span id="Salescartlist">
            <div class="clearfix moderntabs" style="width:330px;width:100%;max-height:100px;min-height:100px;overflow:auto;">
                
               <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="text-align:left;width:100%;border-collapse:collapse;">
                    <tbody>
                    <?php  
                        $grand_total = 0;
                        $count = "";
                        $invoiceId = $_POST['invoiceId'];
                        $query = mysql_query("select * from sr_salesmaster where SaleMaster_SlNo = '".$invoiceId."'");
                        $row = mysql_fetch_array($query);                        

                        //$SaleMaster_IDNo = $row['SaleMaster_SlNo'];
                        $query4 = "select sr_saledetails.*,tbl_product.* from sr_saledetails left join tbl_product on tbl_product.Product_SlNo=sr_saledetails.Product_IDNo where SaleMaster_IDNo='".$invoiceId."'";
                        $result4 = mysql_query($query4)or die(mysql_error());
                        while($row4 = mysql_fetch_array($result4)){
                            $total = $row4['SaleDetails_Rate'] * $row4['SaleDetails_TotalQuantity'];
                            $grand_total = $grand_total + $total;
                    ?>
                    <tr>
                            <td style="width:2%">
                            <input type="hidden" id="masterId" value="<?php echo $invoiceId; ?>">
                                <input type="hidden" id="" value="">
                            </td>
                            <td style="width:20%"><?php echo $row4['Product_Name']; ?></td>
                            <td style="width:10%"><?php echo $row4['SaleDetails_unit']; ?></td>
                            <td style="width:10%"><?php echo $row4['SaleDetails_Rate']; ?></td>
                            <td style="width:10%"><?php echo $row4['SaleDetails_TotalQuantity']; ?></td>
                            <td style="width:10%"><?php echo number_format($total, 2) ?>
                            <input type="hidden" id="PriCe_<?php //echo $item['rowid'];?>" value="<?php //echo $item['subtotal']; ?>"></td>
                            <td style="width:10%">
                                <span style="cursor:pointer" onclick="cartRemove(a='<?php echo $row4['SaleDetails_SlNo'];?>',b='sell',salesId='<?php echo $row4['SaleDetails_SlNo'];?>',totalamt='<?php echo $total;?>')">
                                <input type="hidden" id="srowid<?php echo $row4['SaleDetails_SlNo']; ?>" value="<?php echo $row4['SaleDetails_SlNo']; ?>">
                                <img src='<?php echo base_url() ?>images/cart_cross.jpg' width='20px' height='15px'></span>
                            </td>
                        </tr>

                    <?php
                        }
                    ?>
                    <span id="newcartitem">
                    <?php
                        if ($cart = $this->cart->contents()):
                        //echo form_open('shopping/update_cart');purchaserate
                        
                        $i = 0;
                        foreach ($cart as $item):
                            $i++;
                            $count = $item['qty'];
                            echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                            echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                            echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                            echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                            echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                            echo form_hidden('cart[' . $item['id'] . '][image]', $item['image']); 
                    ?> 
                        <tr>
                            <td style="width:2%"><?php echo $i; ?></td>
                            <td style="width:20%"><?php echo $item['name']; ?></td>
                            <td style="width:10%"><?php echo $item['image']; ?></td>
                            <td style="width:10%"><?php echo $item['price']; ?></td>
                            <td style="width:10%"><?php echo $item['qty']; ?></td>
                            <td style="width:10%"><?php $grand_total = $grand_total + $item['subtotal']; ?> <?php echo number_format($item['subtotal'], 2) ?>
                            <input type="hidden" id="PriCe_<?php echo $item['rowid'];?>" value="<?php echo $item['subtotal']; ?>"></td>
                            <td style="width:10%">
                                <span style="cursor:pointer" onclick="cartRemove(a='<?php echo $item['rowid'];?>',b='cartv',salesId='0',totalamt='0')">
                                <input type="hidden" id="rowid<?php echo $item['rowid'];?>" value="<?php echo $item['rowid'];?>">
                                <img src='<?php echo base_url() ?>images/cart_cross.jpg' width='20px' height='15px'></span>
                            </td>
                        </tr>


                        <?php endforeach; ?>
                        <input type="hidden" id="ckqty" value="<?php echo $count; ?>">
                        <?php endif; ?>
                    </span>
                    </tbody>    
                </table> 
            </div>
        <table width="100%">
            <tr>
                <td width="40%" >
                    <fieldset style="height:65px">
                        <legend>Notes</legend>
                        <textarea name="SelesNotes" id="SelesNotes" rows="2" style="width:100%"></textarea>
                    </fieldset>
                </td>
                <td width="60%">
                    <fieldset style="height:65px">
                        <legend>Total</legend>
                        <h2>
                            <span>Total</span>
                            <div style="float:right">
                                <span style="color:red"><?php if(isset($grand_total)) {echo $grand_total;}else{echo 0;} ?></span>
                                <span>tk</span>
                            </div>
                        </h2>
                    </fieldset>
                </td>

            </tr>
        </table>
        </span>   
    </div>
    </div>

    <div style="width:20%; float:left">
        <fieldset>
            <legend>Amount Details</legend>
            <table width="100%"> 
                <tr>
                    <td>Sub Total<br>
                    <div class="full clearfix">
                        <input type="text" id="subTotalDisabled" disabled="" class="inputclass" value="<?php echo $row2['SaleMaster_SubTotalAmount'];?>">
                        <input type="hidden" id="subTotal"  class="inputclass" value="<?php echo $row2['SaleMaster_SubTotalAmount'];?>">
                    </div></td>
                </tr> 
                <?php
                    $subtot = $row2['SaleMaster_SubTotalAmount'];
                    $vatper = $row2['SaleMaster_TaxAmount'];
                    $sellvatamount = (($subtot*$vatper)/100)
                ?>
                <tr>
                    <td>Vat<br>
                    <div class="full clearfix">
                        <input type="text" id="vatPersent" onkeyup="vatonkeyup()" class="inputclass" style="width:50px" value="<?php echo $row2['SaleMaster_TaxAmount'];?>"> % 
                        <input type="text" id="SellVat" readonly="" class="inputclass" style="width:86px" value="<?php echo $sellvatamount;?>">
                    </div></td>
                </tr>               
                <tr>
                    <td>Transport<br>
                    <div class="full clearfix">
                        <input type="hidden" id="vatPersent" onkeyup="vatonkeyup()" class="inputclass" style="width:50px" value="<?php echo $row2['SaleMaster_Freight'];?>"> 
                        <input type="hidden" id="SellVat" readonly="" class="inputclass" style="width:86px" value="<?php echo $row2['SaleMaster_Freight'];?>">
                        <input type="text" class="inputclass" id="SellsFreight" onkeyup="Freightonkeyup()" value="<?php echo $row2['SaleMaster_Freight'];?>">
                    </div></td>
                </tr>
                <tr>
                    <td>Discount<br>
                    <div class="full clearfix">
                        <input type="text" class="inputclass" id="SellsDiscount" onkeyup="Discountonkeyup()" value="<?php echo $row2['SaleMaster_TotalDiscountAmount'];?>">
                    </div></td>
                </tr>
                <tr>
                    <td>Total<br>
                    <div class="full clearfix">
                        <input type="text" id="SellTotaldisabled" value="<?php echo $row2['SaleMaster_TotalSaleAmount'];?>" disabled="" class="inputclass">
                        <input type="hidden" id="SellTotals" value="<?php echo $row2['SaleMaster_TotalSaleAmount'];?>" class="inputclass">
                    </div></td>
                </tr>
                <tr>
                    <td>Paid<br>
                     <div class="full clearfix">
                        <input type="text" id="SellsPaid" class="inputclass" value="<?php echo $row2['SaleMaster_PaidAmount'];?>" onkeyup="PaidAmount()" onkeypress="CraditLimit()">
                    </div></td>
                </tr>
                <tr>
                    <td>Paid By<br>
                         <div class="full clearfix inputclass">
                            <select id="paidby" style="width:185px">
                                <?php
                                    if($row2['SaleMaster_paidby'] == 'Check'){
                                ?>
                                <option value="Cash">Cash</option>
                                <option value="Check" selected>Check</option>
                                <?php
                                    }else{
                                ?>
                                <option value="Cash" selected>Cash</option>
                                <option value="Check">Check</option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Due<br>
                    <div class="full clearfix">
                        <input type="text" class="inputclass" value="<?php echo $row2['SaleMaster_DueAmount'];?>" disabled="" id="SellsDue2">
                        <input type="hidden" id="SellsDue" class="inputclass" value="<?php echo $row2['SaleMaster_DueAmount'];?>">
                    </div>
                    <div id="ShowCraditLimitAndDue"></div>
                    </td>
                </tr>
                <tr>
                    <td><input type="button" class="buttonAshiqe" onclick="SalseToCartEdit()" value="Update" style="width:50px">
                    <input type="button" class="buttonAshiqe" onclick="window.location = '<?php echo base_url(); ?>sales'" value="New Sell"></td>
                </tr>

            </table>
        </fieldset>
    </div>
    
