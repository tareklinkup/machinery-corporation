<?php
$userType = $this->session->userdata('accountType');
?>
<span style="color:red;font-size:15px;"><?php //if(isset($exists))echo $exists;?></span>

    <div class="clearfix moderntabs" style="width:330px;width:30%;max-height:300px;overflow:auto;">
        
        <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="text-align:left;width:100%;border-collapse:collapse;">
            <thead>
                <tr class="header">
                    <th style="width:10px"></th>
                    <th style="width:200px">Country Name</th>
                    <?php
                    if($userType == 'Admin'){
                    ?>                          
                    <th style="width:200px">Action</th>
                    <?php
                    }
                    ?>                               
                </tr>
            </thead>
            <tbody>
            <?php 
            $i = 0;
            $sql = mysql_query("SELECT * FROM sr_country order by CountryName asc");
                while($row = mysql_fetch_array($sql)){
                    $i++;
                ?>
                <tr>
                    <td style="width:10px"><?php echo $i; ?></td>
                    <td style="width:200px"><?php echo $row['CountryName'] ?></td>
                    <?php
                    if($userType == 'Admin'){
                    ?>
                    <td style="width:90px">
                       <a href="<?php echo base_url().'page/countryedit/'.$row['Country_SlNo'];?>" style="color:green;font-size:20px;float:left" title="Eidt" onclick="return confirm('Are you sure you want to edit this item?');"><i class="fa fa-pencil"></i></a>
                        <span  style="cursor:pointer;color:red;font-size:20px;float:left;padding-left:10px" onclick="deleted(<?php echo $row['Country_SlNo'] ?>)"><i class="fa fa-trash-o"></i></span>
                    </td>
                    <?php
                    }
                    ?>
                </tr>
            <?php } ?>
            </tbody>    
        </table>
    </div> 