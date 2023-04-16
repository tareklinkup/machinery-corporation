<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_delete extends CI_Controller {
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
        $data['title'] = "Sales Invoice Delete";
        $data['content'] = $this->load->view('sales/sales_invoice_delete', $data, TRUE);
        $this->load->view('index', $data);
    }

    function sales_invoice_delete_process()  {
        $sid = $this->input->post('SaleMasteriD');
        $master = mysql_query("SELECT * FROM sr_salesmaster WHERE SaleMaster_SlNo = '$sid'");
        $raw = mysql_fetch_array($master);
        $Invoice = $raw['SaleMaster_InvoiceNo'];

        // Customer payment Delete =========================
        mysql_query("DELETE FROM sr_customer_payment WHERE CPayment_invoice = '$Invoice'");
        // Customer payment Delete end =========================
        
        // sr_saledetails Delete ==========================
        $saledetails = mysql_query("SELECT * FROM sr_saledetails  WHERE SaleMaster_IDNo = '$sid'");
        while($rox = mysql_fetch_array($saledetails)){
            $rox['Product_IDNo'];
            $sellqty = $rox['SaleDetails_TotalQuantity'];

            // qty delete form sr_saleinventory  =============
            $saleinventory = mysql_query("SELECT * from sr_saleinventory where sellProduct_IdNo = '".$rox['Product_IDNo']."'");
            $inven = mysql_fetch_array($saleinventory);
            $oldstock = $inven['SaleInventory_TotalQuantity'];
            $currentqty = $oldstock-$sellqty;
            mysql_query("UPDATE sr_saleinventory SET SaleInventory_TotalQuantity ='$currentqty' WHERE sellProduct_IdNo = '".$rox['Product_IDNo']."' ");
            
            // qty delete form sr_saleinventory end ==========

            //  saledetails Delete
            mysql_query("DELETE FROM sr_saledetails  WHERE SaleMaster_IDNo = '$sid'");
        }
        mysql_query("DELETE FROM sr_salesmaster WHERE SaleMaster_SlNo = '$sid'");
        // sr_saledetails Delete end ======================    
    }


}
