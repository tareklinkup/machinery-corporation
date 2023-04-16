<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase extends CI_Controller {
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
        redirect("purchase/order");
    }
    public function order()  {
        $this->cart->destroy();
        $data['title'] = "Purchase Order";
        $data['content'] = $this->load->view('purchase/purchase_order', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function returns(){
        $data['title'] = "Purchase Return";
        $data['content'] = $this->load->view('purchase/purchase_return', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function damage_entry(){
        $data['title'] = "Damage Entry";
        $data['content'] = $this->load->view('purchase/damage_entry', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function stock(){
        $data['title'] = "Purchase Stock List";
        $data['content'] = $this->load->view('purchase/purchase_stock_list', $data, TRUE);
        $this->load->view('index', $data);
    }
    function Selectsuplier()  {
        $sid = $this->input->post('sid');
        $query = "SELECT * FROM sr_supplier where Supplier_SlNo = '$sid'";
        $data['Supplier'] = $this->mt->edit_by_id($query);
        $this->load->view('purchase/ajax_suplier', $data);
    }
    function SelectPruduct()  {
        $ProID = $this->input->post('ProID');
        $querys = "SELECT tbl_product.*, sr_unit.*  FROM tbl_product left join sr_unit on sr_unit.Unit_SlNo=tbl_product.Unit_ID where tbl_product.Product_SlNo = '$ProID'";
       
        $data['Product'] = $this->mt->edit_by_id($querys);
        $this->load->view('purchase/ajax_product', $data);
    }
    public function Purchase_order(){
        $Purchase = array(
            "Supplier_SlNo"                     =>$this->input->post('SupplierID'),
            "PurchaseMaster_InvoiceNo"          =>$this->input->post('purchInvoice'),
            "PurchaseMaster_OrderDate"          =>$this->input->post('Purchase_date'),
            "PurchaseMaster_PurchaseFor"        =>$this->input->post('PurchaseFor'),
            "PurchaseMaster_Description"        =>$this->input->post('Notes'),
            "PurchaseMaster_TotalAmount"        =>$this->input->post('subTotal'),
            "PurchaseMaster_DiscountAmount"     =>$this->input->post('purchDiscount'),
            "PurchaseMaster_Tax"                =>$this->input->post('vatPersent'),
            "PurchaseMaster_Freight"            =>$this->input->post('purchFreight'),
            "PurchaseMaster_SubTotalAmount"     =>$this->input->post('purchTotal'),
            "PurchaseMaster_PaidAmount"         =>$this->input->post('PurchPaid'),
            "PurchaseMaster_DueAmount"          =>$this->input->post('purchaseDue'),
            "AddBy"                             =>$this->session->userdata("FullName"),
            "PurchaseMaster_BranchID"           =>$this->session->userdata("BRANCHid"),
            "AddTime"                           =>date("Y-m-d h:i:s")
        );      
        $purch_id = $this->billing_model->purchaseOrder($Purchase);
        $data = array(
            "SPayment_date"                     =>$this->input->post('Purchase_date', TRUE),
            "SPayment_invoice"                  =>$this->input->post('purchInvoice', TRUE),
            "SPayment_customerID"               =>$this->input->post('SupplierID', TRUE),
            "SPayment_amount"                   =>$this->input->post('PurchPaid', TRUE),
            "SPayment_notes"                    =>$this->input->post('Notes', TRUE),
            "SPayment_Addby"                    =>$this->session->userdata("FullName"),
            "SPayment_brunchid"                 =>$this->session->userdata("BRANCHid")
        );
        $this->mt->save_data("sr_supplier_payment", $data);

        // check varialble ===================
        if ($cart = $this->cart->contents()):
            foreach ($cart as $item):
                $packagename = $item['packagename'];
                $proname = $item['name'];
                $packagecode = $item['packagecode'];

                if($packagename == $proname){
                    $sqqS = mysql_query("SELECT sr_package_create.*, tbl_product.* FROM sr_package_create left join tbl_product on tbl_product.product_create_pack_id = sr_package_create.create_ID WHERE sr_package_create.create_pacageID = '$packagecode'");
                    while($romS = mysql_fetch_array($sqqS)){
                       $proids = $romS['Product_SlNo'];
                       $packagPRICE = $romS['create_purch_price'];
                       $packagNAME = $romS['create_item'];
                       $packqty = $romS['cteate_qty']*$item['qty'];

                        $order_detail = array(
                            'PurchaseMaster_IDNo'               => $purch_id,
                            'Product_IDNo'                      => $proids,
                            'PurchaseDetails_TotalQuantity'     => $packqty,
                            'PurchaseDetails_Rate'              => $packagPRICE,
                            'Pack_qty'                          => $item['qty'],
                            'PurchaseDetails_Unit'              => 'pcs',
                            'PackName'                          => $item['name'],
                            'PackPice'                          => $item['price'],
                            "PurchaseDetails_branchID"          =>$this->session->userdata("BRANCHid")
                        );
                        $this->mt->save_data("sr_purchasedetails",$order_detail);
                        $sql = mysql_query("SELECT * FROM sr_purchaseinventory WHERE purchProduct_IDNo = '".$proids."'");
                        $rox = mysql_fetch_array($sql);
                        $id = $rox['PurchaseInventory_SlNo'];
                        $oldStock = $rox['PurchaseInventory_TotalQuantity'];
                        $oldpackStock = $rox['PurchaseInventory_packqty'];

                        if($rox['purchProduct_IDNo']== $proids){
                            $addStock = array(
                                'purchProduct_IDNo'                         => $proids,
                                'PurchaseInventory_TotalQuantity'           => $oldStock+$packqty,
                                'PurchaseInventory_packname'                => $packagename, 
                                'PurchaseInventory_packqty'                 => $oldpackStock+$item['qty']
                            );
                            $this->mt->update_data("sr_purchaseinventory",$addStock,$id,'PurchaseInventory_SlNo');  
                        }else{
                            $addStock = array(
                                'purchProduct_IDNo'                         => $proids,
                                'PurchaseInventory_TotalQuantity'           => $packqty,
                                'PurchaseInventory_packname'                => $packagename, 
                                'PurchaseInventory_packqty'                 => $item['qty']
                            );
                        $this->mt->save_data("sr_purchaseinventory",$addStock);
                        }
                    }
                }
                else{
                    $PurchaseFor = $this->input->post('PurchaseFor');
                    $order_detail = array(
                        'PurchaseMaster_IDNo'               => $purch_id,
                        'Product_IDNo'                      => $item['id'],
                        'PurchaseDetails_TotalQuantity'     => $item['qty'],
                        'PurchaseDetails_Rate'              => $item['price'],
                        'PurchaseDetails_Unit'              => $item['image']
                    );
                    $this->mt->save_data("sr_purchasedetails",$order_detail);
                    $srdata = array(
                        'Invoice' => $this->input->post('purchInvoice'),
                        'Date' => $this->input->post('Purchase_date'),
                        'ProductID' => $item['id'],
                        'Store' => $PurchaseFor,
                        'StockType' => 'Product Purchase',
                        'InQty' => $item['qty'],
                        'OutQty' => 0
                    );
                    $this->mt->save_data("tbl_stock_register",$srdata);

                    $sql = mysql_query("SELECT * FROM sr_purchaseinventory WHERE purchProduct_IDNo = '".$item['id']."' AND PurchaseInventory_Store = '".$PurchaseFor."'");
                    $rox = mysql_fetch_array($sql);
                    $id = $rox['PurchaseInventory_SlNo'];
                    $oldStock = $rox['PurchaseInventory_TotalQuantity'];
                    $fld = 'PurchaseInventory_SlNo';
                    
                    if(($rox['purchProduct_IDNo'] == $item['id']) && ($rox['PurchaseInventory_Store'] == $PurchaseFor)){
                        $addStock = array(
                            'purchProduct_IDNo'                         => $item['id'],
                            'PurchaseInventory_TotalQuantity'           =>  $oldStock+$item['qty']
                        );
                        $this->mt->update_data("sr_purchaseinventory",$addStock,$id,$fld);  
                    }else{
                        $addStock = array(
                            'purchProduct_IDNo'                         => $item['id'],
                            'PurchaseInventory_Store' => $PurchaseFor,
                            'PurchaseInventory_TotalQuantity'           => $item['qty']
                        );
                    $this->mt->save_data("sr_purchaseinventory",$addStock);
                    } 
                }

            endforeach;
        endif;

        $this->cart->destroy();
        $xx['purchaseforprint'] = $purch_id;
        $this->session->set_userdata($xx);
        $this->load->view('purchase/purchase_order');

    }

   
    function PurchasereturnSearch(){
        $invoice = $this->input->post('invoiceno');
        $sql = mysql_query("SELECT * FROM sr_purchasemaster WHERE PurchaseMaster_SlNo = '$invoice'");
        $row = mysql_fetch_array($sql);
        $data['proID'] = $row['PurchaseMaster_SlNo'];
        $data['proinv'] = $row['PurchaseMaster_InvoiceNo'];
        $this->load->view('purchase/purchase_return_list', $data);
    }
    function PurchaseReturnInsert(){
        $returnqty = $this->input->post('returnqty');
        $returnamount = $this->input->post('returnamount');
        $return_date = $this->input->post('return_date');
        $productID = $this->input->post('productID');
        $invoices = $this->input->post('invoice');
        $totalQty = "";
        $RAmount = "";
        $totalarray = sizeof($returnqty);
        for($j = 0; $j<$totalarray; $j++){
            $rqtys = $this->input->post('returnqty');
            $totalQty = $rqtys[$j]+$totalQty;
            $ramounts = $this->input->post('returnamount');
            $RAmount = $ramounts[$j]+$RAmount;
        }
        
       $sqlll = mysql_query("SELECT * FROM sr_purchasereturn where PurchaseMaster_InvoiceNo = '$invoices'");
        $ros = mysql_fetch_array($sqlll);
        $iid = $ros['PurchaseReturn_SlNo'];
        $ivo = $ros['PurchaseMaster_InvoiceNo'];

        $totalqt = $ros['PurchaseReturn_ReturnQuantity'];
        $totalamou = $ros['PurchaseReturn_ReturnAmount'];
        $fld = 'PurchaseReturn_SlNo';

        if($ivo > 0){
            $return = array(
                "PurchaseMaster_InvoiceNo"               =>$this->input->post('invoice'),
                "PurchaseReturn_ReturnDate"              =>$this->input->post('return_date'),
                "PurchaseReturn_ReturnQuantity"          =>$totalQty+$totalqt,
                "PurchaseReturn_ReturnAmount"            =>$RAmount+$totalamou,
                "PurchaseReturn_Description"             =>$this->input->post('Notes'),
                "Supplier_IDdNo"                         =>$this->input->post('Supplier_No'),
                
                "AddBy"                                  =>$this->session->userdata("FullName"),
                "PurchaseReturn_brunchID"                =>$this->session->userdata("BRANCHid"),
                "AddTime"                                =>date("Y-m-d h:i:s")
            );      
            $return_id = $this->mt->update_data('sr_purchasereturn',$return,$iid,$fld);
            for($i=0;$i<$totalarray; $i++){
                $returnqtyss = $this->input->post('returnqty');
                $returnamounts = $this->input->post('returnamount');
                $productIDs = $this->input->post('productID');

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
                        //cteate_qty
                        $returns = array(
                            "PurchaseReturn_SlNo"                           =>$iid,
                            "PurchaseReturnDetails_ReturnDate"              =>$this->input->post('return_date'),
                            "PurchaseReturnDetailsProduct_SlNo"             =>$ron['Product_SlNo'],//$productIDs[$i]
                            "PurchaseReturnDetails_ReturnQuantity"          =>$returnqtyss[$i]*$romio['cteate_qty'],
                            "PurchaseReturnDetails_pacQty"                  =>$returnqtyss[$i],
                            "PurchaseReturnDetails_ReturnAmount"            =>$returnamounts[$i],
                            
                            "AddBy"                                         =>$this->session->userdata("FullName"),
                            "PurchaseReturnDetails_brachid"                 =>$this->session->userdata("BRANCHid"),
                            "AddTime"                                       =>date("Y-m-d h:i:s")
                        );      
                        $this->billing_model->SalesReturn('sr_purchasereturndetails',$returns);

                    }
                }else{
                    $returns = array(
                        "PurchaseReturn_SlNo"                           =>$iid,
                        "PurchaseReturnDetails_ReturnDate"              =>$this->input->post('return_date'),
                        "PurchaseReturnDetailsProduct_SlNo"             =>$productIDs[$i],
                        "PurchaseReturnDetails_ReturnQuantity"          =>$returnqtyss[$i],
                        "PurchaseReturnDetails_ReturnAmount"            =>$returnamounts[$i],
                        
                        "AddBy"                                         =>$this->session->userdata("FullName"),
                        "PurchaseReturnDetails_brachid"                 =>$this->session->userdata("BRANCHid"),
                        "AddTime"                                       =>date("Y-m-d h:i:s")
                    );      
                    $this->billing_model->SalesReturn('sr_purchasereturndetails',$returns);
                }
            } 
        }else{
            $return = array(
                "PurchaseMaster_InvoiceNo"               =>$this->input->post('invoice'),
                "PurchaseReturn_ReturnDate"              =>$this->input->post('return_date'),
                "PurchaseReturn_ReturnQuantity"          =>$totalQty,
                "PurchaseReturn_ReturnAmount"            =>$RAmount,
                "PurchaseReturn_Description"             =>$this->input->post('Notes'),
                "Supplier_IDdNo"                         =>$this->input->post('Supplier_No'),
                
                "AddBy"                                  =>$this->session->userdata("FullName"),
                "PurchaseReturn_brunchID"                =>$this->session->userdata("BRANCHid"),
                "AddTime"                                =>date("Y-m-d h:i:s")
            );      
            $return_id = $this->billing_model->SalesReturn('sr_purchasereturn',$return);

            for($i=0;$i<$totalarray; $i++){
                $returnqtyss = $this->input->post('returnqty');
                $returnamounts = $this->input->post('returnamount');
                $productIDs = $this->input->post('productID');

                $productsCodes = $this->input->post('productsCodes');
                $packnames = $this->input->post('packname');
                $packnames = $packnames[$i];
                $productsName = $this->input->post('productsName');
                $productsName = $productsName[$i];
                if($packnames == $productsName){
                    $sqj = mysql_query("SELECT * FROM sr_package_create WHERE create_pacageID ='".$productsCodes[$i]."'");
                    while($romio = mysql_fetch_array($sqj)){

                        $sqn = mysql_query("SELECT * FROM tbl_product WHERE Product_Code = '".$romio['create_proCode']."'");
                        $ron = mysql_fetch_array($sqn);
                        //cteate_qty
                        $returns = array(
                            "PurchaseReturn_SlNo"                           =>$return_id,
                            "PurchaseReturnDetails_ReturnDate"              =>$this->input->post('return_date'),
                            "PurchaseReturnDetailsProduct_SlNo"             =>$ron['Product_SlNo'],//$productIDs[$i]
                            "PurchaseReturnDetails_ReturnQuantity"          =>$returnqtyss[$i]*$romio['cteate_qty'],
                            "PurchaseReturnDetails_pacQty"                  =>$returnqtyss[$i],
                            "PurchaseReturnDetails_ReturnAmount"            =>$returnamounts[$i],
                            
                            "AddBy"                                         =>$this->session->userdata("FullName"),
                            "PurchaseReturnDetails_brachid"                 =>$this->session->userdata("BRANCHid"),
                            "AddTime"                                       =>date("Y-m-d h:i:s")
                        );      
                        $this->billing_model->SalesReturn('sr_purchasereturndetails',$returns);
                    }
                }else{
                    $returns = array(
                        "PurchaseReturn_SlNo"                           =>$return_id,
                        "PurchaseReturnDetails_ReturnDate"              =>$this->input->post('return_date'),
                        "PurchaseReturnDetailsProduct_SlNo"             =>$productIDs[$i],
                        "PurchaseReturnDetails_ReturnQuantity"          =>$returnqtyss[$i],
                        "PurchaseReturnDetails_ReturnAmount"            =>$returnamounts[$i],
                        
                        "AddBy"                                         =>$this->session->userdata("FullName"),
                        "PurchaseReturnDetails_brachid"                 =>$this->session->userdata("BRANCHid"),
                        "AddTime"                                       =>date("Y-m-d h:i:s")
                    );      
                    $this->billing_model->SalesReturn('sr_purchasereturndetails',$returns);
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
                    //cteate_qty 
                    $sqls = mysql_query("SELECT * FROM sr_purchaseinventory WHERE purchProduct_IDNo ='".$ron['Product_SlNo']."'");
                    $ROW = mysql_fetch_array($sqls);
                    $qTys= $romio['cteate_qty']*$rqtyss[$f];
                    $id = $ROW['PurchaseInventory_SlNo'];
                    $qt = $ROW['PurchaseInventory_ReturnQuantity'];
                    $pacKqty = $ROW['PurchaseInventory_returnqty'];
                    $fld = "PurchaseInventory_SlNo";
                    $returns = array(
                        "PurchaseInventory_ReturnQuantity"      =>$qTys+$qt,
                        "PurchaseInventory_returnqty"             =>$rqtyss[$f]+$pacKqty
                    );      
                    $this->mt->update_data('sr_purchaseinventory',$returns, $id,$fld);

                }
            }else{
                $sqls = mysql_query("SELECT * FROM sr_purchaseinventory WHERE purchProduct_IDNo ='".$productIDs[$f]."'");
                $ROW = mysql_fetch_array($sqls);
                $id = $ROW['PurchaseInventory_SlNo'];
                $qt = $ROW['PurchaseInventory_ReturnQuantity'];
                $pacKqty = $ROW['PurchaseInventory_returnqty'];
                $fld = "PurchaseInventory_SlNo";
                $returns = array(
                    "PurchaseInventory_ReturnQuantity"      =>$rqtyss[$f]+$qt,
                    "PurchaseInventory_returnqty"           =>$rqtyss[$f]+$pacKqty
                );      
                $this->mt->update_data('sr_purchaseinventory',$returns, $id,$fld);
            }
           
        }
        $this->load->view('sales/blankpage');
    }
    public function purchase_bill()  {
        $data['title'] = "Purchase Invoice";
        $data['content'] = $this->load->view('purchase/purchase_bill', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function purchase_invoice_search()  {
        $id = $this->input->post('purchasemsid');
        $sql = mysql_query("SELECT * FROM sr_purchasemaster WHERE PurchaseMaster_SlNo = '$id'");
        $row = mysql_fetch_array($sql);
        $datas['PurchID'] = $row['PurchaseMaster_SlNo'];
        $datas['invoices'] = $row['PurchaseMaster_InvoiceNo'];
        $this->session->set_userdata($datas);
        $this->load->view('purchase/purchase_invoice_search', $datas);
    }
    public function purchase_record()  {
        $data['title'] = "Purchase Record";
        $data['content'] = $this->load->view('purchase/purchase_record', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function purchase_supplierName()  {
        $id = $this->input->post('Supplierid');
        $sql = mysql_query("SELECT * FROM sr_supplier WHERE Supplier_SlNo = '$id'");
        $row = mysql_fetch_array($sql);
        $datas['SupplierName'] = $row['Supplier_Name'];
        $this->load->view('purchase/purchase_supplier_name', $datas);
    }
    function search_purchase_record()  {
        $dAta['searchtype']= $searchtype = $this->input->post('searchtype');
        $dAta['Purchase_startdate']=$Purchase_startdate = $this->input->post('Purchase_startdate');
        $dAta['Purchase_enddate']=$Purchase_enddate = $this->input->post('Purchase_enddate');
        $dAta['Supplierid']=$Supplierid = $this->input->post('Supplierid');
        $this->session->set_userdata($dAta);

        if($searchtype == "All"){
            $sql = "SELECT sr_purchasemaster.*, sr_supplier.* FROM sr_purchasemaster left join sr_supplier on sr_supplier.Supplier_SlNo = sr_purchasemaster.Supplier_SlNo WHERE sr_purchasemaster.PurchaseMaster_OrderDate between  '$Purchase_startdate' and '$Purchase_enddate'";
        }
        if($searchtype == "Supplier"){
            $sql = "SELECT sr_purchasemaster.*, sr_supplier.* FROM sr_purchasemaster left join sr_supplier on sr_supplier.Supplier_SlNo = sr_purchasemaster.Supplier_SlNo WHERE sr_purchasemaster.Supplier_SlNo = '$Supplierid' and  sr_purchasemaster.PurchaseMaster_OrderDate between  '$Purchase_startdate' and '$Purchase_enddate'";
        }
        $datas["record"] = $this->mt->ccdata($sql);
        
        $this->load->view('purchase/purchase_record_list', $datas);
    }
    function purchase_stock()  {
        $data['title'] = "Purchase Stock";
        $data['content'] = $this->load->view('stock/purchase_stock', $data, TRUE);
        $this->load->view('index', $data);
    }
    function damage_select_product()  {
        $prod_id = $this->input->post('prod_id');
        $sql = mysql_query("SELECT * FROM tbl_product WHERE Product_SlNo = '$prod_id'");
        $roe = mysql_fetch_array($sql);
        $data['Pname'] = $roe['Unit_ID'];
        $this->load->view('purchase/show_damage_pro_name', $data);
    }
    function damage_product_insert()  {
        $damage = array(
            "Damage_InvoiceNo"        =>$this->input->post('damage_id'),
            "Damage_Description"      =>$this->input->post('desc'),
            "Damage_Date"             =>date("Y-m-d"),
            
            "AddBy"                   =>$this->session->userdata("FullName"),
            "Damage_brunchid"         =>$this->session->userdata("BRANCHid"),
            "AddTime"                 =>date("Y-m-d h:i:s")
        );   
        $lastid = $this->mt->save_date_id("sr_damage",$damage);   
        $damagedeatil = array(
            "Damage_SlNo"                       =>$lastid,
            "Product_SlNo"                      =>$this->input->post('prod_id'),
            "DamageDetails_DamageQuantity"      =>$this->input->post('damage_quantity'),
            
            "AddBy"                             =>$this->session->userdata("FullName"),
            "AddTime"                           =>date("Y-m-d h:i:s")
        );   
        $this->mt->save_date_id("sr_damagedetails",$damagedeatil); 
        $addinventory = array(
            
            "DamageDetails_DamageQuantity"      =>$this->input->post('damage_quantity')
        );   
        //sr_purchaseinventory
        $pId = $this->input->post('prod_id');
        $sqls = mysql_query("SELECT * FROM sr_purchaseinventory WHERE purchProduct_IDNo ='$pId'");
            $ROW = mysql_fetch_array($sqls);
            $id = $ROW['PurchaseInventory_SlNo'];
            $qt = $ROW['PurchaseInventory_DamageQuantity'];
            $fld = "PurchaseInventory_SlNo";
            $returns = array(
                "PurchaseInventory_DamageQuantity"      =>$this->input->post('damage_quantity')+$qt
            );      
            $this->mt->update_data('sr_purchaseinventory',$returns, $id,$fld);
        //
        $this->load->view('purchase/damage_entry');
    }
    public function purchase_to_report()  {
        $data['title'] = "Purchase Invoice";
        $id = $this->session->userdata('purchaseforprint');
        $sql = mysql_query("SELECT * FROM sr_purchasemaster WHERE PurchaseMaster_SlNo = '$id'");
        $row = mysql_fetch_array($sql);
        $datas['PurchID'] = $row['PurchaseMaster_SlNo'];
        $datas['invoices'] = $row['PurchaseMaster_InvoiceNo'];
        $this->session->set_userdata($datas);
        $data['content'] = $this->load->view('purchase/purchase_to_report', $datas, TRUE);
        $this->load->view('index', $data);
    }
    public function returns_list()  {
        $data['title'] = "Purchase Invoice";
        $data['content'] = $this->load->view('purchase/return_list', $data, TRUE);
        $this->load->view('index', $data);
    }


}
