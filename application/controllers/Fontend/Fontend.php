<?php

/**
 * 
 */
class Fontend extends Fontend_Controller
{
	
	public function __construct() {
       parent::__construct();
    }

    function index()
    {
    	$data['pageName'] = 'fontend';
    	$this->load->view("quanlytrungtam/fontend/layout", $data);
    }
}