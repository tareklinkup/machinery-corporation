<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CI_Controller {
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
        $data['title'] = "Sales Service";
        $data['content'] = $this->load->view('service/service_sales', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function service_order(){
        $service = array(
            "ServiceMaster_InvoiceNo"      =>$this->input->post('salesInvoiceno'),
            "Po_No"                        =>$this->input->post('pono'),
            "Delevary_Invoice_No"       =>$this->input->post('delevaryInvoiceNo'),
            "Customer_IDNo"                =>$this->input->post('customerID'),
            "ServiceMaster_SaleDate"       =>$this->input->post('sales_date'),
            "ServiceMaster_Description"    =>$this->input->post('SelesNotes'),
            "ServiceMaster_TotalSaleAmount"   =>$this->input->post('SellTotals'),
            "ServiceMaster_TotalDiscountAmount" =>$this->input->post('SellsDiscount'),
            "ServiceMaster_TaxAmount"          =>$this->input->post('vatPersent'),
            "ServiceMaster_Freight"          =>$this->input->post('SellsFreight'),
            "ServiceMaster_SubTotalAmount"     =>$this->input->post('subTotal'),
            "ServiceMaster_PaidAmount"         =>$this->input->post('SellsPaid'),
            "ServiceMaster_paidby"             =>$this->input->post('paidby'),
            "ServiceMaster_DueAmount"          =>$this->input->post('SellsDue'),
            "AddBy"                        =>$this->session->userdata("FullName"),
            "ServiceMaster_branchid"       =>$this->session->userdata("BRANCHid"),
            "AddTime"                      =>date("Y-m-d h:i:s")
        );     
        $service_id = $this->billing_model->ServiceOrder($service);
        
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

                        $service_detail = array(
                            'ServiceMaster_IDNo'            => $service_id,
                            'Product_IDNo'                  => $proids,
                            'ServiceDetails_TotalQuantity'  => $packqty,
                            'ServiceDetails_qty'            => $item['qty'],
                            'ServiceDetails_Rate'           => $sellPRICE,
                            'ServiceDetails_unit'           => 'PCS',
                            'packSellPrice'                 => $item['price'],
                            'packageName'                   => $item['name'],
                            'Purchase_Rate'                 => $PurchpackagPRICE
                        );
                        $this->billing_model->insert_service_detail($service_detail); 
                    }   
                }
                else{
                    $service_detail = array(
                        'ServiceMaster_IDNo'            => $service_id,
                        'Product_IDNo'                  => $item['id'],
                        'ServiceDetails_TotalQuantity'  => $item['qty'],
                        'ServiceDetails_Rate'           => $item['price'],
                        'ServiceDetails_unit'           => $item['image'],
                        'Purchase_Rate'                 => $item['purchaserate']
                    );
                    $this->billing_model->insert_service_detail($service_detail); 
                }
                
            }// end foreach
        }// end if

        $this->cart->destroy();
        $sss['lastserviceforprint'] = $service_id;
        $this->session->set_userdata($sss);
        $this->load->view('service/service_sales');
    }
    public function serviceAndPrint()  {
        $data['title'] = "Sales Service";
        $id = $this->session->userdata('lastserviceforprint');
        $sql = mysql_query("SELECT * FROM sr_servicemaster WHERE ServiceMaster_SlNo = '$id'");
        $row = mysql_fetch_array($sql);
        $datas['ServiceID'] = $row['ServiceMaster_SlNo'];
        $this->session->set_userdata($datas);
        $data['content'] = $this->load->view('service/serviceAndPrint', $datas, TRUE);
        $this->load->view('index', $data);
    }
    public function viewAllService(){
        $data['title'] = "Sales Service";
        $data['content'] = $this->load->view('service/viewAllService', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function service_search(){
        $datas['SMSearchID'] = $this->input->post('ServiceMasterID');
        $this->session->set_userdata($datas);
        $this->load->view('service/service_search', $datas);
    }

    public function challan(){
        $data['title'] = "Service Challan";
        $data['content'] = $this->load->view('service/challan', $data, TRUE);
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
        $challan_id = $this->billing_model->ServiceChallanOrder($challan);
        
        
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
                        $this->billing_model->insert_service_challan_detail($challan_detail);
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
                    $this->billing_model->insert_service_challan_detail($challan_detail);

  
                }
                
            }// end foreach
        }// end if

        $this->cart->destroy();
        $sss['lastservicechallan'] = $challan_id;
        $this->session->set_userdata($sss);
        $this->load->view('service/challan');
    }
    public function challanAndPrint()  {
        $data['title'] = "Challan Report";
        $id = $this->session->userdata('lastservicechallan');
        $sql = mysql_query("SELECT * FROM sr_servicechallanmaster WHERE    ChallanMaster_SlNo = '$id'");
        $row = mysql_fetch_array($sql);
        $datas['ServiceChallanID'] = $row['ChallanMaster_SlNo'];
        $datas['ServiceChallan'] = $row['ChallanMaster_ChallanNo'];
        $this->session->set_userdata($datas);
        $data['content'] = $this->load->view('service/challanAndPrint', $datas, TRUE);
        $this->load->view('index', $data);
    }
    public function service_challan()  {
        $data['title'] = "Sales Challan";
        $data['content'] = $this->load->view('service/service_challan', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function service_challan_search(){
        $id = $this->input->post('ChallanMasterID');
        $sql = mysql_query("SELECT * FROM sr_servicechallanmaster WHERE ChallanMaster_SlNo = '$id'");
        $row = mysql_fetch_array($sql);
        $datas['serviceChallanMasterID'] = $row['ChallanMaster_SlNo'];
        $datas['servicechallans'] = $row['Delevary_Invoice_No'];
        $this->session->set_userdata($datas);
        $this->load->view('service/service_challan_search', $datas);
    } 

}