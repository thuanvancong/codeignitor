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
			<h1 class="page-header">Khóa học</h1>
		</div>
	</div>
	<div class="row">
		<div class="course">
			<div class="row">
				<div class="col-md-2">
					<label for="courseID">ID</label>
				</div>
				<div class="col-md-10">
					<input type="number" id="courseID"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="courseName">Tên khóa học</label>
				</div>
				<div class="col-md-10">
					<input type="text" id="courseName"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="coursePrice">Giá khóa học</label>
				</div>
				<div class="col-md-10">
					<input type="number" id="coursePrice"><br>
				</div>
			</div>
			<button onclick="ajaxCreateCourse()">Tạo</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	function ajaxCreateCourse()
	{
		var courseID = $('#courseID').val();
		var courseName = $('#courseName').val();
		var coursePrice = $('#coursePrice').val();
		data={course_name: courseName, course_price: coursePrice};
		$.ajax({
	      type: "POST",
	      url: '<?php echo $ajaxCreateCourse; ?>', 
	      data: data,
	      dataType: 'json',
	 	}).done(function(data) {
	 		var kq = data.ketqua;
		  	if(kq == 1)
		  	{
		  		alert("Tạo khóa học thành công  !");
		  		window.location.href='<?php echo $pageCourse; ?>';
		  	}
		  	else
		  	{
		  		alert("Tạo khóa học không thành công !");
		  	}
	 	});
	}
</script>