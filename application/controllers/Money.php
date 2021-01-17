<?php
/**
 * 
 */
class Money extends Pageparent_Controller
{
	
	public function __construct() {
       parent::__construct();
    }

    function index()
    {
    	$this->load->helper('url');
    	$data['pageName'] = 'money';
    	$data['pageMoneyStudent'] = site_url("Money/moneyStudent");
    	$this->load->view("quanlytrungtam/layout",$data);
    }

    function moneyStudent()
    {
    	$data['pageName'] = 'moneystudent';
    	$this->load->model("quanlytrungtam_model");
    	$data['dbExtend'] = $this->quanlytrungtam_model->getDBJoin_STUDENT_CLASS_EXTENTD();
    	$this->load->view("quanlytrungtam/layout",$data);
    }
}