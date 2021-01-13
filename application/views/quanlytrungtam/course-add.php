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
	<div class="panel-body">
		<div class="col-md-6">
			<form id="formCourseAdd" action="ajaxCreateCourse()" method="POST">
				<div class="form-group">
					<label for="courseID">ID</label>
					<input type="number" id="courseID" class="form-control">
				</div>
				<div class="form-group">
					<label for="courseName">Tên khóa học</label>
					<input type="text" id="courseName" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="coursePrice">Giá khóa học</label>
					<input type="number" id="coursePrice" class="form-control" required>
				</div>
				<button class ="btn btn-primary btn-md">SAVE</a></button>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
var frm = $('#formCourseAdd');
frm.submit(function (e) {
    e.preventDefault();
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
});
</script>