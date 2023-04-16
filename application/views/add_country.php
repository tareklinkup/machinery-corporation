<?php
$userType = $this->session->userdata('accountType');
?>
<div class="content_scroll">
    <div class="tabContent">
        <div id="tabs" class="clearfix moderntabs">
            <div id="tabs-1">
               
                    <div class="middle_form">
                        <h2 id="">Add Country</h2>
                        <div class="body">
                            <div class="full clearfix">
                                <span>Country Name</span>
                                <div class="left">                                      
                                    <input name="Country" type="text" id="Country" class="required" placeholder="" autofocus="" style="width:100%" />
                                    <span id="msg"></span>
                                </div>
                            </div>
                            <div class="full clearfix">
                                <div class="section_right clearfix">
                                    <input type="button" onclick="submit()" name="btnSubmit" value="Add"  title="Save" class="button" style="margin-left:55px" />
                                </div>
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
    <span id="saveResult"> 
    <div class="clearfix moderntabs" style="width:330px;width:30%;max-height:300px;overflow:auto;">
        
        <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="text-align:left;width:100%;border-collapse:collapse;">
            <thead>
                <tr class="header">
                    <th style="width:10px"></th>
                    <th style="width:200px">Country Name</th>
                    <?php
                    if($userType == 'Admin'){
                    ?>                          
                    <th style="width:200px">Action</th>
                    <?php
                    }
                    ?>                               
                </tr>
            </thead>
            <tbody>
            <?php 
            $i = 0;
            $sql = mysql_query("SELECT * FROM sr_country order by CountryName asc");
                while($row = mysql_fetch_array($sql)){
                    $i++;
                ?>
                <tr>
                    <td style="width:10px"><?php echo $i; ?></td>
                    <td style="width:200px"><?php echo $row['CountryName'] ?></td>
                    <?php
                    if($userType == 'Admin'){
                    ?> 
                    <td style="width:90px">
                       <a href="<?php echo base_url().'page/countryedit/'.$row['Country_SlNo'];?>" style="color:green;font-size:20px;float:left" title="Eidt" onclick="return confirm('Are you sure you want to Edit this item?');"><i class="fa fa-pencil"></i></a>
                        <span  style="cursor:pointer;color:red;font-size:20px;float:left;padding-left:10px" onclick="deleted(<?php echo $row['Country_SlNo'] ?>)"><i class="fa fa-trash-o"></i></span>
                    </td>
                    <?php
                    }
                    ?>
                </tr>
            <?php } ?>
            </tbody>    
        </table>
    </div> 
     </span>
</div> 
<script type="text/javascript">
    function submit(){
        var Country= $("#Country").val();
        if(Country==""){
            $("#msg").html("Required Filed").css("color","red");
            return false;
        }
        var inputdata = 'Country='+Country;
        var urldata = "<?php echo base_url() ?>page/insert_country";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                
                    var err = data;
                    if((err)=="F"){
                        alert("This Name Allready Exists");
                    }else{
                        alert("Save Success");
                        /*if(confirm('Show Report')){
                            window.location.href='<?php echo base_url(); ?>';
                        }else{
                            $("#saveResult").html(data);
                            return false;
                        }*/
                    }
            }
        });
    }
</script>
<script type="text/javascript">
    function deleted(id){
        var deletedd= id;
        var inputdata = 'deleted='+deletedd;
        //alert(inputdata);
        var urldata = "<?php echo base_url() ?>page/countrydelete";
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