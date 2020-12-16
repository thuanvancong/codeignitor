<?php
class qlks_model extends CI_Model
{
	function getDB_Floor()
	{
		$this->load->database();
		$query = $this->db->query("select * from FLOOR");
  		return $query->result_array();
	}
	function getDB_Room_ByFL_NAME($FL_NAME)
	{
		$this->load->database();
		$query = $this->db->query("select * from room left join floor on room.FL_ID = floor.ID where floor.FL_NAME like N'%$FL_NAME'");
		return $query->result_array();
	}
	function getDB_Room_ByFL_ID($FL_ID)
	{
		$this->load->database();
		$query = $this->db->query("select * from room left join floor on room.FL_ID = floor.ID where floor.ID=$FL_ID");
		return $query->result_array();
	}
	function insert_CheckIn($dataInsert)
	{
		$this->load->database();
		$this->db->insert('checkin',$dataInsert);
		return $this->db->insert_id(); 
	}
}

?>