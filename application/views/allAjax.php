<?php 
if($_POST['send'] == 'AutoSelect'){
    $tr_type = $_POST['tr_type'];
    if($tr_type== "Deposit To Bank"){
        echo "hi";
    ?> 
    
    <select name="acc_type" id="acc_type" class="required" onchange="OnselectAccountType()" style="width:175px">
        <option value=""></option>
        <option value="Customer">Customer</option>
        <option value="Official" selected="">Official</option>
        <option value="Supplier">Supplier</option>
    </select>
<?php } }?>