<?php
$userType = $this->session->userdata('accountType');
?>
<div class="content_scroll">
    <div id="saveResult">
        <div class="tabContent">
            <div id="tabs" class="clearfix moderntabs">
            
                <div id="tabs-1">
                    <div class="middle_form">
                        <div class="body">
                            <div class="full clearfix">
                                <span>Transaction ID</span>
                                <div class="left">                                    
                                    <input name="supplier_id" type="text" id="lier_id" class="required" disabled="" value="<?php $serial ="T1000"; $sql = mysql_query("SELECT * FROM sr_cashtransaction");
                                        while ($d = mysql_fetch_array($sql)){
                                            if($d['Tr_Id']!=null){$serial = $d['Tr_Id'];}
                                        } $serial = explode("T",$serial);
                                        $serial=$serial['1']; $autoserial= $serial+1;echo "T".$autoserial;?>" autofocus="" />
                                    <input name="Transaction_id" type="hidden" id="Transaction_id" class="required" value="<?php $serial ="T1000"; $sql = mysql_query("SELECT * FROM sr_cashtransaction");
                                        while ($d = mysql_fetch_array($sql)){
                                            if($d['Tr_Id']!=null){$serial = $d['Tr_Id'];}
                                        } $serial = explode("T",$serial);
                                        $serial=$serial['1']; $autoserial= $serial+1;echo "T".$autoserial;?>" autofocus="" />
                                </div>
                            </div>                                
                            <div class="full clearfix">
                                <span>Tr Type</span>
                                <div class="left">                                      
                                    <select name="tr_type" id="tr_type" class="required" style="width:175px" onchange="AutoSelect()">
                                        <option value=""></option>
                                        <option value="Cash Receive">Cash Receive</option>
                                        <option value="Cash Payment">Cash Payment</option>
                                        <option value="Deposit To Bank">Deposit To Bank</option>
                                        <option value="Withdraw Form Bank">Withdraw Form Bank</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="full clearfix">
                                <span>Account Type</span>
                                <div class="left" id="OfficialSelect">
                                    <select name="acc_type" id="acc_type" class="required" onchange="OnselectAccountType_()" style="width:175px">
                                        <!-- <option value=""></option> -->
                                        <!-- <option value="Customer">Customer</option> -->
                                        <option value="Official">Official</option>
                                        <!-- <option value="Supplier">Supplier</option> -->
                                    </select>
                                </div>
                            </div>
                            <script type="text/javascript">
                                function AutoSelect(){
                                    var tr_type = $("#tr_type").val();
                                    var sent = "AutoSelect";
                                    var inputdata = 'sent='+sent+'&tr_type='+tr_type;
                                    var urldata = "<?php echo base_url() ?>account/AutoSelect/";
                                    //alert(inputdata);
                                    $.ajax({
                                        type: "POST",
                                        url: urldata,
                                        data: inputdata,
                                        success:function(data){
                                            $("#OfficialSelect").html(data);
                                            //alert("Update Success");
                                        }
                                    });
                                }
                            </script>
                            <div class="full clearfix">
                                <span>Account Name</span>
                                <div class="left">
                                    <div id="SelectResult">
                                        <select name="account_id" id="account_id" style="width:163px;" required>
                                            <option value=""></option>
                                                <?php $sql = mysql_query("SELECT * FROM sr_account order by Acc_Code asc ");
                                                while($row = mysql_fetch_array($sql)){ ?>
                                                <option value="<?php echo $row['Acc_SlNo'] ?>"><?php echo $row['Acc_Name'] ?></option>
                                                <?php } ?>                                     
                                        </select>   
                                    </div> 
                                    
                                </div>
                                <div class="rightElement">
                                    <a class="btn-add fancybox fancybox.ajax" href="<?php echo base_url() ?>account/fancybox_add_account">
                                        <input type="button" name="country_button" value="+"  class="button" style="padding:7px 10px;font-size:16px;"/>                                
                                    </a> 
                                </div>
                            </div>
                            <!-- <div class="full clearfix">
                                   <span>Account Name</span>
                                   <div class="left" id="SelectResultName">                                      
                                       <input name="" type="text" id="" class="required" disabled="" value="" />
                                       <input name="accountName" type="hidden" id="accountName" class="required" value="" />
                                   </div>
                               </div> -->                   
                           
                            </div>                                                                                                                                                  
                </div>
                </div>
                <div class="right_form">
                    <div class="body">
                       <div class="full clearfix" id="ashiqeCalender">
                            <span>Date</span>
                            <input name="DaTe" id="DaTe" type="text" value="<?php echo date("Y-m-d") ?>" class="required" />
                        </div>     
                        <div class="full clearfix">
                            <span style="float: right"><button id="search_datewise_transection" type="button" class="button">Search</button></span>
                            
                        </div>
                        <div class="full clearfix">
                            <span>Description</span>
                            <input name="Description" type="text" id="Description" class="txt" required/>
                        </div> 
                        <div class="full clearfix">
                            <span>Amount</span>
                            <input name="Amount" type="text" id="Amount" class="txt" value="0" required/>
                        </div>                                    
                       
                        <div class="full clearfix">
                            <span></span>
                            <!-- <input type="reset"  value="Reset" class="button" /> -->
                            <input type="button" onclick="Transactionsubmit()" value="Save" class="button" />
                        </div>                                                                                                                                            
                    </div>
                </div>
            </div>
    
        <div class="row_section clearfix" style="margin-top:20px;padding-bottom:0px;">
            <table class="zebra" cellspacing="0" cellpadding="0" border="0" style="width:80%;border-collapse:collapse;">
                <thead>
                    <tr class="header">
                        <th style="width:7%">Tr. ID</th>
                        <th style="width:12%">Date</th>
                        <th style="width:15%">Tr Account</th>
                        <th style="width:15%">Account Name</th>
                        <th style="width:20%">Description</th>
                        <th style="width:10%">In Amount</th>                      
                        <th style="width:10%">Out Amount</th> 
                        <?php
                        if($userType == 'Admin'){
                        ?>                 
                        <th style="width:13%">Action</th>
                        <?php
                        }
                        ?>
                    </tr>
                </thead>
            </table>                    
        </div>                
        <div id="showSearchData" class="row_section clearfix" style="height:300px;overflow:auto;">
            <table class="zebra" cellspacing="0" cellpadding="0" border="0" style="text-align:left;width:80%;border-collapse:collapse;">
                <tbody>
                <?php $sql = mysql_query("SELECT sr_cashtransaction.*,sr_account.* FROM sr_cashtransaction left join sr_account on sr_account.Acc_SlNo=sr_cashtransaction.Acc_SlID order by sr_cashtransaction.Tr_Id asc");
                while($row = mysql_fetch_array($sql)){ ?>
                    <tr>
                        <td style="width:7%"><?php echo $row['Tr_Id'] ?></td>
                        <td style="width:12%"><?php echo $row['Tr_date'] ?></td>
                        <td style="width:15%"><?php echo $row['Tr_Type'] ?></td>
                        <td style="width:15%"><?php echo $row['Acc_Name'] ?></td>
                        <td style="width:20%"><?php echo $row['Tr_Description'] ?></td>
                        <td style="width:10%"><?php echo $row['In_Amount'] ?></td>
                        <td style="width:10%"><?php echo $row['Out_Amount'] ?></td>
                        <?php
                        if($userType == 'Admin'){
                        ?>
                        <td style="width:13%">
                        <a onclick="Edit_transaction(<?php echo $row['Tr_SlNo'] ?>)" style="cursor:pointer;color:green;font-size:20px;float:left" ><i class="fa fa-pencil"></i></a>
                        <span onclick="deleted(<?php echo $row['Tr_SlNo'] ?>)" style="cursor:pointer;color:red;font-size:20px;float:left;padding-left:10px"><i class="fa fa-trash-o"></i></span>
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

 <!-- datewise transection search -->
<script type="text/javascript">
    $('#search_datewise_transection').on("click", function(){
        var DaTe= $("#DaTe").val();
        var inputdata = 'DaTe='+DaTe;
        var urldata = "<?php echo base_url() ?>account/datewise_transection";
        // alert(DaTe);
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#showSearchData").html(data);
            }
        });
    });
