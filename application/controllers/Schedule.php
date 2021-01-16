<?php 
/**
 * 
 */
class Schedule extends Pageparent_Controller
{
	
	public function __construct() {
       parent::__construct();
    }

    function index()
   	{
   		// $table = 'class_by_student';
   		// $data['dbClassStudent'] = GetDBTable($table);
   		$data['pageName'] = 'schedule';
      $this->load->helper('url');
      $data['ajaxScheduleStudent'] =  site_url('Schedule/ajaxScheduleStudent');
      $data['ajaxScheduleClass'] =  site_url('Schedule/ajaxScheduleClass');
   		$this->load->view("quanlytrungtam/layout",$data);
   	}

    function ajaxScheduleStudent()
    {
      $student_identitycard = $_POST['schedule_student'];
      // Lấy Thông Tin Theo CMND
      $this->load->model("quanlytrungtam_model");
      $data = $this->quanlytrungtam_model->getItemScheduleByIndentify($student_identitycard);
      $mang = array();
      $extend = array();
      for ($i=0; $i < count($data); $i++)
      {
        $id_class_student = $data[$i]['class_student_id'];
        $arrayStudentName = $this->quanlytrungtam_model->getStudentNameByID($data[$i]['student_id']);
        $arrayClassName = $this->quanlytrungtam_model->getClassNameByID($data[$i]['class_id']);
        $arrayShift = $this->quanlytrungtam_model->getShiftTimeByID($data[$i]['shift_id']);
        $arrayTeacherName = $this->quanlytrungtam_model->getTeacherNameByID($data[$i]['teacher_id']);
        // $extend['arrayStudentName'] = $arrayStudentName;
        // $extend['arrayClassName'] = $arrayClassName;
        // $extend['arrayShift'] = $arrayShift;
        // $extend['arrayTeacherName'] = $arrayTeacherName;
        $extend['arrayStudentName'] = $arrayStudentName[0];
        $extend['arrayClassName'] = $arrayClassName[0];
        $extend['arrayShift'] = $arrayShift[0];
        $extend['arrayTeacherName'] = $arrayTeacherName[0];
        $mang[] = $extend;
      }
      $ketquaAjax = array();
      for ($i=0; $i < count($mang); $i++)
      {
        $student_name = $mang[$i]['arrayStudentName']['student_name'];
        $class_name = $mang[$i]['arrayClassName']['class_name'];
        $teacher_name = $mang[$i]['arrayTeacherName']['teacher_name'];
        $time_in = $mang[$i]['arrayShift']['time_in'];
        $time_out = $mang[$i]['arrayShift']['time_out'];
        $mangExtend = array(
          'student_name' => $student_name,
          'class_name' => $class_name,
          'teacher_name' => $teacher_name,
          'time_in' => $time_in,
          'time_out' => $time_out
        );
        $ketquaAjax[] = $mangExtend;
      }
      $ketqua = array(
        'ketqua' => $ketquaAjax
      );
      echo json_encode($ketqua);
    }

    function ajaxScheduleClass()
    {
      $class_name = $_POST['schedule_class'];
      $this->load->model("quanlytrungtam_model");
      $data = $this->quanlytrungtam_model->getItemScheduleByClass($class_name);
      $mang = array();
      $extend = array();
      for ($i=0; $i < count($data); $i++)
      {
        $id_class_student = $data[$i]['class_student_id'];
        $arrayStudentName = $this->quanlytrungtam_model->getStudentNameByID($data[$i]['student_id']);
        $arrayClassName = $this->quanlytrungtam_model->getClassNameByID($data[$i]['class_id']);
        $arrayShift = $this->quanlytrungtam_model->getShiftTimeByID($data[$i]['shift_id']);
        $arrayTeacherName = $this->quanlytrungtam_model->getTeacherNameByID($data[$i]['teacher_id']);
        // $extend['arrayStudentName'] = $arrayStudentName;
        // $extend['arrayClassName'] = $arrayClassName;
        // $extend['arrayShift'] = $arrayShift;
        // $extend['arrayTeacherName'] = $arrayTeacherName;
        $extend['arrayStudentName'] = $arrayStudentName[0];
        $extend['arrayClassName'] = $arrayClassName[0];
        $extend['arrayShift'] = $arrayShift[0];
        $extend['arrayTeacherName'] = $arrayTeacherName[0];
        $mang[] = $extend;
      }
      $ketquaAjax = array();
      for ($i=0; $i < count($mang); $i++)
      {
        $student_name = $mang[$i]['arrayStudentName']['student_name'];
        $class_name = $mang[$i]['arrayClassName']['class_name'];
        $teacher_name = $mang[$i]['arrayTeacherName']['teacher_name'];
        $time_in = $mang[$i]['arrayShift']['time_in'];
        $time_out = $mang[$i]['arrayShift']['time_out'];
        $mangExtend = array(
          'student_name' => $student_name,
          'class_name' => $class_name,
          'teacher_name' => $teacher_name,
          'time_in' => $time_in,
          'time_out' => $time_out
        );
        $ketquaAjax[] = $mangExtend;
      }
      $ketqua = array(
        'ketqua' => $ketquaAjax
      );
      echo json_encode($ketqua);
    }
}
