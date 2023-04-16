<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Quotation extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->sbrunch = $this->session->userdata('BRANCHid');
        $access = $this->session->userdata('userId');
        if ($access == '') {
            redirect("login");
        }
        $this->load->model('billing_model');
        $this->load->library('cart');
        $this->load->model('model_table', "mt", TRUE);
        $this->load->helper('form');
    }

    public function index($type = '')
    {
        $this->cart->destroy();
        $data['title'] = "Quatation Entry";
        $data['type'] = $type;
        $data['content'] = $this->load->view('quotation/quotation_entry', $data, TRUE);
        $this->load->view('index', $data);
    }


    public function quotation_create()
    {
        $type = $this->input->post('type');


        $salesInvoiceno = $this->input->post('salesInvoiceno');
        $SalesFrom = $this->input->post('SalesFrom');

        $data = array(
            'customer_name' => $this->input->post('CusName'),
            'contact_number' => $this->input->post('CusMobile'),
            'customer_address' => $this->input->post('CusAddress'),
            'quation_customer_branchid' => $this->session->userdata("BRANCHid"),
            'status' => 'q'
        );
        $customerID = $this->billing_model->quotation_customer_insert($data);

        $quotation = array(
            "SaleMaster_InvoiceNo" => $salesInvoiceno,
            "SalseCustomer_IDNo" => $customerID,
            "SaleMaster_SaleDate" => $this->input->post('sales_date'),
            "SaleMaster_Description" => $this->input->post('SelesNotes'),
            "SaleMaster_SaleType" => $this->input->post('SalesFrom'),
            "SaleMaster_TotalSaleAmount" => $this->input->post('subTotal'),
            "SaleMaster_TotalDiscountAmount" => $this->input->post('SellsDiscount'),
            "SaleMaster_TaxAmount" => $this->input->post('vatPersent'),
            "SaleMaster_Freight" => $this->input->post('SellsFreight'),
            "SaleMaster_SubTotalAmount" => $this->input->post('SellTotals'),
            "SaleMaster_PaidAmount" => 0,
            "SaleMaster_DueAmount" => $this->input->post('SellsDue'),
            "AddBy" => $this->session->userdata("FullName"),
            "Status" => 'q',
            "AddTime" => date("Y-m-d h:i:s")
        );
        $quotation_id = $this->billing_model->quotationCreate($quotation);

        if ($cart = $this->cart->contents()) {
            foreach ($cart as $item) {
                $order_detail = array(
                    'SaleMaster_IDNo' => $quotation_id,
                    'Product_IDNo' => $item['id'],
                    'product_description' => $item['product_description'],
                    'SaleDetails_TotalQuantity' => $item['qty'],
                    'SaleDetails_Rate' => $item['price'],
                    'SaleDetails_unit' => $item['image'],
                    'Purchase_Rate' => $item['purchaserate']
                );
                $this->billing_model->insert_quotation_detail($order_detail);
            }// end foreach
        }// end if

        $this->cart->destroy();
        $sss['type'] = $type;
        $sss['lastidforprint'] = $quotation_id;
        $this->session->set_userdata($sss);
        $this->load->view('sales/product_sales');
    }

    public function sellAndPrint()
    {
        $data['title'] = "Quotation  Report";
        $id = $this->session->userdata('lastidforprint');
        $datas['SalesID'] = $id;

        $this->session->set_userdata($datas);
        $data['content'] = $this->load->view('quotation/sellAndreport', $datas, TRUE);
        $this->load->view('index', $data);
    }


    public function sales_invoice()
    {
        $data['title'] = "Quotation Invoice";
        $data['id'] = $this->session->userdata('SalesID');
        $this->load->view('quotation/sales_invoice', $data);
    }

    public function quotation_invoice()
    {
        $data['title'] = "Quotation Invoice";
        $data['content'] = $this->load->view('quotation/quotation_invoice', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function quotation_invoice_search()
    {
        $id = $this->input->post('SaleMaster_SlNo');
        $sql = mysql_query("SELECT * FROM sr_quotationmaster WHERE SaleMaster_SlNo = '$id'");
        $row = mysql_fetch_array($sql);
        $datas['SalesID'] = $row['SaleMaster_SlNo'];
        $datas['invoices'] = $row['SaleMaster_InvoiceNo'];
        $this->session->set_userdata($datas);
        $this->load->view('quotation/quotation_invoice_search', $datas);
    }



    public function quotationPrint()  {
        $data['title'] = "Quotation Invoice";
        $data['id'] = $this->session->userdata('SalesID');
        $this->load->view('quotation/quotation_invoice_print', $data);
    }
    public function checkInvoice()
    {
        $invoice = $this->input->post('invoice');
        $sql = mysql_query("SELECT * FROM tbl_quotation_master WHERE SaleMaster_InvoiceNo = '$invoice'");
        $row = mysql_fetch_row($sql);
        //echo "<pre>"; print_r($row);exit;
        if ($row['SaleMaster_InvoiceNo'] == $invoice) {
            return true;
        } else {
            return false;
        }
    }

    function quotation_record($type = '')
    {
        if ($type == 'm') {
            $data['title'] = "Memo Record";
        } else {
            $data['title'] = "Quatation Record";
        }
        $data['type'] = $type;
        $data['content'] = $this->load->view('quotation/quotation_record', $data, TRUE);
        $this->load->view('index', $data);
    }

    function sales_customerName()
    {
        $id = $this->input->post('customerID');
        $sql = mysql_query("SELECT * FROM tbl_customer WHERE Customer_SlNo = '$id'");
        $row = mysql_fetch_array($sql);
        $datas['customerName'] = $row['Customer_Name'];
        $this->load->view('sales/salesrecord_customername', $datas);
    }

    function search_quotation_record($type = '')
    {

        $dAta['type'] = $type = $this->input->post('type');
        $dAta['searchtype'] = $searchtype = $this->input->post('searchtype');
        $dAta['Sales_startdate'] = $Sales_startdate = $this->input->post('Sales_startdate');
        $dAta['Sales_enddate'] = $Sales_enddate = $this->input->post('Sales_enddate');
        $dAta['customerID'] = $customerID = $this->input->post('customerID');
        $dAta['Invoice'] = $Invoice = $this->input->post('Invoice');
        $dAta['Salestype'] = $Salestype = $this->input->post('Salestype');

        $this->session->set_userdata($dAta);

        if ($searchtype == "All") {
            if ($type == 'q') {
                $sql = "SELECT tbl_quotation_master.*, tbl_quotation_master.AddBy as served, tbl_quotaion_customer.* FROM tbl_quotation_master left join tbl_quotaion_customer on tbl_quotaion_customer.quotation_customer_id = tbl_quotation_master.SalseCustomer_IDNo WHERE tbl_quotaion_customer.Status = 'q' AND tbl_quotation_master.SaleMaster_branchid = '" . $this->sbrunch . "' AND tbl_quotation_master.SaleMaster_SaleDate between '$Sales_startdate' AND '$Sales_enddate' ";
            } else {
                $sql = "SELECT tbl_quotation_master.*, tbl_quotation_master.AddBy as served, tbl_quotaion_customer.* FROM tbl_quotation_master left join tbl_quotaion_customer on tbl_quotaion_customer.quotation_customer_id = tbl_quotation_master.SalseCustomer_IDNo WHERE tbl_quotaion_customer.Status = 'm' AND tbl_quotation_master.SaleMaster_branchid = '" . $this->sbrunch . "' AND tbl_quotation_master.SaleMaster_SaleDate between '$Sales_startdate' AND '$Sales_enddate' ";
            }
            $datas["invoive"] = "";
        }

        if ($searchtype == "Customer") {
            $sql = "SELECT tbl_quotation_master.*, tbl_quotation_master.AddBy as served, tbl_quotaion_customer.* FROM tbl_quotation_master left join tbl_quotaion_customer on tbl_quotaion_customer.quotation_customer_id = tbl_quotation_master.SalseCustomer_IDNo WHERE tbl_quotation_master.SalseCustomer_IDNo = '$customerID'";
            $datas["invoive"] = "";
        }

        if ($searchtype == "invoice") {
            $sql = "SELECT tbl_quotation_master.*, tbl_quotation_master.AddBy as served, tbl_quotaion_customer.* FROM tbl_quotation_master left join tbl_quotaion_customer on tbl_quotaion_customer.quotation_customer_id = tbl_quotation_master.SalseCustomer_IDNo WHERE tbl_quotation_master.SaleMaster_SlNo = $Invoice";
            $datas["invoive"] = "invoice";
        }

        $datas["record"] = $this->mt->ccdata($sql);

        $this->load->view('quotation/quotation_record_list', $datas);
    }


    public function quotationReport()
    {
        $type = $this->session->userdata('type');
        if ($type == 'q') {
            $data['title'] = "Quatation Report";
        } else {
            $data['title'] = "Memo Report";
        }

        $id = $this->session->userdata('lastidforprint');
        $sql = mysql_query("SELECT * FROM tbl_quotation_master WHERE SaleMaster_SlNo = '$id'");
        $row = mysql_fetch_array($sql);
        $datas['SalesID'] = $row['SaleMaster_SlNo'];
        $datas['invoices'] = $row['SaleMaster_InvoiceNo'];
        $this->session->set_userdata($datas);
        //echo "<pre>";print_r($this->session->userdata);exit;
        $data['content'] = $this->load->view('quotation/quotationReport', $datas, TRUE);
        $this->load->view('index', $data);
    }

    public function quotationPrint2($idd = '')
    {
        $type = $this->session->userdata('type');
        if ($type == 'q') {
            $data['title'] = "Quatation Report";
        } else {
            $data['title'] = "Memo Report";
        }
        $id = $this->session->userdata('lastidforprint');
        $sql = mysql_query("SELECT * FROM tbl_quotation_master WHERE SaleMaster_SlNo = '$id'");
        $row = mysql_fetch_array($sql);
        if ($idd == '') {
            $datas['SalesID'] = $row['SaleMaster_SlNo'];
            $datas['invoices'] = $row['SaleMaster_InvoiceNo'];
        } else {
            $datas['SalesID'] = $idd;
        }

        $this->session->set_userdata($datas);
        $this->load->view('quotation/quotationPrint', $datas);
    }
}
