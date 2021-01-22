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
    	$this->load->helper('url');
    	$data['pageName'] = 'moneystudent';
    	$data['ajaxDetailPayment'] = site_url("Money/ajaxDetailPayment");
    	$data['ajaxPayment'] = site_url("Money/ajaxPayment");
    	$data['pageMoneyStudent'] = site_url("Money/moneyStudent");
        $data['dbClass'] = $this->quanlytrungtam_model->GetDBTable('class');
    	$this->load->model("quanlytrungtam_model");
    	$data['dbExtend'] = $this->quanlytrungtam_model->getDBJoin_STUDENT_CLASS_EXTENTD();
    	$this->load->view("quanlytrungtam/layout",$data);
    }

    function ajaxDetailPayment()
    {
    	$student_identitycard = (int)$_POST['studentIdentitycard'];
        $class_id = (int)$_POST['schedule_class'];
        $level_id = (int)$_POST['level_id'];
    	$this->load->model("quanlytrungtam_model");
    	$dbExtend = $this->quanlytrungtam_model->getDB_STUDENT_CLASS_EXTENTD_BY_INDENTITYCARD($student_identitycard,$class_id,$level_id);
    	$ketquaAjax = array(
    		'ketqua' => $dbExtend
    	);
    	echo json_encode($ketquaAjax);
    } 

    function ajaxPayment()
    {
    	$class_student_id = (int)$_POST['class_student_id'];
    	$precent_debt = $_POST['precentDebt'];
    	$precent_payment = $_POST['precentPayment'];
    	$updateMoney = $precent_debt + $precent_payment;
    	$table = 'extend_class_student';
    	$idTable = 'extend_id';
    	$dataUpdate = array(
    		'precent_debt' => (int)$updateMoney
    	);
    	$this->load->model("quanlytrungtam_model");
    	$affected_rows=$this->quanlytrungtam_model->updateDB($dataUpdate,$class_student_id,$table,$idTable);
    	$ketquaAjax =array(
			'ketqua' => 1
		);
		echo json_encode($ketquaAjax);
    }
}