<?php
$userType = $this->session->userdata('accountType');
?>
<div class="tabContent">
        <div id="tabs" class="clearfix moderntabs">
            <div id="tabs-1">
                <div class="middle_form">
                    <h2>General</h2>
                    <div class="body">
                        <div class="full clearfix">
                            <span>Supplier Id</span>
                            <div class="left">                                    
                                   
                                <input name="supplier_id" type="text" id="supplier_id" class="required" value="" autofocus="" />

                            </div>
                        </div>                                
                        <div class="full clearfix">
                            <span>Name</span>
                            <div class="left">                                      
                                <input name="sl_name" type="text" id="sl_name" class="required" placeholder="" autofocus="" required/>
                                <span id="sl_name_"></span>
                            </div>
                        </div>
                        <div class="full clearfix">
                            <span>Type</span>
                            <div class="left">                                      
                                <input name="type" type="radio" id="type" class="required" value="Local" checked="checked" />Local
                                &nbsp; &nbsp;
                                <input name="type" type="radio" id="type" class="required" value="Foreign" />Foreign
                            </div>
                        </div>
                        <div class="full clearfix">
                            <span>Address</span>
                            <div class="left">                                      
                                <textarea name="address" rows="2" cols="2" id="address" style="border-color:#C8D3DF;height:40px;width:100%;"></textarea>
                            </div>
                        </div>
                        <div class="full clearfix">
                            <span>District</span>
                            <div class="left">
                            <div id="Search_Resultsss">
                                <select name="district" id="district" style="width:163px;" required>
                                    <option value=""></option>
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
                                    <option value=""></option>
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
                            <input name="phone" type="text" id="phone" class="txt" />
                        </div>
                        <div class="full clearfix">
                            <span>Mobile</span>
                            <input name="mobile" type="text" id="mobile" class="txt" required/>
                            <span id="mobile_"></span>       
                        </div>                                    
                        <div class="full clearfix">
                            <span>Email</span>
                            <input name="email" type="text" id="email" class="txt" />
                        </div> 
                        <div class="full clearfix">
                            <span>Office Phone</span>
                            <input name="office_phone" type="text" id="office_phone" class="txt" />
                        </div>
                        <div class="full clearfix">
                            <span>Web</span>
                            <input name="web" type="text" id="web" class="txt" />
                        </div> 
                        <div class="full clearfix">
                            <span></span>
                            <input type="button" onclick="submit()" value="Save" class="button" />
                        </div>                                                                                                                                            
                    </div>
                </div>
            </div>
        </div>
    </div>
                   
    <div class="row_section clearfix" style="height:300px;overflow:auto;">
        <table class="zebra" cellspacing="0" cellpadding="0" border="0" style="text-align:left;width:100%;border-collapse:collapse;">
            <thead>
                <tr class="header">
                    <th style="width:12%">ID</th>
                    <th style="width:25%">Supplier Name</th>
                    <th style="width:25%">Address</th>
                    <th style="width:25%">Contact No</th>
                    <?php
                    if($userType == 'Admin'){
                    ?>
                    <th style="width:13%">Action</th>
                    <?php
                    }
                    ?> 
                </tr>
            </thead>
            <tbody>
            <?php $sql = mysql_query("SELECT * FROM sr_supplier order by Supplier_Code asc");
            while($row = mysql_fetch_array($sql)){ ?>
                <tr>
                    <td style="width:12%"><?php echo $row['Supplier_Code'] ?></td>
                    <td style="width:25%"><?php echo $row['Supplier_Name'] ?></td>
                    <td style="width:25%"><?php echo $row['Supplier_Address'] ?></td>
                    <td style="width:25%"><?php echo $row['Supplier_Mobile'] ?></td>
                    <?php
                    if($userType == 'Admin'){
                    ?>
                    <td style="width:13%">
                        <a onclick="Edit_supplier(<?php echo $row['Supplier_SlNo'] ?>)" style="cursor:pointer;color:green;font-size:20px;float:left" ><i class="fa fa-pencil"></i></a>
                        <span onclick="deleted(<?php echo $row['Supplier_SlNo'] ?>)" style="cursor:pointer;color:red;font-size:20px;float:left;padding-left:10px"><i class="fa fa-trash-o"></i></span>
                    </td>
                    <?php
                    }
                    ?>
                </tr>  
            <?php } ?>                
            </tbody>
        </table>
    </div>   