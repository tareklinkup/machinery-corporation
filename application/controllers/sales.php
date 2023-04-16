<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $access = $this->session->userdata('userId');
         if($access == '' ){
            redirect("login");
        }
        $this->load->model('billing_model');
        $this->load->library('cart');
        $this->load->model('model_table', "mt", TRUE);
        $this->load->helper('form');
    }
    public function index()  {
        $this->cart->destroy();
        $data['title'] = "Product Sales";
        $data['content'] = $this->load->view('sales/product_sales', $data, TRUE);
        $this->load->view('index', $data);
    }
    function selectCustomer()  {
        $data['cid'] = $this->input->post('cid');
        $this->load->view('sales/ajax_customer', $data);
    }
    function SelectProducts()  {
        $data['ProID'] = $this->input->post('ProID');
        $data['SalesFrom'] = $this->input->post('SalesFrom');
        $this->load->view('sales/ajax_product', $data);
    }
    public function sales_order_wh(){
        $sales = array(
            "SaleMaster_InvoiceNo"         =>$this->input->post('salesInvoiceno'),
            "SalseCustomer_IDNo"           =>$this->input->post('customerID'),
            "SaleMaster_SaleDate"          =>$this->input->post('sales_date'),
            "SaleMaster_Description"       =>$this->input->post('SelesNotes'),
            "SaleMaster_TotalSaleAmount"   =>$this->input->post('SellTotals'),
            "SaleMaster_TotalDiscountAmount"=>$this->input->post('SellsDiscount'),
            "SaleMaster_TaxAmount"          =>$this->input->post('vatPersent'),
            "SaleMaster_Freight"            =>$this->input->post('SellsFreight'),
            "SaleMaster_SubTotalAmount"     =>$this->input->post('subTotal'),
            "SaleMaster_PaidAmount"         =>$this->input->post('SellsPaid'),
            "SaleMaster_DueAmount"          =>$this->input->post('SellsDue'),
            "AddBy"                        =>$this->session->userdata("FullName"),
            "AddTime"                      =>date("Y-m-d h:i:s")
        );     
        $wh_id = $this->billing_model->WHSalesOrder($sales);

        $data = array(
            "CPayment_date"                     =>$this->input->post('sales_date', TRUE),
            "CPayment_invoice"                  =>$this->input->post('salesInvoiceno', TRUE),
            "CPayment_customerID"               =>$this->input->post('customerID', TRUE),
            "CPayment_amount"                   =>$this->input->post('SellsPaid', TRUE),
            "CPayment_notes"                    =>$this->input->post('SelesNotes', TRUE),
            "CPayment_Addby"                    =>$this->session->userdata("FullName"),
            "CPayment_AddTime"                 =>date("Y-m-d h:i:s")
        );
        $this->mt->save_data("sr_customer_payment", $data);

        if ($cart = $this->cart->contents()){
            foreach ($cart as $item){
                $order_detail = array(
                    'WHMaster_IDNo'               => $wh_id,
                    'Product_IDNo'                => $item['id'],
                    'SaleDetails_TotalQuantity'   => $item['qty'],
                    'SaleDetails_Rate'            => $item['price'],
                    'SaleDetails_unit'            => $item['image'],
                    'Purchase_Rate'               => $item['purchaserate']
                );
                $this->billing_model->insert_wh_details($order_detail);
            }//end foreach
        }//end if

        $this->cart->destroy();
        $sss['lastwhid'] = $wh_id;
        $this->session->set_userdata($sss);
        $this->load->view('sales/product_sales');

    }
    public function sales_order(){
    	$maxid = mysql_result(mysql_query("SELECT MAX(SaleMaster_SlNo) FROM sr_salesmaster"), 0);
        $sn = ($maxid+1);
        $salesInvoiceno = date('Y-m-d')."-".str_pad($sn, 2, "0", STR_PAD_LEFT);
                        
        $SalesFrom = $this->input->post('SalesFrom');
        if($SalesFrom == 'Shop'){
        $customerID = $this->input->post('customerID');
        if($customerID == '0'){
            $sales = array(
                "SaleMaster_InvoiceNo"         =>$salesInvoiceno,
                "SalseCustomer_IDNo"           =>$this->input->post('customerID'),
                "SalseCustomer_Name"           =>$this->input->post('CusName'),
                "SalseCustomer_Contact"           =>$this->input->post('CusMobile'),
                "SalseCustomer_Address"           =>$this->input->post('CusAddress'),
                "SaleMaster_Chalan_No"           =>$this->input->post('chalan_no'),
                "SaleMaster_SaleDate"          =>$this->input->post('sales_date'),
                "SaleMaster_Description"       =>$this->input->post('SelesNotes'),
                "SaleMaster_SaleType"          =>$this->input->post('SalesFrom'),
                "SaleMaster_TotalSaleAmount"   =>$this->input->post('SellTotals'),
                "SaleMaster_TotalDiscountAmount"=>$this->input->post('SellsDiscount'),
                "SaleMaster_TaxAmount"          =>$this->input->post('vatPersent'),
                "SaleMaster_Freight"            =>$this->input->post('SellsFreight'),
                "SaleMaster_SubTotalAmount"     =>$this->input->post('subTotal'),
                "SaleMaster_PaidAmount"         =>$this->input->post('SellsPaid'),
                "SaleMaster_DueAmount"          =>$this->input->post('SellsDue'),
                "SaleMaster_Dalivery_Status"    =>'D',
                "AddBy"                        =>$this->session->userdata("FullName"),
                "AddTime"                      =>date("Y-m-d h:i:s")
            );
        }else{
            $sales = array(
                "SaleMaster_InvoiceNo"         =>$salesInvoiceno,
                "SalseCustomer_IDNo"           =>$this->input->post('customerID'),
                "SaleMaster_Chalan_No"           =>$this->input->post('chalan_no'),
                "SaleMaster_SaleDate"          =>$this->input->post('sales_date'),
                "SaleMaster_Description"       =>$this->input->post('SelesNotes'),
                "SaleMaster_SaleType"          =>$this->input->post('SalesFrom'),
                "SaleMaster_TotalSaleAmount"   =>$this->input->post('SellTotals'),
                "SaleMaster_TotalDiscountAmount"=>$this->input->post('SellsDiscount'),
                "SaleMaster_TaxAmount"          =>$this->input->post('vatPersent'),
                "SaleMaster_Freight"            =>$this->input->post('SellsFreight'),
                "SaleMaster_SubTotalAmount"     =>$this->input->post('subTotal'),
                "SaleMaster_PaidAmount"         =>$this->input->post('SellsPaid'),
                "SaleMaster_DueAmount"          =>$this->input->post('SellsDue'),
                "SaleMaster_Dalivery_Status"    =>'D',
                "AddBy"                        =>$this->session->userdata("FullName"),
                "AddTime"                      =>date("Y-m-d h:i:s")
            );
        }
      
      

        $sales_id = $this->billing_model->SalesOrder($sales);
        $data = array(
            "CPayment_date"                     =>$this->input->post('sales_date', TRUE),
            "CPayment_invoice"                  =>$salesInvoiceno,
            "CPayment_customerID"               =>$this->input->post('customerID', TRUE),
            "CPayment_amount"                   =>$this->input->post('SellsPaid', TRUE),
            "CPayment_notes"                    =>$this->input->post('SelesNotes', TRUE),
            "CPayment_Addby"                    =>$this->session->userdata("FullName")
        );
        $this->mt->save_data("sr_customer_payment", $data);
        
        if ($cart = $this->cart->contents()){
            foreach ($cart as $item){
                $order_detail = array(
                    'SaleMaster_IDNo'               => $sales_id,
                    'Product_IDNo'                  => $item['id'],
                    'SaleDetails_TotalQuantity'     => $item['qty'],
                    'SaleDetails_Rate'              => $item['price'],
                    'SaleDetails_unit'              => $item['image'],
                    'Purchase_Rate'                 => $item['purchaserate']
                );
                $this->billing_model->insert_sales_detail($order_detail);
                $srdata = array(
                    'Invoice' => $salesInvoiceno,
                    'Date' => $this->input->post('sales_date', TRUE),
                    'ProductID' => $item['id'],
                    'Store' => $this->input->post('SalesFrom'),
                    'StockType' => 'Product Sales',
                    'InQty' => 0,
                    'OutQty' => $item['qty']
                );
                $this->mt->save_data("tbl_stock_register",$srdata);
                $SalesFrom = $this->input->post('SalesFrom');
                // Stock add
                $sql = mysql_query("SELECT * FROM sr_saleinventory WHERE sellProduct_IdNo = '".$item['id']."' AND SaleInventory_Store = '".$SalesFrom."'");
                $rox = mysql_fetch_array($sql);
                $id = $rox['SaleInventory_SlNo'];
                $fld = 'SaleInventory_SlNo';
                $oldStock = $rox['SaleInventory_TotalQuantity'];

                if(($rox['sellProduct_IdNo'] == $item['id']) && ($rox['SaleInventory_Store'] == $SalesFrom)){
                    $addStock = array(
                        'sellProduct_IdNo'                      => $item['id'],
                        'SaleInventory_TotalQuantity'           => $oldStock+$item['qty']
                    );
                    $this->mt->update_data("sr_saleinventory",$addStock,$id,$fld);  
                }else{
                    $addStock = array(
                        'sellProduct_IdNo'                      => $item['id'],
                        'SaleInventory_Store'     => $SalesFrom,
                        'SaleInventory_TotalQuantity'           => $item['qty']
                    );
                $this->mt->save_data("sr_saleinventory",$addStock);
                } 
                
            }// end foreach
        }// end if

        }else{
            $customerID = $this->input->post('customerID');
            if($customerID == '0'){

                $sales = array(
                    "SaleMaster_InvoiceNo"         =>$salesInvoiceno,
                    "SalseCustomer_IDNo"           =>$this->input->post('customerID'),
                    "SalseCustomer_Name"           =>$this->input->post('CusName'),
                    "SalseCustomer_Contact"           =>$this->input->post('CusMobile'),
                    "SalseCustomer_Address"           =>$this->input->post('CusAddress'),
                    "SaleMaster_Chalan_No"           =>$this->input->post('chalan_no'),
                    "SaleMaster_SaleDate"          =>$this->input->post('sales_date'),
                    "SaleMaster_Description"       =>$this->input->post('SelesNotes'),
                    "SaleMaster_SaleType"          =>$this->input->post('SalesFrom'),
                    "SaleMaster_TotalSaleAmount"   =>$this->input->post('SellTotals'),
                    "SaleMaster_TotalDiscountAmount"=>$this->input->post('SellsDiscount'),
                    "SaleMaster_TaxAmount"          =>$this->input->post('vatPersent'),
                    "SaleMaster_Freight"            =>$this->input->post('SellsFreight'),
                    "SaleMaster_SubTotalAmount"     =>$this->input->post('subTotal'),
                    "SaleMaster_PaidAmount"         =>$this->input->post('SellsPaid'),
                    "SaleMaster_DueAmount"          =>$this->input->post('SellsDue'),
                    "SaleMaster_Dalivery_Status"    =>'P',
                    "AddBy"                        =>$this->session->userdata("FullName"),
                    "AddTime"                      =>date("Y-m-d h:i:s")
                );  
            }else{
                $sales = array(
                    "SaleMaster_InvoiceNo"         =>$salesInvoiceno,
                    "SalseCustomer_IDNo"           =>$this->input->post('customerID'),
                    "SaleMaster_Chalan_No"           =>$this->input->post('chalan_no'),
                    "SaleMaster_SaleDate"          =>$this->input->post('sales_date'),
                    "SaleMaster_Description"       =>$this->input->post('SelesNotes'),
                    "SaleMaster_SaleType"          =>$this->input->post('SalesFrom'),
                    "SaleMaster_TotalSaleAmount"   =>$this->input->post('SellTotals'),
                    "SaleMaster_TotalDiscountAmount"=>$this->input->post('SellsDiscount'),
                    "SaleMaster_TaxAmount"          =>$this->input->post('vatPersent'),
                    "SaleMaster_Freight"            =>$this->input->post('SellsFreight'),
                    "SaleMaster_SubTotalAmount"     =>$this->input->post('subTotal'),
                    "SaleMaster_PaidAmount"         =>$this->input->post('SellsPaid'),
                    "SaleMaster_DueAmount"          =>$this->input->post('SellsDue'),
                    "SaleMaster_Dalivery_Status"    =>'P',
                    "AddBy"                        =>$this->session->userdata("FullName"),
                    "AddTime"                      =>date("Y-m-d h:i:s")
                );
            }   
            $sales_id = $this->billing_model->SalesOrder($sales);
            $data = array(
                "CPayment_date"                     =>$this->input->post('sales_date', TRUE),
                "CPayment_invoice"                  =>$salesInvoiceno,
                "CPayment_customerID"               =>$this->input->post('customerID', TRUE),
                "CPayment_amount"                   =>$this->input->post('SellsPaid', TRUE),
                "CPayment_notes"                    =>$this->input->post('SelesNotes', TRUE),
                "CPayment_Addby"                    =>$this->session->userdata("FullName")
            );
            $this->mt->save_data("sr_customer_payment", $data);

            if ($cart = $this->cart->contents()){
                foreach ($cart as $item){
                    $order_detail = array(
                        'SaleMaster_IDNo'               => $sales_id,
                        'Product_IDNo'                  => $item['id'],
                        'SaleDetails_TotalQuantity'     => $item['qty'],
                        'SaleDetails_Rate'              => $item['price'],
                        'SaleDetails_unit'              => $item['image'],
                        'Purchase_Rate'                 => $item['purchaserate']
                    );
                    $this->billing_model->insert_sales_detail($order_detail);
                    
                    $srdata = array(
                        'Invoice' => $salesInvoiceno,
                        'Date' => $this->input->post('sales_date', TRUE),
                        'ProductID' => $item['id'],
                        'Store' => $this->input->post('SalesFrom'),
                        'StockType' => 'Product Sales',
                        'InQty' => 0,
                        'OutQty' => $item['qty']
                    );
                    $this->mt->save_data("tbl_stock_register",$srdata);
                    $SalesFrom = $this->input->post('SalesFrom');
                    // Stock add
                    $sql = mysql_query("SELECT * FROM sr_saleinventory WHERE sellProduct_IdNo = '".$item['id']."' AND SaleInventory_Store = '".$SalesFrom."'");
                    $rox = mysql_fetch_array($sql);
                    $id = $rox['SaleInventory_SlNo'];
                    $fld = 'SaleInventory_SlNo';
                    $oldStock = $rox['SaleInventory_TotalQuantity'];

                    if(($rox['sellProduct_IdNo'] == $item['id']) && ($rox['SaleInventory_Store'] == $SalesFrom)){
                        $addStock = array(
                            'sellProduct_IdNo'                      => $item['id'],
                            'SaleInventory_TotalQuantity'           => $oldStock+$item['qty']
                        );
                        $this->mt->update_data("sr_saleinventory",$addStock,$id,$fld);  
                    }else{
                        $addStock = array(
                            'sellProduct_IdNo'                      => $item['id'],
                            'SaleInventory_Store'     => $SalesFrom,
                            'SaleInventory_TotalQuantity'           => $item['qty']
                        );
                    $this->mt->save_data("sr_saleinventory",$addStock);
                    }
                }
            }

        }

        $this->cart->destroy();
        $sss['lastwhid'] = $sales_id;
        $this->session->set_userdata($sss);
        $this->load->view('sales/product_sales');
    }
    public function sales_order_update(){
        $sales = array(
            "SaleMaster_SlNo"              =>$this->input->post('saleMasterId'),
            "SaleMaster_InvoiceNo"         =>$this->input->post('salesInvoiceno'),
            "Po_No"                        =>$this->input->post('pono'),
            "Delevary_Invoice_No"       =>$this->input->post('delevaryInvoiceNo'),
            "SalseCustomer_IDNo"              =>$this->input->post('customerID'),
            "SaleMaster_Chalan_No"           =>$this->input->post('chalan_no'),
            "SaleMaster_SaleDate"             =>$this->input->post('sales_date'),
            "SaleMaster_Description"          =>$this->input->post('SelesNotes'),
            "SaleMaster_TotalSaleAmount"      =>$this->input->post('SellTotals'),
            "SaleMaster_TotalDiscountAmount"=>$this->input->post('SellsDiscount'),
            "SaleMaster_TaxAmount"           =>$this->input->post('vatPersent'),
            "SaleMaster_Freight"             =>$this->input->post('SellsFreight'),
            "SaleMaster_SubTotalAmount"      =>$this->input->post('subTotal'),
            "SaleMaster_PaidAmount"          =>$this->input->post('SellsPaid'),
            "SaleMaster_paidby"              =>$this->input->post('paidby'),
            "SaleMaster_DueAmount"           =>$this->input->post('SellsDue'),
            "UpdateBy"                     =>$this->session->userdata("FullName"),
            "SaleMaster_branchid"          =>$this->session->userdata("BRANCHid"),
            "UpdateTime"                   =>date("Y-m-d h:i:s")
        );   
        // print_r($sales);
        // exit();

        $SaleMaster_SlNo = $this->input->post('saleMasterId');
        $Po_No = $this->input->post('pono');
        $Delevary_Invoice_No = $this->input->post('delevaryInvoiceNo');
        $SaleMaster_TotalSaleAmount = $this->input->post('SellTotals');
        $SaleMaster_TotalDiscountAmount = $this->input->post('SellsDiscount');
        $SaleMaster_TaxAmount = $this->input->post('vatPersent');
        $SaleMaster_Freight = $this->input->post('SellsFreight');
        $SaleMaster_SubTotalAmount = $this->input->post('subTotal');
        $SaleMaster_PaidAmount = $this->input->post('SellsPaid');
        $SaleMaster_DueAmount = $this->input->post('SellsDue');
        $UpdateBy = $this->session->userdata("FullName");
        $UpdateTime = date("Y-m-d h:i:s");
        $query = $this->db->query("update sr_salesmaster set 
            Po_No = '".$Po_No."', Delevary_Invoice_No = '".$Delevary_Invoice_No."', SaleMaster_TotalSaleAmount = '".$SaleMaster_TotalSaleAmount."', SaleMaster_TotalDiscountAmount = '".$SaleMaster_TotalDiscountAmount."',SaleMaster_TaxAmount = '".$SaleMaster_TaxAmount."', SaleMaster_Freight = '".$SaleMaster_Freight."', SaleMaster_SubTotalAmount = '".$SaleMaster_SubTotalAmount."', SaleMaster_PaidAmount = '".$SaleMaster_PaidAmount."', SaleMaster_DueAmount = '".$SaleMaster_DueAmount."', UpdateBy = '".$UpdateBy."', UpdateTime = '".$UpdateTime."' where SaleMaster_SlNo = '".$SaleMaster_SlNo."'");
        $sales_id = $SaleMaster_SlNo;

        $salesInvoiceno = $this->input->post('salesInvoiceno');
        $selectcpay = "select * from sr_customer_payment where CPayment_invoice = '".$salesInvoiceno."'";
        $result = mysql_query($selectcpay);
        $numrows = mysql_num_rows($result);
        if($numrows > 0){
            $CPayment_amount = $this->input->post('SellsPaid');
            $sql = mysql_query("update sr_customer_payment set CPayment_amount = '".$CPayment_amount."' where CPayment_invoice = '".$salesInvoiceno."'");
        }else{

        $data = array(
            "CPayment_date"          =>$this->input->post('sales_date', TRUE),
            "CPayment_invoice"       =>$this->input->post('salesInvoiceno', TRUE),
            "CPayment_customerID"    =>$this->input->post('customerID', TRUE),
            "CPayment_amount"        =>$this->input->post('SellsPaid', TRUE),
            "CPayment_notes"         =>$this->input->post('SelesNotes', TRUE),
            "CPayment_Addby"         =>$this->session->userdata("FullName"),
            "CPayment_brunchid"      =>$this->session->userdata("BRANCHid")
        );
        $this->mt->save_data("sr_customer_payment", $data);
        }
        if ($cart = $this->cart->contents()){
            foreach ($cart as $item){
                $packagename = $item['packagename'];
                $proname = $item['name'];
                $packagecode = $item['packagecode'];
                if($packagename == $proname){
                    $sqqS = mysql_query("SELECT sr_package_create.*, tbl_product.* FROM sr_package_create left join tbl_product on tbl_product.product_create_pack_id = sr_package_create.create_ID WHERE sr_package_create.create_pacageID = '$packagecode'");
                    while($romS = mysql_fetch_array($sqqS)){
                        $proids = $romS['Product_SlNo'];
                        $sellPRICE = $romS['create_sell_price'];
                        $PurchpackagPRICE = $romS['create_purch_price'];
                        $packagNAME = $romS['create_item'];
                        $packqty = $romS['cteate_qty']*$item['qty'];
                        $order_detail = array(
                            'SaleMaster_IDNo'               => $sales_id,
                            'Product_IDNo'                  => $proids,
                            'SaleDetails_TotalQuantity'     => $packqty,
                            'SeleDetails_qty'               => $item['qty'],
                            'SaleDetails_Rate'              => $sellPRICE,
                            'SaleDetails_unit'              => 'pcs',
                            'packSellPrice'                 => $item['price'],
                            'packageName'                   => $item['name'],
                            'Purchase_Rate'                 => $PurchpackagPRICE
                        );
                        $this->billing_model->insert_sales_detail($order_detail);
                        $sql = mysql_query("SELECT * FROM sr_saleinventory WHERE sellProduct_IdNo = '".$proids."'");
                        $rox = mysql_fetch_array($sql);
                        $id = $rox['SaleInventory_SlNo'];
                        $oldStock = $rox['SaleInventory_TotalQuantity'];
                        $oldpackStock = $rox['SaleInventory_qty'];

                        if($rox['sellProduct_IdNo']== $proids){
                            $addStock = array(
                                'sellProduct_IdNo'                      => $proids,
                                'SaleInventory_TotalQuantity'           => $oldStock+$packqty,
                                'SaleInventory_qty'                     => $oldpackStock+$item['qty'],
                                'SaleInventory_packname'                => $packagename
                            );
                            $this->mt->update_data("sr_saleinventory",$addStock,$id,'SaleInventory_SlNo');  
                        }else{
                            $addStock = array(
                                'sellProduct_IdNo'                      => $proids,
                                'SaleInventory_TotalQuantity'           => $packqty,
                                'SaleInventory_qty'                     => $item['qty'],
                                'SaleInventory_packname'                => $packagename
                            );
                        $this->mt->save_data("sr_saleinventory",$addStock);
                        }
                    }   
                }
                else{
                    $order_detail = array(
                        'SaleMaster_IDNo'               => $sales_id,
                        'Product_IDNo'                  => $item['id'],
                        'SaleDetails_TotalQuantity'     => $item['qty'],
                        'SaleDetails_Rate'              => $item['price'],
                        'SaleDetails_unit'              => $item['image'],
                        'Purchase_Rate'                 => $item['purchaserate']
                    );
                    $this->billing_model->insert_sales_detail($order_detail);
                    // Stock add
                    $sql = mysql_query("SELECT * FROM sr_saleinventory WHERE sellProduct_IdNo = '".$item['id']."'");
                    $rox = mysql_fetch_array($sql);
                    $id = $rox['SaleInventory_SlNo'];
                    $oldStock = $rox['SaleInventory_TotalQuantity'];

                    if($rox['sellProduct_IdNo']== $item['id']){
                        $addStock = array(
                            'sellProduct_IdNo'                      => $item['id'],
                            'SaleInventory_TotalQuantity'           => $oldStock+$item['qty']
                        );
                        $this->mt->update_data("sr_saleinventory",$addStock,$id,'SaleInventory_SlNo');  
                    }else{
                        $addStock = array(
                            'sellProduct_IdNo'                      => $item['id'],
                            'SaleInventory_TotalQuantity'           => $item['qty']
                        );
                    $this->mt->save_data("sr_saleinventory",$addStock);
                    } 
                }
                
            }// end foreach
        }// end if

        $this->cart->destroy();
        $sss['lastidforprint'] = $sales_id;
        $this->session->set_userdata($sss);
        $this->load->view('sales/product_sales');
    }
    function salesreturn(){
        $data['title'] = " Sales Return";
        $data['content'] = $this->load->view('sales/salseReturn', $data, TRUE);
        $this->load->view('index', $data);
    }
    function salesreturnSearch(){
        $invoice = $this->input->post('invoiceno');
        $sql = mysql_query("SELECT * FROM sr_salesmaster WHERE SaleMaster_SlNo = '$invoice'");
        $row = mysql_fetch_array($sql);
        $data['proID'] = $row['SaleMaster_SlNo'];
        $data['invoices'] = $row['SaleMaster_InvoiceNo'];
        $this->load->view('sales/salesReturnList', $data);
    }
    function SalesReturnInsert(){
        
        $returnqty = $this->input->post('returnqty');
        $returnamount = $this->input->post('returnamount');
        $return_date = $this->input->post('return_date');
        $productID = $this->input->post('productID');
        $salseQTY = $this->input->post('salseQTY');
        $invoices = $this->input->post('invoice');
        $totalQty = "";
        $RAmount = "";
        $totalarray =  sizeof($returnqty);
        for($j=0;$j<$totalarray; $j++){
            $rqtys = $this->input->post('returnqty');
            $totalQty = $rqtys[$j]+$totalQty;
            $ramounts = $this->input->post('returnamount');
            $RAmount =$ramounts[$j]+$RAmount;
        }
        $sqlll = mysql_query("SELECT * FROM sr_salereturn where SaleMaster_InvoiceNo = '$invoices'");
        $ros = mysql_fetch_array($sqlll);
        $iid = $ros['SaleReturn_SlNo'];
        $ivo = $ros['SaleMaster_InvoiceNo'];

        $totalqt = $ros['SaleReturn_ReturnQuantity'];
        $totalamou = $ros['SaleReturn_ReturnAmount'];
        $fld = 'SaleReturn_SlNo';

        if($ivo >0){
            $return = array(
                "SaleMaster_InvoiceNo"               =>$this->input->post('invoice'),
                "SaleReturn_ReturnDate"              =>$this->input->post('return_date'),
                "SaleReturn_ReturnQuantity"          =>$totalQty+$totalqt,
                "SaleReturn_ReturnAmount"            =>$RAmount+$totalamou,
                "SaleReturn_Description"             =>$this->input->post('Notes'),
                
                "AddBy"                              =>$this->session->userdata("FullName"),
                "SaleReturn_brunchId"                =>$this->session->userdata("BRANCHid"),
                "AddTime"                            =>date("Y-m-d h:i:s")
            );      
            $return_id = $this->mt->update_data('sr_salereturn',$return,$iid,$fld);
            for($i=0;$i<$totalarray; $i++){
                $returnqtyss = $this->input->post('returnqty');
                $returnamounts = $this->input->post('returnamount');
                $productIDs = $this->input->post('productID');
                $salseQTYs = $this->input->post('salseQTY');
                //
                $productsCodes = $this->input->post('productsCodes');
                $productsCodes=$productsCodes[$i];
                $packnames = $this->input->post('packname');
                $packnames = $packnames[$i];
                $productsName = $this->input->post('productsName');
                $productsName = $productsName[$i];
                if($packnames == $productsName){
                    $sqj = mysql_query("SELECT * FROM sr_package_create WHERE create_pacageID ='".$productsCodes."'");
                    while($romio = mysql_fetch_array($sqj)){

                        $sqn = mysql_query("SELECT * FROM tbl_product WHERE Product_Code = '".$romio['create_proCode']."'");
                        $ron = mysql_fetch_array($sqn);
                    //---------------------------------------
                        $returns = array(
                            "SaleReturn_IdNo"                           =>$iid,
                            "SaleReturnDetails_ReturnDate"              =>$this->input->post('return_date'),
                            "SaleReturnDetailsProduct_SlNo"             =>$ron['Product_SlNo'],//$productIDs[$i],
                            "SaleReturnDetails_SaleQuantity"            =>$salseQTYs[$i],
                            "SaleReturnDetails_ReturnQuantity"          =>$returnqtyss[$i]*$romio['cteate_qty'],
                            "SaleReturnDetails_Qty"                     =>$returnqtyss[$i],
                            "SaleReturnDetails_ReturnAmount"            =>$returnamounts[$i],
                            
                            "AddBy"                                     =>$this->session->userdata("FullName"),
                            "SaleReturnDetails_brunchID"                =>$this->session->userdata("BRANCHid"),
                            "AddTime"                                   =>date("Y-m-d h:i:s")
                        );      
                        $this->billing_model->SalesReturn('sr_salereturndetails',$returns);
                    }
                }else{
                    $returns = array(
                        "SaleReturn_IdNo"                           =>$iid,
                        "SaleReturnDetails_ReturnDate"              =>$this->input->post('return_date'),
                        "SaleReturnDetailsProduct_SlNo"             =>$productIDs[$i],
                        "SaleReturnDetails_SaleQuantity"            =>$salseQTYs[$i],
                        "SaleReturnDetails_ReturnQuantity"          =>$returnqtyss[$i],
                        "SaleReturnDetails_ReturnAmount"            =>$returnamounts[$i],
                        
                        "AddBy"                                     =>$this->session->userdata("FullName"),
                        "SaleReturnDetails_brunchID"                =>$this->session->userdata("BRANCHid"),
                        "AddTime"                                   =>date("Y-m-d h:i:s")
                    );      
                    $this->billing_model->SalesReturn('sr_salereturndetails',$returns);

                }
                //
                
            }   
        }else{
            $return = array(
                "SaleMaster_InvoiceNo"               =>$this->input->post('invoice'),
                "SaleReturn_ReturnDate"              =>$this->input->post('return_date'),
                "SaleReturn_ReturnQuantity"          =>$totalQty,
                "SaleReturn_ReturnAmount"            =>$RAmount,
                "SaleReturn_Description"             =>$this->input->post('Notes'),
                
                "AddBy"                              =>$this->session->userdata("FullName"),
                "SaleReturn_brunchId"                =>$this->session->userdata("BRANCHid"),
                "AddTime"                            =>date("Y-m-d h:i:s")
            );      
            $return_id = $this->billing_model->SalesReturn('sr_salereturn',$return);
            for($i=0;$i<$totalarray; $i++){
                $returnqtyss = $this->input->post('returnqty');
                $returnamounts = $this->input->post('returnamount');
                $productIDs = $this->input->post('productID');
                $salseQTYs = $this->input->post('salseQTY');
                //
                $productsCodes = $this->input->post('productsCodes');
                $productsCodes=$productsCodes[$i];
                $packnames = $this->input->post('packname');
                $packnames = $packnames[$i];
                $productsName = $this->input->post('productsName');
                $productsName = $productsName[$i];
                if($packnames == $productsName){
                    $sqj = mysql_query("SELECT * FROM sr_package_create WHERE create_pacageID ='".$productsCodes."'");
                    while($romio = mysql_fetch_array($sqj)){

                        $sqn = mysql_query("SELECT * FROM tbl_product WHERE Product_Code = '".$romio['create_proCode']."'");
                        $ron = mysql_fetch_array($sqn);
                    //---------------------------------------
                        $returns = array(
                            "SaleReturn_IdNo"                           =>$return_id,
                            "SaleReturnDetails_ReturnDate"              =>$this->input->post('return_date'),
                            "SaleReturnDetailsProduct_SlNo"             =>$ron['Product_SlNo'],//$productIDs[$i],
                            "SaleReturnDetails_SaleQuantity"            =>$salseQTYs[$i],
                            "SaleReturnDetails_ReturnQuantity"          =>$returnqtyss[$i]*$romio['cteate_qty'],
                            "SaleReturnDetails_Qty"                     =>$returnqtyss[$i],
                            "SaleReturnDetails_ReturnAmount"            =>$returnamounts[$i],
                            
                            "AddBy"                                     =>$this->session->userdata("FullName"),
                            "SaleReturnDetails_brunchID"                =>$this->session->userdata("BRANCHid"),
                            "AddTime"                                   =>date("Y-m-d h:i:s")
                        );      
                        $this->billing_model->SalesReturn('sr_salereturndetails',$returns);
                    }
                 }else{
                    $returns = array(
                        "SaleReturn_IdNo"                           =>$return_id,
                        "SaleReturnDetails_ReturnDate"              =>$this->input->post('return_date'),
                        "SaleReturnDetailsProduct_SlNo"             =>$productIDs[$i],
                        "SaleReturnDetails_SaleQuantity"            =>$salseQTYs[$i],
                        "SaleReturnDetails_ReturnQuantity"          =>$returnqtyss[$i],
                        "SaleReturnDetails_ReturnAmount"            =>$returnamounts[$i],
                        
                        "AddBy"                                     =>$this->session->userdata("FullName"),
                        "SaleReturnDetails_brunchID"                =>$this->session->userdata("BRANCHid"),
                        "AddTime"                                   =>date("Y-m-d h:i:s")
                    );      
                    $this->billing_model->SalesReturn('sr_salereturndetails',$returns);
                }

                
            }   

        }
        for($f=0;$f<$totalarray; $f++){
            $productIDs = $this->input->post('productID');
            $rqtyss = $this->input->post('returnqty');
            //------------------------------------------
            $productsCodes = $this->input->post('productsCodes');
            $productsCodes=$productsCodes[$f];
            $packnames = $this->input->post('packname');
            $packnames = $packnames[$f];
            $productsName = $this->input->post('productsName');
            $productsName = $productsName[$f];
            if($packnames == $productsName){
                $sqj = mysql_query("SELECT * FROM sr_package_create WHERE create_pacageID ='".$productsCodes."'");
                while($romio = mysql_fetch_array($sqj)){

                    $sqn = mysql_query("SELECT * FROM tbl_product WHERE Product_Code = '".$romio['create_proCode']."'");
                    $ron = mysql_fetch_array($sqn);

                    $sqls = mysql_query("SELECT * FROM sr_saleinventory WHERE sellProduct_IdNo ='".$ron['Product_SlNo']."'");
                    $ROW = mysql_fetch_array($sqls);
                    $id = $ROW['SaleInventory_SlNo'];
                    $qTys= $romio['cteate_qty']*$rqtyss[$f];
                    $qt = $ROW['SaleInventory_ReturnQuantity'];
                    $qtpac = $ROW['SaleInventory_returnqty'];
                    $fld = "SaleInventory_SlNo";
                    $returns = array(
                        "SaleInventory_ReturnQuantity"      =>$qTys+$qt,
                        "SaleInventory_returnqty"           =>$qtpac+$rqtyss[$f]
                    );      
                    $this->mt->update_data('sr_saleinventory',$returns, $id,$fld);
                }
            }else{
                $sqls = mysql_query("SELECT * FROM sr_saleinventory WHERE sellProduct_IdNo ='".$productIDs[$f]."'");
                $ROW = mysql_fetch_array($sqls);
                $id = $ROW['SaleInventory_SlNo'];
                $qt = $ROW['SaleInventory_ReturnQuantity'];
                $fld = "SaleInventory_SlNo";
                $returns = array(
                    "SaleInventory_ReturnQuantity"      =>$rqtyss[$f]+$qt
                );      
                $this->mt->update_data('sr_saleinventory',$returns, $id,$fld);
            }        
            
        }
        
        $this->load->view('sales/blankpage');

    }
    public function sales_invoice()  {
        $data['title'] = "Sales Invoice";
        $data['content'] = $this->load->view('sales/sales_invoice', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function sales_invoice_search()  {
        $id = $this->input->post('SaleMasteriD');
        $sql = mysql_query("SELECT * FROM sr_salesmaster WHERE SaleMaster_SlNo = '$id'");
        $row = mysql_fetch_array($sql);
        $datas['SalesID'] = $row['SaleMaster_SlNo'];
        $datas['invoices'] = $row['SaleMaster_InvoiceNo'];
        $this->session->set_userdata($datas);
        $this->load->view('sales/sales_invoice_search', $datas);
    }
    public function sales_invoice_due()  {
        $data['title'] = "Sales Invoice";
        $data['content'] = $this->load->view('sales/sales_invoice_withdue', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function sales_invoice_search_due()  {
        $id = $this->input->post('SaleMasteriD');
        $sql = mysql_query("SELECT * FROM sr_salesmaster WHERE SaleMaster_SlNo = '$id'");
        $row = mysql_fetch_array($sql);
        $datas['SalesID'] = $row['SaleMaster_SlNo'];
        $datas['invoices'] = $row['SaleMaster_InvoiceNo'];
        $this->session->set_userdata($datas);
        $this->load->view('sales/sales_invoice_search_withdue', $datas);
    }
    public function challan(){
        $data['title'] = "Challan";
        $data['content'] = $this->load->view('sales/challan', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function challan_order(){
        $challan = array(
            "ChallanMaster_ChallanNo"   =>$this->input->post('salesInvoiceno'),
            "Po_No"                     =>$this->input->post('pono'),
            "Customer_IDNo"             =>$this->input->post('customerID'),
            "ChallanDate"               =>$this->input->post('sales_date'),
            "Description"               =>$this->input->post('SelesNotes'),
            "TotalChallanAmount"        =>$this->input->post('SellTotals'),
            "TotalDiscountAmount"       =>$this->input->post('SellsDiscount'),
            "TaxAmount"                 =>$this->input->post('vatPersent'),
            "Freight"                   =>$this->input->post('SellsFreight'),
            "SubTotalAmount"            =>$this->input->post('subTotal'),
            "PaidAmount"                =>$this->input->post('SellsPaid'),
            "paidby"                    =>$this->input->post('paidby'),
            "DueAmount"                 =>$this->input->post('SellsDue'),
            "AddBy"                     =>$this->session->userdata("FullName"),
            "ChallanMaster_branchid"    =>$this->session->userdata("BRANCHid"),
            "AddTime"                   =>date("Y-m-d h:i:s")
        );     
        $challan_id = $this->billing_model->ChallanOrder($challan);
        
        
        if ($cart = $this->cart->contents()){
            foreach ($cart as $item){
                $packagename = $item['packagename'];
                $proname = $item['name'];
                $packagecode = $item['packagecode'];
                if($packagename == $proname){
                    $sqqS = mysql_query("SELECT sr_package_create.*, tbl_product.* FROM sr_package_create left join tbl_product on tbl_product.product_create_pack_id = sr_package_create.create_ID WHERE sr_package_create.create_pacageID = '$packagecode'");
                    while($romS = mysql_fetch_array($sqqS)){
                        $proids = $romS['Product_SlNo'];
                        $sellPRICE = $romS['create_sell_price'];
                        $PurchpackagPRICE = $romS['create_purch_price'];
                        $packagNAME = $romS['create_item'];
                        $packqty = $romS['cteate_qty']*$item['qty'];
                        $challan_detail = array(
                            'ChallanMaster_SlNo'            => $challan_id,
                            'Product_IDNo'                  => $proids,
                            'TotalQuantity'                 => $packqty,
                            'ChallanDetails_qty'            => $item['qty'],
                            'ChallanDetails_Rate'           => $sellPRICE,
                            'ChallanDetails_unit'           => 'pcs',
                            'packSellPrice'                 => $item['price'],
                            'packageName'                   => $item['name'],
                            'Purchase_Rate'                 => $PurchpackagPRICE
                        );
                        $this->billing_model->insert_challan_detail($challan_detail);
                    }   
                }
                else{
                    $challan_detail = array(
                        'ChallanMaster_SlNo'            => $challan_id,
                        'Product_IDNo'                  => $item['id'],
                        'TotalQuantity'                 => $item['qty'],
                        'ChallanDetails_Rate'           => $item['price'],
                        'ChallanDetails_unit'           => $item['image'],
                        'Purchase_Rate'                 => $item['purchaserate']
                    );
                    $this->billing_model->insert_challan_detail($challan_detail);

  
                }
                
            }// end foreach
        }// end if

        $this->cart->destroy();
        $sss['lastchallan'] = $challan_id;
        $this->session->set_userdata($sss);
        $this->load->view('sales/challan');
    }
    public function sales_challan()  {
        $data['title'] = "Sales Challan";
        $data['content'] = $this->load->view('sales/sales_challan', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function sales_challan_search(){
        $id = $this->input->post('ChallanMasterID');
        $sql = mysql_query("SELECT * FROM sr_challanmaster WHERE ChallanMaster_SlNo = '$id'");
        $row = mysql_fetch_array($sql);
        $datas['ChallanMasterID'] = $row['ChallanMaster_SlNo'];
        $datas['challans'] = $row['Delevary_Invoice_No'];
        $this->session->set_userdata($datas);
        $this->load->view('sales/sales_challan_search', $datas);
    }
    function sales_record()  {
        $data['title'] = "Sales Record";
        $data['content'] = $this->load->view('sales/sales_record', $data, TRUE);
        $this->load->view('index', $data);
    }
    function sales_customerName()  {
        $id = $this->input->post('customerID');
        $sql = mysql_query("SELECT * FROM sr_customer WHERE Customer_SlNo = '$id'");
        $row = mysql_fetch_array($sql);
        $datas['customerName'] = $row['Customer_Name'];
        $this->load->view('sales/salesrecord_customername', $datas);
    }
    function search_sales_record()  {
        $dAta['searchtype']= $searchtype = $this->input->post('searchtype');
        $dAta['Sales_startdate']=$Sales_startdate = $this->input->post('Sales_startdate');
        $dAta['Sales_enddate']=$Sales_enddate = $this->input->post('Sales_enddate');
        $dAta['customerID']= $customerID = $this->input->post('customerID');
        $dAta['productID']= $productID = $this->input->post('productID');
        $this->session->set_userdata($dAta);

        if($searchtype == "All"){
            $sql = "SELECT sr_salesmaster.*, sr_customer.* FROM sr_salesmaster left join sr_customer on sr_customer.Customer_SlNo = sr_salesmaster.SalseCustomer_IDNo WHERE sr_salesmaster.SaleMaster_SaleDate between  '$Sales_startdate' and '$Sales_enddate'";
            $datas["type"] = "All";
            $datas["record"] = $this->mt->ccdata($sql);
            $this->load->view('sales/sales_record_list', $datas);

        }
        if($searchtype == "Customer"){
            $sql = "SELECT sr_salesmaster.*, sr_customer.* FROM sr_salesmaster left join sr_customer on sr_customer.Customer_SlNo = sr_salesmaster.SalseCustomer_IDNo WHERE sr_salesmaster.SalseCustomer_IDNo = '$customerID' and  sr_salesmaster.SaleMaster_SaleDate between  '$Sales_startdate' and '$Sales_enddate'";
            $datas["type"] = "Customer";
            $datas["record"] = $this->mt->ccdata($sql);
            $this->load->view('sales/sales_record_list', $datas);
        }
        if($searchtype == "Product"){

            $products = $this->db->select('*')
                            ->from('sr_saledetails')
                            ->join('sr_salesmaster','sr_salesmaster.SaleMaster_SlNo = sr_saledetails.SaleMaster_IDNo','left')
                            ->join('tbl_product','tbl_product.Product_SlNo = sr_saledetails.Product_IDNo','left')
                            ->join('sr_customer','sr_customer.Customer_SlNo = sr_salesmaster.SalseCustomer_IDNo','left')
                            ->where('sr_saledetails.Product_IDNo',$productID)
                            ->where('sr_salesmaster.SaleMaster_SaleDate >= ',$Sales_startdate)
                            ->where('sr_salesmaster.SaleMaster_SaleDate <= ',$Sales_enddate)
                            ->get()->result();
            $datas["type"] = "Product";
            $datas["products"] = $products;
            $this->load->view('sales/sales_record_list', $datas);

        }


    }
    function sales_stock()  {
        $data['title'] = "Sales Stock";
        $data['content'] = $this->load->view('stock/sales_stock', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function sellAndPrint()  {
        $data['title'] = "Sales Report";
        $id = $this->session->userdata('lastwhid');
        $datas['SalesID'] = $id;
        // $datas['invoices'] = $row['SaleMaster_InvoiceNo'];
        $this->session->set_userdata($datas);
        $data['content'] = $this->load->view('sales/sellAndreport', $datas, TRUE);
        $this->load->view('index', $data);
    }
    // public function sellAndPrint()  {
    //     $data['title'] = "Sales Report";
    //     $id = $this->session->userdata('lastidforprint');
    //     $sql = mysql_query("SELECT * FROM sr_salesmaster WHERE SaleMaster_SlNo = '$id'");
    //     $row = mysql_fetch_array($sql);
    //     $datas['SalesID'] = $row['SaleMaster_SlNo'];
    //     $datas['invoices'] = $row['SaleMaster_InvoiceNo'];
    //     $this->session->set_userdata($datas);
    //     $data['content'] = $this->load->view('sales/sellAndreport', $datas, TRUE);
    //     $this->load->view('index', $data);
    // }
    public function challanAndPrint()  {
        $data['title'] = "Challan Report";
        $id = $this->session->userdata('lastchallan');
        $sql = mysql_query("SELECT * FROM sr_challanmaster WHERE    ChallanMaster_SlNo = '$id'");
        $row = mysql_fetch_array($sql);
        $datas['ChallanID'] = $row['ChallanMaster_SlNo'];
        $datas['Challan'] = $row['ChallanMaster_ChallanNo'];
        $this->session->set_userdata($datas);
        $data['content'] = $this->load->view('sales/challanAndPrint', $datas, TRUE);
        $this->load->view('index', $data);
    }

    function return_list()  {
        $data['title'] = "Sales Return List";
        $data['content'] = $this->load->view('sales/return_list', $data, TRUE);
        $this->load->view('index', $data);
    }
    function craditlimit(){
        $cid = $this->input->post('custID');
        $sql = mysql_query("SELECT *  FROM sr_customer_payment  where CPayment_customerID = '$cid' ");
        $sell = '';
        $paid = '';
        while($rox = mysql_fetch_array($sql)){
            $paid =$paid+ $rox['CPayment_amount'];
        }
        $sqlx = mysql_query("SELECT * FROM sr_salesmaster  where SalseCustomer_IDNo = '$cid' ");
        while($rox = mysql_fetch_array($sqlx)){
            $sell =$sell+ $rox['SaleMaster_SubTotalAmount'];
        }

        //echo  $sell.'<br>';echo $paid;
        $data['totaldue'] = $sell-$paid;
        $sqll = mysql_query("SELECT * FROM sr_customer WHERE Customer_SlNo = '$cid'");
        $rol = mysql_fetch_array($sqll);
        $data['craditlimit'] = $rol['Customer_Credit_Limit'];
        $this->load->view('sales/craditlimit', $data);
    }
    function sales_record_byCategory()  {
        $data['title'] = "Sales Record by Category";
        $data['content'] = $this->load->view('sales/sales_record_byCategory', $data, TRUE);
        $this->load->view('index', $data);
    }
    function search_sales_recordbyCategory()  {
        $dAta['Sales_startdate']=$Sales_startdate = $this->input->post('Sales_startdate');
        $dAta['Sales_enddate']=$Sales_enddate = $this->input->post('Sales_enddate');
        $dAta['customerID']=$customerID = $this->input->post('customerID');
        $dAta['Categoryid']=$Categoryid = $this->input->post('Categoryid');
        $this->session->set_userdata($dAta);
        $sql = "SELECT sr_salesmaster.*, sr_customer.*,sr_saledetails.*,tbl_product.*,sr_productcategory.* 
        FROM sr_salesmaster 
        left join sr_customer on sr_customer.Customer_SlNo = sr_salesmaster.SalseCustomer_IDNo
        left join sr_saledetails on sr_saledetails.SaleMaster_IDNo = sr_salesmaster.SaleMaster_SlNo  
        left join tbl_product on tbl_product.Product_SlNo = sr_saledetails.Product_IDNo  
        left join sr_productcategory on sr_productcategory.ProductCategory_SlNo = tbl_product.ProductCategory_ID
        WHERE tbl_product.ProductCategory_ID = '$Categoryid' and sr_salesmaster.SalseCustomer_IDNo = '$customerID' and 
        sr_salesmaster.SaleMaster_SaleDate between  '$Sales_startdate' and '$Sales_enddate'";
        $datas["record"] = $this->mt->ccdata($sql);
        
        $this->load->view('sales/sales_record_listBycat', $datas);
    }
    function viewAllSales(){
        $data['title'] = "View Sales";
        $data['content'] = $this->load->view('sales/view_sales', $data, TRUE);
        $this->load->view('index', $data);
    }
    function selectInvoiceWiseProduct(){ 
        $invoiceId = $this->input->post('invoiceId');
        $sql = mysql_query("SELECT * FROM sr_salesmaster WHERE SaleMaster_SlNo = '$invoiceId'");
        $row = mysql_fetch_array($sql);
        $invoiceNo = $row['SaleMaster_InvoiceNo'];
        $sql2 = mysql_query("SELECT * FROM sr_salereturn WHERE SaleMaster_InvoiceNo = '$invoiceNo'");
        $rows = mysql_num_rows($sql2);
        if($rows > 0){
            $this->load->view('sales/product_sales');
        }else{
            $this->load->view('sales/edit_sales');
        }

        
    }

    function fancybox_add_checkinfo(){
        $this->load->view('ajax/fancybox_add_checkinfo');
    }
    function sales_insertCheckinfo(){
        $data = array(
                "SalesInvoiceno"    =>$this->input->post('salesInvoiceno', TRUE),
                "CompanyName"       =>$this->input->post('companyName', TRUE),
                "CheckNo"           =>$this->input->post('checkNo', TRUE),
                "BankName"          =>$this->input->post('bankName', TRUE),
                "BrunchName"        =>$this->input->post('brunchName', TRUE),
                "CheckDate"         =>$this->input->post('checkDate', TRUE),
                "CheckStatus"       =>"P",
                "AddBy"             =>$this->session->userdata("FullName"),
                "AddTime"           =>date("Y-m-d h:i:s")
                );
        $this->mt->save_data('tbl_check_pay',$data);
        return true;
    }
    function cashed_check(){
        $data['title'] = "View Cashed Check";
        $data['content'] = $this->load->view('sales/view_cashed_check', $data, TRUE);
        $this->load->view('index', $data);
    }
    function pending_check(){
        $data['title'] = "View Pending Check";
        $data['content'] = $this->load->view('sales/view_pending_check', $data, TRUE);
        $this->load->view('index', $data);
    }
    function pendingToCashed(){
        $id = $this->input->post('checkid');
        $fld = 'CheckPay_SINo';
        $data = array(
            "CheckStatus"             =>'C',
            "UpdatedBy"               =>$this->session->userdata("FullName"),
            "UpdatedTime"             =>date("Y-m-d h:i:s")
        );
        $this->mt->update_data("tbl_check_pay", $data, $id,$fld);
        $this->load->view('sales/pending_list');
    }
    function searchByInvoice(){
        $id = $this->input->post('invoiceId');
        $sql = "SELECT * FROM tbl_check_pay WHERE CheckPay_SINo = '$id' AND CheckStatus = 'P'";
        $datas["records"] = $this->mt->ccdata($sql);
        
        $this->load->view('sales/sales_pending_invoice_search', $datas);
    }
    function searchByCompany(){
        $companyName = $this->input->post('companyName');
        $sql = "SELECT * FROM tbl_check_pay WHERE CompanyName = '$companyName' AND CheckStatus = 'P' ORDER BY CheckDate";
        $datas["records"] = $this->mt->ccdata($sql);
        
        $this->load->view('sales/sales_pending_invoice_search', $datas);
    }
    function searchByCheck(){
        $checkNo = $this->input->post('checkNo');
        $sql = "SELECT * FROM tbl_check_pay WHERE checkNo = '$checkNo' AND CheckStatus = 'P'";
        $datas["records"] = $this->mt->ccdata($sql);
        
        $this->load->view('sales/sales_pending_invoice_search', $datas);
    }
    function searchBydate(){
        $checkDate = $this->input->post('checkDate');
        $sql = "SELECT * FROM tbl_check_pay WHERE CheckDate = '$checkDate' AND CheckStatus = 'P'";
        $datas["records"] = $this->mt->ccdata($sql);
        
        $this->load->view('sales/sales_pending_invoice_search', $datas);
    }
    function searchByInvoiceCashed(){
        $id = $this->input->post('invoiceId');
        $sql = "SELECT * FROM tbl_check_pay WHERE CheckPay_SINo = '$id' AND CheckStatus = 'C'";
        $datas["records"] = $this->mt->ccdata($sql);
        
        $this->load->view('sales/sales_cashed_invoice_search', $datas);
    }
    function searchByCompanyCashed(){
        $companyName = $this->input->post('companyName');
        $sql = "SELECT * FROM tbl_check_pay WHERE CompanyName = '$companyName' AND CheckStatus = 'C' ORDER BY CheckDate";
        $datas["records"] = $this->mt->ccdata($sql);
        
        $this->load->view('sales/sales_cashed_invoice_search', $datas);
    }
    function searchByCheckCashed(){
        $checkNo = $this->input->post('checkNo');
        $sql = "SELECT * FROM tbl_check_pay WHERE checkNo = '$checkNo' AND CheckStatus = 'C'";
        $datas["records"] = $this->mt->ccdata($sql);
        
        $this->load->view('sales/sales_cashed_invoice_search', $datas);
    }
    function searchBydateCashed(){
        $checkDate = $this->input->post('checkDate');
        $sql = "SELECT * FROM tbl_check_pay WHERE CheckDate = '$checkDate' AND CheckStatus = 'C'";
        $datas["records"] = $this->mt->ccdata($sql);
        
        $this->load->view('sales/sales_cashed_invoice_search', $datas);
    }
    public function money_receipt(){
        $data['title'] = "Money Receipt";
        $data['content'] = $this->load->view('sales/money_receipt', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function add_receipt(){
        $data = array(
            "MoneyReceipt_No"        =>$this->input->post('receiptNo', TRUE),
            "MoneyReceipt_Name"      =>$this->input->post('receiptName', TRUE),
            "Money_receipt_Paytype"   =>$this->input->post('receiptType', TRUE),
            "Money_receipt_accountNo" =>$this->input->post('accountNo', TRUE),
            "MoneyReceipt_ChequeNo"   =>$this->input->post('chequeNo', TRUE),
            "MoneyReceipt_Amount"     =>$this->input->post('receiptAmount', TRUE),
            "MoneyReceipt_PayDate"    =>$this->input->post('DaTe', TRUE),
            "Status"                  =>"A",
            "AddBy"                   =>$this->session->userdata("FullName"),
            "AddTime"                 =>date("Y-m-d h:i:s")
                );
        $this->db->insert('tbl_moneyreceipt', $data);
        $receipt_id = $this->db->insert_id();
        //$this->mt->save_data('tbl_moneyreceipt',$data);
        $sss['receiptID'] = $receipt_id;
        $this->session->set_userdata($sss);
        $this->load->view('sales/money_receipt');
    }
    public function receiptPrint(){
        $data['title'] = "Money Receipt Print";
        $data['content'] = $this->load->view('sales/receiptPrint', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function search_money_receipt(){
        $data['title'] = "Money Receipt Search";
        $data['content'] = $this->load->view('sales/search_money_receipt', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function money_receipt_search_result(){
        $id = $this->input->post('receiptID'); 
        $sql = mysql_query("SELECT * FROM tbl_moneyreceipt WHERE    MoneyReceipt_SINo = '$id'");
        $row = mysql_fetch_array($sql);
        $datas['moneyReceiptID'] = $row['MoneyReceipt_SINo'];
        $this->session->set_userdata($datas);      
        $this->load->view('sales/money_receipt_search_result', $datas);
    }

	public function select_product_by_category($id){
		
		?>
		  <select id="ProID" autofocus name="ProID" data-placeholder="Choose a Product..." class="chosen-select" style="width:200px;" tabindex="2" onchange="Products()">
               <option value=""></option>
               <?php $sql = mysql_query("SELECT tbl_product.*, sr_productcategory.* FROM tbl_product left join sr_productcategory on sr_productcategory.ProductCategory_SlNo= tbl_product.ProductCategory_ID WHERE tbl_product.ProductCategory_ID='$id' order by tbl_product.Product_Name asc");
               $rows = mysql_fetch_array($sql);
			   //echo "<pre>";print_r($rows);exit;
			   while($row = mysql_fetch_array($sql)){ ?>
               <option value="<?php echo $row['Product_SlNo'] ?>"><?php echo $row['P_Code'].' - '.$row['Product_Name'] ?></option>
               <?php } ?>
          </select>
		<?php
	}

//	Get all The Invoice List By Product ID

    public function getInvoiceByProductId(){
            $productID = $this->input->get('productID');

            $invoices = $this->db->select('sr_salesmaster.SaleMaster_InvoiceNo,sr_salesmaster.SaleMaster_SlNo')
                                                ->from('sr_saledetails')
                                                ->join('sr_salesmaster','sr_salesmaster.SaleMaster_SlNo=sr_saledetails.SaleMaster_IDNo ','left')
                                                ->where('sr_saledetails.Product_IDNo',$productID)
                                                ->get()->result();

            echo json_encode($invoices);
    }

    public function getAllInvoices(){
        $invoices = $this->db->order_by('SaleMaster_InvoiceNo','DESC')->get('sr_salesmaster')->result();
        echo json_encode($invoices);
    }



}
