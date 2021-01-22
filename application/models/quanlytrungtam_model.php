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
		$query = $this->db->query("select level_id,class_name from class where class_id=$class_id");
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
	function getDBClassByCourseName($course_name)
	{
		$this->load->database();
		$query = $this->db->query("select * from web_codeigniter.course where course_name like N'%$course_name%'");
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
		// $this->load->database();
		// $query = $this->db->query("select * from ( select student_id from student where student_identitycard = $student_identitycard) as STUDENT inner join extend_class_student on STUDENT.student_id = extend_class_student.student_id ");
		// return $query->result_array();
		$this->load->database();
		$query = $this->db->query("select *
									from (select Extend.student_id as student_id,
											Extend.extend_id as extend_id,
									        Extend.class_id as class_id,
									        Extend.class_code as class_code,
									        Extend.shift_id as shift_id,
									        Extend.precent_debt as precent_debt,
									        Student.student_name as student_name
										from (select student_id,student_name
												from student 
												where student_identitycard = $student_identitycard) AS Student 
										inner join extend_class_student as Extend 
										on Student.student_id = Extend.student_id) AS Extend2 inner join class on Extend2.class_id = class.class_id");
		return $query->result_array();
	}

	function getItemScheduleByClass($class_id)
	{
		$this->load->database();
		$query = $this->db->query("select 
											EXTEND2.extend_id,
											EXTEND2.class_id,
									        EXTEND2.class_name,
									        EXTEND2.level_id,
									        EXTEND2.class_code,
									        EXTEND2.precent_debt,
									        EXTEND2.shift_id,
									        student.student_id,
									        student.student_name,
									        student.student_identitycard
									from (
											select 
												CLASS.class_id,
												CLASS.class_name,
												CLASS.level_id,
												extend_class_student.extend_id,
												extend_class_student.student_id,
												extend_class_student.class_code,
												extend_class_student.shift_id,
												extend_class_student.precent_debt 
												from ( select 
															class_id,
															class_name,
															level_id 
														from class 
														where class_id = 1) as CLASS 
												inner join extend_class_student 
												on CLASS.class_id = extend_class_student.class_id) AS EXTEND2 
									inner join student 
									on student.student_id=EXTEND2.student_id");
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

	function getDB_STUDENT_CLASS_EXTENTD_BY_INDENTITYCARD($student_identitycard,$class_name)
	{
		$this->load->database();
		$query = $this->db->query("select 
										class.class_id,
										class.class_name,
										class.course_id,
										EXTEND_STUDENT.student_name,
										EXTEND_STUDENT.student_identitycard,
										EXTEND_STUDENT.precent_debt,
										EXTEND_STUDENT.class_student_id
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
											on class_by_student.student_id = student.student_id 
									        where student_identitycard = $student_identitycard) AS EXTEND_STUDENT
									left join class 
									on EXTEND_STUDENT.class_id = CLASS.class_id
									where class_name like N'%$class_name%'");
		return $query->result_array();
	}

	function getDB_Extend_Class_By_Student_Shift($student_id)
	{
		$this->load->database();
		$query = $this->db->query("select CLASS.class_id,
											CLASS.class_open,
									        CLASS.class_finish,
									        EXTEND.time_in,
									        EXTEND.time_out,
									        EXTEND.shift_id
									from 
										(select 
											time_in,
											time_out,
											class_id,
											class_by_student.shift_id
										from class_by_student 
										left join shift 
										on class_by_student.shift_id=shift.shift_id 
										where student_id=$student_id) AS EXTEND 
										inner join CLASS on EXTEND.class_id = CLASS.class_id;");
		return $query->result_array();
	}
	function getDB_Extend_Class_By_Student_Class($student_id,$class_name)
	{
		$this->load->database();
		$query = $this->db->query("select * 
									from class_by_student 
									left join class 
									on class_by_student.class_id = class.class_id 
									where class_name like N'%$class_name%' and class_by_student.student_id =$student_id");
		return $query->result_array();
	}

	function getDB_Extend_Check_Register($course_id,$level_id,$student_id)
	{
		$this->load->database();
		$query = $this->db->query("select 
									* 
									FROM course 
									left join class_by_student 
									on course.course_id = class_by_student.course_id 
									where class_by_student.course_id = $course_id 
									and class_by_student.level_id=$level_id
									and student_id = $student_id");
		return $query->result_array();
	}

	function CountRow_Extend_Register($course_id,$level_id)
	{
		$this->load->database();
		$query = $this->db->query("select 
									count(class_student_id) as count_row 
									from class_by_student 
									where course_id = $course_id and level_id = $level_id");
		return $query->result_array();
	}

	function CountRow_Extend_Class($course_id,$level_id)
	{
		$this->load->database();
		$query = $this->db->query("select count(class_id) as count_class from class where level_id = $level_id and course_id = $course_id");
		return $query->result_array();
	}

	function getDB_Class_By_Level_Course($course_id,$level_id)
	{
		$this->load->database();
		$query = $this->db->query("select * 
									from class 
									where level_id = $level_id and course_id = $course_id
									order by date_update desc");
		return $query->result_array();
	}

	function GetDB_Register_By_ID_Student_Shift($student_id,$shift_id)
	{
		$this->load->database();
		$query = $this->db->query("select * 
									from class_by_student 
									where student_id = $student_id and shift_id = $shift_id ");
		return $query->result_array();
	}
	// REGISTER MODEL
	function Data_Class_Student_By_ID($class_id,$class_code)
	{
		$this->load->database();
		$query = $this->db->query("select * 
									from extend_class_student 
									where class_id = $class_id and class_code like '%$class_code%' ");
		return $query->result_array();
	} 	

	function Count_Class_Student($class_id,$class_code)
	{
		$this->load->database();
		$query = $this->db->query("select count(class_id) as Count 
									from extend_class_student 
									where class_id = $class_id and class_code like N'%$class_code%' ");
		return $query->result_array();
	}

	function Point_Latest_Class_Student($class_id)
	{
		$this->load->database();
		$query = $this->db->query("select * 
									from extend_class_student 
									where class_id = $class_id  
									order by class_code desc");
		return $query->result_array();
	}

	function Check_Class_Student_By_ID($student_id,$class_id)
	{
		$this->load->database();
		$query = $this->db->query("select * 
								from extend_class_student 
								where student_id = $student_id and class_id = $class_id");
		return $query->result_array();
	}	
}
?>
