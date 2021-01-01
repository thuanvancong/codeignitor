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
	<div class="panel-body">
		<div class="col-md-6">
			<form id="formStudentUpdate" action="ajaxUpdateStudentItem()" method="POST">
				<div class="form-group">
					<label for="studentID">CHỌN ID CẦN SỬA</label>
					<select class="form-control" id="studentID">
						<?php 
							foreach ($DBStudent as $key => $value) {
								echo '<option value="'.$value['student_id'].'" selected>'.$value['student_id'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="studentName">Tên học viên</label>
					<input type="text" id="studentName" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="studentOld">Tuổi</label>
					<input type="number" id="studentOld" class="form-control" required>
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
					<input type="email" id="studentEmail" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="studentPhone">SDT</label><br>
					<input type="number" id="studentPhone" name="studentPhone" class="form-control" required>
				</div>
				<button class ="btn btn-primary btn-md">SAVE</a></button>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(	
	function(){
		$('#formStudentUpdate').find('#studentID').on('change', function(evt) {
	      var $target = $(evt.currentTarget);
	      var student_id = $('#studentID').find('option:selected').val();
	      loadItemStudent(student_id);
	  });
	}
);
function loadItemStudent(student_id)
{
	$.ajax({
      type: "POST",
      url: '<?php echo $ajaxLoadItemStudent; ?>', 
      data: {student_id:student_id},
      dataType: 'json',
	}).done(function(data) {
		var ketqua=data.ketqua;
	  	var i;
	  	for(i=0;i < ketqua.length;i++)
	  	{
	  		$('#studentName').val(ketqua[i].student_name);
	  		$('#studentOld').val(ketqua[i].student_old);
	  		$('#studentSex').val(ketqua[i].student_sex);
	  		$('#studentAddress').val(ketqua[i].student_address);
	  		$('#studentEmail').val(ketqua[i].student_email);
	  		$('#studentPhone').val(ketqua[i].student_phone);
	  	}
	});
}
var frm = $('#formStudentUpdate');
frm.submit(function (e) {
e.preventDefault();
	var student_id = $('#studentID').val(),
			student_name = $('#studentName').val(),
			student_old = $('#studentOld').val(),
			student_sex = $('#studentSex').val(),
			student_address = $('#studentAddress').val(),
			student_email = $('#studentEmail').val();
			student_phone =$('#studentPhone').val()
	var data = 
	{
		student_id:student_id,
		student_name:student_name, 
		student_old:student_old,
		student_sex:student_sex, 
		student_address: student_address, 
		student_email: student_email,
		student_phone:student_phone
	};
$.ajax({
  type: "POST",
  url: '<?php echo $ajaxUpdateStudentItem; ?>', 
  data: data,
  dataType: 'json',
	}).done(function(data) {
		var kq = data.kq;
	  	if(kq > 0)
	  	{
	  		alert("Sửa thông tin thành công  !");
	  		window.location.href='<?php echo $pageStudent; ?>';
	  	}
	  	else
	  	{
	  		alert("Sửa không thành công ");
	  	}
	});
});
</script>