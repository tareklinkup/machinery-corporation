<span id="saveResult">
<div class="content_scroll">
    <div class="tabContent">
        <div id="tabs" class="clearfix moderntabs">
            <div id="tabs-1">
                <div class="middle_form">
                    <h2 id="">Package Create<span style="color:green;float:right"><?php $status = $this->session->userdata('unit');if(isset($status))echo $status;$this->session->unset_userdata('unit'); ?></span>
                        <span style="color:red;float:right;font-size:15px;"><?php //if(isset($exists))echo $exists;?></span>
                    </h2>
                    <div class="body">
                        <div class="full clearfix">
                            <span>Package Type</span>
                            <div class="left">                                      
                                <select id="packateType" class="required" style="width:175px">
                                <?php $sql = mysql_query("SELECT * FROM sr_package ORDER BY package_name ");
                                while($ore = mysql_fetch_array($sql)){ ?>
                                    <option value="<?php echo $ore['package_ProCode'] ?>"><?php echo $ore['package_name'] ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="full clearfix">
                            <span>Category</span>
                            <div class="left">                                      
                                <select name="pCategory" id="pCategory" style="width:175px;" >
                                    <option value="">Select</option>
                                     <?php $sql = mysql_query("SELECT * FROM sr_productcategory order by ProductCategory_Name asc");
                                    while($row = mysql_fetch_array($sql)){ ?>
                                    <option value="<?php echo $row['ProductCategory_SlNo'] ?>"><?php echo $row['ProductCategory_Name'] ?></option>
                                    <?php } ?>
                                </select>  
                            </div>
                        </div>
                        <div class="full clearfix">
                            <span>Package Item</span>
                            <div class="left">                                      
                                <input name="packageItem" type="text" id="packageItem" class="required" placeholder="" autofocus="" required/>
                            </div>
                        </div>
                        <div class="full clearfix">
                            <span>Purchase Price</span>
                            <div class="left">                                      
                                <input type="text" id="purchprice" class="required"/>
                            </div>
                        </div>
                        <div class="full clearfix">
                            <span>Sales Price</span>
                            <div class="left">                                      
                                <input type="text" id="sellpirce" class="required"/>
                            </div>
                        </div>
                        <div class="full clearfix">
                            <span>Item Qty</span>
                            <div class="left">                                      
                                <input type="text" id="itemqty" class="required"/>
                            </div>
                        </div>
                         
                        <div class="full clearfix">
                            <div class="section_right clearfix">
                                <input type="button" onclick="submit()" name="btnSubmit" value="Add"  title="Save" class="button" style="margin-left:42px"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row_section clearfix" style="margin-top:20px;padding-bottom:0px;">
        <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="width:100%;border-collapse:collapse;">
            <thead>
                <tr class="header">
                    <th style="width:10px"></th>
                    <th style="width:200px">Product Name</th>                                                               
                    <th style="width:200px">Item Name</th>                                                               
                    <th style="width:200px">Purchase Price</th>                                                               
                    <th style="width:200px">Sales Price</th>                                                               
                    <th style="width:200px">Item Qty</th>                                                               
                    <th style="width:97px">Action</th>                                                               
                </tr>
            </thead>
        </table>                    
    </div> 
    <div class="clearfix moderntabs" style="width:330px;width:100%;max-height:300px;overflow:auto;">
        <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="text-align:left;width:100%;border-collapse:collapse;">
            <tbody>
                <?php $sql = mysql_query("SELECT sr_package_create.*, sr_package.* FROM sr_package_create left join sr_package on sr_package.package_ProCode = sr_package_create.create_pacageID order by sr_package_create.create_item asc");
                while($row = mysql_fetch_array($sql)){ ?>
                <tr>
                    <td style="width:10px"></td>
                    <td style="width:200px"><?php echo $row['package_name'] ?></td>
                    <td style="width:200px"><?php echo $row['create_item'] ?></td>
                    <td style="width:200px"><?php echo $row['create_purch_price'] ?></td>
                    <td style="width:200px"><?php echo $row['create_sell_price'] ?></td>
                    <td style="width:200px"><?php echo $row['cteate_qty'] ?></td>
                    <td style="width:97px">
                        <span  style="cursor:pointer;color:green;font-size:20px;float:left;padding-left:10px" onclick="packageEdit(<?php echo $row['create_ID'] ?>)"><i class="fa fa-pencil"></i></span>
                        <span  style="cursor:pointer;color:red;font-size:20px;float:left;padding-left:10px" onclick="deleted(<?php echo $row['create_ID'] ?>)"><i class="fa fa-trash-o"></i></span>
                    </td>
                </tr>
            <?php } ?> 
            </tbody>    
        </table> 
    </div> 
</div> 
</span>
<script type="text/javascript">

    function submit(){
        var packateType= $("#packateType").val();
        if(packateType==""){
            $("#packateType").css("border-color","red");
            return false;
        }else{
            $("#packateType").css("border-color","green"); 
        }
        var packageItem= $("#packageItem").val();
        if(packageItem==""){
            $("#packageItem").css("border-color","red");
            return false;
        }else{
            $("#packageItem").css("border-color","green"); 
        }
        var purchprice= $("#purchprice").val();
        if(purchprice==""){
            $("#purchprice").css("border-color","red");
            return false;
        }else{
            $("#purchprice").css("border-color","green"); 
        }
        var sellpirce= $("#sellpirce").val();
        if(sellpirce==""){
            $("#sellpirce").css("border-color","red");
            return false;
        }else{
            $("#sellpirce").css("border-color","green"); 
        }

        var itemqty= $("#itemqty").val();
        if(itemqty==""){
            $("#itemqty").css("border-color","red");
            return false;
        }else{
            $("#itemqty").css("border-color","green"); 
        }
        var pCategory= $("#pCategory").val();
        if(pCategory==""){
            $("#pCategory").css("border-color","red");
            return false;
        }else{
            $("#pCategory").css("border-color","green"); 
        }

        var inputdata = 'pCategory='+pCategory+'&itemqty='+itemqty+'&sellpirce='+sellpirce+'&packateType='+packateType+'&purchprice='+purchprice+'&packageItem='+packageItem;
        var urldata = "<?php echo base_url() ?>package/package_create_Insert";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                var err = data;
                if((err)=="F"){
                    alert("This Name Allready Exists");
                }else{
                     $("#saveResult").html(data);
                alert("Save Success");
                document.getElementById("packageItem").value="";
                document.getElementById("purchprice").value="";
                document.getElementById("itemqty").value="";
                $('input[name=packageItem]').focus();
                }
               
            }
        });
    }
    function update(){
        var id= $("#id").val();
        var pcode= $("#pcode").val();
        var packateType= $("#packateType").val();
        if(packateType==""){
            $("#packateType").css("border-color","red");
            return false;
        }else{
            $("#packateType").css("border-color","green"); 
        }
        var packageItem= $("#packageItem").val();
        if(packageItem==""){
            $("#packageItem").css("border-color","red");
            return false;
        }else{
            $("#packageItem").css("border-color","green"); 
        }
        var purchprice= $("#purchprice").val();
        if(purchprice==""){
            $("#purchprice").css("border-color","red");
            return false;
        }else{
            $("#purchprice").css("border-color","green"); 
        }
        var sellpirce= $("#sellpirce").val();
        if(sellpirce==""){
            $("#sellpirce").css("border-color","red");
            return false;
        }else{
            $("#sellpirce").css("border-color","green"); 
        }
         var itemqty= $("#itemqty").val();
        if(itemqty==""){
            $("#itemqty").css("border-color","red");
            return false;
        }else{
            $("#itemqty").css("border-color","green"); 
        }
        var pCategory= $("#pCategory").val();
        if(pCategory==""){
            $("#pCategory").css("border-color","red");
            return false;
        }else{
            $("#pCategory").css("border-color","green"); 
        }
        var inputdata = 'pCategory='+pCategory+'&itemqty='+itemqty+'&pcode='+pcode+'&id='+id+'&packateType='+packateType+'&purchprice='+purchprice+'&packageItem='+packageItem+'&sellpirce='+sellpirce;
        var urldata = "<?php echo base_url() ?>package/createUdate";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#saveResult").html(data);
                alert("Update Success");
                document.getElementById("packageItem").value="";
                document.getElementById("purchprice").value="";
                document.getElementById("itemqty").value="";
                $('input[name=packageItem]').focus();
            }
        });
    }
    function deleted(id){
        var deletedd= id;
        var inputdata = 'deleted='+deletedd;
        //alert(inputdata);
        var urldata = "<?php echo base_url() ?>package/createDelete";
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
    function packageEdit(id){
        var deletedd= id;
        var inputdata = 'editid='+deletedd;
        var urldata = "<?php echo base_url() ?>package/createEdit";
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