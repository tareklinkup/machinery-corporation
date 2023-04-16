<div class="content_scroll">
    <div class="tabContent">
        <div id="tabs" class="clearfix moderntabs">
            <div id="tabs-1">
                <div class="middle_form">
                    <h2 id="">Edit Depertment</h2>
                    <div class="body">
                        <div class="full clearfix">
                            <span>Name</span>
                            <div class="left">                                      
                                <input name="Depertment" type="text" id="Depertment" class="required" value="<?php echo $selected['Department_Name'] ?>" autofocus="" />
                                <input name="id" type="hidden" id="id" value="<?php echo $selected['Department_SlNo'] ?>" />
                                <span id="msg"></span>
                            </div>
                        </div>
                        <div class="full clearfix">
                            <div class="left clearfix">
                            <a href="<?php echo base_url(); ?>employee/depertment" class="button">Cancel</a>
                                <input type="button" onclick="submited()" name="btnSubmit" value="Update" class="button" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<script type="text/javascript">
    function submited(){
        var Depertment= $("#Depertment").val();
        var id= $("#id").val();
        if(Depertment==""){
            $("#msg").html("Required Filed").css("color","red");
            return false;
        }
        var inputdata = 'Depertment='+Depertment+'&id='+id;
        var urldata = "<?php echo base_url();?>employee/depertmentupdate";
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
