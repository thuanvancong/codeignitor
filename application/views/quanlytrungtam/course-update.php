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
			<form id="formCourseUpdate" action="ajaxUpdateCourseItem()" method="POST">
				<div class="form-group">
					<label for="courseID">ID</label>
					<select id="courseID" class="form-control">
						<?php 
							foreach ($DBCourse as $key => $value) {
								echo '<option value="'.$value['course_id'].'" selected>'.$value['course_id'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="courseName">Tên khóa học</label>
					<input type="text" id="courseName" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="coursePrice">Giá khóa học</label>
					<input type="number" id="coursePrice" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="courseStart">Thời gian bắt đầu</label>
					<input type="date" id="courseStart" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="courseEnd">Thời gian kết thúc</label>
					<input type="date" id="courseEnd" class="form-control" required>
				</div>
				<button class ="btn btn-primary btn-md">SAVE</a></button>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(	
	function(){
		$('#formCourseUpdate').find('#courseID').on('change', function(evt) {
	      var $target = $(evt.currentTarget);
	      var id = $('#courseID').find('option:selected').val();
	      loadItemCourse(id);
	    });
	}
);

function loadItemCourse(id)
{	
	$.ajax({
      type: "POST",
      url: '<?php echo $ajaxLoadItemCourse; ?>', 
      data: {course_id:id},
      dataType: 'json',
	}).done(function(data) {
		var ketqua=data.ketqua;
	  	var i;
	  	for(i=0;i < ketqua.length;i++)
	  	{
	  		$('#courseName').val(ketqua[i].course_name);
	  		$('#coursePrice').val(ketqua[i].course_price);
	  		$('#courseStart').val(ketqua[i].course_start);
	  		$('#courseEnd').val(ketqua[i].course_end);
	  	}
	});
}

var frm = $('#formCourseUpdate');
frm.submit(function (e) {
    e.preventDefault();
    var course_id = $('#courseID').find('option:selected').val();
	data = {
		course_id : course_id,
		course_name : $('#courseName').val(),
		course_price : $('#coursePrice').val(),
		course_end : $('#courseEnd').val(),
		course_start : $('#courseStart').val(),
	}
    $.ajax({
      type: "POST",
      url: '<?php echo $ajaxUpdateCourseItem; ?>', 
      data: data,
      dataType: 'json',
 	}).done(function(data) {
 		var kq = data.kq;
	  	if(kq == 1)
	  	{
	  		alert("Sửa thông tin thành công  !");
	  		window.location.href='<?php echo $pageCourse; ?>';
	  	}
	  	else
	  	{
	  		alert("Sửa không thành công");
	  	}
 	});
});

// function ajaxUpdateCourseItem()
// {
// 	var course_id = $('#courseID').find('option:selected').val();
// 	data = {
// 		course_id : course_id,
// 		course_name : $('#courseName').val(),
// 		course_price : $('#coursePrice').val(),
// 	}
// 	$.ajax({
//       type: "POST",
//       url: '<?php echo $ajaxUpdateCourseItem; ?>', 
//       data: data,
//       dataType: 'json',
// 	}).done(function(data) {
// 		var kq = data.kq;
// 	  	if(kq == 1)
// 	  	{
// 	  		alert("Sửa thông tin thành công  !");
// 	  		window.location.href='<?php echo $pageCourse; ?>';
// 	  	}
// 	  	else
// 	  	{
// 	  		alert("Sửa không thành công");
// 	  	}
// 	});
// }
</script>