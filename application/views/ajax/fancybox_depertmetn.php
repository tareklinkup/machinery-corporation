<select name="em_Depertment" id="em_Depertment" style="width:163px;" required>
    <option value="">Select</option>
    <?php $sql = mysql_query("SELECT * FROM sr_department order by Department_Name asc ");
    while($row = mysql_fetch_array($sql)){ ?>
    <option value="<?php echo $row['Department_SlNo'] ?>"><?php echo $row['Department_Name'] ?></option>
    <?php } ?>
</select>  
<span style="color:red;font-size:15px;"><?php if(isset($exists))echo $exists;?></span>