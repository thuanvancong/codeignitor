<?php 
/**
 * 
 */
class Schedule extends Pageparent_Controller
{
	
	public function __construct() {
       parent::__construct();
    }

    function index()
   	{
   		// $table = 'class_by_student';
   		// $data['dbClassStudent'] = GetDBTable($table);
   		$data['pageName'] = 'schedule';
   		$this->load->view("quanlytrungtam/layout",$data);
   	}
}
