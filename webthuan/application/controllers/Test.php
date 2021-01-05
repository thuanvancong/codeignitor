<?php

/**
 * 
 */
class Test extends Pageparent_Controller
{
	public function __construct() {
       parent::__construct();
    }

    function index()
    {
    	$data['pageName'] = 'test.php';
    	$this->load->view("quanlytrungtam/test.php",$data);
    }
}