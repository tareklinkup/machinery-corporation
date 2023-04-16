<div class="content_scroll">
    <div id="saveResult">
        <div class="tabContent">
            <div id="tabs" class="clearfix moderntabs">
                <div class="right_form">
                    <div class="body">
                        <div class="full clearfix">
                            <span>Receipt No</span>
                            <input name="receiptNo" type="text" id="receiptNo" class="txt" required value="<?php   $serial ="MR00000"; $sql = mysql_query("SELECT * FROM tbl_moneyreceipt");
                                    while ($d = mysql_fetch_array($sql)){
                                        if($d['MoneyReceipt_No']!=null){$serial = $d['MoneyReceipt_No'];}
                                    } $serial = explode("MR",$serial);
                                        $serial=$serial['1']; $autoserial= $serial+1;echo "MR".str_pad($autoserial, 5, "0", STR_PAD_LEFT);?>" disabled=""/>
                        </div>
                        <div class="full clearfix">
                            <span>Receipt Name</span>
                            <input name="receiptName" type="text" id="receiptName" class="txt" required/>
                        </div>
                        <div class="full clearfix">
                            <span>Receipt Type</span>
                            <input name="receiptType" type="text" id="receiptType" class="txt" required/>
                        </div>
                        <div class="full clearfix">
                            <span>Account No</span>
                            <input name="accountNo" type="text" id="accountNo" class="txt" required/>
                        </div>
                        <div class="full clearfix">
                            <span>Cheque No</span>
                            <input name="chequeNo" type="text" id="chequeNo" class="txt" required/>
                        </div>
                        <div class="full clearfix">
                            <span>Receipt Amount</span>
                            <input name="receiptAmount" type="text" id="receiptAmount" class="txt" required/>
                        </div>
                       <div class="full clearfix" id="ashiqeCalender">
                            <span>Date</span>
                            <input name="DaTe" id="DaTe" type="text" value="<?php echo date("Y-m-d") ?>" class="required" />
                        </div>                                        
                       
                        <div class="full clearfix">
                            <span></span>
                            <!-- <input type="reset"  value="Reset" class="button" /> -->
                            <input type="button" onclick="MoneyReceiptsubmit()" value="Save" class="button" />
                        </div>                                                                                                                                            
                    </div>
                </div>
            </div>
    
        <div class="row_section clearfix" style="margin-top:20px;padding-bottom:0px;">
            <table class="zebra" cellspacing="0" cellpadding="0" border="0" style="width:80%;border-collapse:collapse;">
                <thead>
                    <tr class="header">
                        <th style="width:15%">Receipt No</th>
                        <th style="width:15%">Name</th>
                        <th style="width:20%">Account No</th>
                        <th style="width:20%">Cheque No</th>
                        <th style="width:15%">Amount</th>
                        <th style="width:15%">Date</th>                      
                    </tr>
                </thead>
            </table>                    
        </div>                
        <div id="showSearchData" class="row_section clearfix" style="height:300px;overflow:auto;">
            <table class="zebra" cellspacing="0" cellpadding="0" border="0" style="text-align:left;width:80%;border-collapse:collapse;">
                <tbody>
                <?php $sql = mysql_query("SELECT * FROM tbl_moneyreceipt ORDER BY MoneyReceipt_SINo DESC");
                while($row = mysql_fetch_array($sql)){ ?>
                    <tr>
                        <td style="width:15%"><?php echo $row['MoneyReceipt_No'] ?></td>
                        <td style="width:15%"><?php echo $row['MoneyReceipt_Name'] ?></td>
                        <td style="width:20%"><?php echo $row['Money_receipt_accountNo'] ?></td>
                        <td style="width:20%"><?php echo $row['MoneyReceipt_ChequeNo'] ?></td>
                        <td style="width:15%"><?php echo $row['MoneyReceipt_Amount'] ?></td>
                        <td style="width:15%"><?php echo $row['MoneyReceipt_PayDate'] ?></td>
                        
                    </tr>  
                <?php } ?>                
                </tbody>
            </table>
        </div>              
    </div>
    
</div>
<script type="text/javascript">
    function MoneyReceiptsubmit(){
        var receiptNo = $("#receiptNo").val();
        if(receiptNo == ""){
            $("#receiptNo").css('border-color','red');
            return false;
        }
        var receiptName = $("#receiptName").val();
        if(receiptName == ""){
            $("#receiptName").css('border-color','red');
            return false;
        }
        var receiptType = $("#receiptType").val();
        if(receiptType == ""){
            $("#receiptType").css('border-color','red');
            return false;
        }
        var accountNo = $("#accountNo").val();
        if(accountNo == ""){
            $("#accountNo").css('border-color','red');
            return false;
        }
        var chequeNo = $("#chequeNo").val();
        if(chequeNo == ""){
            $("#chequeNo").css('border-color','red');
            return false;
        }
        var receiptAmount = $("#receiptAmount").val();
        if(receiptAmount == ""){
            $("#receiptAmount").css('border-color','red');
            return false;
        }
        var DaTe = $("#DaTe").val();
        var inputdata = 'receiptNo='+receiptNo+'&receiptName='+receiptName+'&receiptType='+receiptType+'&accountNo='+accountNo+'&chequeNo='+chequeNo+'&receiptAmount='+receiptAmount+'&DaTe='+DaTe;
        var urldata = "<?php echo base_url() ?>sales/add_receipt";
        //alert(inputdata);
        //alert(urldata);
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                var err = data;
                if(err){
                    if(confirm('Show Report')){
                        window.location.href='<?php echo base_url(); ?>sales/receiptPrint';
                    }else{
                        //$("#SalescartRefresh").html(data);
                        alert('Success');
                        window.location.href='<?php echo base_url(); ?>sales/money_receipt';
                        return false;
                    }
                }
            }
        });
    }
</script>
