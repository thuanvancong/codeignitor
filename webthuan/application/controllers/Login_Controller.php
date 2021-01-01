<?php
class Login_Controller extends Pageparent_Controller
{
	function pageLogin()
	{
		$data['pageName'] = 'login';
		$this->load->helper('url');
		$data['ajaxCheckLogin'] =site_url('Login_Controller/ajaxCheckLogin');
		$data['index'] =site_url('quanlytrungtam/index');
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
			$ketquaAjax = array(
				'ketqua' => 1
			);
			foreach ($dataDB as $key => $value) {
				$array= array(
					'user_id' => $value['user_id'],
					'user_name' => $value['user_name']
				);
			}
			$_SESSION['user'] = $array;	
		}
		echo json_encode($ketquaAjax);
	}
}