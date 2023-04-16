<div  class="dialog contact" >
    <div class="full clearfix" style="width:330px;height:200px">
        <strong>Add Country</strong>
        <input name="add_country" type="text" id="add_country" style="width:300px;"  class="txt" placeholder="Add Country"  />
        <span id="msc"></span>
	    <br><br><br>
	    <input type="button" onclick="Submitdata()" value="Add" class="button" style="width:50px;float:right"/>
    </div>
    <h3 id="success"></h3>
</div> 

<script type="text/javascript">
	function Submitdata(){
		var add_country = $('#add_country').val();

		if(add_country ==""){
			$('#msc').html('Required Field').css("color","green");
			return false;
		}
		var succes = "";
		if(succes == ""){
			var inputdata = 'add_country='+add_country;
			//alert(inputdata);
			var urldata = "<?php echo base_url();?>supplier/insert_country/";
			$.ajax({
				type: "POST",
				url: urldata,
				data: inputdata,
				success:function(data){
					$('#success').html('Save Success').css("color","green");
					$('#Search_Results').html(data);
					//alert("ok");
					setTimeout(function() {$.fancybox.close()}, 2000);
				}
			});
		}
	}
</script>