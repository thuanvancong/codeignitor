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
			<form id="formStudentUpdateCost" action="ajaxUpdateLevelStudent()" method="POST">
				<div class="form-group">
					<label for="studentID">CHỌN ID CẦN SỬA</label>
					<select class="form-control" id="studentID">
						<?php 
							foreach ($DBStudent as $key => $value) {
								echo '<option value="'.$value['student_id'].'" selected>'.$value['student_id'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="studentName">Tên học viên</label>
					<input type="text" id="studentName" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="studentLevel">Cấp độ học viên</label>
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
		$('#formStudentUpdateCost').find('#studentID').on('change', function(evt) {
	      var $target = $(evt.currentTarget);
	      var student_id = $('#studentID').find('option:selected').val();
	      loadItemStudent(student_id);
	  });
	}
);
function loadItemStudent(student_id)
{
	$.ajax({
      type: "POST",
      url: '<?php echo $ajaxLoadItemStudent; ?>', 
      data: {student_id:student_id},
      dataType: 'json',
	}).done(function(data) {
		var ketqua=data.ketqua;
	  	var i;
	  	for(i=0;i < ketqua.length;i++)
	  	{
	  		$('#studentName').val(ketqua[i].student_name);
	  		$('#studentLevel').val(ketqua[i].student_level);
	  	}
	});
}

// function ajaxUpdateLevelStudent()
// {
// 	var student_id = $('#studentID').val(),
// 		student_level = $('#studentLevel').find('option:selected').val();
// 	var data = 
// 	{
// 		student_id:student_id,
// 		student_level:student_level
// 	};
// 	$.ajax({
//       type: "POST",
//       url: '<?php echo $ajaxUpdateLevelStudent; ?>', 
//       data: data,
//       dataType: 'json',
// 	}).done(function(data) {
// 		var kq = data.kq;
// 	  	if(kq > 0)
// 	  	{
// 	  		alert("Sửa thông tin thành công  !");
// 	  		window.location.href='<?php echo $pageStudent; ?>';
// 	  	}
// 	  	else
// 	  	{
// 	  		alert("Sửa không thành công ");
// 	  	}
// 	});
// }
var frm = $('#formStudentUpdateCost');
frm.submit(function (e) {
e.preventDefault();
	var student_id = $('#studentID').val(),
		student_level = $('#studentLevel').find('option:selected').val();
	var data = 
	{
		student_id:student_id,
		student_level:student_level
	};
$.ajax({
  type: "POST",
  url: '<?php echo $ajaxUpdateLevelStudent; ?>', 
  data: data,
  dataType: 'json',
	}).done(function(data) {
		var kq = data.kq;
	  	if(kq > 0)
	  	{
	  		alert("Sửa thông tin thành công  !");
	  		window.location.href='<?php echo $pageStudent; ?>';
	  	}
	  	else
	  	{
	  		alert("Sửa không thành công ");
	  	}
	});
});
</script>
</script>