<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_management extends CI_Controller {
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
        $data['title'] = "User List";
        $data['content'] = $this->load->view('user', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function add_user()  {
        $data['title'] = "Add User";
        $data['content'] = $this->load->view('add_user', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function user_Insert()  {
        $mail = $this->input->post('username');
        $Brunch = $this->input->post('Brunch');
        $query = $this->db->query("SELECT * from tbl_user where userBrunch_id = '$Brunch' and User_Name = '$mail'");
        if($query->num_rows() > 0){
            $data['exists'] = "This Username is Already Exists";
            $this->load->view('ajax/add_user',$data);
        }
        else{
            $data = array(
                "User_Name"                 => $this->input->post('username', TRUE),
                "FullName"                  => $this->input->post('txtFirstName', TRUE),
                "userBrunch_id"             => $this->input->post('Brunch',TRUE),
                "User_Password"             => md5($this->input->post('rePassword',TRUE)),
                "UserType"                  => $this->input->post('type',TRUE),
                "AddTime"                   => date('Y-m-d H:i:s')
            );
            $this->mt->save_data("tbl_user", $data);
            $this->load->view('ajax/add_user');
        }
    }
   
    public function edit($id) {
        $data['title'] = "User Update Form";
        $query = "SELECT tbl_user.*,tbl_brunch.* FROM tbl_user left join tbl_brunch on tbl_brunch.brunch_id=tbl_user.userBrunch_id WHERE tbl_user.User_SlNo = '$id'";
        $data['selected'] = $this->mt->edit_by_id($query);
        $data['content'] = $this->load->view('edit/edit', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function userupdate(){
        $id = $this->input->post('id');
        $fld = 'User_SlNo';
            $data = array(
                "User_Name"                 => $this->input->post('username', TRUE),
                "FullName"                  => $this->input->post('txtFirstName', TRUE),
                "userBrunch_id"             => $this->input->post('Brunch',TRUE),
                "User_Password"             => md5($this->input->post('rePassword',TRUE)),
                "UserType"                  => $this->input->post('type',TRUE),
                "AddTime"                   => date('Y-m-d H:i:s')
                );
            $this->mt->update_data("tbl_user", $data, $id,$fld);
         
    } 
    public function delete($id){
        $fld = 'User_SlNo';
        if($this->mt->delete_data("tbl_user", $id, $fld)){
            $sdata['status'] = 'Delete Success';
        }
        else {
            $sdata['status'] = 'Try Again';
        }
        $this->session->set_userdata($sdata);
        redirect("user_management"); 
    } 
    public function check_username_availablity(){
      $get_result = $this->mt->check_username_availablity();
        if(!$get_result )
            echo '<span style="color:#f00">Username already in use. </span>';
        else
            echo '<span style="color:#00c">Username Available</span>';
    }
}
