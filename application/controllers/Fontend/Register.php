<?php
/**
 * 
 */
class Register extends Fontend_Controller
{
	
	public function __construct() {
       parent::__construct();
    }

    function index()
    {
        if(!is_null($_SESSION['user']['user_id']))
        {
            foreach ($_SESSION as $key => $value) 
            {
               $user_name = $value['user_name'];
               $array = explode('_', $user_name); 
            }
            $student_indentity = $array[1];
        }
        
        $this->load->model("quanlytrungtam_model");
    	$data['dataStudent'] = $this->quanlytrungtam_model->GetDBTable('student');
    	$data['dataClass'] = $this->quanlytrungtam_model->GetDBTable('class');
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
    	$this->load->view("quanlytrungtam/fontend/layout",$data);
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

    // function ajaxDetailTeacher()
    // {
    // 	$name = $_POST['teacher_name'];
    // 	$this->load->model("quanlytrungtam_model");
    // 	$data = $this->quanlytrungtam_model->getDBTeacherByTeacherName($name);
    // 	$ketquaAjax = array(
    // 		'ketqua' => $data
    // 	);
    // 	echo json_encode($ketquaAjax);
    // }

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
        $this->load->model("quanlytrungtam_model");
        // Nhận dữ liệu từ Ajax
        $ketquaAjax = array();
        $student_id = $_POST['student_id'];    
        $student_name= $_POST['student_name'];   
        $class_id = $_POST['class_id'];   
        $class_name = $_POST['class_name']; 
        $shift_id =  $_POST['shift_id'];
        $precent_debt = $_POST['precent_debt'];
        //Kiem tra đã đăng ký lớp đó chưa
        $check_class_student = $this->quanlytrungtam_model->Check_Class_Student_By_ID($student_id,$class_id);
        if(empty($check_class_student))
        {
            // Mặc định sẽ tạo lớp A
            // Kiêm tra lớp A đã tồn tại chưa
            $array_code = array('A','B','C','D','E','F','G','H','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
            $data_extend_by_id = $this->quanlytrungtam_model->Data_Class_Student_By_ID($class_id,'A');
            if(empty($data_extend_by_id))
            {
                $dataInsertDB_Extend = array(
                    'class_id' => $class_id,
                    'student_id' => $student_id,
                    'class_code' => 'A',
                    'shift_id' => $shift_id,
                    'precent_debt' => $precent_debt
                );
                $id_extend=$this->quanlytrungtam_model->InsertDB($dataInsertDB_Extend,'extend_class_student');

            }
            // Trường hợp đã tạo lớp A rồi 
            else
            {
                $class_code_latest = $this->quanlytrungtam_model->Point_Latest_Class_Student($class_id);
                $class_code = $class_code_latest[0]['class_code'];
                $amount_count = $this->quanlytrungtam_model->Count_Class_Student($class_id,$class_code);

                foreach ($amount_count as $key => $value) {
                    $amount = $value['Count'];
                }
                if($amount <= 25 )
                {
                    $dataInsertDB_Extend = array(
                        'class_id' => $class_id,
                        'student_id' => $student_id,
                        'class_code' => $class_code,
                        'shift_id' => $shift_id,
                        'precent_debt' => $precent_debt
                    );
                    $id_extend=$this->quanlytrungtam_model->InsertDB($dataInsertDB_Extend,'extend_class_student');
                }
                else
                {
                    for($i=0; $i < count($array_code); $i++)
                    {
                        if($class_code == $array_code[$i])
                        {
                            $i = $i + 1;
                            $class_code_new = $array_code[$i];
                        }
                    }
                    $class_code = $class_code_new;
                    $dataInsertDB_Extend = array(
                        'class_id' => $class_id,
                        'student_id' => $student_id,
                        'class_code' => $class_code,
                        'shift_id' => $shift_id,
                        'precent_debt' => $precent_debt
                    );
                    $id_extend=$this->quanlytrungtam_model->InsertDB($dataInsertDB_Extend,'extend_class_student');
                }
            }
            $ketquaAjax = array(
                'ketqua' => 1
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
}