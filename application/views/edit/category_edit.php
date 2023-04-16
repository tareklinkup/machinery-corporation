<div class="content_scroll">
    <div class="tabContent">
        <div id="tabs" class="clearfix moderntabs">
            <div id="tabs-1">
               
                    <div class="middle_form">
                        <h2 id="">Add Category</h2>
                        <div class="body">
                            <div class="full clearfix">
                                <span>Category Name</span>
                                <div class="left">                                      
                                    <input name="catname" type="text" id="catname" class="required" value="<?php echo $selected['ProductCategory_Name'] ?>" autofocus="" required/>
                                    <input name="id" id="id" type="hidden" value="<?php echo $selected['ProductCategory_SlNo'] ?>"/>
                                </div>
                            </div>
                            <div class="full clearfix">
                                <span>Description</span>
                                <div class="left">                                      
                                    <textarea name="catdescrip" id="catdescrip" style="width:167px" rows="2"><?php echo $selected['ProductCategory_Description'] ?></textarea>
                                </div>
                            </div>
                            <div class="full clearfix">
                                <div class="section_right clearfix">
                                <a href="<?php echo base_url(); ?>page/add_category" class="button">Cancel</a>
                                    <input type="button" onclick="submit()" name="btnSubmit" value="Update"  title="Save" class="button" />
                                </div>
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
    <span id="saveResult">
     <div class="row_section clearfix" style="margin-top:20px;padding-bottom:0px;">
        <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="width:50%;border-collapse:collapse;">
            <thead>
                <tr class="header">
                    <th style="width:200px">Category Name</th>
                    <th>Description</th>                                                               
                    <th style="width:90px">Action</th>                                                               
                </tr>
            </thead>
        </table>                    
    </div> 
    <div class="clearfix moderntabs" style="width:330px;width:50%;max-height:150px;overflow:auto;">
        <span id="saveResult">
        <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="text-align:left;width:100%;border-collapse:collapse;">
            <tbody>
            <?php $sql = mysql_query("SELECT * FROM sr_productcategory order by ProductCategory_Name asc");
            while($row = mysql_fetch_array($sql)){ ?>
                <tr>
                    <td style="width:200px"><?php echo $row['ProductCategory_Name'] ?></td>
                    <td><?php echo $row['ProductCategory_Description'] ?></td>
                    <td style="width:90px">
                        <a href="<?php echo base_url().'page/catedit/'.$row['ProductCategory_SlNo'];?>" style="color:green;font-size:20px;float:left" title="Eidt" onclick="return confirm('Are you sure you want to edit this item?');"><i class="fa fa-pencil"></i></a>
                        <span  onclick="deleted(<?php echo $row['ProductCategory_SlNo'] ?>)" style="cursor:pointer;color:red;font-size:20px;float:left;padding-left:10px" ><i class="fa fa-trash-o"></i></span>
                    </td>
                </tr>
            <?php } ?> 
            </tbody>    
        </table> 
    </div> 
    </span>
</div> 

<script type="text/javascript">
    function submit(){
        var catname= $("#catname").val();
        var catdescrip= $("#catdescrip").val();
        var id= $("#id").val();
        if(catname==""){
            $("#msg").html("Required Filed").css("color","red");
            return false;
        }
        var inputdata = 'catname='+catname+'&catdescrip='+catdescrip+'&id='+id;
        var urldata = "<?php echo base_url() ?>page/catupdate";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#saveResult").html(data);
                alert("Save Success");
            }
        });
    }
</script>
<script type="text/javascript">
    function deleted(id){
        var deletedd= id;
        var inputdata = 'deleted='+deletedd;
        //alert(inputdata);
        var urldata = "<?php echo base_url() ?>page/catdelete";
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
</script>