<nav>
    <ul>
        <li class="selected">
            <a class="dashboard" href="<?php echo base_url() ?>"><i ></i><span>Dashboard</span></a>
        </li>
    </ul>
    
    <strong>Point of Sales</strong>
    <?php
        $userType = $this->session->userdata('accountType');
        if($userType == 'Warehouse Manager'){
    ?>
    <ul>
        <li>
            <div id='cssmenu'>
                <ul>
                    <li class='active'>
                        <a class="dashboard" href="<?php echo base_url('warehouse/pending_order') ?>"><i ></i><span>Pending Order</span></a>
                    </li>
                    <li class='active'>
                        <a class="dashboard" href="<?php echo base_url('warehouse/current_stock') ?>"><i ></i><span>Current Stock</span></a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
    <?php
        }else{
    ?>
    
    
    <ul>
        <li>
            <div id='cssmenu'>
                <ul>
                    <li class='active'><a href='<?php echo base_url(); ?>sales'><span style="font-weight:bold">Sales</span></a></li>
                    <li class='active'><a href='<?php echo base_url(); ?>sales/salesreturn'><span style="font-weight:bold">Sales Return</span></a></li>
                    <li class='active'><a href='<?php echo base_url(); ?>quotation'><span style="font-weight:bold">Quotation</span></a></li>
                    <li class='active'><a href='<?php echo base_url(); ?>quotation/quotation_invoice'><span style="font-weight:bold">Quotation Invoice</span></a></li>
                    <li class='active'><a href='<?php echo base_url(); ?>transfer'><span style="font-weight:bold">Product Transfer</span></a></li>
                    <li class='active'><a href='<?php echo base_url(); ?>purchase/order'><span style="font-weight:bold">Purchase </span></a></li>
                    <li class='active'><a href='<?php echo base_url(); ?>purchase/returns'><span style="font-weight:bold">Purchase Return</span></a></li>
                    <li class='active'><a href='<?php echo base_url(); ?>products/current_stock'><span style="font-weight:bold">Current Stock</span></a></li>
                    <li class='active'><a href='<?php echo base_url() ?>account/cash_transaction'><span style="font-weight:bold">Cash Transaction</span></a></li>
                </ul>
            </div>         
        </li>
    </ul>
    <br>
    <strong>Others</strong>
    <ul>
        
        <li>
            <div id='cssmenu'>
                <ul>
                    <li class='active'><a href='<?php echo base_url(); ?>supplier'><span> Add Supplier</span></a>
                    </li>
                </ul>
            </div>                      
        </li>
        <li>
            <div id='cssmenu'>
                <ul>
                    <li class='active'><a href='<?php echo base_url(); ?>customer'><span> Add Customer</span></a></li>
                </ul>
            </div>                      
        </li>        
        <li>
            <div id='cssmenu'>
                <ul>
                    <li class='active has-sub'><a href='#'><span>Purchase</span></a>
                        <ul>
                            <li><a href='<?php echo base_url(); ?>purchase/order'><span>Purchase Order</span></a></li>
                            <li><a href='<?php echo base_url(); ?>purchase/returns'><span>Purchase Return</span></a></li>
                            <li ><a href='<?php echo base_url(); ?>purchase/damage_entry'><span>Damage Entry</span></a></li>
                            <li ><a href='<?php echo base_url(); ?>purchase/purchase_stock'><span>Purchase Stock</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>                    
        </li>
        <li>
            <div id='cssmenu'>
                <ul>
                    <li class='active has-sub'><a href='#'><span>Sales</span></a>
                        <ul>
                            <li><a href='<?php echo base_url(); ?>sales'><span>Product Sales</span></a></li>
                            <li><a href='<?php echo base_url(); ?>sales/salesreturn'><span>Sales Return</span></a></li>
                            <li><a href='<?php echo base_url(); ?>sales/sales_stock'><span>Sales Stock</span></a></li>
                            <li><a href='<?php echo base_url(); ?>sales/sales_record_byCategory'><span>Category Sales</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>         
        </li> 
        <!-- <li>
            <div id='cssmenu'>
                <ul>
                    <li class='active has-sub'><a href='#'><span>Sales By Check</span></a>
                        <ul>
                            <li><a href='<?php echo base_url(); ?>sales/cashed_check'><span>Cashed Check</span></a></li>
                            <li><a href='<?php echo base_url(); ?>sales/pending_check'><span>Pending Check</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>         
        </li> -->
        <li>
            <div id='cssmenu'>
                <ul>
                    <li class='active has-sub'><a href='#'><span>Accounts</span></a>
                        <ul>
                            <li><a href='<?php echo base_url() ?>account/cash_transaction'><span>Cash Transaction</span></a></li>
                            <!-- <li><a href='<?php echo base_url() ?>account/'><span>Cash View </span></a></li> -->
                            <li><a href='<?php echo base_url() ?>account'><span>Add Account</span></a></li>                           
                        </ul>
                    </li>
                </ul>
            </div>         
          </li>               
        <li>
            <div id='cssmenu'>
                <ul>
                    <li class='active has-sub'><a href='#'><span>Employee</span></a>
                        <ul>
                            <li><a href='<?php echo base_url(); ?>employee'><span>Add Employee</span></a></li>
                            <li><a href='<?php echo base_url(); ?>employee/emplists'><span>Employee List</span></a></li>
                            <li ><a href='<?php echo base_url(); ?>employee/designation'><span>Add Designation</span></a></li>
                            <li ><a href='<?php echo base_url(); ?>employee/depertment'><span>Add Department</span></a></li> 
                        </ul>
                    </li>
                </ul>
            </div>             
        </li>
        <li>
            <div id='cssmenu'>
                <ul>
                    <li class='active has-sub'><a href='#'><span>Reports</span></a>
                        <ul>
                            <li class='active'>
                                <a style="cursor:pointer" onclick="window.open('<?php echo base_url(); ?>reports/supplierList', 'newwindow', 'width=850, height=800,scrollbars=yes'); return false;"><span>Supplier List</span></a>
                            </li>
                            <li class='active'>
                                <a style="cursor:pointer" onclick="window.open('<?php echo base_url(); ?>reports/customerlist', 'newwindow', 'width=850, height=800,scrollbars=yes'); return false;"><span>Customer List</span></a>
                            </li>
                            
                            <li class='active'>
                                <a style="cursor:pointer" href="<?php echo base_url(); ?>invoice_delete"><span>Sales Invoice Delete</span></a>
                            </li>
                            <li class='active has-sub'>
                                <a href='#'><span>Warehouse Sales</span></a>
                                <ul>
                                   <li>
                                        <a href='<?php echo base_url(); ?>warehouse/pending_order'><span>Pending Order</span></a>
                                   </li>
                                   <li>
                                        <a href='#'><span>deliveryed Order</span></a>
                                   </li>                                      
                                </ul>                                  
                            </li>
                            <li class='active has-sub'>
                                <a href='#'><span>Sales</span></a>
                                <ul>
                                    <li>
                                        <a href='<?php echo base_url(); ?>sales/sales_invoice'><span>Sales Invoice</span></a>
                                    </li>
                                    <li>
                                        <a href='<?php echo base_url(); ?>sales/sales_invoice_due'><span>Sales Invoice (Due)</span></a>
                                    </li>
                                    <li>
                                        <a href='<?php echo base_url(); ?>customer/customer_due'><span>Customer Due Report</span></a>
                                    </li>
                                    <li>
                                        <a href='<?php echo base_url(); ?>customer/customer_payment_report'><span>Customer Payment </span></a>
                                    </li>
                                    <li>
                                        <a href='<?php echo base_url(); ?>sales/sales_record'><span>Sales Record</span></a>
                                    </li>
                                    <li>
                                        <a href='<?php echo base_url(); ?>sales/return_list'><span>Sales Return List</span></a>
                                    </li>
                                    <!-- <li>                     <a href='#'><span>Profit/Lose By Sales</span></a></li>  -->                       
                                </ul>                                 
                            </li> 
                            <li class='active has-sub'>
                                <a href='#'><span>Purchase</span></a>
                                <ul>
                                    <li>
                                        <a href='<?php echo base_url(); ?>purchase/purchase_bill'><span>Purchase Bill</span></a>
                                    </li>
                                    <li>
                                        <a href='<?php echo base_url(); ?>supplier/supplier_due'><span>Supplier Due Report</span></a>
                                    </li>
                                    <li>
                                        <a href='<?php echo base_url(); ?>supplier/supplier_payment_report'><span>Supplier Payment </span></a>
                                    </li>
                                    <li>
                                        <a href='<?php echo base_url(); ?>purchase/purchase_record'><span>Purchase Record</span></a>
                                    </li>
                                    <li>
                                        <a href='<?php echo base_url(); ?>purchase/returns_list'><span>Purchase Return List</span></a>
                                    </li>                                                                                                                
                                </ul>                                 
                            </li>
                            <li class='active has-sub'>
                                <a href='#'><span>Accounts</span></a>
                                <ul>
                                   <li>
                                        <a href='<?php echo base_url(); ?>account/expense'><span>Expense View</span></a>
                                   </li>
                                   <li>
                                        <a href='<?php echo base_url(); ?>account/cash_view'><span>Cash View</span></a>
                                   </li>
                                   <!--<li>
                                        <a href='#'><span>Official Statement</span></a>
                                   </li>
                                    <li>                     <a href='#'><span>Profit/Lose Statement</span></a></li> -->                                                                                                              
                                </ul>                                 
                            </li> 
                            <li class='active '>
                                <a style="cursor:pointer" onclick="window.open('<?php echo base_url(); ?>reports/employeelist', 'newwindow', 'width=850, height=800,scrollbars=yes'); return false;">Employee List</a>
                            </li> 
                           <!--  <li class='active has-sub'>
                              <a href='#'><span>Others</span></a>
                              <ul>
                                 <li>
                                      <a href='#'><span>Product List</span></a>
                                 </li>
                                 <li>
                                      <a href='#'><span>Re-order List</span></a>
                                 </li>                                     
                              </ul>                                
                          </li>  -->                                                                                                   
                        </ul>
                    </li>
                </ul>
            </div>             
        </li>
        <li>
            <div id='cssmenu'>
                <ul>
                    <li class='active has-sub'><a href='#'> <i class="icon ti-settings"></i> <span>Settings</span></a>
                        <ul>
                            <li><a href='<?php echo base_url(); ?>page/add_category'><span>Add Category</span></a></li>
                            <li><a href='<?php echo base_url(); ?>products'><span>Add Product</span></a></li>
                            <!-- <li><a href='<?php echo base_url(); ?>page/company_profile'><span>Company Profile</span></a></li> -->
                            <li><a href='<?php echo base_url(); ?>user_management'><span>User Profile</span></a></li>
                            <li><a href='<?php echo base_url(); ?>page/unit'><span>Add Unit</span></a></li> 
                            <!-- <li><a href='<?php echo base_url(); ?>barcode/generate_barcode'><span>Generate Barcode</span></a></li>  -->
                            </li> 
                            <!-- <li class='active has-sub'>
                                <a href='#'><span>Package</span></a>
                                <ul>
                                    <li>
                                        <a href='<?php echo base_url(); ?>package'><span>Package Name</span></a>
                                    </li>
                                    <li>
                                        <a href='<?php echo base_url(); ?>package/create'><span>Package Create</span></a>
                                    </li>
                                </ul>                                 
                            </li> -->
                            <!-- <li><a href='<?php echo base_url(); ?>page/brunch'><span>Add Branch</span></a></li>  -->
                            <li><a href='<?php echo base_url(); ?>page/district'><span>Add District</span></a></li> 
                            <li><a href='<?php echo base_url(); ?>page/add_country'><span>Add Country</span></a></li>
                            <!-- <li><a href='<?php echo base_url(); ?>'><span>Database Backup</span></a></li> -->                               
                        </ul>
                    </li>
                </ul>
            </div>             
        </li>
        <!-- <li>
            <div id='cssmenu'>
                <ul>
                    <li class='active has-sub'><a href='#'><span>Tools</span></a>
                        <ul>
                            <li><a href='#'><span>Calculator</span></a></li>
                            <li><a href='#'><span>Notepad</span></a></li>
                            <li><a href='#'><span>Task Manager</span></a></li>
                            <li><a href='#'><span>MS Word</span></a></li>                            
                        </ul>
                    </li>
                </ul>
            </div>             
        </li> -->
        <li>
            <div id='cssmenu'>
                <ul>
                    <li class='active has-sub'><a href='#'><span>Help</span></a>
                        <ul>
                            <!-- <li><a href='http://linktechbd.com' target="_blank"><span>Online Support</span></a></li> -->
                            <li><a href='<?php echo base_url(); ?>page/about_us'><span>About Us</span></a></li>                          
                        </ul>
                    </li>
                </ul>
            </div>             
        </li>                                               
    </ul>
    
    <?php
        }
    ?>
</nav>