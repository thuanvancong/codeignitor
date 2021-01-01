<?php 
class Users extends Pageparent_Controller
{
	public function __construct() {
       parent::__construct();
    }
	/*--- QUẢN LÝ USER ---*/
	function index()
	{
		$this->load->helper('url');
		$this->load->model("quanlytrungtam_model");
		$data['pageName'] = 'user';
		// $data['pageCreateUser'] = site_url().'/user/add';
		// $data['pageUpdateUser'] = site_url().'/user/update';
		// $data['pageDeleteUser'] = site_url().'/user/delete';
		// $data['pageUpdatePassUser'] = site_url().'/user/changepass';
		// $data['pageRoleByUser'] = site_url().'/user/userrole';
		$data['pageCreateUser'] = site_url('Users/add');
		$data['pageUpdateUser'] = site_url('Users/update');
		$data['pageDeleteUser'] = site_url('Users/delete');
		$data['pageUpdatePassUser'] = site_url('Users/updatepass');
		$data['pageRoleByUser'] = site_url('Userrole/index');
		$data['DBUser']=$this->quanlytrungtam_model->GetDBTable('users');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function add()
	{
		$this->load->helper('url');
		$data['pageName'] = 'user-add';
		$data['ajaxCreateUser']=site_url("Users/ajaxCreateUser");
		//$data['pageUser']=site_url().'/user';
		$data['pageUser']=site_url("Users/index");
		$this->load->model("quanlytrungtam_model");
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function ajaxCreateUser()
	{
		$date=date('20y-m-d h:i:s');
		$dataInsert = array(
			'user_name' => $_POST['user_name'],
			'user_isactive' => $_POST['user_isactive'],
			'user_pass' => $_POST['user_pass'],
			'time_create' => $date,
			'time_update' => $date
		);
		$table='users';
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
		$data['pageName'] = 'user-update';
		$data['ajaxLoadItemUser']=site_url("Users/ajaxLoadItemUser");
		$data['ajaxUpdateUserItem']=site_url("Users/ajaxUpdateUserItem");
		//$data['pageUser']=site_url().'/user';
		$data['pageUser']=site_url("Users/index");
		$this->load->model("quanlytrungtam_model");
		$data['DBUser'] = $this->quanlytrungtam_model->GetDBTable('users');
		$this->load->view("quanlytrungtam/layout",$data);
	}
	function ajaxLoadItemUser()
	{
		$this->load->model("quanlytrungtam_model"); 	
		$id = $_POST['user_id'];
		$table = 'users';
		$idTable = 'user_id';
		$dataDB = $this->quanlytrungtam_model->GetDBByID($id,$table,$idTable);
		$ketquaAjax = array(
			'ketqua' => $dataDB
		);
		echo json_encode($ketquaAjax);
	}
	function ajaxUpdateUserItem()
	{
		$date=date('20y-m-d h:i:s');
		$dataUpdate = array(
			'user_name' => $_POST['user_name'],
			'user_isactive' => $_POST['user_isactive'],
			'time_update' => $date
		);
		$id = $_POST['user_id'];
		$table = 'users';
		$idTable = 'user_id';
		$this->load->model("quanlytrungtam_model");
		$rowUpdate=$this->quanlytrungtam_model->updateDB($dataUpdate,$id,$table,$idTable);
		$ketqua = array(
			'kq'=> $rowUpdate
		);
		echo json_encode($ketqua);
	}

	function updatepass()
	{
		$data['pageName'] = 'user-update-pass';
		$data['ajaxLoadItemUser']=site_url("Users/ajaxLoadItemUser");
		$data['ajaxUpdatePassUserItem']=site_url("Users/ajaxUpdatePassUserItem");
		//$data['pageUser']=site_url().'/user';
		$data['pageUser']=site_url("Users/index");
		$this->load->model("quanlytrungtam_model");
		$data['DBUser'] = $this->quanlytrungtam_model->GetDBTable('users');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function ajaxUpdatePassUserItem()
	{
		$user_id = $_POST['user_id'];
		$user_pass = $_POST['user_pass'];
		$user_passnew = $_POST['user_passnew'];
		$date=date('20y-m-d h:i:s');
		$ketquaAjax = array(
			'kq' => 0
		);
		$this->load->model("quanlytrungtam_model");
		$passDB = $this->quanlytrungtam_model->getPassUserByID($user_id);
		foreach ($passDB as $key => $value) {
			if($value['user_pass']==$user_pass)
			{
				$dataUpdate = array(
					'user_pass' => $user_passnew,
					'time_update' => $date
				);
				$id = $_POST['user_id'];
				$table = 'users';
				$idTable = 'user_id';
				$rowUpdate=$this->quanlytrungtam_model->updateDB($dataUpdate,$id,$table,$idTable);
				$ketquaAjax['kq'] = 1;
			}
			else
			{
				$ketquaAjax['kq'] = 0;
			}
		}
		echo json_encode($ketquaAjax);
	}

	function delete()
	{
		$this->load->helper('url');
		$data['pageName'] ='user-delete';
		$data['ajaxDeleteUserItem'] = site_url('Users/ajaxDeleteUserItem');
		//$data['pageUser']=site_url().'/user';
		$data['pageUser'] = site_url('Users/index');
		$this->load->model("quanlytrungtam_model");
		$data['DBUser'] = $this->quanlytrungtam_model->GetDBTable('users');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function ajaxDeleteUserItem()
	{
		$user_id = $_POST['user_id'];
		$table = 'users';
		$idTable ='user_id';
		$this->load->model("quanlytrungtam_model");
		$checkrow=$this->quanlytrungtam_model->deleteDB($user_id,$table,$idTable);
		$ketquaAjax = array(
			'ketqua' => $checkrow
		);
		echo json_encode($ketquaAjax);
	}
}