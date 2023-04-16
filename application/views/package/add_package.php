<span id="saveResult">
<div class="content_scroll">
    <div class="tabContent">
        <div id="tabs" class="clearfix moderntabs">
            <div id="tabs-1">
               
                    <div class="middle_form">
                        <h2 id="">New Package<span style="color:green;float:right"><?php $status = $this->session->userdata('unit');if(isset($status))echo $status;$this->session->unset_userdata('unit'); ?></span>
                            <span style="color:red;float:right;font-size:15px;"><?php if(isset($exists))echo $exists;?></span>
                        </h2>
                        <div class="body">
                            
                            <div class="full clearfix">
                                <span>Package Name</span>
                                <div class="left">                                      
                                    <input name="packagename" type="text" id="packagename" class="required" placeholder="" autofocus="" />
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
                                <span>Purchase Price</span>
                                <div class="left">                                      
                                    <input name="purchaseprice" type="text" id="purchaseprice" class="required" placeholder="" autofocus="" />
                                </div>
                            </div>
                            <div class="full clearfix">
                                <span>Sales Price</span>
                                <div class="left">                                      
                                    <input name="salesprice" type="text" id="salesprice" class="required" placeholder="" autofocus="" />
                                </div>
                            </div>
                            <div class="full clearfix">
                                <div class="section_right clearfix">
                                    <input type="button" onclick="submit()" value="Add"  title="Save" class="button" style="margin-left:42px"/>
                                </div>
                            </div>
                        </div>
                    </div>
               
            </div>
        </div>
    </div>
    <div class="row_section clearfix" style="margin-top:20px;padding-bottom:0px;">
        <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="width:60%;border-collapse:collapse;">
            <thead>
                <tr class="header">
                    <th style="width:10px"></th>
                    <th style="width:200px">Package Name</th>                                                               
                    <th style="width:200px">Category Name</th>                                                               
                    <th style="width:200px">Purchase Price</th>                                                               
                    <th style="width:200px">Sales Price</th>                                                               
                    <th style="width:90px">Action</th>                                                               
                </tr>
            </thead>
        </table>                    
    </div> 
    <div class="clearfix moderntabs" style="width:330px;width:60%;max-height:300px;overflow:auto;">
        
        <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="text-align:left;width:100%;border-collapse:collapse;">
            <tbody>
                <?php $sql = mysql_query("SELECT sr_package.*, sr_productcategory.* FROM sr_package left join sr_productcategory on sr_productcategory.ProductCategory_SlNo =sr_package.package_categoryid  order by package_name asc");
                while($row = mysql_fetch_array($sql)){ ?>
                <tr>
                    <td style="width:10px"></td>
                    <td style="width:200px"><?php echo $row['package_name'] ?></td>
                    <td style="width:200px"><?php echo $row['ProductCategory_Name'] ?></td>
                    <td style="width:200px"><?php echo $row['package_purchPrice'] ?></td>
                    <td style="width:200px"><?php echo $row['package_sellPrice'] ?></td>
                    <td style="width:90px">
                        <span  style="cursor:pointer;color:green;font-size:20px;float:left;padding-left:10px" onclick="packageEdit(<?php echo $row['package_ID'] ?>)"><i class="fa fa-pencil"></i></span>
                        <span  style="cursor:pointer;color:red;font-size:20px;float:left;padding-left:10px" onclick="deleted(<?php echo $row['package_ID'] ?>)"><i class="fa fa-trash-o"></i></span>
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
        var packagename= $("#packagename").val();
        if(packagename==""){
            $("#packagename").css("border-color","red");
            return false;
        }else{
             $("#packagename").css("border-color","green");
        }
        var pCategory= $("#pCategory").val();
        if(pCategory==""){
            $("#pCategory").css("border-color","red");
            return false;
        }else{
             $("#pCategory").css("border-color","green");
        }
        var purchaseprice= $("#purchaseprice").val();
        if(purchaseprice==""){
            $("#purchaseprice").css("border-color","red");
            return false;
        }else{
             $("#purchaseprice").css("border-color","green");
        }
        var salesprice= $("#salesprice").val();
        if(salesprice==""){
            $("#salesprice").css("border-color","red");
            return false;
        }else{
             $("#salesprice").css("border-color","green");
        }
        var inputdata = 'packagename='+packagename+'&salesprice='+salesprice+'&pCategory='+pCategory+'&purchaseprice='+purchaseprice;
        var urldata = "<?php echo base_url() ?>package/package_Insert";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#saveResult").html(data);
                alert("Save Success");
                document.getElementById("packagename").value="";
                document.getElementById("salesprice").value="";
                document.getElementById("pCategory").value="";
                document.getElementById("purchaseprice").value="";
                $('input[name=packagename]').focus();
            }
        });
    }
    function update(){
        var id= $("#id").val();
        var packagename= $("#packagename").val();
        if(packagename==""){
            $("#packagename").css("border-color","red");
            return false;
        }else{
             $("#packagename").css("border-color","green");
        }
        var pCategory= $("#pCategory").val();
        if(pCategory==""){
            $("#pCategory").css("border-color","red");
            return false;
        }else{
             $("#pCategory").css("border-color","green");
        }
        var purchaseprice= $("#purchaseprice").val();
        if(purchaseprice==""){
            $("#purchaseprice").css("border-color","red");
            return false;
        }else{
             $("#purchaseprice").css("border-color","green");
        }
        var salesprice= $("#salesprice").val();
        if(salesprice==""){
            $("#salesprice").css("border-color","red");
            return false;
        }else{
             $("#salesprice").css("border-color","green");
        }
        var inputdata = 'packagename='+packagename+'&id='+id+'&salesprice='+salesprice+'&pCategory='+pCategory+'&purchaseprice='+purchaseprice;
        var urldata = "<?php echo base_url() ?>package/packageUdate";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#saveResult").html(data);
                alert("Update Success");
                document.getElementById("packagename").value="";
                document.getElementById("salesprice").value="";
                document.getElementById("pCategory").value="";
                document.getElementById("purchaseprice").value="";
                $('input[name=packagename]').focus();
            }
        });
    }
</script>
<script type="text/javascript">
    function deleted(id){
        var deletedd= id;
        var inputdata = 'deleted='+deletedd;
        //alert(inputdata);
        var urldata = "<?php echo base_url() ?>package/packageDelete";
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
        //alert(inputdata);
        var urldata = "<?php echo base_url() ?>package/packageEdit";
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