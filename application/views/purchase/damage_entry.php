<span id="ProductsResult">
<div class="content_scroll">
    <div id="page_menu" class="page_menu">
        <ul>
            <li class="active"><a href="damage_entry.php">Damage Entry</a></li>
        </ul>
    </div>
    <div class="tabContent">
        <div id="tabs" class="clearfix moderntabs">
            <div id="tabs-1">
                <div class="middle_form">
                    <h2 id="ctl00_ctl00_content_content_h2">Damage Entry</h2>
                    <div class="body">
                        <div class="full clearfix">
                            <span>Damage ID</span>
                            <div class="left">                                    
                                <input type="text" class="required" disabled="" value="<?php $serial ="D1000"; $sql = mysql_query("SELECT * FROM sr_damage");
                                    while ($d = mysql_fetch_array($sql)){
                                        if($d['Damage_InvoiceNo']!=null){$serial = $d['Damage_InvoiceNo'];}
                                    } $serial = explode("D",$serial);
                                        $serial=$serial['1']; $autoserial= $serial+1;echo "D".$autoserial;?>" />
                                <input type="hidden" id="damage_id" class="required" value="<?php $serial ="D1000"; $sql = mysql_query("SELECT * FROM sr_damage");
                                    while ($d = mysql_fetch_array($sql)){
                                        if($d['Damage_InvoiceNo']!=null){$serial = $d['Damage_InvoiceNo'];}
                                    } $serial = explode("D",$serial);
                                        $serial=$serial['1']; $autoserial= $serial+1;echo "D".$autoserial;?>" />
                            </div>
                        </div>
                        <div class="full clearfix">
                            <span>Product Name</span>
                            <div class="left">    
                                <select id="prod_id" class="required" style="width:174px" >
                                    <option value="" selected=""></option>
                                        <?php $sql = mysql_query("SELECT * from tbl_product order by Product_Code asc");
                                        while($row = mysql_fetch_array($sql)){ ?>
                                    <option value="<?php echo $row['Product_SlNo'] ?>"><?php echo $row['Product_Name'] ?></option>
                                        <?php } ?>
                                </select>                                
                            </div>
                        </div>                                                                 
                    
                           <div id="unitname">                                      
                               <input type="hidden" id="unit_name" class="txt" />
                           </div>
                        <div class="full clearfix">
                            <span>Damage Quantity</span>
                            <div class="left">                                      
                                <input name="damage_quantity" type="text" id="damage_quantity" class="txt" placeholder="0"/>
                            </div>
                        </div>                                                                                                                                                       
                        <div class="full clearfix">
                            <span>Description</span>
                            <div class="left">                                      
                                <input name="desc" type="text" id="desc" class="required" placeholder="" autofocus="" />
                            </div>
                        </div> 
                        <div class="full clearfix">
                            <span></span>
                           <div class="right" style="float:right;">
                                <input type="button" onclick="DamageProducts()" value="Add" class="button" style="margin-left:40px"/>
                            </div>   
                        </div>               
                    </div>
                </div>
       
            </div>
        </div>
    </div>

    <div class="row_section clearfix" style="margin-top:20px;padding-bottom:0px;">
        <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="width:60%;border-collapse:collapse;">
            <thead>
                <tr class="header">
                    <th style="width:10%">Product Name</th>
                    <th style="width:10%">Damage Quantity</th>
                    <th style="width:10%">Unit</th>
                    <th style="width:10%">Description</th>                                                               
                </tr>
            </thead>
        </table>                    
    </div>                
    <div class="row_section clearfix" style="height:300px;overflow:auto;">
        <table class="zebra" cellspacing="0" cellpadding="0" border="0" id="" style="text-align:left;width:60%;border-collapse:collapse;">
            <tbody>
            <?php $sql = mysql_query("SELECT sr_damage.*,sr_damagedetails.*,tbl_product.*, sr_unit.* FROM sr_damage left join sr_damagedetails on sr_damagedetails.Damage_SlNo = sr_damage.Damage_SlNo left join tbl_product on tbl_product.Product_SlNo= sr_damagedetails.Product_SlNo left join sr_unit on sr_unit.Unit_SlNo = tbl_product.Unit_ID ORDER BY sr_damage.Damage_InvoiceNo DESC");
                while($row = mysql_fetch_array($sql)){ ?>
                <tr>
                    <td style="width:10%"><?php echo $row['Product_Name'] ?></td>
                    <td style="width:10%"><?php echo $row['DamageDetails_DamageQuantity'] ?></td>
                    <td style="width:10%"><?php echo $row['Unit_Name'] ?></td>
                    <td style="width:10%"><?php echo $row['Damage_Description'] ?></td>
                </tr>
            <?php } ?>                                                                                                                                                                                                                                                                                                                                                                                        
            </tbody>
        </table>
    </div>              
</div>
</div>
</span>
<script type="text/javascript">
    function Products_select()   {
        var prod_id = $("#prod_id").val();
        var inputdata = 'prod_id='+prod_id;
        var urldata = "<?php echo base_url(); ?>purchase/damage_select_product";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#unitname").html(data);
            }
        });
        
    }
    function DamageProducts()   {
        var damage_id = $("#damage_id").val();
        var prod_id = $("#prod_id").val();
        var damage_quantity = $("#damage_quantity").val();
        var desc = $("#desc").val();
        var unit_name = $("#unit_name").val();

        var inputdata = 'damage_id='+damage_id+'&prod_id='+prod_id+'&damage_quantity='+damage_quantity+'&desc='+desc+'&unit_name='+unit_name;
        var urldata = "<?php echo base_url(); ?>purchase/damage_product_insert";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputdata,
            success:function(data){
                $("#ProductsResult").html(data);
            }
        });
        
    }
</script>
