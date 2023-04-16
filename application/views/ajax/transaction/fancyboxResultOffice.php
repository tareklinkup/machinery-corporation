<select name="account_id" id="account_id" style="width:163px;" required onchange="OnselectName()">
    <option value=""></option>
    <?php $sql = mysql_query("SELECT * FROM sr_account order by Acc_Code asc ");
    while($row = mysql_fetch_array($sql)){ ?>
    <option value="<?php echo $row['Acc_SlNo'] ?>"><?php echo $row['Acc_Name'] ?></option>
    <?php } ?>                                     
</select>