<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" >
	<div class="row">
		<div class="panel panel-info">
			<div class="panel-heading">Lịch Học Các Lớp</div>
			<div class="panel-body">
				<div class="row">
					<h4>Filter</h4> 
					<input class="form-control" id="filterInput" type="text" placeholder="Search..">
					<table style="width:100%" id="table-schedule-student" class="table table-striped">
						<thead>
							<tr>
							    <th>Lớp</th>
							    <th>Tên Học Viên</th>
							    <th>Ngày Bắt Đầu</th>
							    <th>Ngày Kết Thúc</th> 
							    <th>Thời Gian Vào</th>
							    <th>Thời Gian Ra</th>
							</tr>
						</thead>
						<tbody>
							<?php

								foreach ($dbSchedule as $key => $value) {
									echo 
									'<tr>
										<td id="class_name_'.$value['student_id'].'">'.$value['class_name'].'</td>
										<td id="student_name'.$value['student_id'].'">'.$value['student_name'].'</td>
										<td id="class_open'.$value['student_id'].'">'.$value['class_open'].'</td>
										<td id="class_finish'.$value['student_id'].'">'.$value['class_finish'].'</td>
										<td id="time_in'.$value['student_id'].'">'.$value['time_in'].'</td>
										<td id="time_out'.$value['student_id'].'">'.$value['time_out'].'</td>
									</tr>';
								}
								
							?>
							<tr>
								
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(
		function(){

			$(document).ready(function(){
			  $("#filterInput").on("keyup", function() {
			    var value = $(this).val().toLowerCase();
			    $("#table-schedule-student tr").filter(function() {
			      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			    });
			  });
			});
		}
	);
</script>