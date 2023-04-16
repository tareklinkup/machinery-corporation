<select name="country" id="country" style="width:163px;">
    <option value=""></option>
    <?php $sql = mysql_query("SELECT * FROM sr_country order by CountryName asc ");
    while($row = mysql_fetch_array($sql)){ ?>
    <option value="<?php echo $row['Country_SlNo'] ?>"><?php echo $row['CountryName'] ?></option>
    <?php } ?>                                     
</select> 
<span style="color:red;font-size:15px;"><?php if(isset($exists))echo $exists;?></span>