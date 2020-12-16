<?php
class quanlytrungtam_model extends CI_Model
{
	function InsertDBConfiguration($dataInsert)
	{
		$this->load->database();
		$this->db->insert('configuration',$dataInsert);
   		return $this->db->insert_id(); 
	}

	function GetDBConfiguration()
	{
		$this->load->database();
		$query = $this->db->query("select * from configuration");
		return $query->result_array();
	}

	function GetDBTable($table)
	{
		$this->load->database();
		$query = $this->db->query("select * from $table");
		return $query->result_array();
	}

	function GetDBByID($id,$table,$idTable)
	{
		$this->load->database();
		$query = $this->db->query("select * from $table where $idTable=$id");
		return $query->result_array();
	}

	function GetDSMenuName()
	{
		$this->load->database();
		$query = $this->db->query("select menu_name from menu ");
		return $query->result_array();
	}

	function GetMenuIDByName($menu_name)
	{
		$this->load->database();
		$query = $this->db->query("select menu_id from menu where menu_name like N'$menu_name'");
		return $query->result_array();
	}

	function GetIDTableByWhere($condition,$valueCondition,$table,$id)
	{
		$this->load->database();
		$query = $this->db->query("select $id from $table where $condition like N'$valueCondition'");
		return $query->result_array();
	}

	function InsertDB($dataInsert,$table)
	{
		$this->load->database();
		$this->db->insert($table,$dataInsert);
   		return $this->db->insert_id(); 
	}

	function updateDB($updated_data,$id,$table,$idTable)
	{
		$this->load->database();
		$this->db->where($idTable,$id);
   		$this->db->update($table,$updated_data);
   		return $this->db->affected_rows();
	}
	function deleteDB($id,$table,$idTable)
	{
		$this->load->database();
	    $this->db->where($idTable,$id);
	    $this->db->delete($table);
	    return $this->db->affected_rows();
	}
	function getMenuIDMenuName()
	{
		$this->load->database();
		$query = $this->db->query("select * from menu where menu_order =0");
		return $query->result_array();
	}
}
?>