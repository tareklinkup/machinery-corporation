<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Addcart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//load model
		$this->load->model('billing_model');
        $this->load->library('cart');
        $this->load->model('model_table', "mt", TRUE);
        $this->load->helper('form');
	}

	public function index(){	
        redirect("products");
	}
	function purchaseTOcart(){
		$insert_data = array(
			'id' => $this->input->post('id'),
			'name' => mysql_real_escape_string($this->input->post('name')),
			'price' => $this->input->post('price'),
			'purchaserate' => $this->input->post('price'),
			'image' => $this->input->post('image'),
			'packagename' => $this->input->post('packagename'),
			'packagecode' => $this->input->post('packagecode'),
			'qty' => $this->input->post('qty')
		);
		$this->cart->insert($insert_data);
		$this->load->view('purchase/cartproduct');
	}
	
	function ajax_cart_remove() {
		$rowid = $this->input->post('rowid');
		if ($rowid==="all"){
			$this->cart->destroy();
		}
		else{
			$data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);
			$this->cart->update($data);
		}
		$this->load->view('purchase/cartproduct');
	}

	function product_transfer_tocart(){
		$insert_data = array(
			'id' => $this->input->post('ProID'),
			'procode' => $this->input->post('proCode'),
			'name' => mysql_real_escape_string($this->input->post('proName')),
			'price' => 1,
			'image' => $this->input->post('proUnit'),
			'qty' => $this->input->post('proQTY')
		);
		$this->cart->insert($insert_data);
		$this->load->view('transfer/cartproduct');
	}

	function product_transfer_remove(){
		$rowid = $this->input->post('rowid');
		if ($rowid==="all"){
			$this->cart->destroy();
		}else{			
			$data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);
			$this->cart->update($data);		
		}
		$this->load->view('transfer/cartproduct');
	}

	function SalesTOcart(){
		$insert_data = array(
			'id' => $this->input->post('ProID'),
			'name' => mysql_real_escape_string($this->input->post('proName')),
			'product_description' => $this->input->post('product_description'),
			'price' => $this->input->post('ProRATe'),
			'purchaserate' => $this->input->post('ProPurchaseRATe'),
			'packagename' => $this->input->post('packagename'),
			'packagecode' => $this->input->post('packagecode'),
			'image' => mysql_real_escape_string($this->input->post('unit')),
			'qty' => $this->input->post('proQTY')
		);
		$this->cart->insert($insert_data);
		$this->load->view('sales/selseCArtlist');

	}
	function SalesTOcartedit(){
		$insert_data = array(
			'id' => $this->input->post('ProID'),
			'name' => mysql_real_escape_string($this->input->post('proName')),
			'product_description' => $this->input->post('product_description'),
			'price' => $this->input->post('ProRATe'),
			'purchaserate' => $this->input->post('ProPurchaseRATe'),
			'packagename' => $this->input->post('packagename'),
			'packagecode' => $this->input->post('packagecode'),
			'image' => mysql_real_escape_string($this->input->post('unit')),
			'qty' => $this->input->post('proQTY')
		);
		$this->cart->insert($insert_data);
		$this->load->view('sales/selseCArtlistedit');

	}
	function ajax_salsecart_remove() {
		$rowid = $this->input->post('rowid');
		if ($rowid==="all"){
			$this->cart->destroy();
		}
		else{
			
			$data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);
			$this->cart->update($data);
		
		}
		$this->load->view('sales/selseCArtlist');
	}
	function ajax_salsecart_edit_remove() {
		$rowid = $this->input->post('rowid');
		$cartitem = $this->input->post('cartitem');
		$salesId = $this->input->post('salesId');
		$totalamt = $this->input->post('totalamt');



		if ($rowid==="all"){
			$this->cart->destroy();
		}
		else{
			if($cartitem=='sell'){
				
        $salesProduct = "select * from sr_saledetails where SaleDetails_SlNo = '".$salesId."'";
        $salesProductResult = mysql_query($salesProduct);
        $srow = mysql_fetch_array($salesProductResult);
        $salesMasterID = $srow['SaleMaster_IDNo'];
        $salesProductID = $srow['Product_IDNo'];
        $salesItemPrice = $srow['SaleDetails_Rate'];
        $salesItemQty = $srow['SaleDetails_TotalQuantity'];
        $totalPrice = ($salesItemPrice * $salesItemQty);

        $salesInventorySelect = "select SaleInventory_SlNo,SaleInventory_TotalQuantity from sr_saleinventory where sellProduct_IdNo = '".$salesProductID."'";
        $salesInventorySelectResult = mysql_query($salesInventorySelect);
        $sirow = mysql_fetch_array($salesInventorySelectResult);
        $siID = $sirow['SaleInventory_SlNo'];
        $sitotalqty = $sirow['SaleInventory_TotalQuantity'];
        $siupdateqty = ($sitotalqty - $salesItemQty);
        $siupdate = mysql_query("update sr_saleinventory set SaleInventory_TotalQuantity = '".$siupdateqty."' where SaleInventory_SlNo = '".$siID."'");

        $selectSalesMaster = mysql_query("select * from sr_salesmaster where SaleMaster_SlNo = '".$salesMasterID."'");
        $smrow = mysql_fetch_array($selectSalesMaster);
        $smtotalsalesamount = $smrow['SaleMaster_TotalSaleAmount'];
        $smsubtotalsalesamount = $smrow['SaleMaster_SubTotalAmount'];
        $smtotalpaidamount = $smrow['SaleMaster_PaidAmount'];
        $smtotaldueamount = $smrow['SaleMaster_DueAmount'];

        $smupdatesalesamount = ($smtotalsalesamount - $totalPrice);
        $smupdatesubtotalsalesamount = ($smsubtotalsalesamount - $totalPrice);
        $smupdatetotaldueamount = ($smtotaldueamount - $totalPrice);

        $updatesalesmaster = mysql_query("update sr_salesmaster set SaleMaster_TotalSaleAmount = '".$smupdatesalesamount."', SaleMaster_SubTotalAmount = '".$smupdatesubtotalsalesamount."', SaleMaster_DueAmount = '".$smupdatetotaldueamount."' where SaleMaster_SlNo = '".$salesMasterID."'");

        $deleteItem = mysql_query("delete from sr_saledetails where SaleDetails_SlNo = '".$salesId."'");


          
			}
			else{
			$data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);
			$this->cart->update($data);
		}
		}
		$this->load->view('sales/selseCArtlistedit');
	}
	function cart_view(){
		$data ['title']= "Checkout";
		$data['products_page'] = $this->load->view('checkout', $data, TRUE);
		$this->load->view('index', $data);
    }
    function showcartAjax(){
		
		$this->load->view('showcartAjax');
    }
    public function checkout(){
		$data['title'] = "Checkout";
		$data['sidebar'] = $this->load->view('sidebar',$data,TRUE);
		$data['products_page'] = $this->load->view('checkout',$data,TRUE);
		$this->load->view('index',$data);
	}
	
	function remove($rowid) {
            // Check rowid value.
		if ($rowid==="all"){
            // Destroy data which store in  session.
			$this->cart->destroy();
			$this->session->unset_userdata('totalcart');
		}
		else{
            // Destroy selected rowid in session.
			$data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);
            // Update cart data, after cancle.
			$this->cart->update($data);
			$this->session->unset_userdata('totalcart');
		}
        // This will show cancle data in cart.
		redirect('shopping/checkout');
	}
	
	function update_cart(){
        // Recieve post values,calcute them and update
        $cart_info =  $_POST['cart'] ;
 		foreach( $cart_info as $id => $cart){	
            $rowid = $cart['rowid'];
            $price = $cart['price'];
            $amount = $price * $cart['qty'];
            $qty = $cart['qty'];
                    
                $data = array(
				'rowid'   => $rowid,
                'price'   => $price,
                'amount' =>  $amount,
				'qty'     => $qty
			);
			$this->cart->update($data);
		}
		redirect('shopping/checkout');        
	}
	public function order_success(){
    	$data ['title']= "Order Complete";
    	$data['sidebar'] = $this->load->view('sidebar',$data,TRUE);
		$data['products_page'] = $this->load->view('order_success', $data, TRUE);
		$this->load->view('index', $data);
    }
    public function billing_view(){
    	$idd = $this->session->userdata('LogiinSession');
    	if($idd ==NULL){
    		$data ['title']= "Billing Page";
			$data['sidebar'] = $this->load->view('sidebar',$data,TRUE);
        	$data['products_page'] = $this->load->view('billing_page',$data,TRUE);
			$this->load->view('index', $data);
    	}else{
    		redirect("shopping/billing_view_2");
    	}
    	
    }
    public function billing_view_2(){
    	$data ['title']= "Billing Page";
    	$data['sidebar'] = $this->load->view('sidebar',$data,TRUE);
		$data['products_page'] = $this->load->view('billing_page2', $data, TRUE);
		$this->load->view('index', $data);
    }
    public function save_order(){
    	if (!empty($_SERVER['HTTP_CLIENT_IP'])){
          $ip=$_SERVER['HTTP_CLIENT_IP'];
        //Is it a proxy address
        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
          $ip=$_SERVER['REMOTE_ADDR'];
        }
        
			$customer = array(
				"fld_fullname"          =>$this->input->post('fullname'),
	            "fld_password"          =>md5($this->input->post('password')),
	            "fld_email"          =>$this->input->post('email'),
	            "fld_address"          =>$this->input->post('address'),
	            "fld_phone"          =>$this->input->post('phone'),
	            "customer_ip"          =>$ip
			);		
	        // And store user imformation in database.
	        $cust_id = $this->billing_model->insert_customer($customer);
		
		$query = mysql_query("SELECT * from order_tbl order by fld_id desc limit 1");
		$row = mysql_fetch_array($query);

		$orderserial = "1000".$row['fld_id'];
		$order = array(
			'date' 			=> date('m/d/Y'),
			'customer_id' 	=> $cust_id,
			'payment' 		=> $this->input->post('payment'),
			'orderserial' 		=> $orderserial
		);
		$ord_id = $this->billing_model->insert_order($order);
		
		if ($cart = $this->cart->contents()):
			foreach ($cart as $item):
				$order_detail = array(
					'orderid' 		=> $ord_id,
					'productid' 	=> $item['id'],
					'quantity' 		=> $item['qty'],
					'price' 		=> $item['price'],
					'image' 		=> $item['image']

				);
                // Insert product imformation with order detail, store in cart also store in database. 
                $cust_id = $this->billing_model->insert_order_detail($order_detail);
			endforeach;
		endif;
        // After storing all imformation in database load "billing_success".
        $this->cart->destroy();
		redirect('shopping/order_success');
	}
	public function Loginsave_order(){
    	if (!empty($_SERVER['HTTP_CLIENT_IP'])){
          $ip=$_SERVER['HTTP_CLIENT_IP'];
        //Is it a proxy address
        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
          $ip=$_SERVER['REMOTE_ADDR'];
        }
        $id = $this->input->post('orderID');
        $query = mysql_query("SELECT * from customer where fld_id = '$id'");
        $check = mysql_fetch_array($query);
        //$iidd = $check['fld_id'];
        if($query){$cust_id = $id;}

		$query = mysql_query("SELECT * from order_tbl order by fld_id desc limit 1");
		$row = mysql_fetch_array($query);

		$orderserial = "1000".$row['fld_id'];
		$order = array(
			'date' 			=> date('m/d/Y'),
			'customer_id' 	=> $cust_id,
			'payment' 		=> $this->input->post('payment'),
			'orderserial' 	=> $orderserial
		);
		$ord_id = $this->billing_model->insert_order($order);
		
		if ($cart = $this->cart->contents()):
			foreach ($cart as $item):
				$order_detail = array(
					'orderid' 		=> $ord_id,
					'productid' 	=> $item['id'],
					'quantity' 		=> $item['qty'],
					'price' 		=> $item['price'],
					'image' 		=> $item['image']
				);
                // Insert product imformation with order detail, store in cart also store in database. 
                $cust_id = $this->billing_model->insert_order_detail($order_detail);
			endforeach;
		endif;
        // After storing all imformation in database load "billing_success".
        $this->cart->destroy();
		redirect('shopping/order_success');
	}
	public function Back() {
           $rowid = $this->input->post('rowid');
		if ($rowid==="all"){
            // Destroy data which store in  session.
			$this->cart->destroy();
			$this->session->unset_userdata('totalcart');
		}
		else{
            // Destroy selected rowid in session.
			$data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);
            // Update cart data, after cancle.
			$this->cart->update($data);
		}
		redirect(base_url());
	}
	public function PurchacLoginCheck(){
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){
          $ip=$_SERVER['HTTP_CLIENT_IP'];
        //Is it a proxy address
        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
          $ip=$_SERVER['REMOTE_ADDR'];
        }
    	$data['title'] = ' Login';
        $user =mysql_real_escape_string($this->input->post('login_email'));
        $pass = md5($this->input->post('login_pass'));
        $x = "SELECT * from customer where fld_email ='$user' AND fld_password ='$pass'";
        $sql = mysql_query($x);
        $d = mysql_fetch_array($sql); 

        if($d['cusStatus'] == "2"){
            $sdata['LogiinSession'] = $d['fld_id'];
            $sdata['ID'] = $d['fld_id'];
            $sdata['name'] = $d['fld_fullname'];
            $sdata['NaMe'] = $d['fld_fullname'];
            $sdata['email'] = $d['fld_email'];
            $sdata['address'] = $d['fld_address'];
            $sdata['phone'] = $d['fld_phone'];
            $sdata['customer_ip'] = $ip;
            $this->session->set_userdata($sdata);
            redirect('shopping/billing_view_2');
        }
        else{
            $data['title'] = 'Billing Page';
            $data['staa'] = "Invalid Email or Password";
            $data['sidebar'] = $this->load->view('sidebar',$data,TRUE);
        	$data['products_page'] = $this->load->view('billing_page',$data,TRUE);
			$this->load->view('index', $data);
        }
    }
    
    public function customerLogin(){
		
    	$data['title'] = ' Login';
        $user =mysql_real_escape_string($this->input->post('login_email'));
        $pass = md5($this->input->post('login_pass'));
        $x = "SELECT * from customer where fld_email ='$user' AND fld_password ='$pass'";
        $sql = mysql_query($x);
        $d = mysql_fetch_array($sql); 

        if($d['cusStatus'] == "2"){
            $sdata['LogiinSession'] = $d['fld_id'];
            $sdata['ID'] = $d['fld_id'];
            $sdata['NaMe'] = $d['fld_fullname'];
            $this->session->set_userdata($sdata);
            redirect(base_url(),'refresh');
        }
        else{
            $data['title'] = ' Login';
            $data['sta'] = "Invalid Email or Password";
            $data['sidebar'] = $this->load->view('sidebar',$data,TRUE);
            $data['products_page'] = $this->load->view('create_an_account', $data, TRUE);
			$this->load->view('index', $data);
        }
    }
    public function LogOut(){
        $this->session->unset_userdata('ID');
        $this->session->unset_userdata('LogiinSession');
        $this->session->unset_userdata('NaMe');
        redirect(base_url(), 'refresh');
    }
}
?>