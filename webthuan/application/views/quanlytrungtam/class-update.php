<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" >
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-folder-o"></em>
			</a></li>
			<li class="active">QUẢN LÝ LỚP HỌC</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Lớp học</h1>
		</div>
	</div>
	<div class="panel-body">
		<div class="col-md-6">
			<form id="formClassUpdate" action="ajaxUpdateClassItem()" method="POST">
				<div class="form-group">
					<label for="classID">CHỌN ID CẦN SỬA</label>
					<select id="classID" class="form-control">
						<?php 
							foreach ($DBClass as $key => $value) {
								echo 
									'<option value="'.$value['class_id'].'" selected>'.$value['class_id'].'</option>';
							}
						?>
					</select>
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
					<label for="level">Cấp độ</label>
					<select name="level" id="level" class="form-control">
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
		$('#formClassUpdate').find('#classID').on('change', function(evt) {
	      var $target = $(evt.currentTarget);
	      var class_id = $('#classID').find('option:selected').val();
	      loadItemClass(class_id);
	  });
	}
);
function loadItemClass(class_id)
{
	$.ajax({
      type: "POST",
      url: '<?php echo $ajaxLoadItemClass; ?>', 
      data: {class_id:class_id},
      dataType: 'json',
	}).done(function(data) {
		var ketqua=data.ketqua;
	  	var i;
	  	for(i=0;i < ketqua.length;i++)
	  	{
	  		$('#className').val(ketqua[i].class_name);
	  		$('#classDescription').val(ketqua[i].class_description);
	  		$('#classOpen').val(ketqua[i].class_open);
	  		$('#classFinish').val(ketqua[i].class_finish);
	  		$('#level').val(ketqua[i].level_id);
	  		$('#courseID').val(ketqua[i].course_id);
	  	}
	});
}
var frm = $('#formClassUpdate');
frm.submit(function (e) {
e.preventDefault();
	var class_id = $('#classID').find('option:selected').val(),
		class_name =$('#className').val(),
		class_description =$('#classDescription').val(),
		class_open =$('#classOpen').val(),
		class_finish =$('#classFinish').val(),
		level_id = $('#level').find('option:selected').val(),
		course_id = $('#courseID').find('option:selected').val();
		data = {
			class_id:class_id,
			class_name:class_name,
			class_description:class_description,
			class_open:class_open,
			class_finish:class_finish,
			level_id:level_id,
			course_id:course_id
		};
$.ajax({
  type: "POST",
  url: '<?php echo $ajaxUpdateClassItem; ?>', 
  data: data,
  dataType: 'json',
	}).done(function(data) {
		var kq = data.kq;
	  	if(kq > 0)
	  	{
	  		alert("Sửa thông tin thành công  !");
	  		window.location.href='<?php echo $pageClass; ?>';
	  	}
	  	else
	  	{
	  		alert("Sửa không thành công ");
	  	}
	});
});
</script>