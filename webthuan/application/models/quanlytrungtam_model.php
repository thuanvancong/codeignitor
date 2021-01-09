<?php
class quanlytrungtam_model extends CI_Model
{
	function InsertDBConfig($dataInsert)
	{
		$this->load->database();
		$this->db->insert('configuration',$dataInsert);
   		return $this->db->insert_id(); 
	}

	function GetDBConfig()
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

	function getRoleByUserID($user_id)
	{
		$this->load->database();
		$query = $this->db->query("select role_id,user_id from role_has_user where user_id = $user_id");
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
	function getPassUserByID($id)
	{
		$this->load->database();
		$query = $this->db->query("select user_pass from users where user_id=$id");
		return $query->result_array();
	}
	function getDBStudentByIdentifyCard($student_identitycard)
	{
		$this->load->database();
		$query = $this->db->query("select * from student where student_identitycard=$student_identitycard");
		return $query->result_array();
	}

	function getUser_IDByIdentifyCard($student_identitycard)
	{
		$this->load->database();
		$query = $this->db->query("Select user_id from web_codeigniter.users where user_name like '%$student_identitycard%'");
		return $query->result_array();
	}

	function getDB_ByUserName_UserPass($user_name,$user_pass)
	{
		$this->load->database();
		$query = $this->db->query("select * from web_codeigniter.users where user_name like N'$user_name' and user_pass like N'$user_pass'");
		return $query->result_array();
	}

	function getDB_CheckUserRole($user_id)
	{
		$this->load->database();
		$query = $this->db->query("select * from role_has_user as UserRole inner join roles on UserRole.role_id = roles.role_id where user_id = $user_id");
		return $query->result_array();
	}

	function getRouterByUserID($user_id)
	{
		$this->load->database();
		$query = $this->db->query("select roles.role_id, roles.router from (SELECT userrole.role_id 
										 FROM role_has_user as userrole 
										 inner join users 
										 on userrole.user_id = users.user_id 
										 where users.user_id = $user_id ) AS TB_USERROLE 
									inner join roles
									on TB_USERROLE.role_id = roles.role_id ");
		return $query->result_array();
	}
	function getDBClassByClassName($class_name)
	{
		$this->load->database();
		$query = $this->db->query("select * from web_codeigniter.class where class_name like N'%$class_name%'");
		return $query->result_array();
	}

	function getDBStudentByStudentName($student_name)
	{
		$this->load->database();
		$query = $this->db->query("select * from web_codeigniter.student where student_name like N'%$student_name%'");
		return $query->result_array();
	}
	function getDBTeacherByTeacherName($teacher_name)
	{
		$this->load->database();
		$query = $this->db->query("select * from web_codeigniter.teacher where teacher_name like N'%$teacher_name%'");
		return $query->result_array();
	}
	function getDBShiftByShiftName($shift_name)
	{
		$this->load->database();
		$query = $this->db->query("select * from web_codeigniter.shift where shift_name like N'%$shift_name%'");
		return $query->result_array();
	}

	function getIDByTable($id,$condition,$value,$table)
	{
		$this->load->database();
		$query = $this->db->query("select $id from $table where $condition like N'%$value%'");
		return $query->result_array();
	}
}
?>