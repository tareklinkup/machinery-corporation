<?php
$userType = $this->session->userdata('accountType');
?>
<span style="color:red;font-size:15px;"><?php if(isset($exists))echo $exists;?></span>
 
    <div class="clearfix moderntabs" style="width:330px;width:50%;max-height:300px;overflow:auto;">
        <span id="saveResult">
        <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="text-align:left;width:100%;border-collapse:collapse;">
            <thead>
                <tr class="header">
                    <th style="width:200px">Category Name</th>
                    <th>Description</th> 
                    <?php
                    if($userType == 'Admin'){
                    ?>              
                    <th style="width:90px">Action</th>
                    <?php
                    }
                    ?> 
                </tr>
            </thead>
            <tbody>
            <?php $sql = mysql_query("SELECT * FROM sr_productcategory order by ProductCategory_Name asc");
            while($row = mysql_fetch_array($sql)){ ?>
                <tr>
                    <td style="width:200px"><?php echo $row['ProductCategory_Name'] ?></td>
                    <td><?php echo $row['ProductCategory_Description'] ?></td>
                    <?php
                    if($userType == 'Admin'){
                    ?>
                    <td style="width:90px">
                        <a href="<?php echo base_url().'page/catedit/'.$row['ProductCategory_SlNo'];?>" style="color:green;font-size:20px;float:left" title="Eidt" onclick="return confirm('Are you sure you want to edit this item?');"><i class="fa fa-pencil"></i></a>
                        <span  onclick="deleted(<?php echo $row['ProductCategory_SlNo'] ?>)" style="cursor:pointer;color:red;font-size:20px;float:left;padding-left:10px" ><i class="fa fa-trash-o"></i></span>
                    </td>
                    <?php
                    }
                    ?>
                </tr>
            <?php } ?> 
            </tbody>    
        </table> 
    </div> 