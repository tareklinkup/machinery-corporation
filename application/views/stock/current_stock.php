<link href="<?php echo base_url()?>css/prints.css" rel="stylesheet" />
<div class="content_scroll" style="padding:120px 20px 25px 160px">
<h2>Current Stock Search</h2>
<div style="width:100%; float:left;">
    <div style="border:1px solid #ddd">
        <table > 
            <tr>
                <td><strong>Store</strong></td>
                <td> 
                    <select id="Store" class="inputclass" style="width:200px">
                        <option value=""> Select Store </option>
                        <option value="Shop"> Shop </option>
                        <option value="Warehouse"> Warehouse </option>
                        <option value="Warehouse2"> Warehouse Two</option>
                    </select>
                </td>
                <td><strong>Category</strong></td>
                <td> 
                    <select id="CatID" class="inputclass" style="width:200px">
                        <option value=""> Select Category </option>
                        <?php $sql = mysql_query("SELECT * FROM sr_productcategory order by ProductCategory_Name asc");
                            while($row = mysql_fetch_array($sql)){ ?>
                            <option value="<?php echo $row['ProductCategory_SlNo'] ?>"><?php echo $row['ProductCategory_Name'] ?></option>
                            <?php } ?>
                    </select>
                </td>
                <td><input type="button" class="buttonAshiqe" onclick="searchforRecord()" value="Search"></td>
            </tr>
        </table>
    </div>
</div>


<span id="DisplayStock">
    
</span>
</div>
<script type="text/javascript">
    function searchforRecord(){
        var Store = $("#Store").val();
        var CatID = $("#CatID").val();
        var inputData = 'Store='+Store+'&CatID='+CatID;
        var urldata = "<?php echo base_url(); ?>products/search_stock";
        $.ajax({
            type: "POST",
            url: urldata,
            data: inputData,
            success:function(data){
                $("#DisplayStock").html(data);
            }
        });
    }
</script>