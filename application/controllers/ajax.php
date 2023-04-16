<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
    }
function ajax_postdata(){
	$this->load->view('allAjax');
	}
}
