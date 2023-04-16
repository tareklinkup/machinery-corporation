<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transfer extends CI_Controller {
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
        $data['title'] = "Product Transfer";
        $data['content'] = $this->load->view('transfer/index', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function select_product(){
        $data['ProID'] = $this->input->post('ProID');
        $data['SalesFrom'] = $this->input->post('SalesFrom');
        $this->load->view('transfer/ajax_product', $data);
    }

    public function transfer_order(){
        $trans = array(
            'TransferMaster_InvoiceNo' => $this->input->post('Invoiceno'),
            'TransferMaster_TransferTo' => $this->input->post('SalesFrom'),
            'TransferMaster__Date' => $this->input->post('TransDate'),
            'TransferMaster__Description' => $this->input->post('TransNote'),
            'AddBy' => $this->session->userdata("FullName"),
            'AddTime' => date('Y-m-d h:i:s')
        );
        $transid = $this->billing_model->TransferOrder($trans);

        if ($cart = $this->cart->contents()){
            foreach ($cart as $item){
                $trans_details = array(
                    'TransferMaster_IDNo' => $transid,
                    'Product_IDNo' => $item['id'],
                    'TransferDetails_TotalQuantity' => $item['qty'],
                    'TransferDetails_unit' => $item['image']
                );
                $this->billing_model->insert_transfer_details($trans_details);

                //Purchase stock start
                $transto = $this->input->post('SalesFrom');
                if($transto == 'Shop'){
                    $transfrom = 'Warehouse';
                }else{ 
                    $transfrom = 'Shop';
                }

                $spi = mysql_query("SELECT * FROM sr_purchaseinventory WHERE PurchaseInventory_Store = '".$transto."' AND purchProduct_IDNo = '".$item['id']."'");
                $pirow = mysql_fetch_array($spi);
                $piid = $pirow['PurchaseInventory_SlNo'];
                $pifld = 'PurchaseInventory_SlNo';
                $oldstock = $pirow['PurchaseInventory_TotalQuantity'];
                if(($pirow['purchProduct_IDNo'] == $item['id']) && ($pirow['PurchaseInventory_Store'] == $transto)){
                    $addstock = array(
                        'purchProduct_IDNo' => $item['id'],
                        'PurchaseInventory_TotalQuantity' => $oldstock+$item['qty']
                    );
                    $this->mt->update_data("sr_purchaseinventory",$addstock,$piid,$pifld);
                }else{
                    $addstock = array(
                        'purchProduct_IDNo' => $item['id'],
                        'PurchaseInventory_Store' => $transto,
                        'PurchaseInventory_TotalQuantity' => $oldstock+$item['qty']
                    );
                    $this->mt->save_data("sr_purchaseinventory",$addstock);
                }

                //Purchase stock end

                //Sales stock start
                $ssi = mysql_query("SELECT * FROM sr_saleinventory WHERE sellProduct_IdNo = '".$item['id']."' AND SaleInventory_Store = '".$transfrom."'");
                $sirow = mysql_fetch_array($ssi);
                $siid = $sirow['SaleInventory_SlNo'];
                $sifld = 'SaleInventory_SlNo';
                $sioldstock = $sirow['SaleInventory_TotalQuantity'];
                if(($sirow['sellProduct_IdNo'] == $item['id']) && ($sirow['SaleInventory_Store'] == $transfrom)){
                    $addsiStock = array(
                        'sellProduct_IdNo' => $item['id'],
                        'SaleInventory_TotalQuantity' => $sioldstock+$item['qty']
                    );
                    $this->mt->update_data("sr_saleinventory",$addsiStock, $siid, $sifld);
                }else{
                    $addsiStock = array(
                        'sellProduct_IdNo' => $item['id'],
                        'SaleInventory_Store' => $transfrom,
                        'SaleInventory_TotalQuantity' => +$item['qty']
                    );
                    $this->mt->save_data("sr_saleinventory",$addsiStock);
                }
                //Sales stock end


            }//end cart foreach

        }//end cart if
        
        $this->cart->destroy();
        $this->load->view('transfer/index');
    }

}