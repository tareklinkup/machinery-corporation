<?php
if($cid == '0'){
?>
<table>
    <tr>
        <td style="width:100px">Name</td>
        <td style="width:200px">
            <div class="full clearfix">
                <input type="text" id="CusName" class="inputclass" autofocus>
            </div>
        </td>
    </tr>
    <tr>
        <td>Contact No</td>
        <td style="width:200px">
            <div class="full clearfix">
                <input type="text" id="CusMobile" class="inputclass" value="">
            </div>
        </td>
    </tr>
    <tr>
        <td>Address</td>
        <td style="width:200px">
            <div class="full clearfix">
                <textarea  id="CusAddress" rows="2" class="inputclass"></textarea>
            </div>
        </td>
    </tr>
    
</table>
<?php    
}else{
    $SC = mysql_query("SELECT * FROM sr_customer WHERE Customer_SlNo = '$cid'");
    $crow = mysql_fetch_array($SC);
?>
<table>
    <tr>
        <td style="width:100px">Name</td>
        <td style="width:200px">
            <div class="full clearfix">
                <input type="text" id="CusName" class="inputclass" value="<?php echo $crow['Customer_Name']; ?>" disabled="">
            </div>
        </td>
    </tr>
    <tr>
        <td>Contact No</td>
        <td style="width:200px">
            <div class="full clearfix">
                <input type="text" id="CusMobile" class="inputclass" value="<?php echo $crow['Customer_Mobile']; ?>" disabled="">
            </div>
        </td>
    </tr>
    <tr>
        <td>Address</td>
        <td style="width:200px">
            <div class="full clearfix">
                <textarea name="" id="CusAddress" rows="2" class="inputclass" disabled=""><?php echo $crow['Customer_Address']; ?></textarea>
            </div>
        </td>
    </tr>
    
</table>
<?php
}
?>
