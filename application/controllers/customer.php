<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $access = $this->session->userdata('userId');
         if($access == '' ){
            redirect("login");
        }
        $this->load->model("model_myclass", "mmc", TRUE);
        $this->load->model('model_table', "mt", TRUE);
    }
    public function index()  {
        $data['title'] = "Customer";
        $data['content'] = $this->load->view('add_customer', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function insert_customer()  {
        $data = array(
            "Customer_Code"                 =>$this->input->post('Customer_id', TRUE),
            "Customer_Name"                 =>$this->input->post('cus_name', TRUE),
            "Customer_Type"                 =>$this->input->post('type', TRUE),
            "Customer_Address"              =>$this->input->post('address', TRUE),
            "Country_SlNo"                  =>$this->input->post('country', TRUE),
            "Customer_Phone"                =>$this->input->post('phone', TRUE),
            "Customer_Mobile"               =>$this->input->post('mobile', TRUE),
            "Customer_OfficePhone"          =>$this->input->post('office_phone', TRUE),
            "Customer_Email"                =>$this->input->post('email', TRUE),
            "Customer_Web"                  =>$this->input->post('web', TRUE),
            "Customer_Credit_Limit"         =>$this->input->post('credit', TRUE),
            "AddBy"                         =>$this->session->userdata("FullName"),
            "AddTime"                       =>date("Y-m-d h:i:s")
            );
        $this->mt->save_data('sr_customer',$data);
        $this->load->view('ajax/customer');
    }
    public function customeredit()  {
        $data['title'] = "Edit Customer";
        $id =$this->input->post('edit');
        $query = "SELECT sr_customer.*, sr_country.* FROM sr_customer left join sr_country on sr_country.Country_SlNo=sr_customer.Country_SlNo where sr_customer.Customer_SlNo = '$id'";
        $data['selected'] = $this->mt->edit_by_id($query);
        //$data['content'] = $this->load->view('edit/customer_edit', $data, TRUE);
        $this->load->view('edit/customer_edit', $data);
    }
    public function customerupdate(){
        $id = $this->input->post('id');
        $fld = 'Customer_SlNo';
        $data = array(
            "Customer_Code"                 =>$this->input->post('Customer_id', TRUE),
            "Customer_Name"                 =>$this->input->post('cus_name', TRUE),
            "Customer_Type"                 =>$this->input->post('type', TRUE),
            "Customer_Address"              =>$this->input->post('address', TRUE),
            "Country_SlNo"                  =>$this->input->post('country', TRUE),
            "Customer_Phone"                =>$this->input->post('phone', TRUE),
            "Customer_Mobile"               =>$this->input->post('mobile', TRUE),
            "Customer_OfficePhone"          =>$this->input->post('office_phone', TRUE),
            "Customer_Email"                =>$this->input->post('email', TRUE),
            "Customer_Web"                  =>$this->input->post('web', TRUE),
            "Customer_Credit_Limit"         =>$this->input->post('credit', TRUE),
            "UpdateBy"                      =>$this->session->userdata("FullName"),
            "UpdateTime"                    =>date("Y-m-d h:i:s")
        );
        $this->mt->update_data("sr_customer", $data, $id,$fld);
    } 
    public function customerdelete(){
        $id = $this->input->post('deleted');
        $fld = 'Customer_SlNo';
        $this->mt->delete_data("sr_customer", $id, $fld);
        $data['cate'] = 'Delete Success';
        $this->load->view('ajax/customer', $data);
    } 
    function customer_due(){
        $data['title'] = 'Customer Due';
        $data['content'] = $this->load->view('due_report/customer_due', $data, TRUE);
        $this->load->view('index', $data);
    } 
    function search_customer_due()  {
        $dAta['searchtype']= $searchtype = $this->input->post('searchtype');
        $dAta['Sales_startdate']=$Sales_startdate = $this->input->post('Sales_startdate');
        $dAta['Sales_enddate']=$Sales_enddate = $this->input->post('Sales_enddate');
        $dAta['customerID']=$customerID = $this->input->post('customerID');
        $this->session->set_userdata($dAta);

        if($searchtype == "All"){
            $sql = "SELECT sr_salesmaster.*, sr_customer.* FROM sr_salesmaster left join sr_customer on sr_customer.Customer_SlNo = sr_salesmaster.SalseCustomer_IDNo WHERE sr_salesmaster.SaleMaster_SaleDate between  '$Sales_startdate' and '$Sales_enddate' group by sr_salesmaster.SalseCustomer_IDNo";
        }
        if($searchtype == "Customer"){
           
            $sql = "SELECT sr_salesmaster.*, sr_customer.* FROM sr_salesmaster left join sr_customer on sr_customer.Customer_SlNo = sr_salesmaster.SalseCustomer_IDNo WHERE sr_salesmaster.SalseCustomer_IDNo = '$customerID' and  sr_salesmaster.SaleMaster_SaleDate between  '$Sales_startdate' and '$Sales_enddate' group by sr_salesmaster.SalseCustomer_IDNo";
        }
        $datas["record"] = $this->mt->ccdata($sql);
        
        $this->load->view('due_report/customer_due_list', $datas);
    }
    function customer_due_payment($Custid){
       
        $sql = "SELECT sr_salesmaster.*, sr_customer.* FROM sr_salesmaster left join sr_customer on sr_customer.Customer_SlNo = sr_salesmaster.SalseCustomer_IDNo WHERE sr_salesmaster.SalseCustomer_IDNo = '$Custid' group by sr_salesmaster.SalseCustomer_IDNo ";
        
        $datas["record"] = $this->mt->ccdata($sql);
        $this->load->view('due_report/customer_due_payment', $datas);
    }
    
    public function custome_PaymentAmount(){
        
        $data = array(
            "CPayment_date"                     =>$this->input->post('paymentDate', TRUE),
            "CPayment_invoice"                  =>$this->input->post('invoice', TRUE),
            "CPayment_customerID"               =>$this->input->post('CustID', TRUE),
            "CPayment_amount"                   =>$this->input->post('paidAmount', TRUE),
            "CPayment_notes"                    =>$this->input->post('country', TRUE),
            "CPayment_Addby"                    =>$this->session->userdata("FullName")
        );
        $this->mt->save_data("sr_customer_payment", $data);

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
        $this->load->view('due_report/customer_due_list', $datas);
    } 
    function customer_payment_report(){
        $data['title'] = "Customer Payment Reports";
        $data['content'] = $this->load->view('payment_reports/customer_payment_report', $data, TRUE);
        $this->load->view('index', $data);
    }
   
    function search_customer_payments(){
        $dAta['searchtype']= $searchtype = $this->input->post('searchtype');
        $dAta['Sales_startdate']=$Sales_startdate = $this->input->post('Sales_startdate');
        $dAta['Sales_enddate']=$Sales_enddate = $this->input->post('Sales_enddate');
        $dAta['customerID']=$customerID = $this->input->post('customerID');
        $this->session->set_userdata($dAta);

        if($searchtype == "All"){
            
            $sql = "SELECT sr_customer_payment.*, sr_customer.* FROM sr_customer_payment left join sr_customer on sr_customer.Customer_SlNo = sr_customer_payment.CPayment_customerID ";
        }
        if($searchtype == "Customer"){
            $sql = "SELECT sr_customer_payment.*, sr_customer.* FROM sr_customer_payment left join sr_customer on sr_customer.Customer_SlNo = sr_customer_payment.CPayment_customerID WHERE sr_customer_payment.CPayment_customerID = '$customerID'";
        }
        $datas["record"] = $this->mt->ccdata($sql);
        $this->load->view('payment_reports/customer_payment_report_list', $datas);
    }

   
}
