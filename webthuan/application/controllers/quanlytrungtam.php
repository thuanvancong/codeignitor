<?php
class quanlytrungtam extends CI_Controller {
	function index()
	{
		$this->load->helper('url');
		$data['pageName'] = 'pagequanly';
		$data['pageConfiguration'] = site_url('quanlytrungtam/pageconfiguration');
		$data['pageMenu'] = site_url('quanlytrungtam/pageMenu');
		$data['pageCourse'] = site_url('quanlytrungtam/pageCourse');
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
		$data['pageName'] = 'course';
		$this->load->view("quanlytrungtam/layout",$data);
	}
}
