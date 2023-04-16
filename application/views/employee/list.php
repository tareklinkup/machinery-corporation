<?php
$userType = $this->session->userdata('accountType');
?>
<div class="content_scroll">

<div id="page_menu" class="page_menu">
        <ul>
            <li class="active"><a href="<?php echo base_url() ?>employee">Add Employee</a></li>
            <li class="active"><a href="<?php echo base_url() ?>employee/emplists">Employee List </a> </li>
            <li><span style="color:green;"><?php $status = $this->session->userdata('employee');if(isset($status))echo $status;$this->session->unset_userdata('employee'); ?></span></li>
        </ul>
    </div>
                            
    <div class="row_section clearfix" style="height:500px;overflow:auto;">
    <div id="saveResult">
        <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="text-align:left;width:100%;">
            <thead>
                <tr class="header">
                    <th style="width:70px">Photo</th>
                    <th style="width:50px">ID</th>
                    <th style="width:250px">Employee Name</th>
                    <th style="width:250px">Designation</th>
                    <th style="width:250px">Depertment</th>
                    <th style="width:250px">Contact No</th>                              
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
            <?php $sql = mysql_query("SELECT sr_employee.*,sr_department.*,sr_designation.* FROM sr_employee left join sr_department on sr_department.Department_SlNo=sr_employee.Department_ID left join sr_designation on sr_designation.Designation_SlNo=sr_employee.Designation_ID order by sr_employee.Employee_Name asc ");
            while($row = mysql_fetch_array($sql)){ ?>
                <tr>
                    <td style="width:70px">
                    <img src="<?php echo base_url().'uploads/employeePhoto_thum/'.$row['Employee_Pic_thum'];?>" alt="" style="width:45px;height:45px;"></td>
                    <td style="width:50px"><?php echo $row['Employee_ID'] ?></td>
                    <td style="width:250px"><?php echo $row['Employee_Name'] ?></td>
                    <td style="width:250px"><?php echo $row['Designation_Name'] ?></td>
                    <td style="width:250px"><?php echo $row['Department_Name'] ?></td>
                    <td style="width:250px"><?php echo $row['Employee_ContactNo'] ?></td>
                    <?php
                    if($userType == 'Admin'){
                    ?>
                    <td style="width:90px">
                        <a href="<?php echo base_url().'employee/employee_edit/'.$row['Employee_SlNo'];?>" style="color:green;font-size:20px;float:left" title="Eidt" onclick="return confirm('Are you sure you want to Edit this item?');"><i class="fa fa-pencil"></i></a>
                        <span onclick="deleted(<?php echo $row['Employee_SlNo'] ?>)" style="cursor:pointer;color:red;font-size:20px;float:left;padding-left:10px"><i class="fa fa-trash-o"></i></span>
                    </td>
                    <?php
                    }
                    ?>
                </tr>  
            <?php } ?>                                                                                                                                                                                                                                                                                                                                                              
            </tbody>
        </table>
        </div>
    </div>              
</div>
<script type="text/javascript">
    function deleted(id){
        var deletedd= id;
        var inputdata = 'deleted='+deletedd;
        //alert(inputdata);
        var urldata = "<?php echo base_url();?>employee/employee_Delete";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#saveResult").html(data);
                alert("Delete Success");
            }
        });
    }
</script>

