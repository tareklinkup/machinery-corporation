<div class="content_scroll">
    <div class="tabContent">
        <div id="tabs" class="clearfix moderntabs">
            <div id="tabs-1">
               <form action="<?php echo base_url() ?>page/districtupdate" method="post" >
                    <div class="middle_form">
                        <h2>Edit District</h2>
                        <div class="body">
                            <div class="full clearfix">
                                <span>District Name</span>
                                <div class="left">                                      
                                    <input name="District" type="text" id="District" class="required" value="<?php echo $selected['District_Name'] ?>" autofocus="" />
                                    <input name="id" type="hidden" value="<?php echo $selected['District_SlNo'] ?>"/>
                                </div>
                            </div>
                            <div class="full clearfix">
                                <div class="section_right clearfix">
                                <a href="<?php echo base_url(); ?>page/district" class="button">Cancel</a>
                                    <input type="submit" name="btnSubmit" value="Update"  title="Update" class="button" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
