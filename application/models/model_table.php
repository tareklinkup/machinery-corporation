<?php
class Model_Table extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
   
    /*---------------------------  Save Update Data  ------------------------------*/

    
    public function payment_invoice($id){
        $sql = mysql_query("SELECT sr_booking_bill.*, sr_booking_customer.*, sr_booking_customer.fld_id as cusID, sr_cash_receive.fld_id as cashR_ID FROM sr_booking_bill LEFT JOIN sr_booking_customer ON sr_booking_customer.fld_id=sr_booking_bill.fld_customer_id left join sr_cash_receive on sr_booking_bill.fld_id =sr_cash_receive.fld_order_id  where sr_booking_bill.fld_id = '$id'");
        while($d = mysql_fetch_array($sql)){
            return $d;
        }
    }
     public function ajax_cash_payment($key){
        $sql = mysql_query("SELECT sr_booking_bill.*, sr_booking_customer.*, sr_booking_customer.fld_id as cusID, sr_cash_receive.fld_id as cashR_ID FROM sr_booking_bill LEFT JOIN sr_booking_customer ON sr_booking_customer.fld_id=sr_booking_bill.fld_customer_id left join sr_cash_receive on sr_booking_bill.fld_id =sr_cash_receive.fld_order_id  where sr_booking_bill.fld_Serial = '$key'");
        while($d = mysql_fetch_array($sql)){
            return $d;
        }
    }
    public function ajax_cash_receive($id){
        $sql = mysql_query("SELECT sr_booking_bill.*, sr_booking_customer.*, sr_booking_customer.fld_id as cusID, sr_cash_receive.fld_id as cashR_ID FROM sr_booking_bill LEFT JOIN sr_booking_customer ON sr_booking_customer.fld_id=sr_booking_bill.fld_customer_id left join sr_cash_receive on sr_booking_bill.fld_id =sr_cash_receive.fld_order_id  where sr_booking_bill.fld_id = '$id'");
        while($d = mysql_fetch_array($sql)){
            return $d;
        }
    }
    public function add_product($data)
    {
            //untuk insert data ke table product
            $this->db->insert('product', $data);
    }
    public function save_data($table, $data){       
        $result= $this->db->insert($table, $data);
        if ($result) {                    
           $this->Id = $this->db->insert_id();
           return TRUE;
        } 
        $this->Err = mysql_error();
        return FALSE;
    }
    

    public function save_date_id($table, $data){
        $this->db->insert($table, $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;      
    }
    public function update_customer_data($table, $data, $id){       
        $this->db->where("fld_id", $id);
        $result= $this->db->update($table, $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;      
     }
    public function update_data($table, $data, $id,$fld){       
        $this->db->where($fld, $id);
        $result= $this->db->update($table, $data);
        if (!$result) {                      
           return FALSE;
        } 
        return TRUE;
     }
     
    public function delete_data($table, $id, $fld){       
        $this->db->where($fld, $id);
        $result= $this->db->delete($table);
        if (!$result) {                      
           return FALSE;
        } 
        return TRUE;
    }

    public function select_by_Booking_id($id){
        $sql = mysql_query("SELECT sr_booking_bill.*,sr_booking_bill.fld_id as ordID, sr_booking_customer.*, sr_booking_customer.fld_id as cusID, sr_cash_receive.*, sr_cash_receive.fld_id as cashR_ID FROM sr_booking_bill LEFT JOIN sr_booking_customer ON sr_booking_customer.fld_id=sr_booking_bill.fld_customer_id left join sr_cash_receive on sr_booking_bill.fld_id =sr_cash_receive.fld_order_id  where sr_booking_bill.fld_id = '".$id."'");
        while($d = mysql_fetch_array($sql)){
            return $d;
        }
    }
    public function edit_by_id($query){
        $sql = mysql_query($query);
        while($d = mysql_fetch_array($sql)){
            return $d;
        }
    }

    public function select_by_id($table, $id,$fld){
        $sql = mysql_query("SELECT * from {$table} where {$fld} = '".$id."'");
        while($d = mysql_fetch_array($sql)){
            return $d;
        }
    }
    
    public function view_data($table){
        $a = array();
        $sql = mysql_query($table);
        while($d = mysql_fetch_array($sql)){
           $a[] = $d;
        }   
      return $a;
    }

    
    public function ccdata($data){
        $a = array();
        $sql = mysql_query($data);
        while($d = mysql_fetch_array($sql)){
           $a[] = $d;
        }	
      return $a;
    }
    
    
    public function mailcheck_availablity(){
        $mail = $this->input->post('usermail');
        
        $query = $this->db->query("SELECT fld_email from sr_superadmin where fld_email = '$mail'");
        if($query->num_rows() > 0){
            return false;
        }
        else{
            return true;}
    }

    

    private $table = 'tbl_users';
    public function getCode($table, $codeString)
        {
            $c = '';
            $q = $this->db->select('Product_SlNo')->order_by('Product_SlNo', 'desc')->get($table)->row();
            if ($q) {
                $c = ++$q->Product_SlNo;
            }
            //$code= $codeString.$c;
            //$oldCode = substr($c, 1, 11);
            $numlength = mb_strlen($c);
            if (!empty($c)) {
                if ($numlength == 1) {
                    $code = $codeString . '00' . $c;
                } else if ($numlength ==2) {
                    $code = $codeString . '0' . $c;
                } else {
                    $code = $codeString . $c;
                }
            } else {
                $code = $codeString . '001';
            }
            return $code;
        }


  }
?>
