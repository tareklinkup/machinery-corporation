<form method="post" enctype="multipart/form-data">
                    <div id="tabs-1">
                        <div class="middle_form">
                            <h2 id="ctl00_ctl00_content_content_h2">Company Logo</h2>
                            <div class="body">
                                 <div class="full clearfix">
                                    <span></span>
                                    <div class="left"> 
                                         <?php if($selected['Company_Logo_thum'] !="") {?>
                                    <img id="hideid" src="<?php echo base_url().'uploads/company_profile_thum/'.$selected['Company_Logo_thum'];?>" alt="" style="width:100px">
                                    <?php } else{ ?>
                                    <img id="hideid" src="<?php echo base_url() ?>images/No-Image-.jpg" alt="" style="width:100px">
                                    <?php } ?>
                                        <img id="preview" src="#" style="width:100px;height:100px" hidden>
                                    </div>
                                </div>
                                <div class="full clearfix">
                                    <span>Select Logo</span>
                                    <div class="left">                                      
                                        <input name="companyLogo" id="companyLogo" type="file"  onchange="readURL(this)"  id="companyLogo" class="txt" />
                                    </div>
                                </div>
                                                                                                                                                                              
                            </div>
                        </div>
                        <div class="right_form">
                            <div class="body">
                                <div class="full clearfix">
                                    <span>Company Name</span>
                                    <input name="Company_name" type="text" id="Company_name" value="<?php echo $selected['Company_Name'] ?>" class="txt" />
                                    <input name="iidd" type="hidden" id="iidd" value="<?php echo $selected['Company_SlNo'] ?>" class="txt" />
                                </div>
                                
                                <div class="full clearfix">
                                    <span>Description</span>
                                    <textarea name="Description" class="txt" rows="4" cols="2" id="Description" style="border-color:#C8D3DF;height:100px; width:232px"><?php echo $selected['Repot_Heading'] ?></textarea>
                                </div>  
                                <div class="full clearfix">
                                    <span></span>
                                    <input type="submit" value="Save" class="button"/>
                                </div>                                                                                                                                                                          
                            </div>
                        </div>
                    </div>
                </form>