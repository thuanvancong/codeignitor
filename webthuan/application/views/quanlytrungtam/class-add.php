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
	<div class="row">
		<div class="class">
			<div class="row">
				<div class="col-md-2">
					<label for="classID">Id</label>
				</div>
				<div class="col-md-10">
					<input type="number" id="classID"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="className">Tên class</label>
				</div>
				<div class="col-md-10">
					<input type="text" id="className"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="classDescription">Mô tả trang</label>
				</div>
				<div class="col-md-10">
					<input type="text" id="classDescription"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="classOpen">Thời gian mở lớp</label><br>
				</div>
				<div class="col-md-10">
					<input type="date" id="classOpen" name="classOpen">
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="classFinish">Thời gian kết thúc</label><br>
				</div>
				<div class="col-md-10">
					<input type="date" id="classFinish" name="classFinish">
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="level">Cấp độ</label><br>
				</div>
				<div class="col-md-10">
					<select name="level" id="level">
					<?php
					foreach ($DBLevel as $key => $value) {
						echo '<option value="'.$value['level_id'].'" selected="selected">'.$value['level_number'].'</option>';
					}
					?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="courseID">Khóa học</label><br>
				</div>
				<div class="col-md-10">
					<select name="courseID" id="courseID">
					<?php
					foreach ($DBCourse as $key => $value) {
						echo '<option value="'.$value['course_id'].'" selected="selected">'.$value['course_name'].'</option>';
					}
					?>
					</select>
				</div>
			</div>
			<button onclick="ajaxCreateclass()">Tạo</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(	
		function(){
			
		}
	);
	function ajaxCreateclass()
	{

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
	}
</script>