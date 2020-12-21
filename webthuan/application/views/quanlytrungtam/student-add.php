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
		<div class="class">
			<div class="row">
				<div class="col-md-2">
					<label for="studentID">ID</label>
				</div>
				<div class="col-md-10">
					<input type="number" id="studentID"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="studentName">Tên học viên</label>
				</div>
				<div class="col-md-10">
					<input type="text" id="studentName"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="studentOld">Tuổi</label>
				</div>
				<div class="col-md-10">
					<input type="number" id="studentOld"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="studentSex">Giới tính</label><br>
				</div>
				<div class="col-md-10">
					<input type="text" id="studentSex" name="studentSex">
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="studentAddress">Địa chỉ</label><br>
				</div>
				<div class="col-md-10">
					<input type="text" id="studentAddress" name="studentAddress">
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="studentEmail">Email</label><br>
				</div>
				<div class="col-md-10">
					<input type="email" id="studentEmail" name="studentEmail">
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="studentPhone">SDT</label><br>
				</div>
				<div class="col-md-10">
					<input type="number" id="studentPhone" name="studentPhone">
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="studentLevel">Cấp độ học viên</label><br>
				</div>
				<div class="col-md-10">
					<select name="studentLevel" id="studentLevel">
					<?php
					foreach ($DBLevel as $key => $value) {
						echo '<option value="'.$value['level_id'].'" selected="selected">'.$value['level_number'].'</option>';
					}
					?>
					</select>
				</div>
			</div>
			<button onclick="ajaxCreateStudent()">Tạo</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(	
		function(){
			
		}
	);
	function ajaxCreateStudent()
	{

		var student_id = $('#studentID').val(),
			student_name = $('#studentName').val(),
			student_old = $('#studentOld').val(),
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
		  		alert("Tạo menu không thành công !");
		  	}
	  	});
	}
</script>