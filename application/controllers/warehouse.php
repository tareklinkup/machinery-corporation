<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Warehouse extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $access = $this->session->userdata('userId');
         if($access == '' ){
            redirect("login");
        }
        $this->load->model('billing_model');
        $this->load->model('model_table', "mt", TRUE);
        $this->load->helper('form');
    }
    public function index()  {
        $data['title'] = "Sales Order List";
        $data['content'] = $this->load->view('warehouse/index', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function pending_order(){
        $data['title'] = "Warehouse Pending Order";
        $data['content'] = $this->load->view('warehouse/pending_order', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function view_pending_order(){
        $data['SalesID'] = $this->input->post('SMID');
        $this->session->set_userdata($data);
        $this->load->view('warehouse/vieworderAndreport', $data);
    }

    public function delivery_pending_order(){
        $id = $this->input->post('SMID');
        $fld = 'SaleMaster_SlNo';
        $data = array(
            'SaleMaster_Dalivery_Status' => 'D'
            );
        $ud = $this->mt->update_data("sr_salesmaster",$data,$id,$fld); 
        if($ud){
            $this->load->view('warehouse/pending_order');
        }else{
            return false;
        }
    }

    public function delivered_order(){
        $data['title'] = "Warehouse Delivered Order";
        $data['content'] = $this->load->view('warehouse/delivered_order', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function current_stock(){
        $data['title'] = "Current Stock";
        $data['content'] = $this->load->view('warehouse/current_stock', $data, TRUE);
        $this->load->view('index', $data);
    }

}