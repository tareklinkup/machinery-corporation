<div class="clearfix moderntabs" style="width:330px;width:100%;max-height:100px;min-height:100px;overflow:auto;">
                
               <?php  if ($cart = $this->cart->contents()): ?>
                        <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="text-align:left;width:100%;border-collapse:collapse;">
                            <tbody>
                            <?php
                                //echo form_open('shopping/update_cart');purchaserate
                                $grand_total = 0;
                                $count = "";
                                $i = 0;
                                foreach ($cart as $item):
                                    $i++;
                                    $count = $item['qty'];
                                    echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                                    echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                                    echo form_hidden('cart[' . $item['id'] . '][procode]', $item['procode']);
                                    echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                                    echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                                    echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                                    echo form_hidden('cart[' . $item['id'] . '][image]', $item['image']); 
                            ?> 
                                <tr>
                                    <td style="width:5%;text-align: center;"><?php echo $i; ?></td>
                                    <td style="width:10%"><?php echo $item['procode']; ?></td>
                                    <td style="width:20%"><?php echo $item['name']; ?></td>
                                    <td style="width:10%;text-align: center;"><?php echo $item['qty']; ?></td>
                                    <td style="width:10%"><?php echo $item['image']; ?></td>
                                    <td style="width:10%">
                                        <span style="cursor:pointer" onclick="cartRemove(a='<?php echo $item['rowid'];?>')">
                                        <input type="hidden" id="rowid<?php echo $item['rowid'];?>" value="<?php echo $item['rowid'];?>">
                                        <img src='<?php echo base_url() ?>images/cart_cross.jpg' width='20px' height='15px'></span>
                                    </td>
                                </tr>


                                <?php endforeach; ?>
                            </tbody>    
                        </table> 
                        <input type="hidden" id="ckqty" value="<?php echo $count; ?>">
                        <?php endif; ?>
                    
            </div>
<!--             <table width="100%">
                <tr>
                    <td width="80%" >
                        <fieldset style="height:65px">
                            <legend>Notes</legend>
                            <textarea name="SelesNotes" id="SelesNotes" rows="2" style="width:100%"></textarea>
                        </fieldset>
                    </td>
                    <td width="20%">
                        <fieldset style="height:65px;text-align: center;">
                            <input type="button" class="buttonAshiqe" onclick="TransferToCart()" value="Transfer" style="margin-top: 20px" id="sellbtn">
                        </fieldset>
                    </td>

                </tr>
            </table> -->