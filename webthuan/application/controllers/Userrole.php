<?php 
class Userrole extends Pageparent_Controller
{
	public function __construct() {
       parent::__construct();
    }
	/* PAGE ROLE CỦA USER */
	function index()
	{
		$this->load->helper('url');
		$data['pageName'] = 'role-by-user';
		$data['ajaxloadRoleByUser'] = site_url('Userrole/ajaxloadRoleByUser');
		$data['ajaxSaveRoleByUser'] = site_url('Userrole/ajaxSaveRoleByUser');
		$data['pageUser']=site_url("Users/index");
		$this->load->model("quanlytrungtam_model");
		$data['DBUser'] =$this->quanlytrungtam_model->GetDBTable('users');
		$data['DBRole'] =$this->quanlytrungtam_model->GetDBTable('roles');
		$this->load->view("quanlytrungtam/layout",$data);
		
	}

	function ajaxloadRoleByUser()
	 {
	 	$user_id = $_POST['user_id'];
	 	$this->load->model("quanlytrungtam_model");
	 	$dataDB=$this->quanlytrungtam_model->getRoleByUserID($user_id);
	 	$arrayTemp = array();
	 	foreach ($dataDB as $key => $value) 
	 	{
	 		// $array= explode(",",$value['role_id']);
	 		$role_id = $value['role_id'];
	 		$user_id = $value['user_id'];
	 		$arrayTemp[]=$role_id;
	 	}
	 	$userRole = array(
	 		$user_id => $arrayTemp
	 	);
	 	$ketquaAjax = array(
	 		'ketqua' => $userRole
	 	);
	 	echo json_encode($ketquaAjax);	
	}

	function ajaxSaveRoleByUser()
	{
		$this->load->helper('url');
		$user_id = $_POST['user_id'];
		$role_id = $_POST['role_id'];
		$table ='role_has_user';
		$idTable = 'user_id';
		$this->load->model("quanlytrungtam_model");
	 	$dataDB=$this->quanlytrungtam_model->GetDBByID($user_id,$table,$idTable);
	 	if(empty($dataDB))
	 	{
 			for ($i=0; $i<count($role_id); $i++)
 			{
 				$dataInsert = array (
		 			'role_id' => $role_id[$i],
		 			'user_id' => $user_id
	 			);
	 			$userrole_id=$this->quanlytrungtam_model->InsertDB($dataInsert,$table);
 			}
	 	}
	 	else
	 	{
	 		if($role_id=='array null')
	 		{
	 			$this->quanlytrungtam_model->deleteDB($user_id,$table,$idTable);
	 		}
	 		else
	 		{
	 			$this->quanlytrungtam_model->deleteDB($user_id,$table,$idTable);
		 		for ($i=0; $i<count($role_id); $i++)
	 			{
	 				$dataInsert = array (
			 			'role_id' => $role_id[$i],
			 			'user_id' => $user_id
		 			);
		 			$userrole_id=$this->quanlytrungtam_model->InsertDB($dataInsert,$table);
	 			}
	 		}
	 	}
	 	$ketquaAjax = array(
	 		'ketqua' => $userrole_id
	 	);
	 	echo json_encode($ketquaAjax);
	}
}