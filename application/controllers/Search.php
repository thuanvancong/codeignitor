<?php
/**
 * 
 */
class Search extends Pageparent_Controller
{
	
	public function __construct() {
       parent::__construct();
    }

    function index()
    {
    	$data['pageName'] = 'search';
    	$this->load->view("quanlytrungtam/layout",$data);
    }
}