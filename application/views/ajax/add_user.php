<div id="tabs" class="clearfix">
                        <ul class="tabs">
                            <li><a href="#tabs-1"><span class="general">General</span></a></li>
                        </ul>
                        
                            <div id="tabs-1">
                                <div class="clearfix">
                                     <?php if(isset($exists)){?>
                                        <div class="error">
                                            <span><?php echo $exists; ?></span>
                                        </div><?php } ?>
                                    <div class="row_section clearfix">
                                        <div class="section_info">
                                            <strong>Login Credentials</strong>
                                            <i>Credentials used to log-in to the POS System</i>
                                        </div>
                                        <div class="section_content">
                                            <div class="section_full clearfix">
                                                <div class="section_full">
                                                    <strong>Username</strong>
                                                    <input name="username" type="text" id="username" class="txt" required/>
                                                </div>
                                                
                                            </div>
                                            <div class="section_full clearfix">
                                                <div class="section_left">
                                                    <strong>Password</strong>
                                                    <input name="Password" type="password" id="assword" class="txt" required/>
                                                </div>
                                                <div class="section_right">
                                                    <strong>Re-Password</strong>
                                                    <input name="rePassword" onblur="password()" type="password" id="rePassword" class="txt" required/>
                                                </div>
                                                
                                            </div>
                                            <span id="mes"></span>
                                        </div>
                                    </div>
                                    <div class="row_section clearfix">
                                        <div class="section_info">
                                            <strong>Personnel Information</strong>
                                            <i>Basic information regarding the personnel's identity</i>
                                        </div>
                                        <div class="section_content">
                                            <div class="section_full clearfix">
                                                <div class="section_full">
                                                    <strong>Full Name</strong>
                                                    <input name="txtFirstName" type="text" id="txtFirstName" class="txt" required />
                                                </div>
                                                
                                            </div>
                                            <div class="section_full clearfix">
                                                <div class="section_left">
                                                    <strong>Select Branch</strong>
                                                    <select name="Brunch" id="Brunch" class="txt" required>
                                                        <option value=""></option>
                                                        <?php $sql = mysql_query("SELECT * FROM tbl_brunch order by Brunch_name asc ");
                                                        while($row = mysql_fetch_array($sql)){ ?>
                                                        <option value="<?php echo $row['brunch_id'] ?>"><?php echo $row['Brunch_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row_section clearfix">
                                        <div class="section_info">
                                            <strong>Type</strong>
                                        </div>
                                        <div class="section_content">
                                            <div class="section_left clearfix">
                                                <select name="type" id="type" class="txt" required>
                                                    <option value=""></option>
                                                    <option value="a">Admin</option>
                                                    <option value="u">User</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                     <div class="row_section clearfix">
                                        <div class="section_info">
                                        </div>
                                        <div class="section_content">
                                            <div class="section_right clearfix">
                                               <a  class="button btn-info"  href="<?php echo base_url();?>user_management">Cancel</a>
                                                <input type="button" onclick="submit()" name="btnSubmit" value="Save"  title="Save" class="button" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>