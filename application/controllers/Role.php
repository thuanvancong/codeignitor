<?php 
class Role extends Pageparent_Controller
{
	
	/*--- QUẢN LÝ ROLE ---*/
	function index()
	{
		$this->load->helper('url');
		$this->load->model("quanlytrungtam_model");
		$data['pageName'] = 'role';
		// $data['pageCreateRole'] = site_url().'/role/add';
		// $data['pageUpdateRole'] = site_url().'/role/update';
		// $data['pageDeleteRole'] = site_url().'/role/delete';
		$data['pageCreateRole'] = site_url('Role/add');
		$data['pageUpdateRole'] = site_url('Role/update');
		$data['pageDeleteRole'] = site_url('Role/delete');
		$data['DBRole']=$this->quanlytrungtam_model->GetDBTable('roles');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function add()
	{
		$this->load->helper('url');
		$data['pageName'] = 'role-add';
		$data['ajaxCreateRole']=site_url("Role/ajaxCreateRole");
		//$data['pageRole']=site_url().'/role';
		$data['pageRole']=site_url("Role/index");
		$this->load->model("quanlytrungtam_model");
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function ajaxCreateRole()
	{
		$dataInsert = array(
			'role_name' => $_POST['role_name'],
			'role_isactive' => $_POST['role_isactive'],
			'router' => $_POST['router'],
		);
		$table='roles';
		$this->load->model('quanlytrungtam_model');
		$user_id=$this->quanlytrungtam_model->InsertDB($dataInsert,$table);
		$ketquaAjax = array(
			'ketqua' => $user_id
		);
		echo json_encode($ketquaAjax);
	}

	function update()
	{
		$this->load->helper('url');
		$data['pageName'] = 'role-update';
		$data['ajaxLoadItemRole']=site_url("Role/ajaxLoadItemRole");
		$data['ajaxUpdateRoleItem']=site_url("Role/ajaxUpdateRoleItem");
		//$data['pageRole']=site_url().'/role';
		$data['pageRole']=site_url("Role/index");
		$this->load->model("quanlytrungtam_model");
		$data['DBRole'] = $this->quanlytrungtam_model->GetDBTable('roles');
		$this->load->view("quanlytrungtam/layout",$data);
	}
	function ajaxLoadItemRole()
	{
		$this->load->model("quanlytrungtam_model"); 	
		$id = $_POST['role_id'];
		$table = 'roles';
		$idTable = 'role_id';
		$dataDB = $this->quanlytrungtam_model->GetDBByID($id,$table,$idTable);
		$ketquaAjax = array(
			'ketqua' => $dataDB
		);
		echo json_encode($ketquaAjax);
	}
	function ajaxUpdateRoleItem()
	{
		$dataUpdate = array(
			'role_name' => $_POST['role_name'],
			'role_isactive' => $_POST['role_isactive'],
			'router' => $_POST['router']
		);
		$id = $_POST['role_id'];
		$table = 'roles';
		$idTable = 'role_id';
		$this->load->model("quanlytrungtam_model");
		$rowUpdate=$this->quanlytrungtam_model->updateDB($dataUpdate,$id,$table,$idTable);
		$ketqua = array(
			'kq'=> $rowUpdate
		);
		echo json_encode($ketqua);
	}

	function delete()
	{
		$this->load->helper('url');
		$data['pageName'] ='role-delete';
		$data['ajaxDeleteRoleItem'] = site_url('Role/ajaxDeleteRoleItem');
		//$data['pageRole']=site_url().'/role';
		$data['pageRole'] = site_url('Role/index');
		$this->load->model("quanlytrungtam_model");
		$data['DBRole'] = $this->quanlytrungtam_model->GetDBTable('roles');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function ajaxDeleteRoleItem()
	{
		$role_id = $_POST['role_id'];
		$table = 'roles';
		$idTable ='role_id';
		$this->load->model("quanlytrungtam_model");
		$checkrow=$this->quanlytrungtam_model->deleteDB($role_id,$table,$idTable);
		$ketquaAjax = array(
			'ketqua' => $checkrow
		);
		echo json_encode($ketquaAjax);
	}
}