<?php 
/**
 * 
 */
class Schedule extends Fontend_Controller
{
	
	public function __construct() {
       parent::__construct();
    }

    function index()
   	{
      $this->load->model("quanlytrungtam_model");
   		$data['dbClass'] = $this->quanlytrungtam_model->GetDBTable('class');
   		$data['pageName'] = 'schedule';
      $this->load->helper('url');
      $data['ajaxScheduleStudent'] =  site_url('fontend/Schedule/ajaxScheduleStudent');
      $data['ajaxScheduleClass'] =  site_url('fontend/Schedule/ajaxScheduleClass');

   		$this->load->view("quanlytrungtam/fontend/layout",$data);
   	}

    function ajaxScheduleStudent()
    {
      $student_identitycard = $_POST['schedule_student'];
      // Lấy Thông Tin Theo CMND
      $this->load->model("quanlytrungtam_model");
      $data = $this->quanlytrungtam_model->getItemScheduleByIndentify($student_identitycard);
      $mang = array();
      foreach ($data as $key => $value) {
        $arrayDB = $value;
        $arrayShift = $this->quanlytrungtam_model->getShiftTimeByID($arrayDB['shift_id']);
        foreach ($arrayShift as $key => $value) {
          $time_in = $value['time_in'];
          $time_out = $value['time_out'];
        }
        $mang[] = array(
          'student_id' => $arrayDB['student_id'],
          'student_name' => $arrayDB['student_name'],
          'class_name' => $arrayDB['class_name'].$arrayDB['level_id'].$arrayDB['class_code'],
          'shift_id' => $arrayDB['shift_id'],
          'class_open' => $arrayDB['class_open'],
          'class_finish' => $arrayDB['class_finish'],
          'time_in' => $time_in,
          'time_out' =>$time_out
        );
      }
      
      $mangExtend = $mang;
      $ketqua = array(
        'ketqua' => $mangExtend
      );
      echo json_encode($ketqua);
    }

    function ajaxScheduleClass()
    {
      $class_id = $_POST['schedule_class'];
      $level_id = $_POST['level_id'];
      $this->load->model("quanlytrungtam_model");
      $data = $this->quanlytrungtam_model->getItemScheduleByClass($class_id);
      foreach ($data as $key => $value) {
        $arrayDB = $value;
        $arrayShift = $this->quanlytrungtam_model->getShiftTimeByID($arrayDB['shift_id']);
        foreach ($arrayShift as $key => $value) {
          $time_in = $value['time_in'];
          $time_out = $value['time_out'];
        }
        $mang[] = array(
          'student_id' => $arrayDB['student_id'],
          'student_name' => $arrayDB['student_name'],
          'class_name' => $arrayDB['class_name'].$arrayDB['level_id'].$arrayDB['class_code'],
          'shift_id' => $arrayDB['shift_id'],
          'class_open' => $arrayDB['class_open'],
          'class_finish' => $arrayDB['class_finish'],
          'time_in' => $time_in,
          'time_out' =>$time_out
        );
      }
      $mangExtend = $mang;
      $ketqua = array(
        'ketqua' => $mangExtend
      );
      echo json_encode($ketqua);
    }
}
