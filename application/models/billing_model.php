<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Billing_model extends CI_Model {
    
     // Get all details ehich store in "products" table in database.
        public function get_all()
	{
		$query = $this->db->get('products');
		return $query->result_array();
	}
    
    // Insert customer details in "customer" table in database.
	public function purchaseOrder($data)
	{
		$this->db->insert('sr_purchasemaster', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;		
	}

	public function TransferOrder($data){
		$this->db->insert('sr_transfermaster', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}

	public function insert_transfer_details($data){
		$this->db->insert('sr_transferdetails', $data);
	}
	
        // Insert order date with customer id in "orders" table in database.
	public function insert_order($data)
	{
		$this->db->insert('order_tbl', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	
        // Insert ordered product detail in "order_detail" table in database.
	public function insert_order_detail($data) {
		$this->db->insert('sr_purchasedetails', $data);
	}
	// ==========================Sales Product==========================================
	public function SalesOrder($data) {
		$this->db->insert('sr_salesmaster', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;		
	}
	public function WHSalesOrder($data){
		$this->db->insert('sr_warehouse_master', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	public function insert_wh_details($data){
		$this->db->insert('sr_warehouse_details', $data);
	}
	public function ServiceOrder($data) {
		$this->db->insert('sr_servicemaster', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;		
	}
	public function ChallanOrder($data) {
		$this->db->insert('sr_challanmaster', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;		
	}
	public function ServiceChallanOrder($data){
		$this->db->insert('sr_servicechallanmaster', $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;
	}
	public function insert_challan_detail($data){
		$this->db->insert('sr_challandetails', $data);
	}
	public function insert_service_challan_detail($data){
		$this->db->insert('sr_servicechallandetails', $data);
	}
	public function SalesOrderUpdate($data) {
		  $SaleMaster_InvoiceNo = $data['SaleMaster_InvoiceNo'];
		  unset($data['SaleMaster_SlNo']);
		  $this->db->where('SaleMaster_SlNo', $SaleMaster_SlNo);
		  $this->db->update('sr_salesmaster' ,$data);
		  return true;		
	}

	public function insert_sales_detail($data) {
		$this->db->insert('sr_saledetails', $data);
	}
	public function insert_service_detail($data) {
		$this->db->insert('sr_servicedetails', $data);
	}
	// ==========================Sales Return==========================================
	public function SalesReturn($table, $data) {
		$this->db->insert($table, $data);
		$id = $this->db->insert_id();
		return (isset($id)) ? $id : FALSE;		
	}

    // ==========================quotation customer & Product==========================================
    public function quotation_customer_insert($data) {
        $this->db->insert('tbl_quotaion_customer', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }

    public function quotationCreate($data) {
        $this->db->insert('sr_quotationmaster', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }
    public function insert_quotation_detail($data) {
        $this->db->insert('sr_quotationdetails', $data);
    }
}