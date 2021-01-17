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

	function getStudentNameByID($student_id)
	{
		$this->load->database();
		$query = $this->db->query("select student_name from student where student_id=$student_id");
		return $query->result_array();
	}
	function getClassNameByID($class_id)
	{
		$this->load->database();
		$query = $this->db->query("select class_name from class where class_id=$class_id");
		return $query->result_array();
	}
	function getTeacherNameByID($teacher_id)
	{
		$this->load->database();
		$query = $this->db->query("select teacher_name from teacher where teacher_id=$teacher_id");
		return $query->result_array();
	}
	function getShiftTimeByID($shift_id)
	{
		$this->load->database();
		$query = $this->db->query("select time_in,time_out from shift where shift_id=$shift_id");
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
		$query = $this->db->query("select $id from $table where $condition like N'$value%'");
		return $query->result_array();
	}

	function getItemScheduleByIndentify($student_identitycard)
	{
		$this->load->database();
		$query = $this->db->query("select * from ( select student_id from student where student_identitycard = $student_identitycard) as STUDENT inner join class_by_student on STUDENT.student_id = class_by_student.student_id ");
		return $query->result_array();
	}

	function getItemScheduleByClass($class_name)
	{
		$this->load->database();
		$query = $this->db->query("select * from ( select class_id,class_name from class where class_name like N'%$class_name%') as CLASS inner join class_by_student on CLASS.class_id = class_by_student.class_id");
		return $query->result_array();
	}

	function getDBJoin_STUDENT_CLASS_EXTENTD()
	{
		$this->load->database();
		$query = $this->db->query("select 
										class.class_id,
										class.class_name,
										class.course_id,
										EXTEND_STUDENT.student_name,
										EXTEND_STUDENT.student_identitycard,
										EXTEND_STUDENT.precent_debt
									from 
										(select 
											class_student_id,
											precent_debt,
									        shift_id,
									        class_id,
									        student_name,
									        student_identitycard 
									        from class_by_student 
									        left join student 
									        on class_by_student.student_id = student.student_id) AS EXTEND_STUDENT 
									left join class 
									on EXTEND_STUDENT.class_id = CLASS.class_id");
		return $query->result_array();
	}
}
?>
