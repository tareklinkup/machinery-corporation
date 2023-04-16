<div class="tabContent">
        <div id="tabs" class="clearfix moderntabs">
            <div id="tabs-1">
                    <div class="middle_form">
                        <h2>Add Product</h2>
                        <div class="body">
                            <div class="full clearfix">
                                <span>Product Id</span>
                                <div class="left">                                    
                                    <input name="Product_id" type="text" id="Product_id" class="required" value="<?php echo $selected['Product_Code'] ?>" />
                                    <input name="iidd" type="hidden" id="iidd" value="<?php echo $selected['Product_SlNo'] ?>" />
                                </div>
                            </div>                                
                           
                            <div class="full clearfix">
                                <span>Category</span>
                                <div class="left">                                      
                                  <div id="Search_Results_category">
                                        <select name="pCategory" id="pCategory" style="width:163px;" required>
                                            <option value="<?php echo $selected['ProductCategory_ID'] ?>"><?php echo $selected['ProductCategory_Name'] ?></option>
                                             <?php $sql = mysql_query("SELECT * FROM sr_productcategory order by ProductCategory_Name asc");
                                            while($row = mysql_fetch_array($sql)){ ?>
                                            <option value="<?php echo $row['ProductCategory_SlNo'] ?>"><?php echo $row['ProductCategory_Name'] ?></option>
                                            <?php } ?>
                                        </select>  
                                    </div>               
                                </div>
                                <div class="rightElement">
                                    <a class="btn-add fancybox fancybox.ajax" href="<?php echo base_url() ?>products/fanceybox_category">
                                        <input type="button" name="country_button" value="+"  class="button" style="padding:7px 10px;font-size:16px;"/>                                
                                    </a> 
                                </div>
                                <div id="pCategory_"></div>
                            </div>
                            <div class="full clearfix">
                                <span>Name</span>
                                <div class="left">                                    
                                    <input name="pro_Name" type="text" id="pro_Name" value="<?php echo $selected['Product_Name'] ?>" class="required" required/>
                                    <span id="pro_Name_"></span>
                                </div>
                            </div>
                                <input id="product_check" type="hidden" value="Product" <?php if($selected['Product_type']=="Product"){echo "checked";} ?> checked name="product_check" />
                           <!--  <div class="full clearfix">
                               <span>Type</span>
                               <div class="left">                                    
                               <input id="product_check" type="radio" value="Product" <?php if($selected['Product_type']=="Product"){echo "checked";} ?> checked name="product_check" />
                               <label for="chkMultiple">Product</label>&nbsp;&nbsp;&nbsp;
                               <input type="radio" id="product_check"name="product_check" value="Service" <?php if($selected['Product_type']=="Service"){echo "checked";} ?> />
                               <label for="chkMultiple">Service</label>           
                               </div>
                           </div> -->
                             <div class="full clearfix">
                                <span>Re-Order Level</span>
                                <div class="left">                                    
                                    <input name="Re_Order" type="text" id="Re_Order" value="0" value="<?php echo $selected['Product_ReOrederLevel'] ?>" class="required" />
                                    <span id="Re_Order_"></span>
                                </div>
                            </div>                                                                                                                                    
                        </div>
                       
                    </div>
                    <div class="right_form">
                        <div class="body">
                            
                           
                            <div class="full clearfix">
                                <span>Purchase Rate</span>
                                <input name="Purchase_rate" type="text" id="Purchase_rate" value="<?php echo $selected['Product_Purchase_Rate'] ?>" class="txt" required/>
                                <span id="Purchase_rate_"></span>
                            </div>
                            <div class="full clearfix">
                                <span>Sell Rate</span>
                                <input name="sell_rate" type="text" id="sell_rate" value="<?php echo $selected['Product_SellingPrice'] ?>" class="txt" required/>
                                <span id="sell_rate_"></span>
                            </div> 
                            <div class="full clearfix">
                                <span>Unit</span>
                                <div class="left">                                      
                                    <div id="Search_Results">
                                        <select name="product_unit" id="product_unit" style="width:200px;" required>
                                            <option value="<?php echo $selected['Unit_ID'] ?>"><?php echo $selected['Unit_Name'] ?></option>
                                            <?php $sql = mysql_query("SELECT * FROM sr_unit order by Unit_Name asc");
                                            while($row = mysql_fetch_array($sql)){ ?>
                                            <option value="<?php echo $row['Unit_SlNo'] ?>"><?php echo $row['Unit_Name'] ?></option>
                                            <?php } ?>
                                        </select>  
                                    </div>               
                                </div>
                                <div class="rightElement">
                                    <a class="btn-add fancybox fancybox.ajax" href="<?php echo base_url() ?>products/fanceybox_unit">
                                        <input type="button" name="country_button" value="+"  class="button" style="padding:7px 10px;font-size:16px;"/>                                
                                    </a> 
                                </div>
                                <div id="product_unit_"></div>
                            </div>
                            <div class="full clearfix">
                                <span></span>
                                <a href="<?php echo base_url(); ?>products" class="button">Cancel</a>
                                <input type="button" onclick="update_pro()" name="btnSubmit" value="Update"  title="Save" class="button" />
                            </div> 
                                                                                                                                                                         
                        </div>
                    </div>
            </div>
        </div>
    </div>

        <div class="clearfix moderntabs" style="width:330px;width:100%;max-height:500px;overflow:auto;">
           
            <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="text-align:left;width:100%;border-collapse:collapse;">
                <thead>
                <tr class="header">
                    <th style="width:10%">ID</th>
                    <th style="width:25%">Category</th>
                    <th style="width:25%">Product Name</th>
                    <th style="width:10%">Purchase Rate</th>
                    <th style="width:10%">Sell Rate</th>
                    <th style="width:10%">Re-Order Level</th>
                    <th style="width:10%">Action</th>
                </tr>
                </thead>

                <tbody>
                <?php
                $products = $this->db->select('*')
                    ->from('tbl_product')
                    ->join('sr_productcategory','sr_productcategory.ProductCategory_SlNo = tbl_product.ProductCategory_ID','left')
                    ->order_by('tbl_product.Product_Code')
                    ->get()->result();
                foreach ($products as $product):
                    ?>
                    <tr>
                        <td style="width:10%"><?= $product->Product_Code?></td>
                        <td style="width:25%"><?= $product->ProductCategory_Name?></td>
                        <td style="width:25%"><?= $product->Product_Name?></td>
                        <td style="width:10%"><?= $product->Product_Purchase_Rate?></td>
                        <td style="width:10%"><?= $product->Product_SellingPrice?></td>
                        <td style="width:10%"><?= $product->Product_ReOrederLevel?></td>
                            <td style="width:10%">
                                <span onclick="Edit_product(<?= $product->Product_SlNo?>)" style="cursor:pointer;color:green;font-size:20px;float:left"><i class="fa fa-pencil"></i></span>
                                <span  onclick="deleted(<?= $product->Product_SlNo?>)" style="cursor:pointer;color:red;font-size:20px;float:left;padding-left:10px" ><i class="fa fa-trash-o"></i></span>
                            </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>    
            </table>
        </div> 