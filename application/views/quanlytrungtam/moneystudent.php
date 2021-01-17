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
		<div class="col-md-8">
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
</script>