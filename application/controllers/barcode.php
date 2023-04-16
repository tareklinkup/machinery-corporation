<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class barcode extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $access = $this->session->userdata('userId');
         if($access == '' ){
            redirect("login");
        }
        date_default_timezone_set('Asia/Dhaka');
    }

    public function generate_barcode($id){
        $data['product']=$this->db->where('Product_SlNo', $id)->get('tbl_product')->row();
        $this->load->view('barcode/index', $data);
    }

}