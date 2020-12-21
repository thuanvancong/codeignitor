<?php
class quanlytrungtam extends CI_Controller {
	function index()
	{
		$this->load->helper('url');
		$data['pageName'] = 'pagequanly';
		$data['pageConfiguration'] = site_url('quanlytrungtam/pageconfiguration');
		$data['pageMenu'] = site_url('quanlytrungtam/pageMenu');
		$data['pageCourse'] = site_url('quanlytrungtam/pageCourse');
		$data['pageClass'] = site_url('quanlytrungtam/pageClass');
		$data['pageStudent'] = site_url('quanlytrungtam/pageStudent');
		$data['pageTeacher'] = site_url('quanlytrungtam/pageTeacher');
		$data['pageUser'] = site_url('quanlytrungtam/pageUser');
		$data['pageRole'] = site_url('quanlytrungtam/pageRole');
		$data['pageRoleByUser'] = site_url('quanlytrungtam/pageRoleByUser');
		$this->load->view("quanlytrungtam/layout", $data);
	}
	/* PAGE CẤU HÌNH HỆ THỐNG */
	function pageconfiguration()
	{
		$this->load->helper('url');
		$data['pageName'] = 'configuration';
		$data['configAdd'] = site_url('quanlytrungtam/pageConfigAdd');
		$data['configUpdate'] = site_url('quanlytrungtam/pageConfigUpdate');
		$data['configDelete'] = site_url('quanlytrungtam/pageConfigDelete');
		$this->load->model("quanlytrungtam_model");
		$data['DBConfig']=$this->quanlytrungtam_model->GetDBConfiguration();
		$this->load->view("quanlytrungtam/layout", $data);
	}
	/* PAGE THÊM CẤU HÌNH */
	function pageConfigAdd ()
	{
		$this->load->helper('url');
		$data['pageName'] = 'config-add';
		$data['ajaxSaveFormConfig'] = site_url('quanlytrungtam/config_Save_Data');
		$this->load->view("quanlytrungtam/layout", $data);
	}
	/* PAGE SỬA CẤU HÌNH */
	function pageConfigUpdate ()
	{
		$this->load->helper('url');
		$data['pageName'] = 'config-update';
		$data['ajaxSelectItemConfigByID'] = site_url('quanlytrungtam/config_Update_data');
		$data['ajaxUpateConfig'] = site_url('quanlytrungtam/config_Update_data_after');
		$data['pageConfiguration'] = site_url('quanlytrungtam/pageconfiguration');
		$this->load->model("quanlytrungtam_model");
		$data['DBConfig']=$this->quanlytrungtam_model->GetDBConfiguration();
		$this->load->view("quanlytrungtam/layout", $data);
	}
	/* PAGE XÓA CẤU HÌNH */
	function pageConfigDelete ()
	{
		$this->load->helper('url');
		$data['pageName'] = 'config-delete';
		$data['ajaxSelectItemConfigByID'] = site_url('quanlytrungtam/config_Update_data');
		$data['ajaxDeleteConfig'] = site_url('quanlytrungtam/config_Delete_data_after');
		$this->load->model("quanlytrungtam_model");
		$data['DBConfig']=$this->quanlytrungtam_model->GetDBConfiguration();
		$this->load->view("quanlytrungtam/layout",$data);
	}
	// FUNTION AJAX
	/* Function xử lý ajax PageConFig : Thêm Config */
	function config_Save_Data()
	{
		$this->load->helper('url');
		$data['configField'] = $_POST['configField'];
		$data['configValue'] = $_POST['configValue'];
		$data['configIsactive'] = $_POST['configIsactive'];
		$dataInsert = array (
			'config_name' => $data['configField'],
			'config_value' => $data['configValue'],
			'config_isactive' => $data['configIsactive']
		);
		$this->load->model("quanlytrungtam_model");
		$idConfig=$this->quanlytrungtam_model->InsertDBConfiguration($dataInsert);
		$ketquaAjax = array(
			'idConfig' => $idConfig,
			'ketqua' => 1
		);
		echo json_encode($ketquaAjax);
	}
	/* Function xử lý ajax PageConFig : Lấy Config  */
	function config_Update_data()
	{
		$idConfig=$_POST['idConfig'];
		$this->load->model("quanlytrungtam_model");
		$dataConfig =$this->quanlytrungtam_model->GetDBByID($idConfig,'configuration','config_id');
		$ketqua = array(
			'kq' => $dataConfig
		);
		echo json_encode($ketqua);
	}
	/* Function xử lý ajax PageConFig : Update Config  */
	function config_Update_data_after()
	{
		$updated_data = array(
			'config_name' => $_POST['configField'],
			'config_value' => $_POST['configValue']
		);
		$idConfig = $_POST['configID'];
		$this->load->model("quanlytrungtam_model");
		$rowUpdate=$this->quanlytrungtam_model->updateDB($updated_data,$idConfig,'configuration','config_id');
		$ketqua = array(
			'kq'=> $rowUpdate
		);
		echo json_encode($ketqua);
	}
	/* Function xử lý ajax PageConFig : Delete Config  */
	function config_Delete_data_after()
	{
		$idConfig = $_POST['configID'];
		$this->load->model("quanlytrungtam_model");
		$rowDelete=$this->quanlytrungtam_model->deleteDB($idConfig,'configuration','config_id');
		$ketqua = array(
			'kq'=> $rowDelete
		);
		echo json_encode($ketqua);
	}

