
<div class="container">
    <div class="content_scroll">
        <table class="border" cellspacing="0" cellpadding="0" width="70%">
            <h4><a style="cursor:pointer" onclick="window.open('<?php echo base_url(); ?>reports/sales_stock', 'newwindow', 'width=850, height=800,scrollbars=yes'); return false;"><img src="<?php echo base_url(); ?>images/printer.png" alt=""> Print</a></h4>
            <tr bgcolor="#89B03E">
                <th>Category</th>
                <th>ID</th>
                <th>Product Name</th>
                <th>Sales Qty</th>
                <th>Return Qty</th>
                <th>Damage Qty</th>
                <th>Unit</th>
            </tr>
            <?php 
            $sql = mysql_query("SELECT sr_saleinventory.*,tbl_product.*,sr_unit.*,sr_productcategory.* FROM sr_saleinventory left join tbl_product on tbl_product.Product_SlNo= sr_saleinventory.sellProduct_IdNo left join sr_unit on sr_unit.Unit_SlNo = tbl_product.Unit_ID left join sr_productcategory on sr_productcategory.ProductCategory_SlNo = tbl_product.ProductCategory_ID");
            while($record = mysql_fetch_array($sql)){?>
            <tr>
                <td><?php echo $record['ProductCategory_Name'] ?></td>
                <td><?php echo $record['Product_Code'] ?></td>
                <td><?php echo $record['Product_Name'] ?></td>
                <td><?php echo $record['SaleInventory_TotalQuantity'] ?></td>
                <td><?php echo $record['SaleInventory_ReturnQuantity'] ?></td>
                <td><?php echo $record['SaleInventory_DamageQuantity'] ?></td>
                <td><?php echo $record['Unit_Name'] ?></td>
            </tr>
            <?php } ?>
        </table>
    	
    </div>
</div>