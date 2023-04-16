<div class="content_scroll">
    <div class="tabContent">
        <div id="tabs" class="clearfix moderntabs">
            <div id="tabs-1">
               <form action="<?php echo base_url() ?>page/unitupdate" method="post" >
                    <div class="middle_form">
                        <h2 id="">Edit Unit</h2>
                        <div class="body">
                            <div class="full clearfix">
                                <span>Unit Name</span>
                                <div class="left">                                      
                                    <input name="unitname" type="text" id="unitname" class="required" value="<?php echo $selected['Unit_Name'] ?>" autofocus="" required/>
                                    <input name="id" type="hidden" value="<?php echo $selected['Unit_SlNo'] ?>" />
                                </div>
                            </div>
                            <div class="full clearfix">
                                <div class="section_right clearfix">
                                <a href="<?php echo base_url(); ?>page/unit" class="button">Cancel</a>
                                    <input type="submit" name="btnSubmit" value="Update"  title="Save" class="button" />
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
