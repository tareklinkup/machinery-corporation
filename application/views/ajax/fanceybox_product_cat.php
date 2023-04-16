<select name="pCategory" id="pCategory" style="width:163px;" required>
    <option value="">Select</option>
     <?php $sql = mysql_query("SELECT * FROM sr_productcategory order by ProductCategory_Name asc");
    while($row = mysql_fetch_array($sql)){ ?>
    <option value="<?php echo $row['ProductCategory_SlNo'] ?>"><?php echo $row['ProductCategory_Name'] ?></option>
    <?php } ?>
</select>  
<span style="color:red;font-size:15px;"><?php if(isset($exists))echo $exists;?></span>