<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {
    public function __construct() {
        parent::__construct();
        /*$access = $this->session->userdata('userId');
         if($access == '' ){
            redirect("login");
        }*/
        $this->load->model("model_myclass", "mmc", TRUE);
        $this->load->model('model_table', "mt", TRUE);
    }
    public function index()  {
        $data['title'] = "Add Product";
        $data['invoice'] = $this->mt->getCode('tbl_product', 'P-');
        $data['content'] = $this->load->view('products/add_product', $data, TRUE);
        $this->load->view('index', $data);
    }

    public function fanceybox_unit()  {
        $this->load->view('products/fanceybox_unit');
    }
    public function insert_unit()  {
        $mail = $this->input->post('add_unit');
        $query = $this->db->query("SELECT Unit_Name from sr_unit where Unit_Name = '$mail'");
        
        if($query->num_rows() > 0){
            $data['exists'] = "This Name is Already Exists";
            $this->load->view('ajax/fanceybox_product_unit',$data);
        }
        else{
            $data = array(
                "Unit_Name"          =>$this->input->post('add_unit', TRUE),
                "AddBy"                  =>$this->session->userdata("FullName"),
                "AddTime"                =>date("Y-m-d h:i:s")
                );
            $this->mt->save_data('sr_unit',$data);
            $this->load->view('ajax/fanceybox_product_unit');
        }
    }
    
    public function insert_product()  {
        $mail = $this->input->post('Product_id');
        $query = $this->db->query("SELECT Product_Code from tbl_product where Product_Code = '$mail'");
        
        if($query->num_rows() > 0){
            echo "F";
        }
        else{
            $data = array(
                "P_Code"                 =>$this->input->post('P_Code', TRUE),
                "Product_Code"                 =>$this->input->post('Product_id', TRUE),
                "ProductCategory_ID"           =>$this->input->post('pCategory', TRUE),
                "Product_Name"                 =>$this->input->post('pro_Name', TRUE),
                "Product_type"                 =>$this->input->post('product_check', TRUE),
                "Product_ReOrederLevel"        =>$this->input->post('Re_Order', TRUE),
                "Product_Purchase_Rate"        =>$this->input->post('Purchase_rate', TRUE),
                "Product_SellingPrice"         =>$this->input->post('sell_rate', TRUE),
                "Unit_ID"                    =>$this->input->post('product_unit', TRUE),
                "AddBy"                        =>$this->session->userdata("FullName"),
                "AddTime"                      =>date("Y-m-d h:i:s")
                );
            $this->mt->save_data('tbl_product',$data);
            $this->load->view('ajax/product');
        }
    }
    public function product_edit()  {
        $id = $this->input->post('edit');
        $query = "SELECT tbl_product.*, sr_productcategory.*,sr_unit.* FROM tbl_product left join sr_productcategory on sr_productcategory.ProductCategory_SlNo= tbl_product.ProductCategory_ID left join sr_unit on sr_unit.Unit_SlNo=tbl_product.Unit_ID  where tbl_product.Product_SlNo = '$id'";
        $data['selected'] = $this->mt->edit_by_id($query);
        //$data['content'] = $this->load->view('edit/supplier_edit', $data, TRUE);
        $this->load->view('edit/product', $data);
    }
    public function product_update(){
        $id = $this->input->post('id');
        $fld = 'Product_SlNo';
        $data = array(
            "Product_Code"                 =>$this->input->post('Product_id', TRUE),
            "ProductCategory_ID"           =>$this->input->post('pCategory', TRUE),
            "Product_Name"                 =>$this->input->post('pro_Name', TRUE),
            "Product_type"                 =>$this->input->post('product_check', TRUE),
            "Product_ReOrederLevel"        =>$this->input->post('Re_Order', TRUE),
            "Product_Purchase_Rate"        =>$this->input->post('Purchase_rate', TRUE),
            "Product_SellingPrice"         =>$this->input->post('sell_rate', TRUE),
            "Unit_ID"                      =>$this->input->post('product_unit', TRUE),
            "UpdateBy"                      =>$this->session->userdata("FullName"),
            "UpdateTime"                    =>date("Y-m-d h:i:s")
        );
        $this->mt->update_data("tbl_product", $data, $id,$fld);
        $this->load->view('ajax/product', $data);
    } 
    public function product_delete(){
        $id = $this->input->post('deleted');
        $fld = 'Product_SlNo';
        $this->mt->delete_data("tbl_product", $id, $fld);
        $data['cate'] = 'Delete Success';
        $this->load->view('ajax/product', $data);
    } 
    public function fanceybox_category()  {
        $this->load->view('products/fanceybox_category');
    }
    public function insert_fanceybox_category()  {
        $mail = $this->input->post('add_Category');
        $query = $this->db->query("SELECT ProductCategory_Name from sr_productcategory where ProductCategory_Name = '$mail'");
        
        if($query->num_rows() > 0){
            $data['exists'] = "This Name is Already Exists";
            $this->load->view('ajax/fanceybox_product_cat',$data);
        }
        else{
            $data = array(
                "ProductCategory_Name"                  =>$this->input->post('add_Category', TRUE),
                "ProductCategory_Description"           =>$this->input->post('catdescrip', TRUE),
                "AddBy"                                 =>$this->session->userdata("FullName"),
                "AddTime"                               =>date("Y-m-d h:i:s")
                );
            $this->mt->save_data('sr_productcategory',$data);
            $this->load->view('ajax/fanceybox_product_cat');
        }
    }
    public function current_stock()  {
        $data['title'] = "Current Stock";
        $data['content'] = $this->load->view('stock/current_stock', $data, TRUE);
        $this->load->view('index', $data);
    }
    public function search_stock(){
        $data['Store'] = $this->input->post('Store');
        $data['CatID'] = $this->input->post('CatID');
        $this->session->set_userdata($data);
        $this->load->view('stock/search_stock', $data);
    }
    function searchproduct(){
        $data['Searchkey'] = $this->input->post('Searchkey');
        $this->load->view('ajax/search_product', $data);
    }
   
}
