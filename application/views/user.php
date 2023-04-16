
<div class="content_scroll">
    <div id="page_menu" class="page_menu">
        <h1 class="users"><i></i><span>Users List</span> 
        <a class="button" href="<?php echo base_url(); ?>user_management/add_user" title="Add New">Add New</a>
        <span style="color:green;float:right"><?php $status = $this->session->userdata('status');if(isset($status))echo $status;$this->session->unset_userdata('status'); ?></span>
        </h1>
    </div>
    <div class="tabContent">
        <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="width:60%;border-collapse:collapse;">
            <thead>
                <tr class="header">
                    <th scope="col">SI.No</th>
                    <th scope="col" style="width:150px;">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Type</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $i=""; $sql = mysql_query("SELECT tbl_user.*,tbl_brunch.* FROM tbl_user left join tbl_brunch on tbl_brunch.brunch_id=tbl_user.userBrunch_id");while($row = mysql_fetch_array($sql)){ $i++; ?>
                <tr class="item">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['FullName']; ?></td>
                    <td><?php echo $row['User_Name']; ?></td>
                    <td><?php if($row['UserType']=='a'){echo "Admin"; }else{echo "User"; } ?></td>
                    <td>
                        <a href="<?php echo base_url().'user_management/edit/'.$row['User_SlNo'];?>" style="color:green;font-size:25px;float:left" title="Eidt" onclick="return confirm('Are you sure you want to edit this item?');"><i class="fa fa-pencil"></i></a>
                        <a href="<?php echo base_url().'user_management/delete/'.$row['User_SlNo'];?>" style="color:red;font-size:25px;float:left;padding-left:10px" title="Delete" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>