<?php
$userType = $this->session->userdata('accountType');
?>
<div class="tabContent">
    <div id="tabs" class="clearfix moderntabs">
        <div id="tabs-1">
            <div class="middle_form">
                <div class="body">
                    <div class="full clearfix">
                        <span>Account ID</span>
                        <div class="left">                                    
                            <input name="supplier_id" type="text" id="lier_id" class="required" disabled="" value="<?php   $serial ="A1000"; $sql = mysql_query("SELECT * FROM sr_account");
                                while ($d = mysql_fetch_array($sql)){
                                    if($d['Acc_Code']!=null){$serial = $d['Acc_Code'];}
                                } $serial = explode("A",$serial);
                                    $serial=$serial['1']; $autoserial= $serial+1;echo "A".$autoserial;?>" autofocus="" />
                            <input name="account_id" type="hidden" id="account_id" class="required" value="<?php   $serial ="A1000"; $sql = mysql_query("SELECT * FROM sr_account");
                                while ($d = mysql_fetch_array($sql)){
                                    if($d['Acc_Code']!=null){$serial = $d['Acc_Code'];}
                                } $serial = explode("A",$serial);
                                    $serial=$serial['1']; $autoserial= $serial+1;echo "A".$autoserial;?>" autofocus="" />

                        </div>
                    </div>                                
                    <div class="full clearfix">
                        <span>Account Name</span>
                        <div class="left">                                      
                            <input name="accountName" type="text" id="accountName" class="required" placeholder="" autofocus="" required/>
                            <span style="color:red"><?php if(isset($exists))echo $exists; ?></span>
                        </div>
                    </div>              
                   
                    </div>                                                                                                                                                  
                </div>
            </div>
            <div class="right_form">
                <div class="body">
                    <div class="full clearfix">
                        <span>Account Type</span>
                        <input name="accoun" type="text" id="accoun" value="Official" class="txt" disabled="" />
                        <input name="accounttype" type="hidden" id="accounttype" value="Official" class="txt" />
                    </div>
                    <div class="full clearfix">
                        <span>Description</span>
                        <input name="Description" type="text" id="Description" class="txt" required/>
                        
                    </div>                                    
                   
                    <div class="full clearfix">
                        <span></span>
                        <input type="button" onclick="submit()" value="Add" class="button" />
                    </div>                                                                                                                                            
                </div>
            </div>
        </div>
    </div>


<div class="row_section clearfix" style="margin-top:20px;padding-bottom:0px;">
    <table class="zebra" cellspacing="0" cellpadding="0" border="0" style="width:70%;border-collapse:collapse;">
        <thead>
            <tr class="header">
                <th style="width:12%">Account ID</th>
                <th style="width:25%">Account Name</th>
                <th style="width:25%">Account Type</th>
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
        <?php $sql = mysql_query("SELECT * FROM sr_account order by Acc_Code asc");
        while($row = mysql_fetch_array($sql)){ ?>
            <tr>
                <td style="width:12%"><?php echo $row['Acc_Code'] ?></td>
                <td style="width:25%"><?php echo $row['Acc_Name'] ?></td>
                <td style="width:25%"><?php echo $row['Acc_Type'] ?></td>
                <?php
                if($userType == 'Admin'){
                ?>
                <td style="width:13%">
                <a onclick="Edit_Account(<?php echo $row['Acc_SlNo'] ?>)" style="cursor:pointer;color:green;font-size:20px;float:left" ><i class="fa fa-pencil"></i></a>
                <span onclick="deleted(<?php echo $row['Acc_SlNo'] ?>)" style="cursor:pointer;color:red;font-size:20px;float:left;padding-left:10px"><i class="fa fa-trash-o"></i></span>
                </td>
                <?php
                }
                ?>
            </tr>  
        <?php } ?>                
        </tbody>
    </table>
</div>              