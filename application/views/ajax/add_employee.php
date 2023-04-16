 <form  method="post" enctype="multipart/form-data">
                    <div class="middle_form">
                        <h2>Job Information</h2>
                        <div class="body">
                            <div class="full clearfix">
                                <span>Employee Id</span>
                                <div class="left">                                    
                                    <input name="Emp_id" type="text" id="Empr_id" class="required" disabled="" value="<?php   $serial ="E1000"; $sql = mysql_query("SELECT * FROM sr_employee");
                                    while ($d = mysql_fetch_array($sql)){
                                        if($d['Employee_ID']!=null){$serial = $d['Employee_ID'];}
                                    } $serial = explode("E",$serial);
                                        $serial=$serial['1']; $autoserial= $serial+1;echo "E".$autoserial;?>" />
                                        <input name="Employeer_id" type="hidden" id="Employeer_id" class="required" value="<?php   $serial ="E1000"; $sql = mysql_query("SELECT * FROM sr_employee");
                                    while ($d = mysql_fetch_array($sql)){
                                        if($d['Employee_ID']!=null){$serial = $d['Employee_ID'];}
                                    } $serial = explode("E",$serial);
                                        $serial=$serial['1']; $autoserial= $serial+1;echo "E".$autoserial;?>" />
                                </div>
                            </div>                                
                            <div class="full clearfix">
                                <span>Name</span>
                                <div class="left">                                      
                                    <input name="em_name" type="text" id="em_name" class="required" placeholder="" autofocus="" />
                                </div>
                            </div>
                            <div class="full clearfix">
                                <span>Designation</span>
                                <div class="left">                                      
                                  <div id="Search_ResultsDesignation">
                                        <select name="em_Designation" id="em_Designation" style="width:163px;" required>
                                            <option value="">Select</option>
                                            <?php $sql = mysql_query("SELECT * FROM sr_designation order by Designation_Name asc ");
                                            while($row = mysql_fetch_array($sql)){ ?>
                                            <option value="<?php echo $row['Designation_SlNo'] ?>"><?php echo $row['Designation_Name'] ?></option>
                                            <?php } ?>
                                        </select>  
                                    </div>               
                                </div>
                                <div class="rightElement">
                                    <a class="btn-add fancybox fancybox.ajax" href="<?php echo base_url() ?>employee/fancybox_designation">
                                        <input type="button" name="country_button" value="+"  class="button" style="padding:7px 10px;font-size:16px;"/>                                
                                    </a> 
                                </div>
                            </div>
                            <div class="full clearfix">
                                <span>Depertment</span>
                                <div class="left">                                      
                                    <div id="Search_Resultsss">
                                        <select name="em_Depertment" id="em_Depertment" style="width:163px;" required>
                                            <option value="">Select</option>
                                            <?php $sql = mysql_query("SELECT * FROM sr_department order by Department_Name asc ");
                                            while($row = mysql_fetch_array($sql)){ ?>
                                            <option value="<?php echo $row['Department_SlNo'] ?>"><?php echo $row['Department_Name'] ?></option>
                                            <?php } ?>
                                        </select>  
                                    </div>             
                                </div>
                                <div class="rightElement">
                                    <a class="btn-add fancybox fancybox.ajax" href="<?php echo base_url() ?>employee/fancybox_depertment">
                                        <input type="button" name="country_button" value="+"  class="button" style="padding:7px 10px;font-size:16px;"/>                                
                                    </a> 
                                </div>
                            </div>
                            
                            <div class="full clearfix">
                                <span>Joint Date</span>
                                <div class="left" id="ashiqeCalender">
                                <input name="em_Joint_date" type="text" value="" id="em_Joint_date" class="required"  />
                                </div>
                                
                            </div>                                                                                                                                                  
                        </div>
                        <h2 >Personal Information</h2>
                        <div class="body">
                            <div class="full clearfix">
                                <span>Father's Name</span>
                                <div class="left">                                    
                                    <input name="em_father" type="text" id="em_father" class="required"  autofocus="" />
                                </div>
                            </div>                                
                            <div class="full clearfix">
                                <span>Mother's Name</span>
                                <div class="left">                                      
                                    <input name="mother_name" type="text" id="mother_name" class="required" placeholder="" autofocus="" />
                                </div>
                            </div>
                            <div class="full clearfix">
                                <span>Gender</span>
                                <div class="left">                                      
                                   <select name="Gender" id="Gender" style="width:173px;">
                                        <option value="">Select</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>          
                                </div>
                            </div>
                            <div class="full clearfix">
                                <span>Date of Birth</span>
                                <div class="left" id="ashiqeCalender">  
                                <input name="em_dob" type="text" value="" id="em_dob" class="required"  />
                                </div>
                            </div>
                            <div class="full clearfix">
                                <span>Marital Status</span>
                                <div class="left">
                                    <select name="Marital" id="Marital" style="width:173px;">
                                        <option value="">Select</option>
                                        <option value="married">Married</option>
                                        <option value="unmarried">Unmarried</option>
                                    </select>                 
                                </div>
                            </div>                                                                                                                                                  
                        </div>
                    </div>
                    <div class="right_form">
                        <h2 id="personal-info">Contact Information</h2>
                        <div class="body">
                            
                            <div class="full clearfix">
                                <span>Present Address</span>
                                <input name="em_Present_address" type="text" id="em_Present_address" class="txt" />
                            </div>
                            <div class="full clearfix">
                                <span>Permanent Address</span>
                                <input name="em_Permanent_address" type="text" id="em_Permanent_address" class="txt" />
                            </div> 
                            <div class="full clearfix">
                                <span>Contact No</span>
                                <input name="em_contact" type="text" id="em_contact" class="txt" />
                            </div>
                            <div class="full clearfix">
                                <span>Email</span>
                                <input name="ec_email" type="email" id="ec_email" class="txt" />
                            </div> 
                            <div class="full clearfix">
                                <span></span>
                                <img id="hideid" src="<?php echo base_url() ?>images/No-Image-.jpg" alt="" style="width:100px">
                                <img id="preview" src="#" style="width:80px;height:80px" hidden>
                                
                            </div>   
                            <div class="full clearfix">
                                <span>Employee Image</span>
                                <input name="em_photo" type="file" id="em_photo" onchange="readURL(this)" class="txt"/>
                            </div>                                                                                                                                                         
                        </div>
                    </div>
                    <div class="section_content">
                        <div class="section_right clearfix">
                           <a  class="button btn-info"  href="<?php echo base_url();?>">Cancel</a>
                            <input type="button" onclick="Employee_submit()" name="btnSubmit" value="Save"  title="Save" class="button" />
                        </div>
    
                    </div>
                </form>