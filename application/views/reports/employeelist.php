

<!DOCTYPE html>

<html>

<head>

<title> </title>

<meta charset='utf-8'>

    <link href="<?php echo base_url()?>css/prints.css" rel="stylesheet" />

    <link href="<?php echo base_url()?>assets/css/custom-styles.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/print.css">

</head>

<style type="text/css" media="print">

.hide{display:none}



</style>

<script type="text/javascript">

function printpage() {

document.getElementById('printButton').style.visibility="hidden";

window.print();

document.getElementById('printButton').style.visibility="visible";  

}

</script>

<body style="background:none;">

<input name="print" type="button" value="Print" id="printButton" onClick="printpage()">



      <table width="800px" >

        <tr>
          <td>            
            <div style="width:15%;float:left;">
                <img src="<?php echo base_url();?>images/logo.png" alt="Logo" style="margin-bottom:-10px;margin-left:30px;width:100px">
            </div>
            <div style="width:85%;">
                <div style="text-align:center" >
                    <strong style="font-size:16px;color:#1e2d54;">NEW JES MACHINERY CORPORATION</strong><br>
                    <small>209 Nawabpur Road, Dhaka 1100, Bangladesh.</small><br>
                    <small>Phone: +88-02-9568926, 9580512, Mobile: +88 01711832449, +88 01756943997</small><br>
                    <small>Fax: +88-02-7113987, Email: newjesmachinery@gmail.com</small>
                </div>
            </div>
          </td>
        </tr>

        <tr>

          <td style="float:right">

            <table width="100%"  border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td width="250px" style="text-align:right;"><strong></td>

              </tr>

          </table>

          </td>

        </tr>

        <tr>

            <td> 

                <table class="border" cellspacing="0" cellpadding="0" width="100%">

                    <thead>

                        <tr class="header">

                            <th style="width:7%">Photo</th>

                            <th>ID</th>

                            <th>Employee Name</th>

                            <th>Designation</th>

                            <th>Depertment</th>

                            <th>Present Address</th>

                            <th>Contact no</th>

                        </tr>

                    </thead>

                    <tbody>

                   <?php $sql = mysql_query("SELECT sr_employee.*,sr_department.*,sr_designation.* FROM sr_employee left join sr_department on sr_department.Department_SlNo=sr_employee.Department_ID left join sr_designation on sr_designation.Designation_SlNo=sr_employee.Designation_ID order by sr_employee.Employee_Name asc ");

            while($row = mysql_fetch_array($sql)){ ?>

                        <tr>

                            <td style="width:7%"><img src="<?php echo base_url().'uploads/employeePhoto_thum/'.$row['Employee_Pic_thum'];?>" alt="" style="width:45px;height:45px;"></td>

                            <td><?php echo $row['Employee_ID'] ?></td>

                            <td><?php echo $row['Employee_Name'] ?></td>

                            <td><?php echo $row['Designation_Name'] ?></td>

                            <td><?php echo $row['Department_Name'] ?></td>

                            <td><?php echo $row['Employee_PrasentAddress'] ?></td>

                            <td><?php echo $row['Employee_ContactNo'] ?></td>

                        </tr>  

                    <?php } ?>                

                    </tbody>

                </table>

            </td>

        </tr>

       

    </table></td>

  </tr>

  

</table>



<div class="signature" style="width:800px;">
    <div style="width:30%;float:left;text-align:center;margin-top:0px">
        <span style="border-top:1px dotted #000;font-weight:bold;font-size: 12px;">Buyer Signature</span>
    </div>
    <div style="width:40%;float:left;text-align:center;">
        <p>Thank You for Your Business!</p>        
    </div>
    <div style="width:30%;float:left;text-align:right;margin-top:0px">
        <span style="border-top:1px dotted #000;font-weight:bold;font-size: 12px;">Authorize Signature</span>
    </div>
</div>

</body>
</html>