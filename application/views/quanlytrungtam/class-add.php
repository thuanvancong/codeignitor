<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" >
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-folder-o"></em>
			</a></li>
			<li class="active">QUẢN LÝ KHÓA HỌC</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Class</h1>
		</div>
	</div>
	<div class="panel-body">
		<div class="col-md-6">
			<form id="formClassAdd" action="ajaxCreateclass()" method="POST">
				<div class="form-group">
					<label for="classID">Id</label>
					<input type="number" id="classID" class="form-control">
				</div>
				<div class="form-group">
					<label for="className">Tên class</label>
					<input type="text" id="className" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="classDescription">Mô tả trang</label>
					<input type="text" id="classDescription" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="classOpen">Thời gian mở lớp</label>
					<input type="date" id="classOpen" name="classOpen" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="classFinish">Thời gian kết thúc</label>
					<input type="date" id="classFinish" name="classFinish" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="coursePrice">Giá khóa học</label>
					<input type="number" id="coursePrice" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="level">Cấp độ</label>
					<select name="level" id="level" class="form-control" required>
						<?php
							foreach ($DBLevel as $key => $value) {
								echo '<option value="'.$value['level_id'].'" selected="selected">'.$value['level_number'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label>Khóa học</label>
					<select name="courseID" id="courseID" class="form-control">
						<?php
							foreach ($DBCourse as $key => $value) {
								echo '<option value="'.$value['course_id'].'" selected="selected">'.$value['course_name'].'</option>';
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
var frm = $('#formClassAdd');
frm.submit(function (e) {
e.preventDefault();
	var class_name = $('#className').val(),
				class_description = $('#classDescription').val(),
				class_open = $('#classOpen').val(),
				class_finish = $('#classFinish').val(),
				level_id = $('#level').find('option:selected').val(),
				course_id = $('#courseID').find('option:selected').val();
	var data = 
	{
		class_name:class_name,
		class_description:class_description, 
		class_open:class_open, 
		class_finish:class_finish, 
		level_id: level_id, 
		course_id: course_id
	};
$.ajax({
  type: "POST",
  url: '<?php echo $ajaxCreateclass; ?>', 
  data: data,
  dataType: 'json',
	}).done(function(data) {
		var kq = data.ketqua;
	  	if(kq > 0)
	  	{
	  		alert("Tạo menu thành công  !");
	  		window.location.href='<?php echo $pageClass; ?>';
	  	}
	  	else
	  	{
	  		alert("Tạo menu không thành công !");
	  	}
	});
});
</script>