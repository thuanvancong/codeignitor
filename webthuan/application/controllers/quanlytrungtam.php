<?php
class quanlytrungtam extends Pageparent_Controller 
{
	protected $access = 'admin';
	public function __construct() {
       parent::__construct();
    }
	function index()
	{
		$this->load->helper('url');
		$data['pageName'] = 'pagequanly';
		$data['pageConfiguration'] = site_url().'config';
		$data['pageMenu'] = site_url().'menu/index';
		$data['pageCourse'] = site_url().'course';
		$data['pageClass'] = site_url().'class';
		$data['pageStudent'] = site_url().'student';
		$data['pageTeacher'] = site_url().'teacher';
		$data['pageUser'] = site_url().'user';
		$data['pageRole'] = site_url().'role';
		$data['pageRoleByUser'] = site_url().'user/userrole';
		$data['pageLogin'] = site_url().'Login/index';
		$this->load->view("quanlytrungtam/layout", $data);
	}
}

