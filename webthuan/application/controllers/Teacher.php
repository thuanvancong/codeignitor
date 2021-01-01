<?php 
class Teacher extends Pageparent_Controller
{
	public function __construct() {
       parent::__construct();
    }
	/*--- PAGE QUẢN LÝ GIÁO VIÊN---*/
	function index()
	{
		$this->load->helper('url');
		$this->load->model("quanlytrungtam_model");
		$data['pageName'] = 'teacher';
		// $data['pageCreateTeacher'] = site_url().'/teacher/add';
		// $data['pageUpdateTeacher'] = site_url().'/teacher/update';
		// $data['pageDeleteTeacher'] = site_url().'/teacher/delete';
		$data['pageCreateTeacher'] = site_url('Teacher/add');
		$data['pageUpdateTeacher'] = site_url('Teacher/update');
		$data['pageDeleteTeacher'] = site_url('Teacher/delete');
		$data['DBTeacher']=$this->quanlytrungtam_model->GetDBTable('teacher');
		$this->load->view("quanlytrungtam/layout",$data);
	}
	function add()
	{
		$this->load->helper('url');
		$data['pageName'] = 'teacher-add';
		$data['ajaxCreateTeacher']=site_url("Teacher/ajaxCreateTeacher");
		//$data['pageTeacher']=site_url().'/teacher';
		$data['pageTeacher']=site_url("Teacher/index");
		$this->load->model("quanlytrungtam_model");
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function ajaxCreateTeacher()
	{
		$dataInsert = array(
			'teacher_name' => $_POST['teacher_name'],
			'teacher_old' => $_POST['teacher_old'],
			'teacher_sex' => $_POST['teacher_sex'],
			'teacher_address' => $_POST['teacher_address']
		);
		$table='teacher';
		$this->load->model('quanlytrungtam_model');
		$teacher_id=$this->quanlytrungtam_model->InsertDB($dataInsert,$table);
		$ketquaAjax = array(
			'ketqua' => $teacher_id
		);
		echo json_encode($ketquaAjax);
	}

	function update()
	{
		$this->load->helper('url');
		$data['pageName'] = 'teacher-update';
		$data['ajaxLoadItemTeacher']=site_url("Teacher/ajaxLoadItemTeacher");
		$data['ajaxUpdateTeacherItem']=site_url("Teacher/ajaxUpdateTeacherItem");
		//$data['pageTeacher']=site_url().'/teacher';
		$data['pageTeacher']=site_url("Teacher/index");
		$this->load->model("quanlytrungtam_model");
		$data['DBTeacher'] = $this->quanlytrungtam_model->GetDBTable('teacher');
		$this->load->view("quanlytrungtam/layout",$data);
	}
	function ajaxLoadItemTeacher()
	{
		$this->load->model("quanlytrungtam_model"); 	
		$id = $_POST['teacher_id'];
		$table = 'teacher';
		$idTable = 'teacher_id';
		$dataDB = $this->quanlytrungtam_model->GetDBByID($id,$table,$idTable);
		$ketquaAjax = array(
			'ketqua' => $dataDB
		);
		echo json_encode($ketquaAjax);
	}

	function ajaxUpdateTeacherItem()
	{
		$dataUpdate = array(
			'teacher_name' => $_POST['teacher_name'],
			'teacher_old'=> $_POST['teacher_old'],
			'teacher_sex'=> $_POST['teacher_sex'],
			'teacher_address'=> $_POST['teacher_address']
		);
		$id = $_POST['teacher_id'];
		$table = 'teacher';
		$idTable = 'teacher_id';
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
		$data['pageName'] ='teacher-delete';
		$data['ajaxDeleteTeacherItem'] = site_url('Teacher/ajaxDeleteTeacherItem');
		//$data['pageTeacher']=site_url().'/teacher';
		$data['pageTeacher'] = site_url('Teacher/index');
		$this->load->model("quanlytrungtam_model");
		$data['DBTeacher'] = $this->quanlytrungtam_model->GetDBTable('teacher');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function ajaxDeleteTeacherItem()
	{
		$teacher_id = $_POST['teacher_id'];
		$table = 'teacher';
		$idTable ='teacher_id';
		$this->load->model("quanlytrungtam_model");
		$checkrow=$this->quanlytrungtam_model->deleteDB($teacher_id,$table,$idTable);
		$ketquaAjax = array(
			'ketqua' => $checkrow
		);
		echo json_encode($ketquaAjax);
	}

}