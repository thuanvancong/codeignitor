<?php
class quanlykhachsan extends CI_Controller {

	function homepage()
	{
		$this->load->helper('url');
		$this->load->model('qlks_model');
		$data['dataFloor'] = $this->qlks_model->getDB_Floor();
		$data['pageName'] = 'qlks_view';
		$data['ajaxFloor'] = site_url('quanlykhachsan/load_Room_By_Floor');
		$this->load->view("quanlykhachsan/layout", $data);
	}

	function load_Room_By_Floor()
	{
		$FL_NAME = $_POST['FL_NAME'];
		$this->load->model('qlks_model');
		$dataDB = $this->qlks_model->getDB_Room_ByFL_NAME($FL_NAME);
		/*-------- DATA XỬ LÝ AJAX LOAD ROOM ---------*/
		foreach ($dataDB as $key => $value) {
			$ketqua[] = array(
				'RO_ID' => $value['RO_ID'],
				'RO_NAME' => $value['RO_NAME'],
				'FL_ID' => $value['FL_ID'],
			);		
		}
		echo json_encode($ketqua);
	}

	function checkinpage()
	{
		$this->load->helper('url');
		$this->load->model('qlks_model');
		$data['pageName'] = 'checkin_form';
		$data['ajaxLoadRoomSelect'] = site_url('quanlykhachsan/load_Room_PageFormCheckIn');
		$data['ajaxGetDataCheckIn'] = site_url('quanlykhachsan/get_data_checkin');
		$this->load->view("quanlykhachsan/layout",$data);
	}
	function load_Room_PageFormCheckIn()
	{
		$FL_ID = $_POST['IdFlood'];
		$this->load->model('qlks_model');
		$dataDB = $this->qlks_model->getDB_Room_ByFL_ID($FL_ID);
		foreach ($dataDB as $key => $value) {
			$ketqua[] = array(
				'RO_ID' => $value['RO_ID'],
				'RO_NAME' => $value['RO_NAME'],
				'FL_ID' => $value['FL_ID'],
			);		
		}
		echo json_encode($ketqua);
	}
	function get_data_checkin()
	{
		$FL_ID = $_POST['FLID'];
		$RO_ID = $_POST['ROID'];
		$TIME_IN = time();
		$TIMEBYDATE=date("Y-m-d h:i:sa",$TIME_IN);
		$RO_STATUS_ID = 1;
		$dataInsert = array(
			'RO_ID' => $RO_ID,
			'TIME_IN' => $TIME_IN,
			'FL_ID' => $FL_ID,
			'RO_STATUS_ID' => $RO_STATUS_ID
		);
		$this->load->model('qlks_model');
		$idCheckin=$this->qlks_model->insert_CheckIn($dataInsert);
		var_dump($idCheckin);
	}
}