<?php
/**
 * 
 */
class Register extends Pageparent_Controller
{
	
	public function __construct() {
       parent::__construct();
    }

    function index()
    {
    	// Load DS Student
    	$this->load->model("quanlytrungtam_model");
    	$data['dataStudent'] = $this->quanlytrungtam_model->GetDBTable('student');
    	$data['dataClass'] = $this->quanlytrungtam_model->GetDBTable('class');
    	$data['dataTeacher'] = $this->quanlytrungtam_model->GetDBTable('teacher');
    	$data['dataShift'] = $this->quanlytrungtam_model->GetDBTable('shift');
    	$data['pageName'] = 'register';
    	$this->load->helper('url');
    	$data['ajaxDetailClass'] = site_url('Register/ajaxDetailClass');
    	$data['ajaxDetailStudent'] = site_url('Register/ajaxDetailStudent');
    	$data['ajaxDetailTeacher'] = site_url('Register/ajaxDetailTeacher');
    	$data['ajaxDetailShift'] = site_url('Register/ajaxDetailShift');
    	$data['ajaxRegister'] = site_url('Register/ajaxRegister');
    	$this->load->view("quanlytrungtam/layout",$data);
    }
    function ajaxDetailClass()
    {
    	$name = $_POST['class_name'];
    	$this->load->model("quanlytrungtam_model");
    	$data = $this->quanlytrungtam_model->getDBClassByClassName($name);
    	$ketquaAjax = array(
    		'ketqua' => $data
    	);
    	echo json_encode($ketquaAjax);
    }

    function ajaxDetailStudent()
    {
    	$name = $_POST['student_name'];
    	$this->load->model("quanlytrungtam_model");
    	$data = $this->quanlytrungtam_model->getDBStudentByStudentName($name);
    	$ketquaAjax = array(
    		'ketqua' => $data
    	);
    	echo json_encode($ketquaAjax);
    }

    function ajaxDetailTeacher()
    {
    	$name = $_POST['teacher_name'];
    	$this->load->model("quanlytrungtam_model");
    	$data = $this->quanlytrungtam_model->getDBTeacherByTeacherName($name);
    	$ketquaAjax = array(
    		'ketqua' => $data
    	);
    	echo json_encode($ketquaAjax);
    }

    function ajaxDetailShift()
    {
    	$name = $_POST['shift_name'];
    	$this->load->model("quanlytrungtam_model");
    	$data = $this->quanlytrungtam_model->getDBShiftByShiftName($name);
    	$ketquaAjax = array(
    		'ketqua' => $data
    	);
    	echo json_encode($ketquaAjax);
    }

    function ajaxRegister()
    {
        $student_id = (int)$_POST['student_id'];
    	$student_name = $_POST['student_name'];
    	$class_name = $_POST['class_name'];
    	$teacher_name = $_POST['teacher_name'];
    	$shift_name = $_POST['shift_name'];
    	$precent_debt = $_POST['precent_debt'];
    	$this->load->model("quanlytrungtam_model");
    	//$idStudent = $this->quanlytrungtam_model->getIDByTable('student_id','student_name',$student_name,'Student');
    	$idClass = $this->quanlytrungtam_model->getIDByTable('class_id','class_name',$class_name,'Class');
    	$idTeacher = $this->quanlytrungtam_model->getIDByTable('teacher_id','teacher_name',$teacher_name,'Teacher');
    	$idShift = $this->quanlytrungtam_model->getIDByTable('shift_id','shift_name',$shift_name,'Shift');
    	//$student_id = $idStudent[0]['student_id'];
    	$class_id = $idClass[0]['class_id'];
    	$teacher_id = $idTeacher[0]['teacher_id'];
    	$shift_id = $idShift[0]['shift_id'];
    	$dataInsert = array(
    		'precent_debt' => $precent_debt,
    		'class_id' => $class_id,
    		'teacher_id' => $teacher_id,
    		'student_id' => $student_id,
    		'shift_id' => $shift_id
     	);
     	$table = 'class_by_student';
		$id_student_class=$this->quanlytrungtam_model->InsertDB($dataInsert,$table);
		$ketquaAjax = array(
			'ketqua' => $id_student_class
		);
		echo json_encode($ketquaAjax);
    }
}