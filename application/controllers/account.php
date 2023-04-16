<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
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
        $data['title'] = "Add Account";
        $data['content'] = $this->load->view('account/add_account', $data, TRUE);
        $this->load->view('index', $data);
    }

   
    public function account_insert()  {
        $mail = $this->input->post('accountName');
        $query = $this->db->query("SELECT Acc_Name from sr_account where Acc_Name = '$mail'");
        
        if($query->num_rows() > 0){
            $data['exists'] = "This Name is Already Exists";
            $this->load->view('ajax/add_account',$data);
        }
        else{
            $data = array(
                "Acc_Code"          =>$this->input->post('account_id', TRUE),
                "Acc_Name"          =>$this->input->post('accountName', TRUE),
                "Acc_Type"          =>$this->input->post('accounttype', TRUE),
                "Acc_Description"          =>$this->input->post('Description', TRUE),
                "AddBy"                  =>$this->session->userdata("FullName"),
                "AddTime"                =>date("Y-m-d h:i:s")
                );
            $this->mt->save_data('sr_account',$data);
            $this->load->view('ajax/add_account');
        }
    }
    public function account_insertFanceybox()  {
        $mail = $this->input->post('accountName');
        $query = $this->db->query("SELECT Acc_Name from sr_account where Acc_Name = '$mail'");
        
        if($query->num_rows() > 0){
            $data['exists'] = "This Name is Already Exists";
            $this->load->view('ajax/add_account',$data);
        }
        else{
            $data = array(
                "Acc_Code"          =>$this->input->post('account_id', TRUE),
                "Acc_Name"          =>$this->input->post('accountName', TRUE),
                "Acc_Type"          =>$this->input->post('accounttype', TRUE),
                "Acc_Description"          =>$this->input->post('Description', TRUE),
                "AddBy"                  =>$this->session->userdata("FullName"),
                "AddTime"                =>date("Y-m-d h:i:s")
                );
            $this->mt->save_data('sr_account',$data);
            $this->load->view('ajax/transaction/fancyboxResultOffice');
        }
    }
    
   
    public function account_edit() {
        $id = $this->input->post('edit');
        $query = "SELECT * from sr_account where Acc_SlNo = '$id'";
        $data['selected'] = $this->mt->edit_by_id($query);
        //$data['content'] = $this->load->view('edit/supplier_edit', $data, TRUE);
        $this->load->view('edit/account_edit', $data);
    }
    public function account_update(){
        $id = $this->input->post('id');
        $fld = 'Acc_SlNo';
        $data = array(
            "Acc_Code"              =>$this->input->post('account_id', TRUE),
            "Acc_Name"              =>$this->input->post('accountName', TRUE),
            "Acc_Type"              =>$this->input->post('accounttype', TRUE),
            "Acc_Description"       =>$this->input->post('Description', TRUE),
            "UpdateBy"              =>$this->session->userdata("FullName"),
            "UpdateTime"            =>date("Y-m-d h:i:s")
        );
        $this->mt->update_data("sr_account", $data, $id,$fld);
        $this->load->view('ajax/add_account', $data);
    } 
    public function account_delete(){
        $id = $this->input->post('deleted');
        $fld = 'Acc_SlNo';
        $this->mt->delete_data("sr_account", $id, $fld);
        $data['cate'] = 'Delete Success';
        $this->load->view('ajax/add_account', $data);
    }
    // Cash Transection
    public function cash_transaction()  {
        $data['title'] = "Cash Transection";
        $data['content'] = $this->load->view('account/cash_transaction', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function fancybox_add_account()  {
        $this->load->view('ajax/fanceybox_add_account');
    }
    public function AccountType()  {
        $acc_type = $this->input->post('acc_type');
        if($acc_type=="Customer"){
            $this->load->view('ajax/transaction/customer');
        }
        elseif($acc_type=="Official"){
            $this->load->view('ajax/transaction/Official');
        }
        elseif($acc_type=="Supplier"){
            $this->load->view('ajax/transaction/Supplier');
        }
    }
    public function OnselectName()  {
        $acc_type = $this->input->post('acc_type');
        $account_id = $this->input->post('account_id');
        if($acc_type=="Customer"){
            $query = "SELECT * from sr_customer where Customer_SlNo = '$account_id'";
            $data['selected'] = $this->mt->edit_by_id($query);
            $this->load->view('ajax/transaction/customer_name', $data);
        }
        elseif($acc_type=="Official"){
            $query = "SELECT * from sr_account where Acc_SlNo = '$account_id'";
            $data['selected'] = $this->mt->edit_by_id($query);
            $this->load->view('ajax/transaction/official_name', $data);
        }
        elseif($acc_type=="Supplier"){
            $query = "SELECT * from sr_supplier where Supplier_SlNo = '$account_id'";
            $data['selected'] = $this->mt->edit_by_id($query);
            $this->load->view('ajax/transaction/supplier_name', $data);
        }
    }
    public function AutoSelect()  {
        $tr_type = $this->input->post('tr_type');
        if($tr_type== "Deposit To Bank" or $tr_type== "Withdraw Form Bank"){
            $this->load->view('ajax/transaction/Office_autoSelect');  
        }else{
            $this->load->view('ajax/transaction/Office_None_Select');  
        }
    
    }
    public function cashTransection_insert()  {
        $atype = $this->input->post('acc_type');
        $TrType = $this->input->post('tr_type');

        
        if($atype=="Official" && $TrType=="Cash Payment"){
            $data = array(
                "Tr_Id"                 =>$this->input->post('Transaction_id', TRUE),
                "Tr_date"               =>$this->input->post('DaTe', TRUE),
                "Tr_Type"               =>$this->input->post('tr_type', TRUE),
                "Tr_account_Type"       =>$this->input->post('acc_type', TRUE),
                "Acc_SlID"              =>$this->input->post('account_id', TRUE),
                "Tr_Description"        =>$this->input->post('Description', TRUE),
                "In_Amount"             =>0,
                "Out_Amount"             =>$this->input->post('Amount', TRUE),
                "AddBy"                 =>$this->session->userdata("FullName"),
                "AddTime"               =>date("Y-m-d h:i:s")
            ); 
        }
        elseif($atype=="Official" && $TrType=="Cash Receive"){
            $data = array(
                "Tr_Id"                 =>$this->input->post('Transaction_id', TRUE),
                "Tr_date"               =>$this->input->post('DaTe', TRUE),
                "Tr_Type"               =>$this->input->post('tr_type', TRUE),
                "Tr_account_Type"       =>$this->input->post('acc_type', TRUE),
                "Acc_SlID"              =>$this->input->post('account_id', TRUE),
                "Tr_Description"        =>$this->input->post('Description', TRUE),
                "Out_Amount"            =>0,
                "In_Amount"             =>$this->input->post('Amount', TRUE),
                "AddBy"                 =>$this->session->userdata("FullName"),
                "AddTime"               =>date("Y-m-d h:i:s")
            ); 
        }
        elseif($atype=="Official" && $TrType=="Deposit To Bank"){
            $data = array(
                "Tr_Id"                 =>$this->input->post('Transaction_id', TRUE),
                "Tr_date"               =>$this->input->post('DaTe', TRUE),
                "Tr_Type"               =>$this->input->post('tr_type', TRUE),
                "Tr_account_Type"       =>$this->input->post('acc_type', TRUE),
                "Acc_SlID"              =>$this->input->post('account_id', TRUE),
                "Tr_Description"        =>$this->input->post('Description', TRUE),
                "Out_Amount"            =>0,
                "In_Amount"             =>$this->input->post('Amount', TRUE),
                "AddBy"                 =>$this->session->userdata("FullName"),
                "AddTime"               =>date("Y-m-d h:i:s")
            ); 
        }
        elseif($atype=="Official" && $TrType=="Withdraw Form Bank"){
            $data = array(
                "Tr_Id"                 =>$this->input->post('Transaction_id', TRUE),
                "Tr_date"               =>$this->input->post('DaTe', TRUE),
                "Tr_Type"               =>$this->input->post('tr_type', TRUE),
                "Tr_account_Type"       =>$this->input->post('acc_type', TRUE),
                "Acc_SlID"              =>$this->input->post('account_id', TRUE),
                "Tr_Description"        =>$this->input->post('Description', TRUE),
                "In_Amount"             =>0,
                "Out_Amount"            =>$this->input->post('Amount', TRUE),
                "AddBy"                 =>$this->session->userdata("FullName"),
                "AddTime"               =>date("Y-m-d h:i:s")
            ); 
        }
        /*elseif($atype=="Supplier"){
            $data = array(
                "Tr_Id"                 =>$this->input->post('Transaction_id', TRUE),
                "Tr_date"               =>$this->input->post('DaTe', TRUE),
                "Tr_Type"               =>$this->input->post('tr_type', TRUE),
                "Tr_account_Type"       =>$this->input->post('acc_type', TRUE),
                "Supplier_SlID"         =>$this->input->post('account_id', TRUE),
                "Tr_Description"        =>$this->input->post('Description', TRUE),
                "Out_Amount"            =>$this->input->post('Amount', TRUE),
                "AddBy"                 =>$this->session->userdata("FullName"),
                "AddTime"               =>date("Y-m-d h:i:s")
            ); 
        }*/
        $lastid = $this->mt->save_date_id('sr_cashtransaction',$data);

        $upstadata = array(
            "Transaction_Date"         =>$this->input->post('DaTe', TRUE),
            "IdentityNo"               =>$lastid,
            "Narration"                =>$this->input->post('Transaction_id', TRUE),
            "InAmount"                 =>$this->input->post('Transaction_id', TRUE),
            "OutAmount"                =>$this->input->post('Amount', TRUE),
            "Description"              =>$this->input->post('Description', TRUE),
            "Saved_By"                 =>$this->session->userdata("FullName"),
            "Saved_Time"               =>date("Y-m-d h:i:s")
        );

        $this->load->view('ajax/cash_transection');
    }
    public function cash_transaction_edit() {
        $id = $this->input->post('edit');
        $query = "SELECT sr_cashtransaction.*,sr_account.*,sr_supplier.*,sr_customer.* from sr_cashtransaction left join sr_account on sr_account.Acc_SlNo= sr_cashtransaction.Acc_SlID left join sr_supplier on sr_supplier.Supplier_SlNo=sr_cashtransaction.Supplier_SlID left join sr_customer on sr_customer.Customer_SlNo=sr_cashtransaction.Customer_SlID where sr_cashtransaction.Tr_SlNo = '$id'";
        $data['selected'] = $this->mt->edit_by_id($query);
        $this->load->view('edit/cash_transection_Edit', $data);
    }
    public function cash_transaction_delete(){
        $id = $this->input->post('deleted');
        $fld = 'Tr_SlNo';
        $this->mt->delete_data("sr_cashtransaction", $id, $fld);
        $data['cate'] = 'Delete Success';
        $this->load->view('ajax/cash_transection', $data);
    }
    public function cash_transaction_update(){
        $id = $this->input->post('id');
        $fld = 'Tr_SlNo';
        $atype = $this->input->post('acc_type');
        $TrType = $this->input->post('tr_type');

        if($atype=="Official" && $TrType=="Cash Receive"){
            $data = array(
                "Tr_Id"                 =>$this->input->post('Transaction_id', TRUE),
                "Tr_date"               =>$this->input->post('DaTe', TRUE),
                "Tr_Type"               =>$this->input->post('tr_type', TRUE),
                "Tr_account_Type"       =>$this->input->post('acc_type', TRUE),
                "Acc_SlID"              =>$this->input->post('account_id', TRUE),
                "Tr_Description"        =>$this->input->post('Description', TRUE),
                "In_Amount"             =>$this->input->post('Amount', TRUE),
                "Out_Amount"             =>0,
                "UpdateBy"              =>$this->session->userdata("FullName"),
                "UpdateTime"            =>date("Y-m-d h:i:s")
            ); 
        }
        elseif($atype=="Official" && $TrType=="Cash Payment"){
            $data = array(
                "Tr_Id"                 =>$this->input->post('Transaction_id', TRUE),
                "Tr_date"               =>$this->input->post('DaTe', TRUE),
                "Tr_Type"               =>$this->input->post('tr_type', TRUE),
                "Tr_account_Type"       =>$this->input->post('acc_type', TRUE),
                "Acc_SlID"              =>$this->input->post('account_id', TRUE),
                "Tr_Description"        =>$this->input->post('Description', TRUE),
                "In_Amount"             =>0,
                "Out_Amount"            =>$this->input->post('Amount', TRUE),
                "UpdateBy"              =>$this->session->userdata("FullName"),
                "UpdateTime"            =>date("Y-m-d h:i:s")
            ); 
        }
        elseif($atype=="Official" && $TrType=="Deposit To Bank"){
            $data = array(
                "Tr_Id"                 =>$this->input->post('Transaction_id', TRUE),
                "Tr_date"               =>$this->input->post('DaTe', TRUE),
                "Tr_Type"               =>$this->input->post('tr_type', TRUE),
                "Tr_account_Type"       =>$this->input->post('acc_type', TRUE),
                "Acc_SlID"              =>$this->input->post('account_id', TRUE),
                "Tr_Description"        =>$this->input->post('Description', TRUE),
                "Out_Amount"             =>0,
                "In_Amount"             =>$this->input->post('Amount', TRUE),
                "UpdateBy"              =>$this->session->userdata("FullName"),
                "UpdateTime"            =>date("Y-m-d h:i:s")
            ); 
        }
        elseif($atype=="Official" && $TrType=="Withdraw Form Bank"){
            $data = array(
                "Tr_Id"                 =>$this->input->post('Transaction_id', TRUE),
                "Tr_date"               =>$this->input->post('DaTe', TRUE),
                "Tr_Type"               =>$this->input->post('tr_type', TRUE),
                "Tr_account_Type"       =>$this->input->post('acc_type', TRUE),
                "Acc_SlID"              =>$this->input->post('account_id', TRUE),
                "Tr_Description"        =>$this->input->post('Description', TRUE),
                "In_Amount"             =>0,
                "Out_Amount"            =>$this->input->post('Amount', TRUE),
                "UpdateBy"              =>$this->session->userdata("FullName"),
                "UpdateTime"            =>date("Y-m-d h:i:s")
            ); 
        }
        /*elseif($atype=="Supplier"){
            $data = array(
                "Tr_Id"                 =>$this->input->post('Transaction_id', TRUE),
                "Tr_date"               =>$this->input->post('DaTe', TRUE),
                "Tr_Type"               =>$this->input->post('tr_type', TRUE),
                "Tr_account_Type"       =>$this->input->post('acc_type', TRUE),
                "Supplier_SlID"         =>$this->input->post('account_id', TRUE),
                "Tr_Description"        =>$this->input->post('Description', TRUE),
                "Out_Amount"            =>$this->input->post('Amount', TRUE),
                "In_Amount"             =>0,
                "UpdateBy"              =>$this->session->userdata("FullName"),
                "UpdateTime"            =>date("Y-m-d h:i:s")
            ); 
        }*/
        $this->mt->update_data("sr_cashtransaction", $data, $id,$fld);
        $this->load->view('ajax/cash_transection', $data);
    } 
    function expense()  {
        $data['title'] = "Expense";
        $data['content'] = $this->load->view('account/expense_report', $data, TRUE);
        $this->load->view('index', $data);
    }
    function expense_search()  {
        $dAta['expence_startdate']=$expence_startdate = $this->input->post('expence_startdate');
        $dAta['expence_enddate']=$expence_enddate = $this->input->post('expence_enddate');
        $dAta['accountid']=$accountid = $this->input->post('accountid');
        $dAta['searchtype']=$searchtype = $this->input->post('searchtype');
        $this->session->set_userdata($dAta);
        if($searchtype=="All"){
            $sql = "SELECT sr_cashtransaction.*,sr_account.* FROM sr_cashtransaction left join sr_account on sr_account.Acc_SlNo=sr_cashtransaction.Acc_SlID where Tr_date between '$expence_startdate' and '$expence_enddate'";

        }
        elseif($searchtype=="Account"){
            $sql = "SELECT sr_cashtransaction.*,sr_account.* FROM sr_cashtransaction left join sr_account on sr_account.Acc_SlNo=sr_cashtransaction.Acc_SlID where sr_cashtransaction.Acc_SlID ='$accountid ' and sr_cashtransaction.Tr_date between '$expence_startdate' and '$expence_enddate'";
        }
        $datas["record"] = $this->mt->ccdata($sql);
        
        $this->load->view('account/expense_search_list', $datas);
    }
    function cash_view()  {
        $data['title'] = "Cash View";
        $data['content'] = $this->load->view('account/cashview_search', $data, TRUE);
        $this->load->view('index', $data);
    }
    function cash_view_list()  {
        $startdate = $this->input->post('startdate');
        $enddate = $this->input->post('enddate');
        $checkall = $this->input->post('checkall');
        if($checkall == 'all'){
        $sql = mysql_query("select SUM(In_Amount) as ina, SUM(Out_Amount) as outa from sr_cashtransaction");
        $data['record'] = mysql_fetch_array($sql);
        $this->load->view('account/cashview_search_list_all', $data);
        }else{
        $sql = "SELECT sr_cashtransaction.*,sr_account.* FROM sr_cashtransaction left join sr_account on sr_account.Acc_SlNo=sr_cashtransaction.Acc_SlID WHERE sr_cashtransaction.Tr_date between '$startdate' AND '$enddate'";
        $data["record"] = $this->mt->ccdata($sql);
        $data['startdate'] = $startdate;
        $data['enddate'] = $enddate;
        $this->session->set_userdata($data);
        $this->load->view('account/cashview_search_list', $data);
        }
    }
    function datewise_transection(){
        $searchtdate= $_POST['DaTe'];
        $startdate = date("Y-m-d", strtotime($searchtdate));
        ?>
        <table class="zebra" cellspacing="0" cellpadding="0" border="0" style="text-align:left;width:80%;border-collapse:collapse;">
                <tbody>
                <?php $sql = mysql_query("SELECT sr_cashtransaction.*,sr_account.* FROM sr_cashtransaction left join sr_account on sr_account.Acc_SlNo=sr_cashtransaction.Acc_SlID where sr_cashtransaction.Tr_date='".$startdate."' order by sr_cashtransaction.Tr_Id asc");
                while($row = mysql_fetch_array($sql)){ ?>
                    <tr>
                        <td style="width:7%"><?php echo $row['Tr_Id'] ?></td>
                        <td style="width:12%"><?php echo $row['Tr_date'] ?></td>
                        <td style="width:15%"><?php echo $row['Tr_Type'] ?></td>
                        <td style="width:15%"><?php echo $row['Acc_Name'] ?></td>
                        <td style="width:20%"><?php echo $row['Tr_Description'] ?></td>
                        <td style="width:10%"><?php echo $row['In_Amount'] ?></td>
                        <td style="width:10%"><?php echo $row['Out_Amount'] ?></td>
                        <td style="width:13%">
                        <a onclick="Edit_transaction(<?php echo $row['Tr_SlNo'] ?>)" style="cursor:pointer;color:green;font-size:20px;float:left" ><i class="fa fa-pencil"></i></a>
                        <span onclick="deleted(<?php echo $row['Tr_SlNo'] ?>)" style="cursor:pointer;color:red;font-size:20px;float:left;padding-left:10px"><i class="fa fa-trash-o"></i></span>
                        </td>
                    </tr>  
                <?php } ?>                
                </tbody>
            </table>
        <?php
    }

    public function daily_summery(){
        $data['title'] = "Daily Summery";
        $data['content'] = $this->load->view('account/daily_summery', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function summery_search(){
        $data['startdate'] = $this->input->post('startdate');
        $data['enddate'] = $this->input->post('enddate');
        $this->session->set_userdata($data);
        $this->load->view('account/summery_search', $data);
    }

}
