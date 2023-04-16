
        <div class="tabContent">
            <div id="tabs" class="clearfix moderntabs">
                <div id="tabs-1">
                    <div class="middle_form">
                    <div id="success"></div>  
                        <div class="body">
                            <div class="full clearfix">
                                <div class="left">
                                    <input type="hidden" id="salesInvoiceno" value="<?php $sql = mysql_query("SELECT * FROM sr_salesmaster");
                                        $raw = mysql_num_rows($sql)+1;$raw = (int)$raw;echo date("Y-m-d").$raw;?>">
                                    
                                </div>
                            </div>
                            <div class="full clearfix">
                                <span>Company Name</span>
                                <div class="left">                                 
                                    <input name="companyName" type="text" id="companyName" class="required" style="width:263px" value="" autofocus="" />
                                   

                                </div>
                            </div>                                
                            <div class="full clearfix">
                                <span>Check No</span>
                                <div class="left">                                      
                                    <input name="checkNo" type="text" id="checkNo" class="required" placeholder="" style="width:263px" required/>
                                    
                                </div>
                            </div> 
                            <div class="full clearfix">
                                <span>Bank Name</span>
                                <div class="left">                                      
                                    <input name="bankName" type="text" id="bankName" class="required" placeholder="" style="width:263px" required/>
                                    
                                </div>
                            </div>
                            <div class="full clearfix">
                                <span>Brunch Name</span>
                                <div class="left">                                      
                                    <input name="brunchName" type="text" id="brunchName" class="required" placeholder="" style="width:263px" required/>
                                    
                                </div>
                            </div> 
                            <div class="full clearfix">
                                <span>Check Date</span>
                                <div class="left" id="ashiqeCalender">
                                <input name="checkDate" type="text" value="" id="checkDate" class="required"  />
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
        var salesInvoiceno= $("#salesInvoiceno").val();
        var companyName= $("#companyName").val();
        if(companyName==""){
            $("#companyName").css("border-color","red");
            return false;
        }
        var checkNo= $("#checkNo").val();
        if(checkNo==""){
            $("#checkNo").css("border-color","red");
            return false;
        }
        var bankName= $("#bankName").val();
        if(bankName==""){
            $("#bankName").css("border-color","red");
            return false;
        }
        var brunchName= $("#brunchName").val();
        if(brunchName==""){
            $("#brunchName").css("border-color","red");
            return false;
        }
        var checkDate= $("#checkDate").val();
        if(checkDate==""){
            $("#checkDate").css("border-color","red");
            return false;
        }

        var inputdata = 'salesInvoiceno='+salesInvoiceno+'&companyName='+companyName+'&checkNo='+checkNo+'&bankName='+bankName+'&brunchName='+brunchName+'&checkDate='+checkDate;
        alert(inputdata);
        var urldata = "<?php echo base_url() ?>sales/sales_insertCheckinfo";
        var succes = "";
        if(succes == ""){
            var inputdata = 'salesInvoiceno='+salesInvoiceno+'&companyName='+companyName+'&checkNo='+checkNo+'&bankName='+bankName+'&brunchName='+brunchName+'&checkDate='+checkDate;
            var urldata = "<?php echo base_url() ?>sales/sales_insertCheckinfo";
            $.ajax({
                type: "POST",
                url: urldata,
                data: inputdata,
                success:function(data){
                    $('#success').html('Save Success').css("color","green");
                    $('#SelectResult').html(data);
                    $("#addAccountInfo").hide();
                    $("#sellbtn").removeAttr('disabled');
                    setTimeout(function() {$.fancybox.close()}, 2000);
                     
                }
            });
        }
    }
</script>

