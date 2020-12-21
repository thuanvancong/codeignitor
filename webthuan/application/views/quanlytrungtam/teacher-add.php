<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" >
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-folder-o"></em>
			</a></li>
			<li class="active">QUẢN LÝ GIÁO VIÊN</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Giáo viên</h1>
		</div>
	</div>
	<div class="row">
		<div class="class">
			<div class="row">
				<div class="col-md-2">
					<label for="teacherID">ID</label>
				</div>
				<div class="col-md-10">
					<input type="number" id="teacherID"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="teacherName">Tên Giáo Viên</label>
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
			<button onclick="ajaxCreateTeacher()">Tạo</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(	
		function(){
			
		}
	);
	function ajaxCreateTeacher()
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
		    url: '<?php echo $ajaxCreateTeacher; ?>', 
		    data: data,
		    dataType: 'json',
		}).done(function(data) {
	 		var kq = data.ketqua;
		  	if(kq > 0)
		  	{
		  		alert("Tạo giáo viên thành công  !");
		  		window.location.href='<?php echo $pageTeacher; ?>';
		  	}
		  	else
		  	{
		  		alert("Tạo giáo viên không thành công !");
		  	}
	  	});
	}
</script>