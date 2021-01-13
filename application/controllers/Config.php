<?php 
class Config extends Pageparent_Controller
{
	public function __construct() {
       parent::__construct();
    }
    
    function index()
	{
		$this->load->helper('url');
		$data['pageName'] = 'Config';
		// $data['configAdd']= site_url().'/config/add';
		// $data['configUpdate']= site_url().'/config/update';
		// $data['configDelete']= site_url().'/config/delete';
		$data['configAdd'] = site_url('Config/add');
		$data['configUpdate'] = site_url('Config/update');
		$data['configDelete'] = site_url('Config/delete');
		$this->load->model("quanlytrungtam_model");	
		$data['DBConfig']=$this->quanlytrungtam_model->GetDBConfig();
		$this->load->view("quanlytrungtam/layout", $data);
	}
	/* PAGE THÊM CẤU HÌNH */
	function add()
	{
		$this->load->helper('url');
		$data['pageName'] = 'config-add';
		$data['pageConfig'] = site_url().'/config';
		$data['ajaxSaveFormConfig'] = site_url('Config/ajaxSaveFormConfig');
		//$data['pageConfig'] = site_url('Config/pageConfig');
		$this->load->view("quanlytrungtam/layout", $data);
	}
	/* PAGE SỬA CẤU HÌNH */
	function update()
	{
		$this->load->helper('url');
		$data['pageName'] = 'config-update';
		$data['ajaxSelectItemConfigByID'] = site_url('Config/config_Update_data');
		$data['ajaxUpateConfig'] = site_url('Config/config_Update_data_after');
		$data['pageConfig'] = site_url().'/config';
		//$data['pageConfig'] = site_url('Config/pageConfig');
		$this->load->model("quanlytrungtam_model");
		$data['DBConfig']=$this->quanlytrungtam_model->GetDBConfig();
		$this->load->view("quanlytrungtam/layout", $data);
	}
	/* PAGE XÓA CẤU HÌNH */
	function delete()
	{
		$this->load->helper('url');
		$data['pageName'] = 'config-delete';
		$data['ajaxSelectItemConfigByID'] = site_url('Config/config_Update_data');
		$data['ajaxDeleteConfig'] = site_url('Config/config_Delete_data_after');
		$data['pageConfig'] = site_url().'/config';
		//$data['pageConfig'] = site_url('Config/pageConfig');
		$this->load->model("quanlytrungtam_model");
		$data['DBConfig']=$this->quanlytrungtam_model->GetDBConfig();
		$this->load->view("quanlytrungtam/layout",$data);
	}
	// FUNTION AJAX
	/* Function xử lý ajax PageConFig : Thêm Config */
	function ajaxSaveFormConfig()
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
		$idConfig=$this->quanlytrungtam_model->InsertDBConfig($dataInsert);
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
}