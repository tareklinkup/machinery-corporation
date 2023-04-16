<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $access = $this->session->userdata('userId');
         if($access == '' ){
            redirect("login");
        }
        $this->load->model("model_myclass", "mmc", TRUE);
        $this->load->model('model_table', "mt", TRUE);
        date_default_timezone_set('Asia/Dhaka');
    }
    public function index()  {
        $data['title'] = "Dashboard";
        $data['content'] = $this->load->view('dashboard', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function about_us()  {
        $data['title'] = "About us";
        $data['content'] = $this->load->view('about_us', $data, TRUE);
        $this->load->view('index', $data);
    }
    // Product Category 
    public function add_category()  {
        $data['title'] = "Add Category";
        $data['content'] = $this->load->view('add_prodcategory', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function insert_category()  {
        $mail = $this->input->post('catname');
        $query = $this->db->query("SELECT ProductCategory_Name from sr_productcategory where ProductCategory_Name = '$mail'");
        if($query->num_rows() > 0){
            
            $data['exists'] = "This Category Name is Already Exists";
            $this->load->view('ajax/add_prodcategory', $data);
        }
        else{
            $data = array(
                "ProductCategory_Name"              =>$this->input->post('catname', TRUE),
                "ProductCategory_Description"       =>$this->input->post('catdescrip', TRUE),
                "AddBy"                  =>$this->session->userdata("FullName"),
                "AddTime"                           =>date("Y-m-d h:i:s")
                );
            $this->mt->save_data('sr_productcategory',$data);
            $this->load->view('ajax/add_prodcategory');    
        }
    }
    public function catedit($id)  {
        $data['title'] = "Edit Category";
        //$fld = 'ProductCategory_SlNo';
        $data['selected'] = $this->mt->select_by_id('sr_productcategory', $id,'ProductCategory_SlNo');
        $data['content'] = $this->load->view('edit/category_edit', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function catupdate(){
        $id = $this->input->post('id');
        $fld = 'ProductCategory_SlNo';
            $data = array(
                "ProductCategory_Name"              =>$this->input->post('catname', TRUE),
                "ProductCategory_Description"       =>$this->input->post('catdescrip', TRUE),
                "UpdateBy"                          =>$this->session->userdata("FullName"),
                "UpdateTime"                        =>date("Y-m-d h:i:s")
            );
            $this->mt->update_data("sr_productcategory", $data, $id,$fld);
            $this->load->view('ajax/add_prodcategory'); 
    } 
    public function catdelete(){
        $id = $this->input->post('deleted');
        $fld = 'ProductCategory_SlNo';
        $this->mt->delete_data("sr_productcategory", $id, $fld);
        $data['cate'] = 'Delete Success';
       $this->load->view('ajax/add_prodcategory', $data);
    } 
    //^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
    // unit 
    public function unit()  {
        $data['title'] = "Add Unit";
        $data['content'] = $this->load->view('unit', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function insert_unit()  {
        $mail = $this->input->post('unitname');
        $query = $this->db->query("SELECT Unit_Name from sr_unit where Unit_Name = '$mail'");
        
        if($query->num_rows() > 0){
            $data['exists'] = "This Name is Already Exists";
            $this->load->view('ajax/unit', $data);
        }
        else{
            $data = array(
                "Unit_Name"              =>$this->input->post('unitname', TRUE),
                "AddBy"                  =>$this->session->userdata("FullName"),
                "AddTime"                =>date("Y-m-d h:i:s")
                );
            $this->mt->save_data('sr_unit',$data);
            $this->load->view('ajax/unit');
        }
    }
    public function unitedit($id)  {
        $data['title'] = "Edit Unit";
        $fld = 'Unit_SlNo';
        $data['selected'] = $this->mt->select_by_id('sr_unit', $id,$fld);
        $data['content'] = $this->load->view('edit/unit_edit', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function unitupdate(){
        $id = $this->input->post('id');
        $fld = 'Unit_SlNo';
            $data = array(
                "Unit_Name"                         =>$this->input->post('unitname', TRUE),
                "UpdateBy"                          =>$this->session->userdata("FullName"),
                "UpdateTime"                        =>date("Y-m-d h:i:s")
            );
            if($this->mt->update_data("sr_unit", $data, $id,$fld)){
                $sdata['unit'] = 'Update Success';
            }
            else {
                $sdata['unit'] = 'Update is Faild';
            }
            $this->session->set_userdata($sdata);
            redirect("page/unit");  
    } 
    public function unitdelete(){
        $fld = 'Unit_SlNo';
        $id = $this->input->post('deleted');
        $this->mt->delete_data("sr_unit", $id, $fld);
        $this->load->view('ajax/unit');
        
    } 
    //^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
    //District 
    public function district()  {
        $data['title'] = "Add District";
        $data['content'] = $this->load->view('district', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function insert_district()  {
        $mail = $this->input->post('District');
        $query = $this->db->query("SELECT District_Name from sr_district where District_Name = '$mail'");
        
        if($query->num_rows() > 0){
            $data['exists'] = "This Name is Already Exists";
            $this->load->view('ajax/district',$data);
        }
        else{
            $data = array(
                "District_Name"          =>$this->input->post('District', TRUE),
                "AddBy"                  =>$this->session->userdata("FullName"),
                "AddTime"                =>date("Y-m-d h:i:s")
                );
            $this->mt->save_data('sr_district',$data);
            $this->load->view('ajax/district');
        }
    }
    public function districtedit($id)  {
        $data['title'] = "Edit Unit";
        $fld = 'District_SlNo';
        $data['selected'] = $this->mt->select_by_id('sr_district', $id,$fld);
        $data['content'] = $this->load->view('edit/district_edit', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function districtupdate(){
        $id = $this->input->post('id');
        $fld = 'District_SlNo';
            $data = array(
                "District_Name"                     =>$this->input->post('District', TRUE),
                "UpdateBy"                          =>$this->session->userdata("FullName"),
                "UpdateTime"                        =>date("Y-m-d h:i:s")
            );
            if($this->mt->update_data("sr_district", $data, $id,$fld)){
                $sdata['district'] = 'Update Success';
            }
            else {
                $sdata['district'] = 'Update is Faild';
            }
            $this->session->set_userdata($sdata);
            redirect("page/district");  
    } 
    public function districtdelete(){
        $id = $this->input->post('deleted');
        $fld = 'District_SlNo';
        $this->mt->delete_data("sr_district", $id, $fld);
        $this->load->view('ajax/district');
    } 
    //^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
    // Country 
    public function add_country()  {
        $data['title'] = "Add Country";
        $data['content'] = $this->load->view('add_country', $data, TRUE);
        $this->load->view('index', $data);
    }
    
    public function insert_country()  {
        $mail = $this->input->post('Country');
        $query = $this->db->query("SELECT CountryName from sr_country where CountryName = '$mail'");
        
        if($query->num_rows() > 0){
            echo "F";
            //$this->load->view('ajax/Country');
        }
        else{
            $data = array(
                "CountryName"          =>$this->input->post('Country', TRUE),
                "AddBy"                  =>$this->session->userdata("FullName"),
                "AddTime"                =>date("Y-m-d h:i:s")
                );
            $this->mt->save_data('sr_country',$data);
            $this->load->view('ajax/Country');
        }
    }
    public function countryedit($id)  {
        $data['title'] = "Edit Country";
        $fld = 'Country_SlNo';
        $data['selected'] = $this->mt->select_by_id('sr_country', $id,$fld);
        $data['content'] = $this->load->view('edit/country_edit', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function countryupdate(){
        $id = $this->input->post('id');
        $fld = 'Country_SlNo';
            $data = array(
                "CountryName"                     =>$this->input->post('Country', TRUE),
                "UpdateBy"                          =>$this->session->userdata("FullName"),
                "UpdateTime"                        =>date("Y-m-d h:i:s")
            );
        $this->mt->update_data("sr_country", $data, $id,$fld);
        $this->load->view('ajax/Country');
    } 
    public function countrydelete(){
        $id = $this->input->post('deleted');
        $fld = 'Country_SlNo';
        $this->mt->delete_data("sr_country", $id, $fld);
        $this->load->view('ajax/Country');
    }
    //^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
    //Company Profile
    public function company_profile()  {
        $data['title'] = "Company Profile";
        $fld = 'Company_SlNo';
        $id = '1';
        $data['selected'] = $this->mt->select_by_id('sr_company', $id,$fld);
        $data['content'] = $this->load->view('company_profile', $data, TRUE);
        $this->load->view('index', $data);
    }
   
    public function company_profile_Update(){
       
        $id= $this->input->post('iidd');
        $fld = 'Company_SlNo';
        $this->load->library('upload');
        $config['upload_path'] = './uploads/company_profile_org/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '10000';
        $config['image_width']= '4000';
        $config['image_height']= '4000';
        $this->upload->initialize($config);

        $data['Company_Name']=  $this->input->post('Company_name',true);
        $data['Repot_Heading']=  $this->input->post('Description',true);
        
        $xx = $this->mt->select_by_id("sr_company", $id,$fld);

        $image=$this->upload->do_upload('companyLogo');
        $images = $this->upload->data();
        
        if($image != ""){            
            if($xx['Company_Logo_thum'] && $xx['Company_Logo_org']){
            unlink("./uploads/company_profile_thum/".$xx['Company_Logo_thum']);
            unlink("./uploads/company_profile_org/".$xx['Company_Logo_org']);
            }
            $data['Company_Logo_org'] = $images['file_name'];
            
            $config['image_library'] = 'gd2';
            $config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
            $config['new_image'] = 'uploads/'.'company_profile_thum/'.$this->upload->file_name;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 165;
            $config['height'] = 175;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $data['Company_Logo_thum'] = $this->upload->file_name;                 
        }else{
           
            $data['Company_Logo_org'] = $xx['Company_Logo_org'];
            $data['Company_Logo_thum'] = $xx['Company_Logo_thum'];
         }
        
        $this->mt->update_data("sr_company", $data, $id,$fld);
        $id = '1';
        $data['selected'] = $this->mt->select_by_id('sr_company', $id,$fld);
        $this->load->view('ajax/company',$data);
    }
    //^^^^^^^^^^^^^^^^^^^^^
    // Brunch Name
    public function brunch()  {
        $data['title'] = "Add Branch";
        $data['content'] = $this->load->view('brunch/add_brunch', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function insert_brunch()  {
        $mail = $this->input->post('Brunchname');
        $query = $this->db->query("SELECT Brunch_name from tbl_brunch where Brunch_name = '$mail'");
        
        if($query->num_rows() > 0){
            $data['exists'] = "This Name is Already Exists";
            $this->load->view('ajax/brunch', $data);
        }
        else{
            $data = array(
                "Brunch_name"              =>$this->input->post('Brunchname', TRUE)
                );
            $this->mt->save_data('tbl_brunch',$data);
            $this->load->view('ajax/brunch');
        }
    }
    
    public function brunch_edit() {
        $id = $this->input->post('edit');
        $query = "SELECT * from tbl_brunch where brunch_id = '$id'";
        $data['selected'] = $this->mt->edit_by_id($query);
        $this->load->view('edit/brunch_edit', $data);
    }
    public function brunch_update(){
        $id = $this->input->post('id');
        $fld = 'brunch_id';
            $data = array(
                "Brunch_name"        =>$this->input->post('Brunchname', TRUE)
            );
            $this->mt->update_data("tbl_brunch", $data, $id,$fld);
            $this->load->view('ajax/brunch');
    } 
    public function brunch_delete(){
        $fld = 'brunch_id';
        $id = $this->input->post('deleted');
        $this->mt->delete_data("tbl_brunch", $id, $fld);
        $this->load->view('ajax/brunch');
        
    } 
    //^^^^^^^^^^^^^^^^^^^^^^^^
    
}
