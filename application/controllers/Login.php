<?php
class Login extends Pageparent_Controller
{
	public function __construct() {
       parent::__construct();
    }
    
	function index()
	{
		$data['pageName'] = 'login';
		$this->load->helper('url');
		$data['ajaxCheckLogin'] =site_url('Login/ajaxCheckLogin');
		$data['index'] =site_url('quanlytrungtam/index');
		$data['fontend'] =site_url('fontend/Fontend/index');
		$this->load->view("quanlytrungtam/layout_login",$data);
	}
	
	function ajaxCheckLogin()
	{
		$user_name=$_POST['user_name'];
		$user_pass=$_POST['user_pass'];
		$this->load->model("quanlytrungtam_model");
		$dataDB = $this->quanlytrungtam_model->getDB_ByUserName_UserPass($user_name,$user_pass);
		if(empty($dataDB))
		{
			$ketquaAjax = array(
				'ketqua' => 0
			);
		}
		else
		{
			
			foreach ($dataDB as $key => $value) {
				$array= array(
					'user_id' => $value['user_id'],
					'user_name' => $value['user_name']
				);
				$user_name = $value['user_name'];
				$mang = explode('_', $user_name);
				$key = $mang[0];
				if($key == 'SV')
				{
					$ketquaAjax = array(
						'ketqua' => 1
					);
				}
				else
				{
					$ketquaAjax = array(
						'ketqua' => 2
					);
				}
			}
			$_SESSION['user'] = $array;	
		}
		echo json_encode($ketquaAjax);
	}
}