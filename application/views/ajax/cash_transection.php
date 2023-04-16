<?php
$userType = $this->session->userdata('accountType');
?>
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
                            <select name="acc_type" id="acc_type" class="required" onchange="OnselectAccountType()" style="width:175px">
                            	<option value="Official">Official</option>
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
                    <span></span>
                    
                </div>
                 <div class="full clearfix">
                    <span></span>
                    
                </div>
                 <div class="full clearfix">
                    <span></span>
                    
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
                <th style="width:20%">Tr Account</th>
                <th style="width:25%">Description</th>
                <th style="width:13%">In Amount</th>                      
                <th style="width:13%">Out Amount</th>
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
<div class="row_section clearfix" style="height:300px;overflow:auto;">
    <table class="zebra" cellspacing="0" cellpadding="0" border="0" style="text-align:left;width:70%;border-collapse:collapse;">
        <tbody>
        <?php $sql = mysql_query("SELECT * FROM sr_cashtransaction order by Tr_Id asc");
        while($row = mysql_fetch_array($sql)){ ?>
            <tr>
                <td style="width:7%"><?php echo $row['Tr_Id'] ?></td>
                <td style="width:12%"><?php echo $row['Tr_date'] ?></td>
                <td style="width:20%"><?php echo $row['Tr_Type'] ?></td>
                <td style="width:25%"><?php echo $row['Tr_Description'] ?></td>
                <td style="width:13%"><?php echo $row['In_Amount'] ?></td>
                <td style="width:13%"><?php echo $row['Out_Amount'] ?></td>
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

