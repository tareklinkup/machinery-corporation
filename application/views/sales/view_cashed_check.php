<div class="content_scroll">

<div id="page_menu" class="page_menu">
        <ul>
            <li class="active"><a href="<?php echo base_url() ?>sales">Add Sales</a></li>
            <li class="active"><a href="<?php echo base_url() ?>sales/cashed_check">Cashed Check List </a> </li>
            <li><span style="color:green;"><?php $status = $this->session->userdata('employee');if(isset($status))echo $status;$this->session->unset_userdata('employee'); ?></span></li>
        </ul>
    </div>
            
    <div class="row_section clearfix" style="margin-top:20px;padding-bottom:0px;">
        <table width="100%" id="searchTable">
            <tr>
                <td>
                    <table>
                        <tr>
                            <td width="60px">Invoice</td>
                            <td width="200px">
                                <div class="">
                                    <select id="invoiceno" data-placeholder="Choose a Invoice..." class="chosen-select" onchange="invoiceSearchCashed()">
                                        <option value=""></option>
                                        <?php $sql = mysql_query("SELECT * FROM tbl_check_pay WHERE CheckStatus = 'C' ORDER BY CheckPay_SINo");
                                        while($row = mysql_fetch_array($sql)){ ?>
                                        <option value="<?php echo $row['CheckPay_SINo'] ?>"> <?php echo $row['SalesInvoiceno']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table>
                        <tr>
                            <td width="60px">Company</td>
                            <td width="200px">
                                <div class="">
                                    <select id="companyName" data-placeholder="Choose a Company..." class="chosen-select"  onchange="companySearchCashed()">
                                        <option value=""></option>
                                        <?php $sql = mysql_query("SELECT DISTINCT CompanyName FROM tbl_check_pay WHERE CheckStatus = 'C' ORDER BY CheckPay_SINo");
                                        while($row = mysql_fetch_array($sql)){ ?>
                                        <option value="<?php echo $row['CompanyName'] ?>"> <?php echo $row['CompanyName']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
                
            </tr>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td width="60px">Check No</td>
                            <td width="200px">
                                <div class="">
                                    <select id="checkNo" data-placeholder="Choose a Check..." class="chosen-select"  onchange="checkSearchCashed()">
                                        <option value=""></option>
                                        <?php $sql = mysql_query("SELECT * FROM tbl_check_pay WHERE CheckStatus = 'C' ORDER BY CheckPay_SINo");
                                        while($row = mysql_fetch_array($sql)){ ?>
                                        <option value="<?php echo $row['CheckNo'] ?>"> <?php echo $row['CheckNo']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table>
                        <tr>
                            <td width="60px">Date</td>
                            <td>
                                <div class="left" id="ashiqeCalender" onchange="dateSearchCashed()">
                                <input name="checkDate" type="text" value="" id="checkDate" class="required"  />
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <div class="row_section clearfix" style="margin-top:20px;padding-bottom:0px;">
        <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="width:100%;">
            <thead>
                <tr class="header">
                    <th style="width:100px">Invoice No</th>
                    <th style="width:200px">Company Name</th>
                    <th style="width:200px">Check No</th>
                    <th style="width:200px">Bank Name</th>
                    <th style="width:200px">Brunch Name</th>
                    <th style="width:200px">Check Date</th>                       
                </tr>
            </thead>
        </table>                    
    </div>                
    <div class="row_section clearfix" style="height:500px;overflow:auto;">
    <div id="saveResult">
        <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="text-align:left;width:100%;">
            <tbody>
            <?php $sql = mysql_query("SELECT * FROM tbl_check_pay WHERE CheckStatus = 'C' ORDER BY CheckDate");
            while($row = mysql_fetch_array($sql)){ ?>
                <tr>
                    <td style="width:100px"><?php echo $row['SalesInvoiceno'] ?></td>
                    <td style="width:200px"><?php echo $row['CompanyName'] ?></td>
                    <td style="width:200px"><?php echo $row['CheckNo'] ?></td>
                    <td style="width:200px"><?php echo $row['BankName'] ?></td>
                    <td style="width:200px"><?php echo $row['BrunchName'] ?></td>
                    <td style="width:200px"><?php echo $row['CheckDate'] ?></td>
                </tr>  
            <?php } ?>                                                           
            </tbody>
        </table>
        </div>
    </div>              
</div>

<script type="text/javascript">
    function invoiceSearchCashed(){
        var invoiceId = $('#invoiceno :selected').val();
        //alert(invoiceId);
        var inputdata = 'invoiceId='+invoiceId;
        var urldata = "<?php echo base_url();?>sales/searchByInvoiceCashed";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#saveResult").html(data);
            }
        });
    }
    function companySearchCashed(){
        companyName = $('#companyName :selected').val();
        var inputdata = 'companyName='+companyName;
        var urldata = "<?php echo base_url();?>sales/searchByCompanyCashed";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#saveResult").html(data);
            }
        });
    }
    function checkSearchCashed(){
        checkNo = $('#checkNo :selected').val();
        var inputdata = 'checkNo='+checkNo;
        var urldata = "<?php echo base_url();?>sales/searchByCheckCashed";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#saveResult").html(data);
            }
        });
    }
    function dateSearchCashed(){
        checkDate = $('#checkDate').val();
        var inputdata = 'checkDate='+checkDate;
        var urldata = "<?php echo base_url();?>sales/searchBydateCashed";
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