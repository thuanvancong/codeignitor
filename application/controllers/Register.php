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
        $data['dataCourse'] = $this->quanlytrungtam_model->GetDBTable('course');
        $data['dataLevel'] = $this->quanlytrungtam_model->GetDBTable('tb_level');
    	$data['pageName'] = 'register';
    	$this->load->helper('url');
        $data['ajaxDetailCourse'] = site_url('Register/ajaxDetailCourse');
    	$data['ajaxDetailClass'] = site_url('Register/ajaxDetailClass');
    	$data['ajaxDetailStudent'] = site_url('Register/ajaxDetailStudent');
    	$data['ajaxDetailTeacher'] = site_url('Register/ajaxDetailTeacher');
    	$data['ajaxDetailShift'] = site_url('Register/ajaxDetailShift');
    	$data['ajaxRegister'] = site_url('Register/ajaxRegister');
    	$this->load->view("quanlytrungtam/layout",$data);
    }

    function ajaxDetailCourse()
    {
        $name = $_POST['course_name'];
        $this->load->model("quanlytrungtam_model");
        $data = $this->quanlytrungtam_model->getDBClassByCourseName($name);
        $ketquaAjax = array(
            'ketqua' => $data
        );
        echo json_encode($ketquaAjax);
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
        
        $ketquaAjax = array();
        $course_name = $_POST['course_name'];
        $course_id = $_POST['course_id'];
        $level_id = $_POST['level_id'];
        $student_id = (int)$_POST['student_id'];
    	$student_name = $_POST['student_name'];
    	//$class_name = $_POST['class_name'];
    	$teacher_name = $_POST['teacher_name'];
    	$shift_name = $_POST['shift_name'];
        $shift_id = $_POST['shift_id'];
    	$precent_debt = $_POST['precent_debt'];
    	$this->load->model("quanlytrungtam_model");
    	$DBStudent = $this->quanlytrungtam_model->getDB_Extend_Class_By_Student_Shift($student_id);
        $DBExtend_Check_Register = $this->quanlytrungtam_model->getDB_Extend_Check_Register($course_id,$level_id,$student_id);
        // Không trùng lớp đã đăng ký 
        if(empty($DBExtend_Check_Register))
        {
            //kiểm tra có trùng giờ học không
            $DB_Register_By_ID_Student_Shift = $this->quanlytrungtam_model->GetDB_Register_By_ID_Student_Shift($student_id,$shift_id);
            if(!empty($DB_Register_By_ID_Student_Shift))
            {
                echo 'Đã trùng lịch';
                die();
            }
            else
            {
                foreach ($DBStudent as $key => $value) {
                    $dataOpen = strtotime($value['class_open']);
                    $dataFinish = strtotime($value['class_finish']);
                }
                $idTeacher = $this->quanlytrungtam_model->getIDByTable('teacher_id','teacher_name',$teacher_name,'Teacher');
                $idShift = $this->quanlytrungtam_model->getIDByTable('shift_id','shift_name',$shift_name,'Shift');
                //$student_id = $idStudent[0]['student_id'];
                $teacher_id = $idTeacher[0]['teacher_id'];
                $shift_id = $idShift[0]['shift_id'];
                $dataInsert = array(
                    'precent_debt' => $precent_debt,
                    'teacher_id' => $teacher_id,
                    'student_id' => $student_id,
                    'shift_id' => $shift_id,
                    'course_id' => $course_id,
                    'level_id' => $level_id
                );
                $table = 'class_by_student';
                // ĐĂNG KÝ HỌC VIÊN
                $id_student_class=$this->quanlytrungtam_model->InsertDB($dataInsert,$table);
                $countRow = $this->quanlytrungtam_model->CountRow_Extend_Register($course_id,$level_id);
                foreach ($countRow as $key => $value) {
                    $count = (int)$value['count_row'];
                    // Trường hợp đủ 25 người thì tạo mới 1 lớp.
                    if($count == 2)
                    {
                        $dataClass = $this->quanlytrungtam_model->getDB_Class_By_Level_Course($course_id,$level_id);
                        // Trường hợp khóa chưa tạo lớp bao giờ 
                        if(empty($dataClass))
                        {
                            date_default_timezone_set("Asia/Ho_Chi_Minh");
                            $date = new \DateTime();
                            $date_format = date_format($date, 'Y-m-d H:i:s');
                            $dataInsertClass = array (
                                'class_name' => $course_name.'_'.$level_id.'_'.'1',
                                'class_description' => $course_name,
                                'level_id' => $level_id,
                                'course_id' => $course_id,
                                'date_update' => $date_format
                            );
                            $id_student_class=$this->quanlytrungtam_model->InsertDB($dataInsertClass,'class');
                        }
                        // else
                        // {
                        //     date_default_timezone_set("Asia/Ho_Chi_Minh");
                        //     $date = new \DateTime();
                        //     $date_format = date_format($date, 'Y-m-d H:i:s');
                        //     $number_auto = (int)$dataClass[0]['class_id'] + 1;
                        //     $dataInsertClass = array (
                        //         'class_name' => $course_name.'_'.$level_id.'_'.$number_auto,
                        //         'class_description' => $course_name,
                        //         'level_id' => $level_id,
                        //         'course_id' => $course_id,
                        //         'date_update' => $date_format
                        //     );
                        //     $id_student_class=$this->quanlytrungtam_model->InsertDB($dataInsertClass,'class');
                        // }
                    }
                    else
                    {   
                        // SỐ Lượng học sinh đăng ký > 25
                        // countClass = số lượng lớp tại khóa học - level đó 
                        // sumAmountStudent : tổng số lượng học sinh đăng ký các lớp 1 lớp * 25 học viên
                        // registerNew : số lượng đăng ký mới (điều kiện tạo lớp nếu hơn 25 học viên )
                        // Nếu registerNew = 25 chứng tỏ đủ điều kiện 
                        if($count > 2)
                        {   
                            $dataClass = $this->quanlytrungtam_model->getDB_Class_By_Level_Course($course_id,$level_id);
                            $countClass = $this->quanlytrungtam_model->CountRow_Extend_Class($course_id,$level_id);
                            foreach ($countClass as $key => $value) {
                                $count_class = (int)$value['count_class'];
                                $sumAmountStudent = $count_class * 2;
                                $registerNew =$count - $sumAmountStudent;
                                if($registerNew == 2)
                                {
                                    date_default_timezone_set("Asia/Ho_Chi_Minh");
                                    $date = new \DateTime();
                                    $date_format = date_format($date, 'Y-m-d H:i:s');
                                    $number_auto = (int)$dataClass[0]['class_id'] + 1;
                                    $dataInsertClass = array (
                                        'class_name' => $course_name.'_'.$level_id.'_'.$number_auto,
                                        'class_description' => $course_name,
                                        'level_id' => $level_id,
                                        'course_id' => $course_id,
                                        'date_update' => $date_format
                                    );
                                    //$id_student_class=$this->quanlytrungtam_model->InsertDB($dataInsertClass,'class');
                                }
                            }
                        }
                    }
                    $ketquaAjax = array(
                        'ketqua' => 1
                    );
                }
            }
        }
        // Trường hợp lớp đã đăng ký rồi
        else
        {   
            $ketquaAjax = array(
                'ketqua' => 0
            );
        }   
    }

    function CountAmountStudent()
    {
        $dem = 0;
    }
}