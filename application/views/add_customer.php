<?php
$userType = $this->session->userdata('accountType');
?>
<div id="saveResult">
<div class="content_scroll">
    <div id="page_menu" class="page_menu">
        <ul>
            <li class="active"><a href="">Add Customer</a></li>
           
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
                                <input name="lier_id" type="text" id="ier_id" class="required" disabled="" value="<?php   $serial ="C1000"; $sql = mysql_query("SELECT * FROM sr_customer");
                                    while ($d = mysql_fetch_array($sql)){
                                        if($d['Customer_Code']!=null){$serial = $d['Customer_Code'];}
                                    } $serial = explode("C",$serial);
                                        $serial=$serial['1']; $autoserial= $serial+1;echo "C".$autoserial;?>" />
                                <input name="Customer_id" type="hidden" id="Customer_id" value="<?php   $serial ="C1000"; $sql = mysql_query("SELECT * FROM sr_customer");
                                    while ($d = mysql_fetch_array($sql)){
                                        if($d['Customer_Code']!=null){$serial = $d['Customer_Code'];}
                                    } $serial = explode("C",$serial);
                                        $serial=$serial['1']; $autoserial= $serial+1;echo "C".$autoserial;?>" />
                            </div>
                        </div>                                
                        <div class="full clearfix">
                            <span>Name</span>
                            <div class="left">                                      
                                <input name="cus_name" type="text" id="cus_name" class="required" autofocus="" />
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
                                <textarea name="address" rows="2" cols="2" id="address" style="border-color:#C8D3DF;height:70px;width:100%;"></textarea>
                                <span id="address_"></span> 
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
                            <input name="mobile" type="text" id="mobile" class="txt" />
                             <span id="mobile_"></span>  
                        </div>                                    
                        <div class="full clearfix">
                            <span>Email</span>
                            <input name="email" type="email" id="email" class="txt" />
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
                            <span>Credit Limit</span>
                            <input name="credit" type="text" id="credit" class="txt" value="0" />
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
            <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="text-align:left;width:80%;border-collapse:collapse;">
                <thead>
                    <tr class="header">
                        <th style="width:12%">ID</th>
                        <th style="width:25%">Customer Name</th>
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
                <?php $sql = mysql_query("SELECT * FROM sr_customer order by Customer_Code asc");
                while($row = mysql_fetch_array($sql)){ ?>
                    <tr>
                        <td style="width:12%"><?php echo $row['Customer_Code'] ?></td>
                        <td style="width:25%"><?php echo $row['Customer_Name'] ?></td>
                        <td style="width:25%"><?php echo $row['Customer_Address'] ?></td>
                        <td style="width:25%"><?php echo $row['Customer_Mobile'] ?></td>
                        <?php
                        if($userType == 'Admin'){
                        ?>
                        <td style="width:13%">
                        <a onclick="customer_edit(<?php echo $row['Customer_SlNo'] ?>)" style="cursor:pointer;color:green;font-size:20px;float:left"><i class="fa fa-pencil"></i></a>
                        <span onclick="deleted(<?php echo $row['Customer_SlNo'] ?>)" style="cursor:pointer;color:red;font-size:20px;float:left;padding-left:10px"><i class="fa fa-trash-o"></i></span>
                        </td>
                        <?php
                        }
                        ?>
                    </tr>  
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>              
</div>
<script type="text/javascript">
    function submit(){
        var Customer_id= $("#Customer_id").val();

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
       
        var inputdata = 'Customer_id='+Customer_id+'&cus_name='+cus_name+'&type='+type+'&address='+address+'&country='+country+'&phone='+phone+'&mobile='+mobile+'&email='+email+'&office_phone='+office_phone+'&web='+web+'&credit='+credit;
        
        var urldata = "<?php echo base_url() ?>customer/insert_customer";
        //alert(inputdata);
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#saveResult").html(data);
                alert("Save Success");
            }
        });
    }
</script>
<script type="text/javascript">
    function customer_edit(id){
        var edit= id;
        var inputdata = 'edit='+edit;
        var urldata = "<?php echo base_url();?>customer/customeredit";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#saveResult").html(data);
            }
        });
    }
</script>
<script type="text/javascript">
    function deleted(id){
        var deletedd= id;
        var inputdata = 'deleted='+deletedd;
        //alert(inputdata);
        var urldata = "<?php echo base_url();?>customer/customerdelete";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#saveResult").html(data);
                alert("Delete Success");
            }
        });
    }
</script>