<div class="content_scroll">
    <div class="tabContent">
        <div id="tabs" class="clearfix moderntabs">
            <div id="tabs-1">
                <div class="middle_form">
                    <h2 id="">Edit Designation</h2>
                    <div class="body">
                        <div class="full clearfix">
                            <span>Name</span>
                            <div class="left">                                      
                                <input name="Designation" type="text" id="Designation" class="required" value="<?php echo $selected['Designation_Name'] ?>" autofocus="" />
                                <input name="id" type="hidden" id="id" value="<?php echo $selected['Designation_SlNo'] ?>" />
                                <span id="msg"></span>
                            </div>
                        </div>
                        <div class="full clearfix">
                            <div class="left clearfix">
                                <a href="<?php echo base_url();?>employee/designation" class="button">Cancel</a>
                                <input type="button" onclick="submit()" name="btnSubmit" value="Update"  title="Save" class="button" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<script type="text/javascript">
    function submit(){
        var Designation= $("#Designation").val();
        if(Designation==""){
            $("#msg").html("Required Filed").css("color","red");
            return false;
        }
        var inputdata = 'Designation='+Designation;
        var urldata = "<?php echo base_url() ?>employee/designationupdate";
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
