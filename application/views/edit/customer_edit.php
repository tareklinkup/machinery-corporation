<div class="content_scroll">
    <div id="page_menu" class="page_menu">
        <ul>
            <li class="active"><a href="add_supplier.php">Edit Customer</a></li>
            <li><a href="supplier.php">Customer List</a></li>
        </ul>
    </div>
    <div class="tabContent">
        <div id="tabs" class="clearfix moderntabs">
            <div id="tabs-1">
                <div class="middle_form">
                    <h2>General</h2>
                    <div class="body">
                        <div class="full clearfix">
                            <span>Customer Id</span>
                            <div class="left">                                    
                                <input name="lier_id" type="text" id="ier_id" class="required" disabled="" value="<?php echo $selected['Customer_Code'] ?>" />
                                <input name="Customer_id" type="hidden" id="Customer_id" value="<?php echo $selected['Customer_Code'] ?>" />
                                <input name="id" type="hidden" id="id" value="<?php echo $selected['Customer_SlNo'] ?>" />
                            </div>
                        </div>                                
                        <div class="full clearfix">
                            <span>Name</span>
                            <div class="left">                                      
                                <input name="cus_name" type="text" id="cus_name" class="required" value="<?php echo $selected['Customer_Name'] ?>" autofocus="" />
                                <span id="cus_name_"></span>  
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
                                <textarea name="address" rows="2" cols="2" id="address" style="border-color:#C8D3DF;height:70px;width:100%;"><?php echo $selected['Customer_Address'] ?></textarea>
                                <span id="address_"></span> 
                            </div>
                        </div>
                        <div class="full clearfix">
                            <span>Country</span>
                            <div class="left">
                                <div id="Search_Results">
                                <select name="country" id="country" style="width:163px;" required>
                                    <option value="<?php echo $selected['Country_SlNo'] ?>"><?php echo $selected['CountryName'] ?></option>
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
                            <input name="phone" type="text" id="phone" value="<?php echo $selected['Customer_Phone'] ?>" class="txt" />
                        </div>
                        <div class="full clearfix">
                            <span>Mobile</span>
                            <input name="mobile" type="text" id="mobile" value="<?php echo $selected['Customer_Mobile'] ?>" class="txt" />
                             <span id="mobile_"></span>  
                        </div>                                    
                        <div class="full clearfix">
                            <span>Email</span>
                            <input name="email" type="email" id="email" value="<?php echo $selected['Customer_Email'] ?>" class="txt" />
                        </div> 
                        <div class="full clearfix">
                            <span>Office Phone</span>
                            <input name="office_phone" type="text" id="office_phone" value="<?php echo $selected['Customer_OfficePhone'] ?>" class="txt" />
                        </div>
                        <div class="full clearfix">
                            <span>Web</span>
                            <input name="web" type="text" id="web" value="<?php echo $selected['Customer_Web'] ?>" class="txt" />
                        </div> 
                        <div class="full clearfix">
                            <span>Credit Limit</span>
                            <input name="credit" type="text" id="credit" value="<?php echo $selected['Customer_Credit_Limit'] ?>" class="txt" value="0" />
                        </div> 
                        <div class="full clearfix">
                            <span></span>
                            <a href="<?php echo base_url() ?>customer" class="button">Cancel</a>
                            <input type="button" onclick="update()" value="Update" class="button" />
                        </div>                                                                                                                                                                                
                    </div>
                </div>
            </div>
        </div>
    </div>
            
</div>
<script type="text/javascript">
    function update(){
        var Customer_id= $("#Customer_id").val();
        var id= $("#id").val();

        var cus_name= $("#cus_name").val();
        if(cus_name==""){
            $("#cus_name_").html("Required Filed").css("color","red");
            return false;
        }
        var type= $("#type").val();
        var address= $("#address").val();
        if(address==""){
            $("#address_").html("Required Filed").css("color","red");
            return false;
        }
        var country= $("#country").val();
         if(country==""){
            $("#country_").html("Required Filed").css("color","red");
            return false;
        }
        var phone= $("#phone").val();
        var mobile= $("#mobile").val();
         if(mobile==""){
            $("#mobile_").html("Required Filed").css("color","red");
            return false;
        }
        var email= $("#email").val();
        var office_phone= $("#office_phone").val();
        var web= $("#web").val();
        var credit= $("#credit").val();
       
        var inputdata = 'id='+id+'&Customer_id='+Customer_id+'&cus_name='+cus_name+'&type='+type+'&address='+address+'&country='+country+'&phone='+phone+'&mobile='+mobile+'&email='+email+'&office_phone='+office_phone+'&web='+web+'&credit='+credit;
        
        var urldata = "<?php echo base_url() ?>customer/customerupdate";
        //alert(inputdata);
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                //$("#saveResult").html(data);
                alert("Update Success");
            }
        });
    }
</script>

