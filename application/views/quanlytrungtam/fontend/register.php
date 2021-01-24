<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" >
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-folder-o"></em>
			</a></li>
			<li class="active">Register</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Ghi danh học viên</h1>
		</div>
	</div>
	<div class="panel-body">
		<div class="col-md-6">
			<form id="formRegister" action="ajaxRegister" method="POST">
				<div class="form-group">
					<label>Danh sách lớp học</label>
					<select class="form-control" id="item_class_name">
					<?php 
						foreach ($dataClass as $key => $value) {
							$className = $value['class_name'];
							echo '<option id="class_name'.$value['class_id'].'" class_id="'.$value['class_id'].'">'.$className.'</option>';
						}
					?>
					</select>
					<button type="button" class="btn btn-link" data-toggle="modal" data-target="#PopupClassModal" onclick="detailItem()">Xem Chi Tiết</button>
				</div>
				<div class="form-group">
					<label>Tên học viên</label>
					<select class="form-control" id="item_student_name">
					<?php 
						foreach ($dataStudent as $key => $value) {
							$studentName = $value['student_name'];
							echo '<option id="student_name'.$value['student_id'].'" student_id="'.$value['student_id'].'" >'.$studentName.'</option>';
						}
					?>
					</select>
					<button type="button" class="btn btn-link" data-toggle="modal" data-target="#PopupStudentModal" onclick="detailItemStudent()">Xem Chi Tiết</button>
				</div>
				<!-- <div class="form-group">
					<label>Chọn giáo viên</label>
					<select class="form-control" id="item_teacher_name">
					<?php 
						foreach ($dataTeacher as $key => $value) {
							$teacherName = $value['teacher_name'];
							echo '<option id="teacher_name'.$value['teacher_id'].'">'.$teacherName.'</option>';
						}
					?>
					</select>
					<button type="button" class="btn btn-link" data-toggle="modal" data-target="#PopupTeacherModal" onclick="detailItemTeacher()">Xem Chi Tiết</button>
				</div> -->
				<div class="form-group">
					<label>Phần trăm tiền</label>
					<input type='number' class="form-control" placeholder="100% là đã trả đủ" id="precent_debt" min="50" max="100" require>
				</div>
				<div class="form-group">
					<label>Chọn ca học</label>
					<select class="form-control" id="item_shift_name">
					<?php 
						foreach ($dataShift as $key => $value) {
							$shiftName = $value['shift_name'];
							echo '<option id="shift_name'.$value['shift_id'].'" shiftID = "'.$value['shift_id'].'">'.$shiftName.'</option>';
						}
					?>
					</select>
					<button type="button" class="btn btn-link" data-toggle="modal" data-target="#PopupShiftModal" onclick="detailItemShift()">Xem Chi Tiết</button>
				</div>
				<button class ="btn btn-primary btn-md">SAVE</a></button>
			</form>
			<div class="alert bg-info hidden" role="alert" id="success"><em class="fa fa-lg fa-warning">&nbsp;</em> Đã đăng ký thành công ! <em class="fa fa-lg fa-close"></em></a></div>
			<div class="alert bg-info hidden" role="alert" id="fail-shift"><em class="fa fa-lg fa-warning">&nbsp;</em> Đã trùng lịch vui lòng kiểm tra lại ! <em class="fa fa-lg fa-close"></em></a></div>
			<div class="alert bg-teal hidden" role="alert" id="fail"><em class="fa fa-lg fa-warning">&nbsp;</em> Lớp đã đăng ký rồi ! <em class="fa fa-lg fa-close"></em></a></div>
		</div>
	</div>
	<!-- Modal Class-->
	<!-- <div class="modal fade" id="PopupCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Thông Tin Khóa Họcc</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form id="formPopupClass">
				<div class="form-group">
					<label for="courseID">Mã Khóa Học</label>
					<input type="text" id="courseID" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="courseName">Tên Khóa Học</label>
					<input type="text" id="courseName" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="courseStart">Ngày bắt đầu</label>
					<input type="date" id="courseStart" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="courseEnd">Ngày kết thúc</label>
					<input type="date" id="courseEnd" name="courseEnd" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="coursePrice">Giá</label>
					<input type="number" id="coursePrice" name="coursePrice" class="form-control" required>
				</div>
			</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
	  </div>
	</div> -->
	<!-- Modal Class-->
	<div class="modal fade" id="PopupClassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Thông Tin Lớp Học</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form id="formPopupClass">
				<div class="form-group">
					<label for="classID">Mã lớp</label>
					<input type="text" id="classID" class="form-control" required>
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
					<input type="date" id="classLevel" name="classLevel" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Khóa học</label>
					<input type="date" id="classCourse" name="classCourse" class="form-control" required>
				</div>
			</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Student-->
	<div class="modal fade" id="PopupStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Thông Tin Học Viên</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form id="formPopupStudent">
				<div class="form-group">
					<label for="studentID">MSSV</label>
					<input type="text" id="studentID" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="studentName">Tên học viên</label>
					<input type="text" id="studentName" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="studentOld">Tuổi</label>
					<input type="text" id="studentOld" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="studentSex">Giới tính</label>
					<input type="text" id="studentSex" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="studentAddress">Địa chỉ</label>
					<input type="text" id="studentAddress" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="studentEmail">Email</label>
					<input type="text" id="studentEmail" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="studentPhone">Số điện thoại</label>
					<input type="text" id="studentPhone" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="studentLevel">Cấp độ</label>
					<input type="text" id="studentLevel" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="studentIdentitycard">CMND</label>
					<input type="text" id="studentIdentitycard" class="form-control" required>
				</div>

			</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Teacher-->
	<!-- <div class="modal fade" id="PopupTeacherModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Thông Tin Học Viên</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form id="formPopupTeacher">
				<div class="form-group">
					<label for="teacherID">MSSV</label>
					<input type="text" id="teacherID" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="teacherName">Tên học viên</label>
					<input type="text" id="teacherName" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="teacherOld">Tuổi</label>
					<input type="text" id="teacherOld" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="teacherSex">Giới tính</label>
					<input type="text" id="teacherSex" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="teacherAddress">Địa chỉ</label>
					<input type="text" id="teacherAddress" class="form-control" required>
				</div>
			</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
	  </div>
	</div> -->
	<!-- Modal Shift-->
	<div class="modal fade" id="PopupShiftModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Thông Tin Học Viên</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form id="formPopupShift">
				<div class="form-group">
					<label for="shiftID">ID</label>
					<input type="text" id="shiftID" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="shiftName">CA</label>
					<input type="text" id="shiftName" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="timeIn">Tuổi</label>
					<input type="time" id="timeIn" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="timeOut">Giới tính</label>
					<input type="time" id="timeOut" class="form-control" required>
				</div>
			</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
	  </div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(	
	function()
	{

	});
	// function detailItemCourse()
	// {
	// 	var name = $('#item_course_name').find('option:selected').val();
	// 	$.ajax({
	//       type: "POST",
	//       url: '<?php echo $ajaxDetailCourse; ?>', 
	//       data: {course_name:name},
	//       dataType: 'json',
	//  	}).done(function(data) {
	//  		ketqua = data.ketqua;
	//  		for(var i = 0; i < ketqua.length; i++)
	//  		{
	//  			$('#courseID').val(ketqua[i].course_id);
	//  			$('#courseName').val(ketqua[i].course_name);
	//  			$('#courseStart').val(ketqua[i].course_start);
	//  			$('#courseEnd').val(ketqua[i].course_end);
	//  			$('#coursePrice').val(ketqua[i].course_price);
	//  		}
	//  	});
	// }
	function detailItem()
	{
		var name = $('#item_class_name').find('option:selected').val();
		$.ajax({
	      type: "POST",
	      url: '<?php echo $ajaxDetailClass; ?>', 
	      data: {class_name:name},
	      dataType: 'json',
	 	}).done(function(data) {
	 		ketqua = data.ketqua;
	 		for(var i = 0; i < ketqua.length; i++)
	 		{
	 			$('#classID').val(ketqua[i].class_id);
	 			$('#className').val(ketqua[i].class_name);
	 			$('#classDescription').val(ketqua[i].class_description);
	 			$('#classOpen').val(ketqua[i].class_open);
	 			$('#classFinish').val(ketqua[i].class_finish);
	 			$('#classLevel').val(ketqua[i].level_id);
	 			$('#classCourse').val(ketqua[i].course_id);
	 		}
	 	});
	}

	function detailItemStudent()
	{
		var name = $('#item_student_name').find('option:selected').val();
		$.ajax({
	      type: "POST",
	      url: '<?php echo $ajaxDetailStudent; ?>', 
	      data: {student_name:name},
	      dataType: 'json',
	 	}).done(function(data) {
	 		ketqua = data.ketqua;
	 		for(var i = 0; i < ketqua.length; i++)
	 		{
	 			$('#studentID').val(ketqua[i].student_id);
	 			$('#studentName').val(ketqua[i].student_name);
	 			$('#studentOld').val(ketqua[i].student_old);
	 			$('#studentSex').val(ketqua[i].student_sex);
	 			$('#studentAddress').val(ketqua[i].student_address);
	 			$('#studentEmail').val(ketqua[i].student_email);
	 			$('#studentPhone').val(ketqua[i].student_phone);
	 			$('#studentLevel').val(ketqua[i].student_level);
	 			$('#studentIdentitycard').val(ketqua[i].student_identitycard);
	 		}
	 	});
	}

	// function detailItemTeacher()
	// {
	// 	var name = $('#item_teacher_name').find('option:selected').val();
	// 	$.ajax({
	//       type: "POST",
	//       url: '<?php echo $ajaxDetailTeacher; ?>', 
	//       data: {teacher_name:name},
	//       dataType: 'json',
	//  	}).done(function(data) {
	//  		ketqua = data.ketqua;
	//  		for(var i = 0; i < ketqua.length; i++)
	//  		{
	//  			$('#teacherID').val(ketqua[i].teacher_id);
	//  			$('#teacherName').val(ketqua[i].teacher_name);
	//  			$('#teacherOld').val(ketqua[i].teacher_old);
	//  			$('#teacherSex').val(ketqua[i].teacher_sex);
	//  			$('#teacherAddress').val(ketqua[i].teacher_address);
	//  		}
	//  	});
	// }
	function detailItemShift()
	{
		var name = $('#item_shift_name').find('option:selected').val();
		$.ajax({
	      type: "POST",
	      url: '<?php echo $ajaxDetailShift; ?>', 
	      data: {shift_name:name},
	      dataType: 'json',
	 	}).done(function(data) {
	 		ketqua = data.ketqua;
	 		for(var i = 0; i < ketqua.length; i++)
	 		{
	 			$('#shiftID').val(ketqua[i].shift_id);
	 			$('#shiftName').val(ketqua[i].shift_name);
	 			$('#timeIn').val(ketqua[i].time_in);
	 			$('#timeOut').val(ketqua[i].time_out);
	 		}
	 	});
	}
	var frm = $('#formRegister');
	frm.submit(function (e) {
	e.preventDefault();
		var student_id = $('#item_student_name').find('option:selected').attr("student_id"),
			student_name = $('#item_student_name').find('option:selected').val(),
			class_id = $('#item_class_name').find('option:selected').attr("class_id"),
			class_name = $('#item_class_name').find('option:selected').val(),
			// course_id = $('#item_course_name').find('option:selected').attr("courseID"),
			// course_name = $('#item_course_name').find('option:selected').val(),
			// level_id = $('#item_level_name').find('option:selected').val(),
			// teacher_name = $('#item_teacher_name').find('option:selected').val(),
			shift_id = $('#item_shift_name').find('option:selected').attr("shiftID"),
			shift_name = $('#item_shift_name').find('option:selected').val(),
			precent_debt = $('#precent_debt').val();
			var data = {
				student_id:student_id,
				student_name:student_name,
				class_id:class_id,
				class_name:class_name,
				// course_id:course_id,
				// course_name:course_name,
				// level_id:level_id, 
				// teacher_name:teacher_name, 
				shift_name:shift_name,
				shift_id:shift_id,
				precent_debt: precent_debt, 
			};
		
	$.ajax({
	  type: "POST",
	  url: '<?php echo $ajaxRegister; ?>', 
	  data: data,
	  dataType: 'json',
		}).done(function(data) {
			var kq = data.ketqua;
		  	if(kq > 0)
		  	{
		  		if(kq > 1)
		  		{
		  			$('#fail-shift').removeClass('hidden');
		  		}
		  		else
		  		{
		  			$('#success').removeClass('hidden');
		  		}
		  		//alert("Đã thêm cấu hình thành công !");
		  	}
		  	else
		  	{
		  		// alert("Thêm cấu hình không thành công !");
		  		$('#fail').removeClass('hidden');
		  	}
		});
	});
</script>