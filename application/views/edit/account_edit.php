
   
    <div id="saveResult">
        <div class="tabContent">
            <div id="tabs" class="clearfix moderntabs">
                <div id="tabs-1">
                    <div class="middle_form">
                        <div class="body">
                            <div class="full clearfix">
                                <span>Account ID</span>
                                <div class="left">                                    
                                    <input name="supplier_id" type="text" id="lier_id" class="required" disabled="" value="<?php echo $selected['Acc_Code'] ?>"/>
                                    <input name="account_id" type="hidden" id="account_id" class="required" value="<?php echo $selected['Acc_Code'] ?>" />
                                    <input name="iidd" type="hidden" id="iidd" value="<?php echo $selected['Acc_SlNo'] ?>" />

                                </div>
                            </div>                                
                            <div class="full clearfix">
                                <span>Account Name</span>
                                <div class="left">                                      
                                    <input name="accountName" type="text" id="accountName" class="required" value="<?php echo $selected['Acc_Name'] ?>" required/>
                                </div>
                            </div>              
                           
                            </div>                                                                                                                                                  
                        </div>
                    </div>
                    <div class="right_form">
                        <div class="body">
                            <div class="full clearfix">
                                <span>Account Type</span>
                                <input name="accoun" type="text" id="accoun" value="<?php echo $selected['Acc_Type'] ?>" class="txt" disabled="" />
                                <input name="accounttype" type="hidden" id="accounttype" value="<?php echo $selected['Acc_Type'] ?>" class="txt" />
                            </div>
                            <div class="full clearfix">
                                <span>Description</span>
                                <input name="Description" type="text" id="Description" class="txt" value="<?php echo $selected['Acc_Description'] ?>" required/>
                            </div>                                    
                           
                            <div class="full clearfix">
                                <span></span>
                                <input type="button" onclick="Updatesubmit()" value="Update" class="button" />
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
                        <th style="width:13%">Action</th>                                              
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
                        <td style="width:13%">
                        <a onclick="Edit_Account(<?php echo $row['Acc_SlNo'] ?>)" style="cursor:pointer;color:green;font-size:20px;float:left" ><i class="fa fa-pencil"></i></a>
                        <span onclick="deleted(<?php echo $row['Acc_SlNo'] ?>)" style="cursor:pointer;color:red;font-size:20px;float:left;padding-left:10px"><i class="fa fa-trash-o"></i></span>
                        </td>
                    </tr>  
                <?php } ?>                
                </tbody>
            </table>
        </div>              
    </div>