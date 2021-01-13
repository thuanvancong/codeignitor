<?php 
class Class_CI extends Pageparent_Controller
{
	public function __construct() {
       parent::__construct();
    }
	/*--- PAGE QUẢN LÝ LỚP HỌC---*/
	function index()
	{
		$this->load->helper('url');
		$this->load->model("quanlytrungtam_model");
		$data['pageName'] = 'class';
		// $data['pageCreateClass'] = site_url().'/class/add';
		// $data['pageUpdateClass'] = site_url().'/class/update';
		// $data['pageDeleteClass'] = site_url().'/class/delete';
		$data['pageCreateClass'] = site_url('Class_CI/add');
		$data['pageUpdateClass'] = site_url('Class_CI/update');
		$data['pageDeleteClass'] = site_url('Class_CI/delete');
		$data['DBClass']=$this->quanlytrungtam_model->GetDBTable('class');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function add()
	{
		$this->load->helper('url');
		$data['pageName'] = 'class-add';
		$data['ajaxCreateclass']=site_url("Class_CI/ajaxCreateclass");
		//$data['pageClass']=site_url().'/class';
		$data['pageClass']=site_url("Class_CI/index");
		$this->load->model("quanlytrungtam_model");
		$data['DBCourse'] = $this->quanlytrungtam_model->GetDBTable('course');
		$data['DBLevel'] = $this->quanlytrungtam_model->GetDBTable('tb_level');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function update()
	{
		$this->load->helper('url');
		$data['pageName'] = 'class-update';
		$data['ajaxLoadItemClass']=site_url("Class_CI/ajaxLoadItemClass");
		$data['ajaxUpdateClassItem']=site_url("Class_CI/ajaxUpdateClassItem");
		//$data['pageClass']=site_url().'/class';
		$data['pageClass']=site_url("Class_CI/index");
		$this->load->model("quanlytrungtam_model");
		$data['DBClass'] = $this->quanlytrungtam_model->GetDBTable('class');
		$data['DBCourse'] = $this->quanlytrungtam_model->GetDBTable('course');
		$data['DBLevel'] = $this->quanlytrungtam_model->GetDBTable('tb_level');
		$this->load->view("quanlytrungtam/layout",$data);
	}
	function ajaxCreateclass()
	{
		$dataInsert = array(
			'class_name' => $_POST['class_name'],
			'class_description' => $_POST['class_description'],
			'class_open' => $_POST['class_open'],
			'class_finish' => $_POST['class_finish'],
			'level_id' => $_POST['level_id'],
			'course_id' => $_POST['course_id']
		);
		$table='class';
		$this->load->model('quanlytrungtam_model');
		$class_id=$this->quanlytrungtam_model->InsertDB($dataInsert,$table);
		$ketquaAjax = array(
			'ketqua' => $class_id
		);
		echo json_encode($ketquaAjax);
	}

	function ajaxLoadItemClass()
	{
		$this->load->model("quanlytrungtam_model");
		$id = $_POST['class_id'];
		$table = 'class';
		$idTable = 'class_id';
		$dataDB = $this->quanlytrungtam_model->GetDBByID($id,$table,$idTable);
		$ketquaAjax = array(
			'ketqua' => $dataDB
		);
		echo json_encode($ketquaAjax);
	}
	function ajaxUpdateClassItem()
	{
		$dataUpdate = array(
			'class_name' => $_POST['class_name'],
			'class_description'=> $_POST['class_description'],
			'class_open'=> $_POST['class_open'],
			'class_finish'=> $_POST['class_finish'],
			'level_id'=> $_POST['level_id'],
			'course_id'=> $_POST['course_id'],
		);
		$id = $_POST['class_id'];
		$table = 'class';
		$idTable = 'class_id';
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
		$data['pageName'] ='class-delete';
		$data['ajaxDeleteClassItem'] = site_url('Class_CI/ajaxDeleteClassItem');
		//$data['pageClass']=site_url().'/class';
		$data['pageClass']=site_url("Class_CI/index");
		$this->load->model("quanlytrungtam_model");
		$data['DBClass'] = $this->quanlytrungtam_model->GetDBTable('class');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function ajaxDeleteClassItem()
	{
		$class_id = $_POST['class_id'];
		$table = 'class';
		$idTable ='class_id';
		$this->load->model("quanlytrungtam_model");
		$checkrow=$this->quanlytrungtam_model->deleteDB($class_id,$table,$idTable);
		$ketquaAjax = array(
			'ketqua' => $checkrow
		);
		echo json_encode($ketquaAjax);
	}
}