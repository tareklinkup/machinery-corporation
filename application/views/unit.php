<?php
$userType = $this->session->userdata('accountType');
?>
<div class="content_scroll">
    <div class="tabContent">
        <div id="tabs" class="clearfix moderntabs">
            <div id="tabs-1">
               
                    <div class="middle_form">
                        <h2 id="">Add Unit<span style="color:green;float:right"><?php $status = $this->session->userdata('unit');if(isset($status))echo $status;$this->session->unset_userdata('unit'); ?></span>
                            <span style="color:red;float:right;font-size:15px;"><?php if(isset($exists))echo $exists;?></span>
                        </h2>
                        <div class="body">
                            <div class="full clearfix">
                                <span>Unit Name</span>
                                <div class="left">                                      
                                    <input name="unitname" type="text" id="unitname" class="required" placeholder="" autofocus="" required/>
                                    <span id="msg"></span>
                                </div>
                            </div>
                            <div class="full clearfix">
                                <div class="section_right clearfix">
                                    <input type="button" onclick="submit()" name="btnSubmit" value="Add"  title="Save" class="button" style="margin-left:42px" />
                                </div>
                            </div>
                        </div>
                    </div>
               
            </div>
        </div>
    </div>

    <div class="clearfix moderntabs" style="width:330px;width:30%;max-height:300px;overflow:auto;">
        <span id="saveResult">
        <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="text-align:left;width:100%;border-collapse:collapse;">
            <thead>
                <tr class="header">
                    <th style="width:10px"></th>
                    <th style="width:200px">Unit Name</th>
                    <?php
                    if($userType == 'Admin'){
                    ?>                           
                    <th style="width:90px">Action</th>
                    <?php
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 0;
                $sql = mysql_query("SELECT * FROM sr_unit order by Unit_Name asc");
                while($row = mysql_fetch_array($sql)){
                    $i++
                ?>
                <tr>
                    <td style="width:10px"><?php echo $i; ?></td>
                    <td style="width:200px"><?php echo $row['Unit_Name'] ?></td>
                    <?php
                    if($userType == 'Admin'){
                    ?>
                    <td style="width:90px">
                        <a href="<?php echo base_url().'page/unitedit/'.$row['Unit_SlNo'];?>" style="color:green;font-size:20px;float:left" title="Eidt" onclick="return confirm('Are you sure you want to edit this item?');"><i class="fa fa-pencil"></i></a>
                        <span  style="cursor:pointer;color:red;font-size:20px;float:left;padding-left:10px" onclick="deleted(<?php echo $row['Unit_SlNo'] ?>)"><i class="fa fa-trash-o"></i></span>
                    </td>
                    <?php
                    }
                    ?>
                </tr>
            <?php } ?> 
            </tbody>    
        </table> 
        </span>
    </div> 
</div> 
<script type="text/javascript">
    function submit(){
        var unitname= $("#unitname").val();
        if(unitname==""){
            $("#msg").html("Required Filed").css("color","red");
            return false;
        }
        var inputdata = 'unitname='+unitname;
        var urldata = "<?php echo base_url() ?>page/insert_unit";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#saveResult").html(data);
                alert("Save Success");
                document.getElementById("unitname").value="";
                $('input[name=unitname]').focus();
            }
        });
    }
</script>
<script type="text/javascript">
    function deleted(id){
        var deletedd= id;
        var inputdata = 'deleted='+deletedd;
        //alert(inputdata);
        var urldata = "<?php echo base_url() ?>page/unitdelete";
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