 <div class="tabContent">
        <div id="tabs" class="clearfix moderntabs">
            <div id="tabs-1">
                    <div class="middle_form">
                        <h2>Add Product</h2>
                        <div class="body">
                            <div class="full clearfix">
                                <span>Product Id</span>
                                <div class="left">                                    
                                    
                                    <input name="Product_id" type="text" id="Product_id" class="required" value="" />
                                </div>
                            </div>                                
                           
                            <div class="full clearfix">
                                <span>Category</span>
                                <div class="left">                                      
                                  <div id="Search_Results_category">
                                        <select name="pCategory" id="pCategory" style="width:163px;" required>
                                            <option value="">Select</option>
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
                                    <input name="pro_Name" type="text" id="pro_Name" class="required" required/>
                                    <span id="pro_Name_"></span>
                                </div>
                            </div>
                            <div class="full clearfix">
                                <span>Type</span>
                                <div class="left">                                    
                                <input id="product_check" type="radio" value="Product" checked name="product_check" />
                                <label for="chkMultiple">Product</label>&nbsp;&nbsp;&nbsp;
                                <input type="radio" id="product_check"name="product_check" value="Service" />
                                <label for="chkMultiple">Service</label>           
                                </div>
                            </div>
                             <div class="full clearfix">
                                <span>Re-Order Level</span>
                                <div class="left">                                    
                                    <input name="Re_Order" type="text" id="Re_Order" value="0" class="required" />
                                    <span id="Re_Order_"></span>
                                </div>
                            </div>                                                                                                                                    
                        </div>
                       
                    </div>
                    <div class="right_form">
                        <div class="body">
                            
                            <div class="full clearfix">
                                <span>Search Products</span>
                                <input name="Searchproduct" type="text" id="Searchproduct" placeholder="Search Products" required class="txt" />
                            </div>
                            <div class="full clearfix">
                                <span>Purchase Rate</span>
                                <input name="Purchase_rate" type="text" id="Purchase_rate" value="0" class="txt" required/>
                                <span id="Purchase_rate_"></span>
                            </div>
                            <div class="full clearfix">
                                <span>Sell Rate</span>
                                <input name="sell_rate" type="text" id="sell_rate" value="0" class="txt" required/>
                                <span id="sell_rate_"></span>
                            </div> 
                            <div class="full clearfix">
                                <span>Unit</span>
                                <div class="left">                                      
                                    <div id="Search_Results">
                                        <select name="product_unit" id="product_unit" style="width:200px;" required>
                                            <option value="">Select</option>
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
                                <input type="button" onclick="submit()" name="btnSubmit" value="Save"  title="Save" class="button" />
                            </div> 
                                                                                                                                                                         
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="full clearfix" style="float:right;">
        <input type="text" id="Searchkey" placeholder="Search Products" required class="txt" onkeypress="productSearch(event)" style="border: 1px solid #c8d3df;
  border-radius: 2px;
  padding: 7px !important;" />
    </div><br>

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
                <?php $sql = mysql_query("SELECT tbl_product.*, sr_productcategory.* FROM tbl_product left join sr_productcategory on sr_productcategory.ProductCategory_SlNo= tbl_product.ProductCategory_ID where tbl_product.Product_Name like '%$Searchkey%' order by tbl_product.Product_Code asc");
                while($row = mysql_fetch_array($sql)){ ?>
                    <tr>
                        <td style="width:10%"><?php echo $row['Product_Code'] ?></td>
                        <td style="width:25%"><?php echo $row['ProductCategory_Name'] ?></td>
                        <td style="width:25%"><?php echo $row['Product_Name'] ?></td>
                        <td style="width:10%"><?php echo $row['Product_Purchase_Rate'] ?></td>
                        <td style="width:10%"><?php echo $row['Product_SellingPrice'] ?></td>
                        <td style="width:10%"><?php echo $row['Product_ReOrederLevel'] ?></td>
                        <td style="width:10%">
                            <span onclick="Edit_product(<?php echo $row['Product_SlNo'] ?>)" style="cursor:pointer;color:green;font-size:20px;float:left"><i class="fa fa-pencil"></i></span>
                            <span  onclick="deleted(<?php echo $row['Product_SlNo'] ?>)" style="cursor:pointer;color:red;font-size:20px;float:left;padding-left:10px" ><i class="fa fa-trash-o"></i></span>
                        </td>
                    </tr>
                <?php } ?> 
                </tbody>    
            </table> 
        </div> 