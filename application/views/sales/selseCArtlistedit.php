<div class="clearfix moderntabs" style="width:330px;width:100%;max-height:100px;min-height:100px;overflow:auto;">
                
               
                        <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="text-align:left;width:100%;border-collapse:collapse;">
                            <tbody>
                            <?php  
                                $grand_total2 = 0;
                                $grand_total = 0;
                                $count = "";
                                $SaleMaster_IDNo = $_POST['masterId'];

                                $query4 = "select sr_saledetails.*,tbl_product.* from sr_saledetails left join tbl_product on tbl_product.Product_SlNo=sr_saledetails.Product_IDNo where SaleMaster_IDNo='".$SaleMaster_IDNo."'";
                                $result4 = mysql_query($query4)or die(mysql_error());
                                while($row4 = mysql_fetch_array($result4)){
                                    $total = $row4['SaleDetails_Rate'] * $row4['SaleDetails_TotalQuantity'];
                                    $grand_total2 = $grand_total2  + $total;
                            ?>
                            <tr>
                                    <td style="width:2%"><?php //echo $i; ?></td>
                                    <td style="width:20%"><?php echo $row4['Product_Name']; ?></td>
                                    <td style="width:10%"><?php echo $row4['SaleDetails_unit']; ?></td>
                                    <td style="width:10%"><?php echo $row4['SaleDetails_Rate']; ?></td>
                                    <td style="width:10%"><?php echo $row4['SaleDetails_TotalQuantity']; ?></td>
                                    <td style="width:10%"><?php echo number_format($total, 2) ?>
                                    <input type="hidden" id="PriCe_<?php echo $row4['SaleDetails_SlNo'];?>" value="<?php echo $total; ?>"></td>
                                    <td style="width:10%">
                      <span style="cursor:pointer" onclick="cartRemove(a='<?php echo $row4['SaleDetails_SlNo'];?>',b='sell',salesId='<?php echo $row4['Product_SlNo'];?>',totalamt='<?php echo $total;?>',masteid='<?php echo $SaleMaster_IDNo;?>')">
                                        <input type="hidden" id="rowid<?php echo $row4['SaleDetails_SlNo']; ?>" value="<?php echo $row4['SaleDetails_SlNo']; ?>">
                                        <img src='<?php echo base_url() ?>images/cart_cross.jpg' width='20px' height='15px'></span>
                                    </td>
                                </tr>

                            <?php
                                }
                            ?>
                            <?php  if ($cart = $this->cart->contents()): ?>
                            <?php
                                //echo form_open('shopping/update_cart');
                               
                                $i = 0;
                                foreach ($cart as $item):
                                    $i++;
                                    $count=$item['qty'];
                                    echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                                    echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                                    echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                                    echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                                    echo form_hidden('cart[' . $item['id'] . '][purchaserate]', $item['purchaserate']);
                                    echo form_hidden('cart[' . $item['id'] . '][packagename]', $item['packagename']);
                                    echo form_hidden('cart[' . $item['id'] . '][checkname]', $item['packagename']);
                                    echo form_hidden('cart[' . $item['id'] . '][packagecode]', $item['packagecode']);
                                    echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                                    echo form_hidden('cart[' . $item['id'] . '][image]', $item['image']); 
                            ?> 
                                <tr>
                                    <td style="width:2%"><?php echo $i; ?></td>
                                    <td style="width:20%"><?php echo $item['name']; ?></td>
                                    <td style="width:10%"><?php echo $item['image']; ?></td>
                                    <td style="width:10%"><?php echo $item['price']; ?></td>
                                    <td style="width:10%"><?php echo $item['qty']; ?><?php if(!empty($item['packagename'])){ ?><input type="hidden" name="sqty[]" id="sqty<?php echo $i;?>" value="<?php echo $item['qty']; ?>">
                                        <input type="hidden" name="sNaMe[]" id="sNaMe<?php echo $i;?>" value="<?php echo $item['name']; ?>">
                                    <?php } ?>
                                    <input type="hidden" name="allqty[]" id="allqty<?php echo $i;?>" value="<?php echo $item['qty']; ?>">
                                    <input type="hidden" name="allname[]" id="allname<?php echo $i;?>" value="<?php echo $item['name']; ?>">
                                    </td>
                                    <td style="width:10%"><?php $grand_total = $grand_total + $item['subtotal']; ?> <?php echo number_format($item['subtotal'], 2) ?>
                                    <input type="hidden" id="PriCe_<?php echo $item['rowid'];?>" value="<?php echo $item['subtotal']; ?>"></td>
                                    <td style="width:10%">
                                        <span style="cursor:pointer" onclick="cartRemove(a='<?php echo $item['rowid'];?>',b='cartv',sealsId='0',totalamt='0',masteid='<?php echo $SaleMaster_IDNo;?>')">
                                        <input type="hidden" id="rowid<?php echo $item['rowid'];?>" value="<?php echo $item['rowid'];?>">
                                        <img src='<?php echo base_url() ?>images/cart_cross.jpg' width='20px' height='15px'></span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <input type="hidden" id="ckqty" value="<?php echo $count; ?>">
                        <?php endif; ?>
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
                                <span style="color:red"><?php if(isset($grand_total)) {echo $grand_total+$grand_total2;}else{echo 0;} ?></span>
                                <span>tk</span>
                            </div>
                        </h2>
                    </fieldset>
                </td>

            </tr>
        </table>