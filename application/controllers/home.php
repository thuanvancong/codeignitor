<?php
class Home extends CI_Controller {
	
	public function index()
	{

	  	$this->load->model("home_model");
	  	$data["list"] = $this->home_model->getList();
	  	$data["Product"] = $this->home_model->getCIProduct();
	  	$data["pageName"] = 'home_view';
	  	$this->load->view("home/layout", $data);
	}
	public function product()
	{

	  	$this->load->model("home_model");
	  	$data["list"] = $this->home_model->getList();
	  	$data["Product"] = $this->home_model->getCIProduct();
	  	$data["pageName"] = 'product_view';
	  	$this->load->view("home/layout", $data);
	}
	public function form_insert_product()
	{
		$this->load->helper('url');
	  	$data["pageName"] = 'form_input_product';	
	  	$data["forminsertproduc"] = site_url('home/form_insert');
	  	$data["urlIndex"]=site_url('home/index');
	  	$this->load->view("home/layout", $data);
	}
	public function form_insert()
	{
		$this->load->helper('url');
	  	$ProName=$_POST['ProName'];
	  	$ProPrice=$_POST['ProPrice'];
	  	$data = array(
	  		'Pro_Name' => $ProName,
	  		'Pro_Price' => $ProPrice,
	  	);
	  	$this->load->model("home_model");
	  	$id=$this->home_model->insertDB($data);
	  	$ketqua = array(
	  		'id' => $id
	  	);
	  	echo json_encode($ketqua);
	}
}
