
        <div class="tabContent">
            <div id="tabs" class="clearfix moderntabs">
                <div id="tabs-1">
                    <div class="middle_form">
                    <div id="success"></div>  
                        <div class="body">
                            <div class="full clearfix">
                                <span>Account ID</span>
                                <div class="left">                                    
                                    <input name="supplier_id" type="text" id="lier_id" class="required" disabled="" style="width:263px" value="<?php   $serial ="A1000"; $sql = mysql_query("SELECT * FROM sr_account");
                                        while ($d = mysql_fetch_array($sql)){
                                            if($d['Acc_Code']!=null){$serial = $d['Acc_Code'];}
                                        } $serial = explode("A",$serial);
                                            $serial=$serial['1']; $autoserial= $serial+1;echo "A".$autoserial;?>" autofocus="" />
                                    <input name="account_id" type="hidden" id="Account_id" class="required" value="<?php   $serial ="A1000"; $sql = mysql_query("SELECT * FROM sr_account");
                                        while ($d = mysql_fetch_array($sql)){
                                            if($d['Acc_Code']!=null){$serial = $d['Acc_Code'];}
                                        } $serial = explode("A",$serial);
                                            $serial=$serial['1']; $autoserial= $serial+1;echo "A".$autoserial;?>" autofocus="" />

                                </div>
                            </div>                                
                            <div class="full clearfix">
                                <span>Account Name</span>
                                <div class="left">                                      
                                    <input name="accountName" type="text" id="AccountName" class="required" placeholder="" style="width:263px" required/>
                                    
                                </div>
                            </div> 
                             <div class="full clearfix">
                                <span>Account Type</span>
                                <div class="left">                                      
                                    <input name="accoun" type="text" id="accoun" value="Official" class="required"style="width:263px" disabled="" />
                                <input name="accounttype" type="hidden" id="Accounttype" value="Official" class="txt" />
                                    
                                </div>
                            </div> 
                             <div class="full clearfix">
                                <span>Description</span>
                                <div class="left">                                      
                                    <input name="Description" type="text" id="description" class="required" style="width:263px" required />
                                    
                                </div>
                            </div> 
                            <div class="full clearfix">
                                <span></span>
                                <input type="button" onclick="Submit()" value="Add" class="button" />
                            </div>                              
                           
                            </div>                                                                                                                                                  
                        </div>
                    </div>
                   
                </div>
        </div>
<script type="text/javascript">
    function Submit(){
        var account_id= $("#Account_id").val();
        var accountName= $("#AccountName").val();
        if(accountName==""){
            $("#accountName").css("border-color","red");
            return false;
        }
        var accounttype= $("#Accounttype").val();
        var Description= $("#description").val();

        var inputdata = 'account_id='+account_id+'&accountName='+accountName+'&accounttype='+accounttype+'&Description='+Description;
        var urldata = "<?php echo base_url() ?>account/account_insertFanceybox";
        var succes = "";
        if(succes == ""){
            var inputdata = 'account_id='+account_id+'&accountName='+accountName+'&accounttype='+accounttype+'&Description='+Description;
            var urldata = "<?php echo base_url() ?>account/account_insertFanceybox";
            $.ajax({
                type: "POST",
                url: urldata,
                data: inputdata,
                success:function(data){
                    $('#success').html('Save Success').css("color","green");
                    $('#SelectResult').html(data);
                    setTimeout(function() {$.fancybox.close()}, 2000);
                }
            });
        }
    }
</script>

