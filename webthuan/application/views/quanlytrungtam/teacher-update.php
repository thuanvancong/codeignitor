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
	<div class="row">
		<div class="" id="teacherItem">
			<div class="row">
				<div class="col-md-2">
					<label for="teacherID">CHỌN ID CẦN SỬA</label>
				</div>
				<div class="col-md-10">
					<select id="teacherID">
						<?php 
							foreach ($DBTeacher as $key => $value) {
								echo 
									'<option value="'.$value['teacher_id'].'" selected>'.$value['teacher_id'].'</option>';
							}
						?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="teacherName">Tên học viên</label>
				</div>
				<div class="col-md-10">
					<input type="text" id="teacherName"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="teacherOld">Tuổi</label>
				</div>
				<div class="col-md-10">
					<input type="number" id="teacherOld"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="teacherSex">Giới tính</label><br>
				</div>
				<div class="col-md-10">
					<input type="text" id="teacherSex" name="teacherSex">
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="teacherAddress">Địa chỉ</label><br>
				</div>
				<div class="col-md-10">
					<input type="text" id="teacherAddress" name="teacherAddress">
				</div>
			</div>
			<button onclick="ajaxUpdateTeacherItem()">SỬA THÔNG TIN</button>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(	
	function(){
		$('#teacherItem').find('#teacherID').on('change', function(evt) {
	      var $target = $(evt.currentTarget);
	      var teacher_id = $('#teacherID').find('option:selected').val();
	      loadItemTeacher(teacher_id);
	  });
	}
);
function loadItemTeacher(teacher_id)
{
	$.ajax({
      type: "POST",
      url: '<?php echo $ajaxLoadItemTeacher; ?>', 
      data: {teacher_id:teacher_id},
      dataType: 'json',
	}).done(function(data) {
		var ketqua=data.ketqua;
	  	var i;
	  	for(i=0;i < ketqua.length;i++)
	  	{
	  		$('#teacherName').val(ketqua[i].teacher_name);
	  		$('#teacherOld').val(ketqua[i].teacher_old);
	  		$('#teacherSex').val(ketqua[i].teacher_sex);
	  		$('#teacherAddress').val(ketqua[i].teacher_address);
	  	}
	});
}
function ajaxUpdateTeacherItem()
{
	var teacher_id = $('#teacherID').val(),
		teacher_name = $('#teacherName').val(),
		teacher_old = $('#teacherOld').val(),
		teacher_sex = $('#teacherSex').val(),
		teacher_address = $('#teacherAddress').val()
	var data = 
	{
		teacher_id:teacher_id,
		teacher_name:teacher_name, 
		teacher_old:teacher_old, 
		teacher_sex:teacher_sex, 
		teacher_address: teacher_address
	};
	$.ajax({
      type: "POST",
      url: '<?php echo $ajaxUpdateTeacherItem; ?>', 
      data: data,
      dataType: 'json',
	}).done(function(data) {
		var kq = data.kq;
		console.log(kq);
	  	if(kq > 0)
	  	{
	  		alert("Sửa thông tin thành công  !");
	  		window.location.href='<?php echo $pageTeacher; ?>';
	  	}
	  	else
	  	{
	  		alert("Sửa không thành công ");
	  	}
	});
}
</script>