	// PAGE MENU
	/*---Load page menu ---*/
	function pageMenu()
	{
		$this->load->helper('url');
		$data['pageName'] = 'menu';
		$data['pageMenuCreate'] = site_url('quanlytrungtam/pageMenuCreate');
		$data['pageMenuUpdate'] = site_url('quanlytrungtam/pageMenuUpdate');
		$data['pageMenuDelete'] = site_url('quanlytrungtam/pageMenuDelete');
		$this->load->model("quanlytrungtam_model");
		$data['DBMenu'] = $this->quanlytrungtam_model->GetDBTable('menu');
		$this->load->view("quanlytrungtam/layout",$data);
	}
	/*---Load page creat menu ---*/	
	function pageMenuCreate()
	{
		$this->load->helper('url');
		$data['pageName'] = 'menu-add';
		$this->load->model('quanlytrungtam_model');
		$data['DsDbMenuName'] =$this->quanlytrungtam_model->GetDSMenuName();
		$data['ajaxCreatMenu'] =site_url('quanlytrungtam/ajaxCreateItemMenu');
		$data['pageMenu'] =site_url('quanlytrungtam/pageMenu');
		$this->load->view("quanlytrungtam/layout",$data);
	}
	/*---Load page update menu ---*/
	function pageMenuUpdate()
	{
		$this->load->helper('url');
		$data['pageName']='menu-update';
		$data['pageMenu'] =site_url('quanlytrungtam/pageMenu');
		$data['ajaxLoadItemMenu'] =site_url('quanlytrungtam/ajaxLoadItemMenu');
		$data['ajaxUpdateItemMenu'] =site_url('quanlytrungtam/ajaxUpdateItemMenu');
		$this->load->model("quanlytrungtam_model");
		$data['DsDbMenuName'] =$this->quanlytrungtam_model->GetDSMenuName();
		$data['DBMenu'] = $this->quanlytrungtam_model->GetDBTable('menu');
		$this->load->view("quanlytrungtam/layout",$data);
	}
	function pageMenuDelete()
	{
		$this->load->helper('url');
		$data['pageName'] = 'menu-delete';
		$data['ajaxLoadItemMenu'] =site_url('quanlytrungtam/ajaxLoadItemMenu');
		$data['ajaxDeleteItemMenu'] =site_url('quanlytrungtam/ajaxDeleteItemMenu');
		$data['pageMenu'] =site_url('quanlytrungtam/pageMenu');
		$this->load->model("quanlytrungtam_model");
		$data['DBMenu'] = $this->quanlytrungtam_model->GetDBTable('menu');
		$this->load->view("quanlytrungtam/layout",$data);
	}
	/*---Ajax tạo item menu ---*/
	function ajaxCreateItemMenu()
	{
		$this->load->model("quanlytrungtam_model");
		$menu_name = $_POST['menu_name'];
		$menu_id = $this->quanlytrungtam_model->GetMenuIDByName($menu_name);
		/*-- Trường hợp không có menu_name --*/
		if(empty($menu_id))
		{
			/*--  menu_order 0:khong co submenu 1:co submenu --*/
			if($_POST['menu_order'] == 0)
			{
				$dataInsert = array(
					'menu_name' => $_POST['menu_name'],
					'menu_content' => $_POST['menu_content'],
					'menu_isactive' => $_POST['menu_isactive'],
					'menu_order' => $_POST['menu_order'],
					'parent_id' => 0,
				);
				$menu_id=$this->quanlytrungtam_model->InsertDB($dataInsert,'menu');
			}
			else
			{
				$parent_id = $_POST['parent_id'];
				$array_menu_parent_id = $this->quanlytrungtam_model->GetMenuIDByName($parent_id);
				foreach ($array_menu_parent_id as $key => $value) {
					$menu_parent_id=$value['menu_id'];
				}
				$dataInsert = array(
					'menu_name' => $_POST['menu_name'],
					'menu_content' => $_POST['menu_content'],
					'menu_isactive' => $_POST['menu_isactive'],
					'menu_order' => $_POST['menu_order'],
					'parent_id' => $menu_parent_id,
				);
				$menu_id=$this->quanlytrungtam_model->InsertDB($dataInsert,'menu');
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

	function ajaxLoadItemMenu()
	{
		$this->load->model("quanlytrungtam_model");
		$menu_id = $_POST['menu_id'];
		$table = 'menu';
		$idTable ='menu_id';
		$dataDBmenu=$this->quanlytrungtam_model->GetDBByID($menu_id,$table,$idTable);
		$ketquaAjax = array(
			'ketqua' => $dataDBmenu
		);
		echo json_encode($ketquaAjax);
	}

	function ajaxUpdateItemMenu()
	{
		$menu_order = $_POST['menu_order'];
		$menu_id = $_POST['menu_id'];
		$table = 'menu';
		$idTable = 'menu_id';
		$idTableByParentID = 'parent_id';
		$this->load->model("quanlytrungtam_model");
		$dataDBByParentID = $this->quanlytrungtam_model->GetDBByID($menu_id,$table,$idTableByParentID);
		
		/*---- 0: không co submenu ---*/
		if($menu_order == 0)
		{
			$dataUpdate = array(
				'menu_name' => $_POST['menu_name'],
				'menu_content' => $_POST['menu_content'],
				'menu_isactive' => $_POST['menu_isactive'],
				'menu_order' => $_POST['menu_order'],
				'parent_id' => 0
			);
			$ketquaAjax =array(
				'ketqua' => 1
			);
			$this->quanlytrungtam_model->updateDB($dataUpdate,$menu_id,$table,$idTable);
		}
		else
		{
			$array_menu_id = $this->quanlytrungtam_model->GetMenuIDByName($_POST['parent_id']);
			/* Kiểm tra xem có rằng buộc với page con hay không */
			if(!empty($dataDBByParentID))
			{
				$ketquaAjax =array(
					'ketqua' => 0
				);
			}
			else
			{
				foreach ($array_menu_id as $key => $value) {
					$dataUpdate = array(
						'menu_name' => $_POST['menu_name'],
						'menu_content' => $_POST['menu_content'],
						'menu_isactive' => $_POST['menu_isactive'],
						'menu_order' => $_POST['menu_order'],
						'parent_id' => $value['menu_id']
					);
				}
				$ketquaAjax =array(
					'ketqua' => 1
				);
				$this->quanlytrungtam_model->updateDB($dataUpdate,$menu_id,$table,$idTable);
			}

		}
		echo json_encode($ketquaAjax);
	}
	function ajaxDeleteItemMenu()
	{
		$menu_id =$_POST['menu_id'];
		$table = 'menu';
		$idTable = 'menu_id';
		$idTableByParentID = 'parent_id';
		$this->load->model("quanlytrungtam_model");
		/* kiểm tra xem có page con hay không */
		$dataDB = $this->quanlytrungtam_model->GetDBByID($menu_id,$table,$idTable);
		$dataDBByParentID = $this->quanlytrungtam_model->GetDBByID($menu_id,$table,$idTableByParentID);
		if(!empty($dataDBByParentID))
		{
			$ketquaAjax = array(
				'ketqua' => 0
			);
		}
		else
		{
			$this->quanlytrungtam_model->deleteDB($menu_id,$table,$idTable);
			$ketquaAjax = array(
				'ketqua' => 1
			);
		}
		echo json_encode($ketquaAjax);
	}
	/*--- PAGE QUẢN LÝ KHÓA HỌC---*/
	function pageCourse()
	{
		$this->load->helper('url');
		$this->load->model("quanlytrungtam_model");
		$data['pageName'] = 'course';
		$data['pageCreateCourse'] = site_url('quanlytrungtam/pageCreateCourse');
		$data['pageUpdateCourse'] = site_url('quanlytrungtam/pageUpdateCourse');
		$data['pageDeleteCourse'] = site_url('quanlytrungtam/pageDeleteCourse');
		$data['DBCourse']=$this->quanlytrungtam_model->GetDBTable('course');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function pageCreateCourse()
	{
		$this->load->helper('url');
		$data['pageName'] = 'course-add';
		$data['ajaxCreateCourse']= site_url('quanlytrungtam/ajaxCreateCourse');
		$data['pageCourse'] = site_url('quanlytrungtam/pageCourse');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function pageUpdateCourse()
	{
		$this->load->helper('url');
		$data['pageName'] ='course-update';
		$data['ajaxLoadItemCourse'] = site_url('quanlytrungtam/ajaxLoadItemCourse');
		$data['ajaxUpdateCourseItem'] = site_url('quanlytrungtam/ajaxUpdateCourseItem');
		$data['pageCourse'] = site_url('quanlytrungtam/pageCourse');
		$this->load->model("quanlytrungtam_model");
		$data['DBCourse']=$this->quanlytrungtam_model->GetDBTable('course');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function pageDeleteCourse()
	{
		$this->load->helper('url');
		$data['pageName'] ='course-delete';
		$data['ajaxDeleteCourseItem'] = site_url('quanlytrungtam/ajaxDeleteCourseItem');
		$data['pageCourse'] = site_url('quanlytrungtam/pageCourse');
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
	/*--- PAGE QUẢN LÝ LỚP HỌC---*/
	function pageClass()
	{
		$this->load->helper('url');
		$this->load->model("quanlytrungtam_model");
		$data['pageName'] = 'class';
		$data['pageCreateClass'] = site_url('quanlytrungtam/pageCreateClass');
		$data['pageUpdateClass'] = site_url('quanlytrungtam/pageUpdateClass');
		$data['pageDeleteClass'] = site_url('quanlytrungtam/pageDeleteClass');
		$data['DBClass']=$this->quanlytrungtam_model->GetDBTable('class');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function pageCreateClass()
	{
		$this->load->helper('url');
		$data['pageName'] = 'class-add';
		$data['ajaxCreateclass']=site_url("quanlytrungtam/ajaxCreateclass");
		$data['pageClass']=site_url("quanlytrungtam/pageClass");
		$this->load->model("quanlytrungtam_model");
		$data['DBCourse'] = $this->quanlytrungtam_model->GetDBTable('course');
		$data['DBLevel'] = $this->quanlytrungtam_model->GetDBTable('tb_level');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function pageUpdateClass()
	{
		$this->load->helper('url');
		$data['pageName'] = 'class-update';
		$data['ajaxLoadItemClass']=site_url("quanlytrungtam/ajaxLoadItemClass");
		$data['ajaxUpdateClassItem']=site_url("quanlytrungtam/ajaxUpdateClassItem");
		$data['pageClass']=site_url("quanlytrungtam/pageClass");
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

	function pageDeleteClass()
	{
		$this->load->helper('url');
		$data['pageName'] ='class-delete';
		$data['ajaxDeleteClassItem'] = site_url('quanlytrungtam/ajaxDeleteClassItem');
		$data['pageClass'] = site_url('quanlytrungtam/pageClass');
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

	/* ---- QUẢN LÝ HỌC VIÊN ----*/
	function pageStudent()
	{
		$this->load->helper('url');
		$this->load->model("quanlytrungtam_model");
		$data['pageName'] = 'student';
		$data['pageCreateStudent'] = site_url('quanlytrungtam/pageCreateStudent');
		$data['pageUpdateStudent'] = site_url('quanlytrungtam/pageUpdateStudent');
		$data['pageDeleteStudent'] = site_url('quanlytrungtam/pageDeleteStudent');
		$data['pageUpdateLevelStudent'] = site_url('quanlytrungtam/pageUpdateLevelStudent');
		$data['DBStudent']=$this->quanlytrungtam_model->GetDBTable('student');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function pageCreateStudent()
	{
		$this->load->helper('url');
		$data['pageName'] = 'student-add';
		$data['ajaxCreateStudent']=site_url("quanlytrungtam/ajaxCreateStudent");
		$data['pageStudent']=site_url("quanlytrungtam/pageStudent");
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
			'student_sex' => $_POST['student_sex'],
			'student_address' => $_POST['student_address'],
			'student_email' => $_POST['student_email'],
			'student_phone' => $_POST['student_phone'],
			'student_level' => $_POST['student_level']
		);
		$table='student';
		$this->load->model('quanlytrungtam_model');
		$student_id=$this->quanlytrungtam_model->InsertDB($dataInsert,$table);
		$ketquaAjax = array(
			'ketqua' => $student_id
		);
		echo json_encode($ketquaAjax);
	}

	function pageUpdateStudent()
	{
		$this->load->helper('url');
		$data['pageName'] = 'student-update';
		$data['ajaxLoadItemStudent']=site_url("quanlytrungtam/ajaxLoadItemStudent");
		$data['ajaxUpdateStudentItem']=site_url("quanlytrungtam/ajaxUpdateStudentItem");
		$data['pageStudent']=site_url("quanlytrungtam/pageStudent");
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

	function pageDeleteStudent()
	{
		$this->load->helper('url');
		$data['pageName'] ='student-delete';
		$data['ajaxDeleteStudentItem'] = site_url('quanlytrungtam/ajaxDeleteStudentItem');
		$data['pageStudent'] = site_url('quanlytrungtam/pageStudent');
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

	function pageUpdateLevelStudent()
	{
		$this->load->helper('url');
		$data['pageName'] = 'student-update-level';
		$data['ajaxLoadItemStudent']=site_url("quanlytrungtam/ajaxLoadItemStudent");
		$data['ajaxUpdateLevelStudent']=site_url("quanlytrungtam/ajaxUpdateLevelStudent");
		$data['pageStudent']=site_url("quanlytrungtam/pageStudent");
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
	
	/*--- PAGE QUẢN LÝ GIÁO VIÊN---*/
	function pageTeacher()
	{
		$this->load->helper('url');
		$this->load->model("quanlytrungtam_model");
		$data['pageName'] = 'teacher';
		$data['pageCreateTeacher'] = site_url('quanlytrungtam/pageCreateTeacher');
		$data['pageUpdateTeacher'] = site_url('quanlytrungtam/pageUpdateTeacher');
		$data['pageDeleteTeacher'] = site_url('quanlytrungtam/pageDeleteTeacher');
		$data['DBTeacher']=$this->quanlytrungtam_model->GetDBTable('teacher');
		$this->load->view("quanlytrungtam/layout",$data);
	}
	function pageCreateTeacher()
	{
		$this->load->helper('url');
		$data['pageName'] = 'teacher-add';
		$data['ajaxCreateTeacher']=site_url("quanlytrungtam/ajaxCreateTeacher");
		$data['pageTeacher']=site_url("quanlytrungtam/pageTeacher");
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

	function pageUpdateTeacher()
	{
		$this->load->helper('url');
		$data['pageName'] = 'teacher-update';
		$data['ajaxLoadItemTeacher']=site_url("quanlytrungtam/ajaxLoadItemTeacher");
		$data['ajaxUpdateTeacherItem']=site_url("quanlytrungtam/ajaxUpdateTeacherItem");
		$data['pageTeacher']=site_url("quanlytrungtam/pageTeacher");
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
	function pageDeleteTeacher()
	{
		$this->load->helper('url');
		$data['pageName'] ='teacher-delete';
		$data['ajaxDeleteTeacherItem'] = site_url('quanlytrungtam/ajaxDeleteTeacherItem');
		$data['pageTeacher'] = site_url('quanlytrungtam/pageTeacher');
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

	/*--- QUẢN LÝ USER ---*/
	function pageUser()
	{
		$this->load->helper('url');
		$this->load->model("quanlytrungtam_model");
		$data['pageName'] = 'user';
		$data['pageCreateUser'] = site_url('quanlytrungtam/pageCreateUser');
		$data['pageUpdateUser'] = site_url('quanlytrungtam/pageUpdateUser');
		$data['pageDeleteUser'] = site_url('quanlytrungtam/pageDeleteUser');
		$data['pageUpdatePassUser'] = site_url('quanlytrungtam/pageUpdatePassUser');
		$data['pageRoleByUser'] = site_url('quanlytrungtam/pageRoleByUser');
		$data['DBUser']=$this->quanlytrungtam_model->GetDBTable('users');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function pageCreateUser()
	{
		$this->load->helper('url');
		$data['pageName'] = 'user-add';
		$data['ajaxCreateUser']=site_url("quanlytrungtam/ajaxCreateUser");
		$data['pageUser']=site_url("quanlytrungtam/pageUser");
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

	function pageUpdateUser()
	{
		$this->load->helper('url');
		$data['pageName'] = 'user-update';
		$data['ajaxLoadItemUser']=site_url("quanlytrungtam/ajaxLoadItemUser");
		$data['ajaxUpdateUserItem']=site_url("quanlytrungtam/ajaxUpdateUserItem");
		$data['pageUser']=site_url("quanlytrungtam/pageUser");
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

	function pageUpdatePassUser()
	{
		$data['pageName'] = 'user-update-pass';
		$data['ajaxLoadItemUser']=site_url("quanlytrungtam/ajaxLoadItemUser");
		$data['ajaxUpdatePassUserItem']=site_url("quanlytrungtam/ajaxUpdatePassUserItem");
		$data['pageUser']=site_url("quanlytrungtam/pageUser");
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

	function pageDeleteUser()
	{
		$this->load->helper('url');
		$data['pageName'] ='user-delete';
		$data['ajaxDeleteUserItem'] = site_url('quanlytrungtam/ajaxDeleteUserItem');
		$data['pageUser'] = site_url('quanlytrungtam/pageUser');
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

	/*--- QUẢN LÝ ROLE ---*/
	function pageRole()
	{
		$this->load->helper('url');
		$this->load->model("quanlytrungtam_model");
		$data['pageName'] = 'role';
		$data['pageCreateRole'] = site_url('quanlytrungtam/pageCreateRole');
		$data['pageUpdateRole'] = site_url('quanlytrungtam/pageUpdateRole');
		$data['pageDeleteRole'] = site_url('quanlytrungtam/pageDeleteRole');
		$data['DBRole']=$this->quanlytrungtam_model->GetDBTable('roles');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function pageCreateRole()
	{
		$this->load->helper('url');
		$data['pageName'] = 'role-add';
		$data['ajaxCreateRole']=site_url("quanlytrungtam/ajaxCreateRole");
		$data['pageRole']=site_url("quanlytrungtam/pageRole");
		$this->load->model("quanlytrungtam_model");
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function ajaxCreateRole()
	{
		$dataInsert = array(
			'role_name' => $_POST['role_name'],
			'role_isactive' => $_POST['role_isactive'],
			'router' => $_POST['router'],
		);
		$table='roles';
		$this->load->model('quanlytrungtam_model');
		$user_id=$this->quanlytrungtam_model->InsertDB($dataInsert,$table);
		$ketquaAjax = array(
			'ketqua' => $user_id
		);
		echo json_encode($ketquaAjax);
	}

	function pageUpdateRole()
	{
		$this->load->helper('url');
		$data['pageName'] = 'role-update';
		$data['ajaxLoadItemRole']=site_url("quanlytrungtam/ajaxLoadItemRole");
		$data['ajaxUpdateRoleItem']=site_url("quanlytrungtam/ajaxUpdateRoleItem");
		$data['pageRole']=site_url("quanlytrungtam/pageRole");
		$this->load->model("quanlytrungtam_model");
		$data['DBRole'] = $this->quanlytrungtam_model->GetDBTable('roles');
		$this->load->view("quanlytrungtam/layout",$data);
	}
	function ajaxLoadItemRole()
	{
		$this->load->model("quanlytrungtam_model"); 	
		$id = $_POST['role_id'];
		$table = 'roles';
		$idTable = 'role_id';
		$dataDB = $this->quanlytrungtam_model->GetDBByID($id,$table,$idTable);
		$ketquaAjax = array(
			'ketqua' => $dataDB
		);
		echo json_encode($ketquaAjax);
	}
	function ajaxUpdateRoleItem()
	{
		$dataUpdate = array(
			'role_name' => $_POST['role_name'],
			'role_isactive' => $_POST['role_isactive'],
			'router' => $_POST['router']
		);
		$id = $_POST['role_id'];
		$table = 'roles';
		$idTable = 'role_id';
		$this->load->model("quanlytrungtam_model");
		$rowUpdate=$this->quanlytrungtam_model->updateDB($dataUpdate,$id,$table,$idTable);
		$ketqua = array(
			'kq'=> $rowUpdate
		);
		echo json_encode($ketqua);
	}

	function pageDeleteRole()
	{
		$this->load->helper('url');
		$data['pageName'] ='role-delete';
		$data['ajaxDeleteRoleItem'] = site_url('quanlytrungtam/ajaxDeleteRoleItem');
		$data['pageRole'] = site_url('quanlytrungtam/pageRole');
		$this->load->model("quanlytrungtam_model");
		$data['DBRole'] = $this->quanlytrungtam_model->GetDBTable('roles');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function ajaxDeleteRoleItem()
	{
		$role_id = $_POST['role_id'];
		$table = 'roles';
		$idTable ='role_id';
		$this->load->model("quanlytrungtam_model");
		$checkrow=$this->quanlytrungtam_model->deleteDB($role_id,$table,$idTable);
		$ketquaAjax = array(
			'ketqua' => $checkrow
		);
		echo json_encode($ketquaAjax);
	}
	/* PAGE ROLE CỦA USER */
	function pageRoleByUser()
	{
		$this->load->helper('url');
		$data['pageName'] = 'role-by-user';
		$data['ajaxloadRoleByUser'] = site_url('quanlytrungtam/ajaxloadRoleByUser');
		$data['ajaxSaveRoleByUser'] = site_url('quanlytrungtam/ajaxSaveRoleByUser');
		$this->load->model("quanlytrungtam_model");
		$data['DBUser'] =$this->quanlytrungtam_model->GetDBTable('users');
		$data['DBRole'] =$this->quanlytrungtam_model->GetDBTable('roles');
		$this->load->view("quanlytrungtam/layout",$data);
	}

	function ajaxloadRoleByUser()
	 {
	 	$user_id = $_POST['user_id'];
	 	$this->load->model("quanlytrungtam_model");
	 	$dataDB=$this->quanlytrungtam_model->getRoleByUserID($user_id);
	 	$arrayTemp = array();
	 	foreach ($dataDB as $key => $value) 
	 	{
	 		$array= explode(",",$value['role_id']);
	 		$user_id = $value['user_id'];
	 		$arrayTemp['role_id']=$array;
	 		$arrayTemp['user_id']=$user_id;

	 	}
	 	$ketquaAjax = array(
	 		'ketqua' => $arrayTemp
	 	);
	 	echo json_encode($ketquaAjax);	
	}

	function ajaxSaveRoleByUser()
	{
		$this->load->helper('url');
		$user_id = $_POST['user_id'];
		$role_id = $_POST['role_id'];
		$table ='role_has_user';
		$idTable = 'user_id';
		$this->load->model("quanlytrungtam_model");
	 	$dataDB=$this->quanlytrungtam_model->GetDBByID($user_id,$table,$idTable);
	 	if(!empty($dataDB))
	 	{
	 		
	 	}
	}
}