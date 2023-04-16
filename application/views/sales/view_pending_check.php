<div class="content_scroll">

    <div id="page_menu" class="page_menu">
        <ul>
            <li class="active"><a href="<?php echo base_url() ?>sales">Add Sales</a></li>
            <li class="active"><a href="<?php echo base_url() ?>sales/pending_check">Pending Check List </a> </li>
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
                                    <select id="invoiceno" data-placeholder="Choose a Invoice..." class="chosen-select" onchange="invoiceSearch()">
                                        <option value=""></option>
                                        <?php $sql = mysql_query("SELECT * FROM tbl_check_pay WHERE CheckStatus = 'P' ORDER BY CheckPay_SINo");
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
                                    <select id="companyName" data-placeholder="Choose a Company..." class="chosen-select"  onchange="companySearch()">
                                        <option value=""></option>
                                        <?php $sql = mysql_query("SELECT DISTINCT CompanyName FROM tbl_check_pay WHERE CheckStatus = 'P' ORDER BY CheckPay_SINo");
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
                                    <select id="checkNo" data-placeholder="Choose a Check..." class="chosen-select"  onchange="checkSearch()">
                                        <option value=""></option>
                                        <?php $sql = mysql_query("SELECT * FROM tbl_check_pay WHERE CheckStatus = 'P' ORDER BY CheckPay_SINo");
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
                                <div class="left" id="ashiqeCalender" onchange="dateSearch()">
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
                    <th style="width:100px">Action</th>                            
                </tr>
            </thead>
        </table>                    
    </div>                
    <div class="row_section clearfix" style="height:500px;overflow:auto;">
        <div id="saveResult">
            <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="text-align:left;width:100%;">
                <tbody>
                <?php $sql = mysql_query("SELECT * FROM tbl_check_pay WHERE CheckStatus = 'P' ORDER BY CheckDate ASC");
                while($row = mysql_fetch_array($sql)){ ?>
                    <tr>
                        <td style="width:100px"><?php echo $row['SalesInvoiceno'] ?></td>
                        <td style="width:200px"><?php echo $row['CompanyName'] ?></td>
                        <td style="width:200px"><?php echo $row['CheckNo'] ?></td>
                        <td style="width:200px"><?php echo $row['BankName'] ?></td>
                        <td style="width:200px"><?php echo $row['BrunchName'] ?></td>
                        <td style="width:200px"><?php echo $row['CheckDate'] ?></td>
                        <td style="width:100px">
                            <input type="button" class="btn btn-primary" value="Cashed" onclick="cashed(<?php echo $row['CheckPay_SINo'] ?>)"/>
                        </td>
                    </tr>  
                <?php } ?>                                                     
                </tbody>
            </table>
        </div>
    </div>              
</div>
<script type="text/javascript">
    function cashed(id){
        var checkid = id;
        var inputdata = 'checkid='+checkid;
        var urldata = "<?php echo base_url();?>sales/pendingToCashed";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#saveResult").html(data);
                //alert("Cashed Success");
            }
        });
    }
    function invoiceSearch(){
        var invoiceId = $('#invoiceno :selected').val();
        var inputdata = 'invoiceId='+invoiceId;
        var urldata = "<?php echo base_url();?>sales/searchByInvoice";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#saveResult").html(data);
            }
        });
    }
    function companySearch(){
        companyName = $('#companyName :selected').val();
        var inputdata = 'companyName='+companyName;
        var urldata = "<?php echo base_url();?>sales/searchByCompany";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#saveResult").html(data);
            }
        });
    }
    function checkSearch(){
        checkNo = $('#checkNo :selected').val();
        var inputdata = 'checkNo='+checkNo;
        var urldata = "<?php echo base_url();?>sales/searchByCheck";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#saveResult").html(data);
            }
        });
    }
    function dateSearch(){
        checkDate = $('#checkDate').val();
        var inputdata = 'checkDate='+checkDate;
        var urldata = "<?php echo base_url();?>sales/searchBydate";
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

