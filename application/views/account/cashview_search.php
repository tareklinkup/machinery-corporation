<link href="<?php echo base_url()?>css/prints.css" rel="stylesheet" />
<div class="content_scroll">
<h2>Cash View</h2>
    <div style="width:100%; float:left;">
        <div style="border:1px solid #ddd">
            <table width="60%"> 
                <tr>
                    <td><strong>All</strong></td>
                    <td><input type="checkbox" name="all" value="all" id="checkall"></td>
                    <td><strong>Date</strong></td>
                    <td id="ashiqeCalender"><input  type="text" id="startdate" value="<?php echo date("Y-m-d") ?>" class="inputclass" style="width:200px"/></td>
                    <td> To </td>
                    <td id="ashiqeCalender"><input  type="text" id="enddate" value="<?php echo date("Y-m-d") ?>" class="inputclass" style="width:200px"/></td>
                    <td><input type="button" class="buttonAshiqe" onclick="searchCashView()" value="Show Report"></td>
                </tr>
            </table>
        </div>
    </div>
<div id="SalesCashView"></div>
</div>

<script type="text/javascript">
    $('#checkall').on( "click", function(){
        var checkall = $("#checkall:checked").val();
        if(checkall){
            $('#startdate').attr('disabled', 'disabled');
            $('#enddate').attr('disabled', 'disabled');
        }else{
            $("#startdate").removeAttr("disabled");
            $("#enddate").removeAttr("disabled");
        }
    });

  function searchCashView(){
    var checkall = $("#checkall:checked").val();
    var startdate = $("#startdate").val();
    if(startdate==""){
      $("#startdate").css('border-color','red');
      return false;
    }else{
        $("#startdate").css('border-color','green');
    }

    var enddate = $("#enddate").val();
    if(enddate==""){
      $("#enddate").css('border-color','red');
      return false;
    }else{
        $("#enddate").css('border-color','green');
    }
    var inputData = 'startdate='+startdate+'&enddate='+enddate+'&checkall='+checkall;
    var urldata = "<?php echo base_url(); ?>account/cash_view_list";
    $.ajax({
        type: "POST",
        url: urldata,
        data: inputData,
        success:function(data){
            $("#SalesCashView").html(data);
        }
    });
  }
</script>