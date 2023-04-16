<select name="district" id="district" style="width:163px;">
    <option value=""></option>
    <?php $sql = mysql_query("SELECT * FROM sr_district order by District_Name asc ");
    while($row = mysql_fetch_array($sql)){ ?>
    <option value="<?php echo $row['District_SlNo'] ?>"><?php echo $row['District_Name'] ?></option>
    <?php } ?>
</select>    
<span style="color:red;font-size:15px;"><?php if(isset($exists))echo $exists;?></span>
