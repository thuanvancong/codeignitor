<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" >
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-folder-o"></em>
			</a></li>
			<li class="active">PHÂN HỆ TIỀN</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Quản Lý Thu Chi Công Nợ</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-warning">
				<div class="panel-heading">QUẢN LÝ CÔNG NỢ HỌC SINH</div>
				<div class="panel-body">
					<h2>Filter</h2> 
					<input class="form-control" id="myInput" type="text" placeholder="Search..">
					<table id="table-money-student" class="table table-striped">
						<thead>
							<tr>
							    <th>TÊN HỌC VIÊN</th>
							    <th>CMND</th> 
							    <th>LỚP</th>
							    <th>TIỀN HỌC PHÍ</th>
							    <th>TIỀN NỢ</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach ($dbExtend as $key => $value) {
									$money_debt = 100 - $value['precent_debt'];
									echo 
									'<tr>
										<td id="student-name'.$value['student_identitycard'].'" class="student-name">'.$value['student_name'].'</td>
										<td id="student-identitycard'.$value['student_identitycard'].'" class="student-identitycard">'.$value['student_identitycard'].'</td>
										<td id="class-name'.$value['class_id'].'" class="class-name">'.$value['class_name'].'</td>
										<td id="precent_pay'.$value['student_identitycard'].'" class="precent_pay">'.$value['precent_debt'].'</td>
										<td id="precent_debt'.$value['student_identitycard'].'" class="precent_debt">'.$money_debt.'</td>';

								}
								echo'</tr>';
							?> 
						</tbody>
					</table>
					<button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#PopupPaymentDebt" onclick="">THANH TOÁN TIỀN NỢ</button>
				</div>
			</div>
		</div>
	</div>
	<!-- POPUP PAYMENT DEBT-->
	<div class="modal fade" id="PopupPaymentDebt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">THÔNG TIN</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form id="formPopupPayment">
				<div class="form-group">
					<label for="studentIdentitycard">Nhập CMND</label>
					<input type="text" id="studentIdentitycard" class="form-control"  ClassStudentID=0 required>
				</div>
				<div class="form-group">
					<label for="className">Nhập Tên Lớp</label>
					<input type="text" id="className" class="form-control" required>
					<button type="button" class="btn btn-link fa fa-arrow-right" onclick="detailItemPaymenyt()"> Lấy thông tin</button>
				</div>
				<div class="form-group">
					<label for="precentDebt">Phần Trăm Đã Đóng</label>
					<input type="number" id="precentDebt" class="form-control">
				</div>
				<div class="form-group">
					<label for="precentPayment">Số Tiền Còn Lại</label>
					<input type="number" id="precentPayment" class="form-control">
				</div>
			</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" onclick="ajaxUpdatePaymentDebt()" >Save changes</button>
	      </div>
	    </div>
	  </div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#table-money-student tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

// lấy thông tin 
function detailItemPaymenyt()
{
	var studentIdentitycard = $('#studentIdentitycard').val(),
		className = $('#className').val();
	var data = {
		studentIdentitycard: studentIdentitycard,
		className : className
	};
	$.ajax({
	  type: "POST",
	  url: '<?php echo $ajaxDetailPayment; ?>', 
	  data: data,
	  dataType: 'json',
	}).done(function(data) {
		var ketqua = data.ketqua;
		if(ketqua.length > 0)
		{ 
			for(var i = 0; i < ketqua.length; i++)
			{
				var precent_pay = 100-ketqua[i].precent_debt;
				$('#precentDebt').val(ketqua[i].precent_debt);
				$('#precentPayment').val(precent_pay);
				$('#studentIdentitycard').attr("ClassStudentID",ketqua[i].class_student_id);
				if(ketqua[i].precent_debt == 100)
				{
					alert("Đã Thanh Toán Đủ");
				}
			}	
		}
		else
		{
			alert("Sai thông tin vui lòng kiểm tra lại");
		}
		
	});
}

function ajaxUpdatePaymentDebt()
{
	var precentPayment = $('#precentPayment').val(),
		precentDebt = $('#precentDebt').val(),
		class_student_id = $('#studentIdentitycard').attr("ClassStudentID"),
		data = {
			precentPayment:precentPayment,
			precentDebt:precentDebt,
			class_student_id:class_student_id
		};
	$.ajax({
	  type: "POST",
	  url: '<?php echo $ajaxPayment; ?>', 
	  data: data,
	  dataType: 'json',
	}).done(function(data) {
		var ketqua = data.ketqua;
		if(ketqua == 1)
		{
		  alert("Đóng tiền thành công!");
		  window.location.href='<?php echo $pageMoneyStudent; ?>';
		}
		else
		{
			alert("Đóng tiền không thành công!");
		}
	});
}
</script>