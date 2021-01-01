<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" >
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-folder-o"></em>
			</a></li>
			<li class="active">QUẢN LÝ HỌC VIÊN</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Học viên</h1>
		</div>
	</div>
	<div class="panel-body">
		<div class="col-md-6">
			<form id="formStudentAdd" action="ajaxCreateStudent()" method="POST">
				<div class="form-group">
					<label for="studentID">ID</label>
					<input type="number" id="studentID" class="form-control">
				</div>
				<div class="form-group">
					<label for="studentName">Tên học viên</label>
					<input type="text" id="studentName" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="studentOld">Tuổi</label>
					<input type="number" id="studentOld" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="studentIdentityCard">CMND</label>
					<input type="number" id="studentIdentityCard" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="studentSex">Giới tính</label>
					<input type="text" id="studentSex" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="studentAddress">Địa chỉ</label>
					<input type="text" id="studentAddress" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="studentEmail">Email</label>
					<input type="email" id="studentEmail" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="studentPhone">SDT</label><br>
					<input type="number" id="studentPhone" name="studentPhone" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="studentLevel">Cấp độ học viên</label><
					<select name="studentLevel" id="studentLevel" class="form-control">
					<?php
						foreach ($DBLevel as $key => $value) {
							echo '<option value="'.$value['level_id'].'" selected="selected">'.$value['level_number'].'</option>';
						}
					?>
					</select>
				</div>
				<button class ="btn btn-primary btn-md">SAVE</a></button>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(	
	function(){
		
	}
);
var frm = $('#formStudentAdd');
frm.submit(function (e) {
e.preventDefault();
	var student_id = $('#studentID').val(),
			student_name = $('#studentName').val(),
			student_old = $('#studentOld').val(),
			student_identitycard = $('#studentIdentityCard').val(),
			student_sex = $('#studentSex').val(),
			student_address = $('#studentAddress').val(),
			student_email = $('#studentEmail').val(),
			student_phone = $('#studentPhone').val(),
			student_level = $('#studentLevel').find('option:selected').val();
	var data = 
	{
		student_id:student_id,
		student_name:student_name, 
		student_old:student_old,
		student_identitycard:student_identitycard,
		student_sex:student_sex, 
		student_address: student_address, 
		student_email: student_email,
		student_phone:student_phone,
		student_level:student_level
	};
$.ajax({
  type: "POST",
  url: '<?php echo $ajaxCreateStudent; ?>', 
  data: data,
  dataType: 'json',
	}).done(function(data) {
		var kq = data.ketqua;
	  	if(kq > 0)
	  	{
	  		alert("Tạo menu thành công  !");
	  		window.location.href='<?php echo $pageStudent; ?>';
	  	}
	  	else
	  	{
	  		alert("Tạo menu không thành công ! Trùng CMND");
	  	}
	});
});
</script>