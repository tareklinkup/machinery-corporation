<select name="product_unit" id="product_unit" style="width:200px;" required>
    <option value="">Select</option>
    <?php $sql = mysql_query("SELECT * FROM sr_unit order by Unit_Name asc");
    while($row = mysql_fetch_array($sql)){ ?>
    <option value="<?php echo $row['Unit_SlNo'] ?>"><?php echo $row['Unit_Name'] ?></option>
    <?php } ?>
</select>  
<span style="color:red;font-size:15px;"><?php if(isset($exists))echo $exists;?></span>