    <div class="tabContent">
        <div id="tabs" class="clearfix moderntabs">
            <div id="tabs-1">
                <div class="middle_form">
                    <h2>General</h2>
                    <div class="body">
                        <div class="full clearfix">
                            <span>Supplier Id</span>
                            <div class="left">                                    
                                <input name="supplier_id" type="text" id="supplier_id" value="<?php echo $selected['Supplier_Code']?>"/>
                                <input name="id" type="hidden" id="id"  value="<?php echo $selected['Supplier_SlNo']?>"/>

                            </div>
                        </div>                                
                        <div class="full clearfix">
                            <span>Name</span>
                            <div class="left">                                      
                                <input name="sl_name" type="text" id="sl_name" class="required" value="<?php echo $selected['Supplier_Name']?>" autofocus="" required/>
                                <span id="sl_name_"></span>
                            </div>
                        </div>
                        <div class="full clearfix">
                            <span>Type</span>
                            <div class="left">                                      
                                <input name="type" type="radio" id="type" class="required" value="Local" <?php if($selected['Supplier_Type']=='Local'){echo 'checked';}?> />Local
                                &nbsp; &nbsp;
                                <input name="type" type="radio" id="type" class="required" value="Foreign" <?php if($selected['Supplier_Type']=='Foreign'){echo 'checked';}?> />Foreign
                            </div>
                        </div>
                        <div class="full clearfix">
                            <span>Address</span>
                            <div class="left">                                      
                                <textarea name="address" rows="2" cols="2" id="address" style="border-color:#C8D3DF;height:40px;width:100%;"><?php echo $selected['Supplier_Address']?></textarea>
                            </div>
                        </div>
                        <div class="full clearfix">
                            <span>District</span>
                            <div class="left">
                            <div id="Search_Resultsss">
                                <select name="district" id="district" style="width:163px;" required>
                                    <option value="<?php echo $selected['District_SlNo']?>"><?php echo $selected['District_Name']?></option>
                                    <?php $sql = mysql_query("SELECT * FROM sr_district order by District_Name asc ");
                                    while($row = mysql_fetch_array($sql)){ ?>
                                    <option value="<?php echo $row['District_SlNo'] ?>"><?php echo $row['District_Name'] ?></option>
                                    <?php } ?>

                                </select>  
                            </div>     
                            <span id="district_"></span>                                   
                            </div>
                            <div class="rightElement">
                                <a class="btn-add fancybox fancybox.ajax" href="<?php echo base_url() ?>supplier/supplier_district">
                                    <input type="button" name="add_cat" value="+"  class="button" style="padding:7px 10px;font-size:16px;"/>                                
                                </a> 
                            </div>
                        </div>
                        <div class="full clearfix">
                            <span>Country</span>
                            <div class="left">
                            <div id="Search_Results">
                                <select name="country" id="country" style="width:163px;" required>
                                    <option value="<?php echo $selected['Country_SlNo']?>"><?php echo $selected['CountryName']?></option>
                                    <?php $sql = mysql_query("SELECT * FROM sr_country order by CountryName asc ");
                                    while($row = mysql_fetch_array($sql)){ ?>
                                    <option value="<?php echo $row['Country_SlNo'] ?>"><?php echo $row['CountryName'] ?></option>
                                    <?php } ?>                                     
                                </select>   
                            </div>   
                            <span id="country_"></span>                                     
                            </div>
                            <div class="rightElement">
                                <a class="btn-add fancybox fancybox.ajax" href="<?php echo base_url() ?>supplier/supplier_country">
                                    <input type="button" name="country_button" value="+"  class="button" style="padding:7px 10px;font-size:16px;"/>                                
                                </a> 
                            </div>
                        </div>                                                                                                                                                  
                    </div>
                </div>
                <div class="right_form">
                    <h2 id="personal-info">Contact Information</h2>
                    <div class="body">
                        <div class="full clearfix">
                            <span>Phone</span>
                            <input name="phone" type="text" id="phone" class="txt" value="<?php echo $selected['Supplier_Phone']?>" />
                        </div>
                        <div class="full clearfix">
                            <span>Mobile</span>
                            <input name="mobile" type="text" id="mobile" class="txt" value="<?php echo $selected['Supplier_Mobile']?>" required/>
                            <span id="mobile_"></span>       
                        </div>                                    
                        <div class="full clearfix">
                            <span>Email</span>
                            <input name="email" type="text" id="email" value="<?php echo $selected['Supplier_Email']?>" class="txt" />
                        </div> 
                        <div class="full clearfix">
                            <span>Office Phone</span>
                            <input name="office_phone" type="text" id="office_phone" value="<?php echo $selected['Supplier_OfficePhone']?>" class="txt" />
                        </div>
                        <div class="full clearfix">
                            <span>Web</span>
                            <input name="web" type="text" id="web" value="<?php echo $selected['Supplier_Web']?>" class="txt" />
                        </div> 
                        <div class="full clearfix">
                           <span></span>
                            <!-- <a href="<?php echo base_url() ?>supplier" class="button" />Cancel</a> -->
                            <input type="button" onClick="window.location='<?php echo base_url() ?>supplier'" value="Cancel" class="button" />
                            <input type="button" onclick="Update_suppliers()" value="Update" class="button" />
                        </div>                                                                                                                                            
                    </div>
                </div>
            </div>
        </div>
    </div>
     <div class="row_section clearfix" style="margin-top:20px;padding-bottom:0px;">
            <table class="zebra" cellspacing="0" cellpadding="0" border="0" style="width:100%;border-collapse:collapse;">
                <thead>
                    <tr class="header">
                        <th style="width:12%">ID</th>
                        <th style="width:25%">Supplier Name</th>
                        <th style="width:25%">Address</th>
                        <th style="width:25%">Contact No</th>
                        <th style="width:13%">Action</th>                                              
                    </tr>
                </thead>
            </table>                    
        </div>                
        <div class="row_section clearfix" style="height:300px;overflow:auto;">
            <table class="zebra" cellspacing="0" cellpadding="0" border="0" style="text-align:left;width:100%;border-collapse:collapse;">
                <tbody>
                <?php $sql = mysql_query("SELECT * FROM sr_supplier order by Supplier_Code asc");
                while($row = mysql_fetch_array($sql)){ ?>
                    <tr>
                        <td style="width:12%"><?php echo $row['Supplier_Code'] ?></td>
                        <td style="width:25%"><?php echo $row['Supplier_Name'] ?></td>
                        <td style="width:25%"><?php echo $row['Supplier_Address'] ?></td>
                        <td style="width:25%"><?php echo $row['Supplier_Mobile'] ?></td>
                        <td style="width:13%">
                            <a onclick="Edit_supplier(<?php echo $row['Supplier_SlNo'] ?>)" style="cursor:pointer;color:green;font-size:20px;float:left" ><i class="fa fa-pencil"></i></a>
                            <span onclick="deleted(<?php echo $row['Supplier_SlNo'] ?>)" style="cursor:pointer;color:red;font-size:20px;float:left;padding-left:10px"><i class="fa fa-trash-o"></i></span>
                        </td>
                    </tr>  
                <?php } ?>                
                </tbody>
            </table>
        </div>     
