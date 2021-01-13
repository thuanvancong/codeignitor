<?php 
class Menu extends Pageparent_Controller
{
	// PAGE MENU
	public function __construct() {
       parent::__construct();
    }
	function index()
	{
		$this->load->helper('url');
		$data['pageName'] = 'menu';
		// $data['pageMenuCreate'] = site_url().'/menu/add';
		// $data['pageMenuUpdate'] = site_url().'/menu/update';
		// $data['pageMenuDelete'] = site_url().'/menu/delete';
		$data['pageMenuCreate'] = site_url('Menu/add');
		$data['pageMenuUpdate'] = site_url('Menu/update');
		$data['pageMenuDelete'] = site_url('Menu/delete');
		$this->load->model("quanlytrungtam_model");
		$data['DBMenu'] = $this->quanlytrungtam_model->GetDBTable('menu');
		$this->load->view("quanlytrungtam/layout",$data);
	}
	/*---Load page creat menu ---*/	
	function add()
	{
		$this->load->helper('url');
		$data['pageName'] = 'menu-add';
		$this->load->model('quanlytrungtam_model');
		$data['DsDbMenuName'] =$this->quanlytrungtam_model->GetDSMenuName();
		$data['ajaxCreatMenu'] =site_url('Menu/ajaxCreatMenu');
		$data['pageMenu'] =site_url().'/menu';
		//$data['pageMenu'] =site_url('Menu_Controller/pageMenu');
		$this->load->view("quanlytrungtam/layout",$data);
	}
	/*---Load page update menu ---*/
	function update()
	{
		$this->load->helper('url');
		$data['pageName']='menu-update';
		$data['pageMenu'] =site_url().'/menu/index';
		//$data['pageMenu'] =site_url('Menu_Controller/pageMenu');
		$data['ajaxLoadItemMenu'] =site_url('Menu/ajaxLoadItemMenu');
		$data['ajaxUpdateItemMenu'] =site_url('Menu/ajaxUpdateItemMenu');
		$this->load->model("quanlytrungtam_model");
		$data['DsDbMenuName'] =$this->quanlytrungtam_model->GetDSMenuName();
		$data['DBMenu'] = $this->quanlytrungtam_model->GetDBTable('menu');
		$this->load->view("quanlytrungtam/layout",$data);
	}
	function delete()
	{
		$this->load->helper('url');
		$data['pageName'] = 'menu-delete';
		$data['ajaxLoadItemMenu'] =site_url('Menu/ajaxLoadItemMenu');
		$data['ajaxDeleteItemMenu'] =site_url('Menu/ajaxDeleteItemMenu');
		$data['pageMenu'] =site_url().'/menu/index';
		//$data['pageMenu'] =site_url('Menu_Controller/pageMenu');
		$this->load->model("quanlytrungtam_model");
		$data['DBMenu'] = $this->quanlytrungtam_model->GetDBTable('menu');
		$this->load->view("quanlytrungtam/layout",$data);
	}
	/*---Ajax tạo item menu ---*/
	function ajaxCreatMenu()
	{
		$this->load->model("quanlytrungtam_model");
		$menu_name = $_POST['menu_name'];
		$menu_id = $this->quanlytrungtam_model->GetMenuIDByName($menu_name);
		/*-- Trường hợp không có menu_name --*/
		if(empty($menu_id))
		{
			$this->load->helper('url');
			/*--  menu_order 0:khong co submenu 1:co submenu --*/
			if($_POST['menu_order'] == 0)
			{
				$dataInsert = array(
					'menu_name' => $_POST['menu_name'],
					'menu_content' => $_POST['menu_content'],
					'menu_isactive' => $_POST['menu_isactive'],
					'menu_order' => $_POST['menu_order'],
					'parent_id' => 0,
					'menu_url' => $_POST['menu_url']
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
					'menu_url' => $_POST['menu_url']
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
				'menu_url' => $_POST['menu_url'],
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
						'menu_url' => $_POST['menu_url'],
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
}