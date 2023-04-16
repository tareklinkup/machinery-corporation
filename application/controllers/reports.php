<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {
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
        $data['title'] = "Product Sales";
        $data['content'] = $this->load->view('sales/product_sales', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function supplierList()  {
        $data['title'] = "Supplier List";
        $this->load->view('reports/supplierList', $data);
    }
    public function customerlist()  {
        $data['title'] = "Customer List";
        $this->load->view('reports/customer_list', $data);
    }
    public function employeelist()  {
        $data['title'] = "Employee List";
        $this->load->view('reports/employeelist', $data);
    }
    public function sales_invoice()  {
        $data['title'] = "Sales Invoice";
        $data['id'] = $this->session->userdata('SalesID');
        $this->load->view('reports/sales_invoice', $data);
    }
    public function warehouse_sales_invoice(){
        $data['title'] = "Sales Invoice";
        $data['id'] = $this->session->userdata('SalesID');
        $this->load->view('reports/warehouse_sales_invoice', $data);
    }
    public function wh_sales_invoice(){
        $data['title'] = "Sales Invoice";
        $data['id'] = $this->session->userdata('SalesID');
        $this->load->view('reports/wh_sales_invoice', $data);
    }
    public function sales_challan()  {
        $data['title'] = "Sales Challan";
        $data['id'] = $this->session->userdata('ChallanMasterID');
        $this->load->view('reports/sales_challan', $data);
    }
    public function sales_invoice_due()  {
        $data['title'] = "Sales Invoice";
        $data['id'] = $this->session->userdata('SalesID');
        $this->load->view('reports/sales_invoice_withdue', $data);
    }
    public function Purchase_invoice()  {
        $data['title'] = "Purchase Bill";
        $data['id'] = $this->session->userdata('PurchID');
        $this->load->view('reports/purchase_bill', $data);
    }
    function search_purchase_record()  {
        $searchtype = $this->session->userdata('searchtype');
        $Purchase_startdate = $this->session->userdata('Purchase_startdate');
        $Purchase_enddate = $this->session->userdata('Purchase_enddate');
        $Supplierid = $this->session->userdata('Supplierid');
        if($searchtype == "All"){
            $sql = "SELECT sr_purchasemaster.*, sr_supplier.* FROM sr_purchasemaster left join sr_supplier on sr_supplier.Supplier_SlNo = sr_purchasemaster.Supplier_SlNo WHERE sr_purchasemaster.PurchaseMaster_OrderDate between  '$Purchase_startdate' and '$Purchase_enddate'";
        }
        if($searchtype == "Supplier"){
            $sql = "SELECT sr_purchasemaster.*, sr_supplier.* FROM sr_purchasemaster left join sr_supplier on sr_supplier.Supplier_SlNo = sr_purchasemaster.Supplier_SlNo WHERE sr_purchasemaster.Supplier_SlNo = '$Supplierid' and  sr_purchasemaster.PurchaseMaster_OrderDate between  '$Purchase_startdate' and '$Purchase_enddate'";
        }
        $datas["record"] = $this->mt->ccdata($sql);
        
        $this->load->view('reports/purchase_record_print', $datas);
    }
    function search_sales_record()  {
        $searchtype = $this->session->userdata('searchtype');
        $Sales_startdate = $this->session->userdata('Sales_startdate');
        $Sales_enddate = $this->session->userdata('Sales_enddate');
        $customerID = $this->session->userdata('customerID');
        if($searchtype == "All"){
            $sql = "SELECT sr_salesmaster.*, sr_customer.* FROM sr_salesmaster left join sr_customer on sr_customer.Customer_SlNo = sr_salesmaster.SalseCustomer_IDNo WHERE sr_salesmaster.SaleMaster_SaleDate between  '$Sales_startdate' and '$Sales_enddate'";
        }
        if($searchtype == "Customer"){
            $sql = "SELECT sr_salesmaster.*, sr_customer.* FROM sr_salesmaster left join sr_customer on sr_customer.Customer_SlNo = sr_salesmaster.SalseCustomer_IDNo WHERE sr_salesmaster.SalseCustomer_IDNo = '$customerID' and  sr_salesmaster.SaleMaster_SaleDate between  '$Sales_startdate' and '$Sales_enddate'";
        }
        $datas["record"] = $this->mt->ccdata($sql);
        
        $this->load->view('reports/sales_record_print', $datas);
    }
    function sales_stock()  {
        $datas['title'] = "Sales Stock";
        $this->load->view('reports/sales_sotck', $datas);
    }
    function purchase_stock()  {
        $datas['title'] = "Purchase Stock";
        $this->load->view('reports/purchase_stock', $datas);
    }
    function search_supplier_due()  {
        $searchtype = $this->session->userdata('searchtype');
        $Purchase_startdate = $this->session->userdata('Purchase_startdate');
        $Purchase_enddate = $this->session->userdata('Purchase_enddate');
        $Supplierid = $this->session->userdata('Supplierid');
        if($searchtype == "All"){
            $sql = "SELECT sr_purchasemaster.*, sr_supplier.* FROM sr_purchasemaster left join sr_supplier on sr_supplier.Supplier_SlNo = sr_purchasemaster.Supplier_SlNo WHERE sr_purchasemaster.PurchaseMaster_OrderDate between  '$Purchase_startdate' and '$Purchase_enddate' group by sr_purchasemaster.Supplier_SlNo";
        }
        if($searchtype == "Supplier"){
            $sql = "SELECT sr_purchasemaster.*, sr_supplier.* FROM sr_purchasemaster left join sr_supplier on sr_supplier.Supplier_SlNo = sr_purchasemaster.Supplier_SlNo WHERE sr_purchasemaster.Supplier_SlNo = '$Supplierid' and  sr_purchasemaster.PurchaseMaster_OrderDate between  '$Purchase_startdate' and '$Purchase_enddate' group by sr_purchasemaster.Supplier_SlNo";
        }
        $datas["record"] = $this->mt->ccdata($sql);
        
        $this->load->view('reports/supplier_due_list_print', $datas);
    }
    function search_customer_due()  {
        $searchtype = $this->session->userdata('searchtype');
        $Sales_startdate = $this->session->userdata('Sales_startdate');
        $Sales_enddate = $this->session->userdata('Sales_enddate');
        $customerID = $this->session->userdata('customerID');
        if($searchtype == "All"){
            $sql = "SELECT sr_salesmaster.*, sr_customer.* FROM sr_salesmaster left join sr_customer on sr_customer.Customer_SlNo = sr_salesmaster.SalseCustomer_IDNo WHERE sr_salesmaster.SaleMaster_SaleDate between  '$Sales_startdate' and '$Sales_enddate' group by sr_salesmaster.SalseCustomer_IDNo";
        }
        if($searchtype == "Customer"){
            $sql = "SELECT sr_salesmaster.*, sr_customer.* FROM sr_salesmaster left join sr_customer on sr_customer.Customer_SlNo = sr_salesmaster.SalseCustomer_IDNo WHERE sr_salesmaster.SalseCustomer_IDNo = '$customerID' and  sr_salesmaster.SaleMaster_SaleDate between  '$Sales_startdate' and '$Sales_enddate' group by sr_salesmaster.SalseCustomer_IDNo";
        }
        $datas["record"] = $this->mt->ccdata($sql);
        
        $this->load->view('reports/customer_due_print', $datas);
    }
    function supplier_payment_print()  {
        $searchtype = $this->session->userdata('searchtype');
        $Purchase_startdate = $this->session->userdata('Purchase_startdate');
        $Purchase_enddate = $this->session->userdata('Purchase_enddate');
        $Supplierid = $this->session->userdata('Supplierid');
        if($searchtype == "All"){
            $sql = "SELECT sr_supplier_payment.*, sr_supplier.* FROM sr_supplier_payment left join sr_supplier on sr_supplier.Supplier_SlNo = sr_supplier_payment.SPayment_customerID WHERE sr_supplier_payment.SPayment_date between  '$Purchase_startdate' and '$Purchase_enddate'";
        }
        if($searchtype == "Supplier"){
            $sql = "SELECT sr_supplier_payment.*, sr_supplier.* FROM sr_supplier_payment left join sr_supplier on sr_supplier.Supplier_SlNo = sr_supplier_payment.SPayment_customerID WHERE sr_supplier_payment.SPayment_customerID = '$Supplierid' and  sr_supplier_payment.SPayment_date between  '$Purchase_startdate' and '$Purchase_enddate'";
        }
        $datas["record"] = $this->mt->ccdata($sql);
        
        $this->load->view('reports/supplier_payment_print', $datas);
    }
    function customer_payment_print()  {
       $searchtype = $this->session->userdata('searchtype');
        $Sales_startdate = $this->session->userdata('Sales_startdate');
        $Sales_enddate = $this->session->userdata('Sales_enddate');
        $customerID = $this->session->userdata('customerID');
        if($searchtype == "All"){
            
            $sql = "SELECT sr_customer_payment.*, sr_customer.* FROM sr_customer_payment left join sr_customer on sr_customer.Customer_SlNo = sr_customer_payment.CPayment_customerID WHERE sr_customer_payment.CPayment_date between  '$Sales_startdate' and '$Sales_enddate'";
        }
        if($searchtype == "Customer"){
            $sql = "SELECT sr_customer_payment.*, sr_customer.* FROM sr_customer_payment left join sr_customer on sr_customer.Customer_SlNo = sr_customer_payment.CPayment_customerID WHERE sr_customer_payment.CPayment_customerID = '$customerID' and  sr_customer_payment.CPayment_date between  '$Sales_startdate' and '$Sales_enddate'";
        }
        $datas["record"] = $this->mt->ccdata($sql);
        
        $this->load->view('reports/customer_payment_print', $datas);
    }
    function current_stock()  {
        $datas['title'] = "Current Stock";
        $this->load->view('reports/current_stock', $datas);
    }
    function expense_print()  {
        $expence_startdate = $this->session->userdata('expence_startdate');
        $expence_enddate = $this->session->userdata('expence_enddate');
        $accountid = $this->session->userdata('accountid');
        $searchtype = $this->session->userdata('searchtype');
        if($searchtype=="All"){
            $sql = "SELECT sr_cashtransaction.*,sr_account.* FROM sr_cashtransaction left join sr_account on sr_account.Acc_SlNo=sr_cashtransaction.Acc_SlID where Tr_date between '$expence_startdate' and '$expence_enddate'";

        }
        elseif($searchtype=="Account"){
            $sql = "SELECT sr_cashtransaction.*,sr_account.* FROM sr_cashtransaction left join sr_account on sr_account.Acc_SlNo=sr_cashtransaction.Acc_SlID where sr_cashtransaction.Acc_SlID ='$accountid ' and sr_cashtransaction.Tr_date between '$expence_startdate' and '$expence_enddate'";
        }
        $datas["record"] = $this->mt->ccdata($sql);
        
        $this->load->view('reports/expense_list', $datas);
    }
    function cashview_print()  {
        $startdate = $this->session->userdata('startdate');
        $enddate = $this->session->userdata('enddate');
        $sql = "SELECT sr_cashtransaction.*,sr_account.* FROM sr_cashtransaction left join sr_account on sr_account.Acc_SlNo=sr_cashtransaction.Acc_SlID WHERE sr_cashtransaction.Tr_date between '$startdate' AND '$enddate'";
        //$sql = "SELECT sr_cashtransaction.*,sr_account.* FROM sr_cashtransaction left join sr_account on sr_account.Acc_SlNo=sr_cashtransaction.Acc_SlID ";
        $datas["record"] = $this->mt->ccdata($sql);
        $datas["startdate"] = $startdate;
        $datas["enddate"] = $enddate;
        $this->load->view('reports/cashview_print', $datas);
    }
    function salesreturnlist(){
        $this->load->view('reports/salesreturnlist');
    }
    function purchase_returnlist(){
        $this->load->view('reports/purchase_return_list');
    }
    function search_sales_recordbyCate()  {
        $Categoryid = $this->session->userdata('Categoryid');
        $Sales_startdate = $this->session->userdata('Sales_startdate');
        $Sales_enddate = $this->session->userdata('Sales_enddate');
        $customerID = $this->session->userdata('customerID');
        $sql = "SELECT sr_salesmaster.*, sr_customer.*,sr_saledetails.*,tbl_product.*,sr_productcategory.* 
        FROM sr_salesmaster 
        left join sr_customer on sr_customer.Customer_SlNo = sr_salesmaster.SalseCustomer_IDNo
        left join sr_saledetails on sr_saledetails.SaleMaster_IDNo = sr_salesmaster.SaleMaster_SlNo  
        left join tbl_product on tbl_product.Product_SlNo = sr_saledetails.Product_IDNo  
        left join sr_productcategory on sr_productcategory.ProductCategory_SlNo = tbl_product.ProductCategory_ID
        WHERE tbl_product.ProductCategory_ID = '$Categoryid' and sr_salesmaster.SalseCustomer_IDNo = '$customerID' and 
        sr_salesmaster.SaleMaster_SaleDate between  '$Sales_startdate' and '$Sales_enddate'";
        $datas["record"] = $this->mt->ccdata($sql);
        
        $this->load->view('reports/sales_record_printbyCat', $datas);
    }
    public function money_receipt(){
        $data['title'] = "Money Receipt";
        $data['id'] = $this->session->userdata("receiptID");
        $this->load->view('reports/money_receipt', $data);
    }
    public function challan(){
        $data['title'] = "Challan";
        $data['id'] = $this->session->userdata("lastchallan");
        $this->load->view('reports/challan', $data);
    }
    public function service_challan_report(){
        $data['title'] = "Challan";
        $data['id'] = $this->session->userdata("lastservicechallan");
        $this->load->view('reports/service_challan', $data);
    }
    public function money_receipt_print(){
        $this->load->view('reports/money_receipt_search_result');
    }
    public function sales_invoiec(){
        $data['title'] = "Sales Invoice";
        $data['id'] = $this->session->userdata('ServiceID');
        $this->load->view('reports/sales_service', $data);
    }
    public function service_search(){
        $this->load->view('reports/service_search');
    }
    public function service_challan_search()  {
        $data['title'] = "Sales Challan";
        $data['id'] = $this->session->userdata('serviceChallanMasterID');
        $this->load->view('reports/service_challan_search', $data);
    }
    public function warehouse_current_stock(){
        $this->load->view('reports/warehouse_current_stock');
    }

    public function summery_print(){
        $this->load->view('reports/summery_print');
    }
}