</script>
 <!-- datewise transection search End -->

 <!-- Onselect Name -->
<script type="text/javascript">
    function OnselectName() {
        var acc_type = $("#acc_type").val();
        var account_id = $("#account_id").val();
        var inputdata = 'acc_type='+acc_type+'&account_id='+account_id;
        var urldata = "<?php echo base_url() ?>account/OnselectName";
        //alert(inputdata);
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#SelectResultName").html(data);
                //alert("Save Success");
            }
        });
    }
</script>
 <!-- Oneselect Name End -->
<!-- Onselect -->
<script type="text/javascript">
    function OnselectAccountType() {
        var acc_type = $("#acc_type").val();
        var inputdata = 'acc_type='+acc_type;
        var urldata = "<?php echo base_url() ?>account/AccountType";
        //alert(inputdata);
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#SelectResult").html(data);
                //alert("Save Success");
            }
        });
    }
    function OnhovertAccountType() {
        var acc_type = $("#acc_type").val();
        var inputdata = 'acc_type='+acc_type;
        var urldata = "<?php echo base_url() ?>account/AccountType";
        //alert(inputdata);
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#SelectResult").html(data);
                //alert("Save Success");
            }
        });
    }
</script>
<!-- Onselect End -->
<script type="text/javascript">
    function Transactionsubmit(){

        var Transaction_id= $("#Transaction_id").val();
        var tr_type= $("#tr_type").val();
        if(tr_type==""){
            $("#tr_type").css('border-color','red');
            return false;
        }else{
            $("#tr_type").css('border-color','gray');
        }
        var acc_type= $("#acc_type").val();
        if(acc_type==""){
            $("#acc_type").css('border-color','red');
            return false;
        }else{
            $("#acc_type").css('border-color','gray');
        }
        var account_id= $("#account_id").val();
        if(account_id==""){
            $("#account_id").css('border-color','red');
            return false;
        }else{
            $("#account_id").css('border-color','gray');
        }
        

        var DaTe= $("#DaTe").val();
        var Description= $("#Description").val();
        var regex = /^[0-9]+$/;

        var Amount= $("#Amount").val();
        if(!regex.test(Amount)){
            $("#Amount").css('border-color','red');
            return false;
        }else{
            $("#Amount").css('border-color','gray');
        }


        var inputdata = 'Transaction_id='+Transaction_id+'&tr_type='+tr_type+'&acc_type='+acc_type+'&account_id='+account_id+'&DaTe='+DaTe+'&Description='+Description+'&Amount='+Amount;
        var urldata = "<?php echo base_url() ?>account/cashTransection_insert";
        //alert(inputdata);
        //alert(urldata);
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
       function TransactionUpdatesubmit(){
        var Transaction_id= $("#Transaction_id").val();
        var tr_type= $("#tr_type").val();
        if(tr_type==""){
            $("#tr_type").css('border-color','red');
            return false;
        }else{
            $("#tr_type").css('border-color','');
        }
        var acc_type= $("#acc_type").val();
        if(acc_type==""){
            $("#acc_type").css('border-color','red');
            return false;
        }else{
            $("#acc_type").css('border-color','');
        }
        var account_id= $("#account_id").val();
        if(account_id==""){
            $("#account_id").css('border-color','red');
            return false;
        }else{
            $("#account_id").css('border-color','');
        }
        

        var DaTe= $("#DaTe").val();
        var Description= $("#Description").val();
        var Amount= $("#Amount").val();
        var id= $("#iidd").val();
        var inputdata = 'id='+id+'&Transaction_id='+Transaction_id+'&tr_type='+tr_type+'&acc_type='+acc_type+'&account_id='+account_id+'&DaTe='+DaTe+'&Description='+Description+'&Amount='+Amount;
        //var inputdata = 'id='+id+'&account_id='+account_id+'&accountName='+accountName+'&accounttype='+accounttype+'&Description='+Description;
        var urldata = "<?php echo base_url() ?>account/cash_transaction_update";
        //alert(inputdata);
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#saveResult").html(data);
                alert("Update Success");
            }
        });
    }
</script>
<script type="text/javascript">
    function Edit_transaction(id){
        var edit= id;
        var inputdata = 'edit='+edit;
        var urldata = "<?php echo base_url();?>account/cash_transaction_edit";
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
        var urldata = "<?php echo base_url();?>account/cash_transaction_delete";
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
