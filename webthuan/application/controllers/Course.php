<?php 
class Course extends Pageparent_Controller
{
	public function __construct() {
       parent::__construct();
    }
	/*--- PAGE QUẢN LÝ KHÓA HỌC---*/
	function index()
	{
		$this->load->helper('url');
		$this->load->model("quanlytrungtam_model");
		$data['pageName'] = 'course';
		// $data['pageCreateCourse'] = site_url().'/course/add';
		// $data['pageUpdateCourse'] = site_url().'/course/update';
		// $data['pageDeleteCourse'] = site_url().'/course/delete';
		$data['pageCreateCourse'] = site_url('Course/add');
		$data['pageUpdateCourse'] = site_url('Course/update');
		$data['pageDeleteCourse'] = site_url('Course/delete');
		$data['DBCourse']=$this->quanlytrungtam_model->GetDBTable('course');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function add()
	{
		$this->load->helper('url');
		$data['pageName'] = 'course-add';
		$data['ajaxCreateCourse']= site_url('Course/ajaxCreateCourse');
		$data['pageCourse'] = site_url('Course/index');
		//$data['pageCourse'] = site_url().'/course/index';
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function update()
	{
		$this->load->helper('url');
		$data['pageName'] ='course-update';
		$data['ajaxLoadItemCourse'] = site_url('Course/ajaxLoadItemCourse');
		$data['ajaxUpdateCourseItem'] = site_url('Course/ajaxUpdateCourseItem');
		$data['pageCourse'] = site_url('Course/index');
		//$data['pageCourse'] = site_url().'/course';
		$this->load->model("quanlytrungtam_model");
		$data['DBCourse']=$this->quanlytrungtam_model->GetDBTable('course');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function delete()
	{
		$this->load->helper('url');
		$data['pageName'] ='course-delete';
		$data['ajaxDeleteCourseItem'] = site_url('Course/ajaxDeleteCourseItem');
		//$data['pageCourse'] = site_url().'/course';
		$data['pageCourse'] = site_url('Course/index');
		$this->load->model("quanlytrungtam_model");
		$data['DBCourse'] = $this->quanlytrungtam_model->GetDBTable('course');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function ajaxCreateCourse()
	{
		$ketqua = array(
			'ketqua' => 0
		);
		$dataInsert = array(
			'course_name' => $_POST['course_name'],
			'course_price' => $_POST['course_price']
		);
		$table = 'course';
		$this->load->model("quanlytrungtam_model");
		$course_id=$this->quanlytrungtam_model->InsertDB($dataInsert,$table);
		if($course_id > 0)
		{
			$ketqua['ketqua'] = 1;
		}
		echo json_encode($ketqua);
	}

	function ajaxLoadItemCourse()
	{
		$this->load->model("quanlytrungtam_model");
		$id = $_POST['course_id'];
		$table = 'course';
		$idTable = 'course_id';
		$dataDB = $this->quanlytrungtam_model->GetDBByID($id,$table,$idTable);
		$ketquaAjax = array(
			'ketqua' => $dataDB
		);
		echo json_encode($ketquaAjax);
	}

	function ajaxUpdateCourseItem()
	{
		$dataUpdate = array(
			'course_name' => $_POST['course_name'],
			'course_price'=> $_POST['course_price']
		);
		$id = $_POST['course_id'];
		$table = 'course';
		$idTable = 'course_id';
		$this->load->model("quanlytrungtam_model");
		$rowUpdate=$this->quanlytrungtam_model->updateDB($dataUpdate,$id,$table,$idTable);
		$ketqua = array(
			'kq'=> $rowUpdate
		);
		echo json_encode($ketqua);
	}

	function ajaxDeleteCourseItem()
	{
		$course_id = $_POST['course_id'];
		$table = 'course';
		$idTable ='course_id';
		$this->load->model("quanlytrungtam_model");
		$checkrow=$this->quanlytrungtam_model->deleteDB($course_id,$table,$idTable);
		$ketquaAjax = array(
			'ketqua' => $checkrow
		);
		echo json_encode($ketquaAjax);
	}
}