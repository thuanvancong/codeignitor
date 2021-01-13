<?php 
class Student extends Pageparent_Controller
{
	public function __construct() {
       parent::__construct();
    }
	/* ---- QUẢN LÝ HỌC VIÊN ----*/
	function index()
	{
		$this->load->helper('url');
		$this->load->model("quanlytrungtam_model");
		$data['pageName'] = 'student';
		// $data['pageCreateStudent'] = site_url().'/student/add';
		// $data['pageUpdateStudent'] = site_url().'/student/update';
		// $data['pageDeleteStudent'] = site_url().'/student/delete';
		// $data['pageUpdateLevelStudent'] = site_url().'/student/updatelevel';
		$data['pageCreateStudent'] = site_url('Student/add');
		$data['pageUpdateStudent'] = site_url('Student/update');
		$data['pageDeleteStudent'] = site_url('Student/delete');
		$data['pageUpdateLevelStudent'] = site_url('Student/updatelevel');
		$data['DBStudent']=$this->quanlytrungtam_model->GetDBTable('student');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function add()
	{
		$this->load->helper('url');
		$data['pageName'] = 'student-add';
		$data['ajaxCreateStudent']=site_url("Student/ajaxCreateStudent");
		//$data['pageStudent']=site_url().'/student';
		$data['pageStudent']=site_url("Student/index");
		$this->load->model("quanlytrungtam_model");
		$data['DBCourse'] = $this->quanlytrungtam_model->GetDBTable('student');
		$data['DBLevel'] = $this->quanlytrungtam_model->GetDBTable('tb_level');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function ajaxCreateStudent()
	{
		$dataInsert = array(
			'student_name' => $_POST['student_name'],
			'student_old' => $_POST['student_old'],
			'student_identitycard' => $_POST['student_identitycard'],
			'student_sex' => $_POST['student_sex'],
			'student_address' => $_POST['student_address'],
			'student_email' => $_POST['student_email'],
			'student_phone' => $_POST['student_phone'],
			'student_level' => $_POST['student_level']
		);
		$table='student';
		$this->load->model('quanlytrungtam_model');
		$dataStudent = $this->quanlytrungtam_model->getDBStudentByIdentifyCard($_POST['student_identitycard']);
		if(empty($dataStudent))
		{
			$student_id=$this->quanlytrungtam_model->InsertDB($dataInsert,$table);
			// Insert User Sinh Viên 
			$date=date('20y-m-d h:i:s');
			$tableInsert='users';
			$dataInsertUser = array (
				'user_name' => 'SV_'.$_POST['student_identitycard'],
				'user_pass' => $_POST['student_identitycard'],
				'user_isactive' => 1,
				'time_create' => $date,
				'time_update' => $date
			);
			$user_id=$this->quanlytrungtam_model->InsertDB($dataInsertUser,$tableInsert);
			$ketquaAjax = array(
				'ketqua' => $student_id
			);
		}
		else
		{
			$ketquaAjax = array(
				'ketqua' => 0
			);
		}
		echo json_encode($ketquaAjax);
	}

	function update()
	{
		$this->load->helper('url');
		$data['pageName'] = 'student-update';
		$data['ajaxLoadItemStudent']=site_url("Student/ajaxLoadItemStudent");
		//$data['ajaxUpdateStudentItem']=site_url("Student_Controller/ajaxUpdateStudentItem");
		$data['pageStudent']=site_url().'/student';
		$data['pageStudent']=site_url("Student/index");
		$this->load->model("quanlytrungtam_model");
		$data['DBStudent'] = $this->quanlytrungtam_model->GetDBTable('student');
		$data['DBLevel'] = $this->quanlytrungtam_model->GetDBTable('tb_level');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function ajaxLoadItemStudent()
	{
		$this->load->model("quanlytrungtam_model"); 	
		$id = $_POST['student_id'];
		$table = 'student';
		$idTable = 'student_id';
		$dataDB = $this->quanlytrungtam_model->GetDBByID($id,$table,$idTable);
		$ketquaAjax = array(
			'ketqua' => $dataDB
		);
		echo json_encode($ketquaAjax);
	}

	function ajaxUpdateStudentItem()
	{
		$dataUpdate = array(
			'student_name' => $_POST['student_name'],
			'student_old'=> $_POST['student_old'],
			'student_sex'=> $_POST['student_sex'],
			'student_address'=> $_POST['student_address'],
			'student_phone'=> $_POST['student_phone'],
		);
		$id = $_POST['student_id'];
		$table = 'student';
		$idTable = 'student_id';
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
		$data['pageName'] ='student-delete';
		$data['ajaxDeleteStudentItem'] = site_url('Student/ajaxDeleteStudentItem');
		//$data['pageStudent']=site_url().'/student';
		$data['pageStudent'] = site_url('Student/index');
		$this->load->model("quanlytrungtam_model");
		$data['DBStudent'] = $this->quanlytrungtam_model->GetDBTable('student');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function ajaxDeleteStudentItem()
	{
		$student_id = $_POST['student_id'];
		$table = 'student';
		$idTable ='student_id';
		$this->load->model("quanlytrungtam_model");
		$checkrow=$this->quanlytrungtam_model->deleteDB($student_id,$table,$idTable);
		$ketquaAjax = array(
			'ketqua' => $checkrow
		);
		echo json_encode($ketquaAjax);
	}

	function updatelevel()
	{
		$this->load->helper('url');
		$data['pageName'] = 'student-update-level';
		$data['ajaxLoadItemStudent']=site_url("Student/ajaxLoadItemStudent");
		$data['ajaxUpdateLevelStudent']=site_url("Student/ajaxUpdateLevelStudent");
		//$data['pageStudent']=site_url().'/student';
		$data['pageStudent']=site_url("Student/index");
		$this->load->model("quanlytrungtam_model");
		$data['DBStudent'] = $this->quanlytrungtam_model->GetDBTable('student');
		$data['DBLevel'] = $this->quanlytrungtam_model->GetDBTable('tb_level');
		$this->load->view("quanlytrungtam/layout",$data);
	}
	function ajaxUpdateLevelStudent()
	{
		$dataUpdate = array(
			'student_level'=> $_POST['student_level']
		);
		$id = $_POST['student_id'];
		$table = 'student';
		$idTable = 'student_id';
		$this->load->model("quanlytrungtam_model");
		$rowUpdate=$this->quanlytrungtam_model->updateDB($dataUpdate,$id,$table,$idTable);
		$ketqua = array(
			'kq'=> $rowUpdate
		);
		echo json_encode($ketqua);
	}
	
}
