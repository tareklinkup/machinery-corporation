
            <div class="content_scroll">
                <div id="page_menu" class="page_menu">
                    <h1 class="users"><i></i><span>User Form</span> 
                    <span style="color:green;float:right"><?php $status = $this->session->userdata('status');if(isset($status))echo $status;$this->session->unset_userdata('status'); ?></span>
                    </h1>
                </div>
                <div class="tabContent">
                <div id="saveResult">
                    <div id="tabs" class="clearfix">
                        <ul class="tabs">
                            <li><a href="#tabs-1"><span class="general">General</span></a></li>
                        </ul>
                        
                            <div id="tabs-1">
                                <div class="clearfix">
                                     <?php if(isset($exists)){?>
                                        <div class="error">
                                            <span><?php echo $exists; ?></span>
                                        </div><?php } ?>
                                    <div class="row_section clearfix">
                                        <div class="section_info">
                                            <strong>Login Credentials</strong>
                                            <i>Credentials used to log-in to the POS System</i>
                                        </div>
                                        <div class="section_content">
                                            <div class="section_full clearfix">
                                                <div class="section_full">
                                                    <strong>Username</strong>
                                                    <input name="username" type="text" id="username" class="txt" required/>
                                                    
                                                </div>
                                                
                                            </div>
                                            <div class="section_full clearfix">
                                                <div class="section_left">
                                                    <strong>Password</strong>
                                                    <input name="Password" type="password" id="assword" class="txt" required/>
                                                </div>
                                                <div class="section_right">
                                                    <strong>Re-Password</strong>
                                                    <input name="rePassword" onkeyup="password()" onblur="onblurPassword()" type="password" id="rePassword" class="txt" required/>
                                                </div>
                                                
                                            </div>
                                            <span id="mes"></span>
                                        </div>
                                    </div>
                                    <div class="row_section clearfix">
                                        <div class="section_info">
                                            <strong>Personnel Information</strong>
                                            <i>Basic information regarding the personnel's identity</i>
                                        </div>
                                        <div class="section_content">
                                            <div class="section_full clearfix">
                                                <div class="section_full">
                                                    <strong>Full Name</strong>
                                                    <input name="txtFirstName" type="text" id="txtFirstName" class="txt" required />
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row_section clearfix">
                                        <div class="section_info">
                                            <strong>Type</strong>
                                        </div>
                                        <div class="section_content">
                                            <div class="section_left clearfix">
                                                <select name="type" id="type" class="txt" required>
                                                    <option value=""></option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="Warehouse Manager">Warehouse Manager</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row_section clearfix">
                                        <div class="section_info">
                                        </div>
                                        <div class="section_content">
                                            <div class="section_right clearfix">
                                               <a  class="button btn-info"  href="<?php echo base_url();?>user_management">Cancel</a>
                                                <input type="button" onclick="submit()" name="btnSubmit" value="Save"  title="Save" class="button" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    function password(){
        var pass = $("#assword").val();
        var passre = $("#rePassword").val();
        //alert(pass+passre);
        if(pass != passre){
            $('#mes').html('Your password and confirm password do not match').css('color','red');
            return false;
        }else{
            $('#mes').html('Your password and confirm password matched').css('color','green');
            setTimeout( function() {$.fancybox.close(); },1200);
        }
        
    }
    function onblurPassword(){
        var pass = $("#Password").val();
        var passre = $("#rePassword").val();
        //alert(pass+passre);
        if(pass != passre){
            $('#mes').html('Your password and confirm password do not match').css('color','red');
            return false;
        }else{
            $('#mes').html('Your password and confirm password matched').css('color','green');
            setTimeout( function() {$.fancybox.close(); },1200);
        }
        
    }
</script>
<script type="text/javascript">
    function submit(){
        var username= $("#username").val();
        if(username==""){
            $("#username").css("border-color","red");
            return false;
        }else{
            $("#username").css("border-color","green");
        }
        var assword= $("#assword").val();
        if(assword==""){
            $("#assword").css("border-color","red");
            return false;
        }else{
            $("#assword").css("border-color","green");
        }
        var rePassword= $("#rePassword").val();
        if(rePassword==""){
            $("#rePassword").css("border-color","red");
            return false;
        }else{
            $("#rePassword").css("border-color","green");
        }
        if(assword != rePassword){
            $('#mes').html('Your password and confirm password do not match').css('color','red');
            return false;
        }else{
            $('#mes').html('Your password and confirm password matched').css('color','green');
            setTimeout( function() {$.fancybox.close(); },1200);
        }

        var txtFirstName= $("#txtFirstName").val();
        if(txtFirstName==""){
            $("#txtFirstName").css("border-color","red");
            return false;
        }else{
            $("#txtFirstName").css("border-color","green");
        }

        
        var type= $("#type").val();
        if(type==""){
            $("#type").css("border-color","red");
            return false;
        }else{
            $("#type").css("border-color","green");
        }

        
        var inputdata = 'username='+username+'&rePassword='+rePassword+'&txtFirstName='+txtFirstName+'&type='+type;
        var urldata = "<?php echo base_url();?>user_management/user_Insert";
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