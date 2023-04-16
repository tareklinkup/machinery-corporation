<div class="content_scroll">
    <span id="saveResult">
        <div class="tabContent">
            <div id="tabs" class="clearfix moderntabs">
                <div id="tabs-1">
                   
                        <div class="middle_form">
                            <h2 id="">Add Branch<span style="color:green;float:right"><?php $status = $this->session->userdata('Brunch');if(isset($status))echo $status;$this->session->unset_userdata('Brunch'); ?></span>
                                <span style="color:red;float:right;font-size:15px;"><?php if(isset($exists))echo $exists;?></span>
                            </h2>
                            <div class="body">
                                <div class="full clearfix">
                                    <span>Branch Name</span>
                                    <div class="left">                                      
                                        <input name="Brunchname" type="text" id="Brunchname" class="required" placeholder="" autofocus="" required/>
                                        <span id="msg"></span>
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
            <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="width:30%;border-collapse:collapse;">
                <thead>
                    <tr class="header">
                        <th style="width:10px"></th>
                        <th style="width:200px">Brunch Name</th>                                                               
                        <th style="width:90px">Action</th>                                                               
                    </tr>
                </thead>
            </table>                    
        </div> 
        <div class="clearfix moderntabs" style="width:330px;width:30%;max-height:300px;overflow:auto;">
            
            <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="text-align:left;width:100%;border-collapse:collapse;">
                <tbody>
                    <?php $sql = mysql_query("SELECT * FROM tbl_brunch order by Brunch_name asc");
                    while($row = mysql_fetch_array($sql)){ ?>
                    <tr>
                        <td style="width:10px"></td>
                        <td style="width:200px"><?php echo $row['Brunch_name'] ?></td>
                        <td style="width:90px">
                            <a onclick="Edit_brunch(<?php echo $row['brunch_id'] ?>)"  style="cursor:pointer;color:green;font-size:20px;float:left" title="Eidt" ><i class="fa fa-pencil"></i></a>
                            <span  style="cursor:pointer;color:red;font-size:20px;float:left;padding-left:10px" onclick="deleted(<?php echo $row['brunch_id'] ?>)"><i class="fa fa-trash-o"></i></span>
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
        var Brunchname= $("#Brunchname").val();
        if(Brunchname==""){
            $("#msg").html("Required Filed").css("color","red");
            return false;
        }
        var inputdata = 'Brunchname='+Brunchname;
        var urldata = "<?php echo base_url() ?>page/insert_brunch";
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
    function Edit_brunch(id){
        var edit= id;
        var inputdata = 'edit='+edit;
        var urldata = "<?php echo base_url();?>page/brunch_edit";
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
<script type="text/javascript">
    function UPdatesubmit(){
        var Brunchname= $("#Brunchname").val();
        
        if(Brunchname==""){
            $("#msg").html("Required Filed").css("color","red");
            return false;
        }
        var id= $("#iidd").val();
        var inputdata = 'Brunchname='+Brunchname+'&id='+id;
        var urldata = "<?php echo base_url() ?>page/brunch_update";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#saveResult").html(data);
                alert("Update Success");
            }
        });
    }
</script>
<script type="text/javascript">
    function deleted(id){
        var deletedd= id;
        var inputdata = 'deleted='+deletedd;
        var urldata = "<?php echo base_url() ?>page/brunch_delete";
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