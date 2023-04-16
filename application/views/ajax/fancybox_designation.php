 <select name="em_Designation" id="em_Designation" style="width:163px;" required>
    <option value="">Select</option>
    <?php $sql = mysql_query("SELECT * FROM sr_designation order by Designation_Name asc ");
    while($row = mysql_fetch_array($sql)){ ?>
    <option value="<?php echo $row['Designation_SlNo'] ?>"><?php echo $row['Designation_Name'] ?></option>
    <?php } ?>
</select>  
<span style="color:red;font-size:15px;"><?php if(isset($exists))echo $exists;?></span>
