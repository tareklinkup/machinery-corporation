<div  class="dialog contact" >
    <div class="full clearfix" style="width:320px;height:200px">
        <h2><strong>Add Transport</strong></h2>
        <input name="add_freight" type="text" id="add_freight" style="width:300px;"  class="txt" placeholder="Transport Name"  />
        <span id="msc"></span>
	    <br><br><br>
	    <input type="button" onclick="Submitdata()" value="Add" class="button" style="width:50px;float:right"/>
    </div>
    <h3 id="success"></h3>
</div> 

<script type="text/javascript">
	function Submitdata(){
		var add_freight = $('#add_freight').val();

		if(add_freight ==""){
			$('#msc').html('Required Field').css("color","green");
			return false;
		}
		
		var inputdata = 'add_freight='+add_freight;

		var urldata = "<?php echo base_url();?>Administrator/quotation/insert_freignt";
		$.ajax({
			type: "POST",
			url: urldata,
			data: inputdata,
			success:function(data){
				$('#success').html('Save Success').css("color","green");
				$('#freight_result').html(data);

				location.reload();
			}
		});
		
	}
</script>