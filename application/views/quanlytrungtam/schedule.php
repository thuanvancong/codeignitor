<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" >
	<div class="row">
		<div class="panel panel-info">
			<div class="panel-heading">Lịch Học Các Lớp</div>
			<div class="panel-body">
				<div class="form-group">
					<label>Chọn Chủ Đề</label>
					<div class="radio">
						<label>
							<input type="radio" name="optionsRadios" id="optionsRadiosStudent" value="student" checked="">Thời Khóa Biểu Theo Học Sinh
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="optionsRadios" id="optionsRadiosClass" value="class" checked="">Thời Khóa Biểu Lớp
						</label>
					</div>
					<h4>Filter</h4> 
					<input class="form-control" id="filterInput" type="text" placeholder="Search..">
				</div>
				<div class="row">
					<div class="input-group hidden" id="schedule-student">
						<input id="input-ID-student" type="number" class="form-control input-md" placeholder="Nhập CMND Sinh Vien">
						<span class="input-group-btn">
							<button class="btn btn-primary btn-md" id="btn-chat" onclick="ajaxScheduleStudent()" >GỬI</button>
						</span>
					</div>
				</div>
				<div class="row">
					<form id="formScheduleClass" action="ajaxScheduleClass()" method="POST">
						<div class="form-group hidden" id="schedule-class">
							<label>Chọn Lớp</label>
							<select class="form-control">
								<?php 
								foreach ($dbClass as $key => $value) {
									echo 
									'
										<option class="option-class-name" value="'.$value['class_id'].'" class_level="'.$value['level_id'].'" selected="selected">'.$value['class_name'].'</option>
									';
								}
								?>
							</select>
							<button class="btn btn-primary btn-md" id="btn-chat">GỬI</button>
						</div>
					</form>
						<!-- <input id="input-ID-class" type="text" class="form-control input-md" placeholder="Nhập Lớp">
						<span class="input-group-btn">
							<button class="btn btn-primary btn-md" id="btn-chat" onclick="ajaxScheduleClass()">GỬI</button>
						</span> -->

					</div>
				</div>
				<div class="row">
					<table style="width:100%" id="table-schedule-student" class="table table-striped hidden">
						<thead>
							<tr>
							    <th>Lớp</th>
							    <th>Tên Học Viên</th> 
							    <th>Thời Gian Vào</th>
							    <th>Thời Gian Ra</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								
							</tr>
						</tbody>
					</table>
				</div>
				<div class="row">
					<table style="width:100%" id="table-schedule-class" class="table table-striped hidden">
						<thead>
							<tr>
							    <th>Lớp</th>
							    <th>Tên Học Viên</th> 
							    <th>Thời Gian Vào</th>
							    <th>Thời Gian Ra</th>
							</tr>
						</thead>
						<tbody>
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
			$( "input" ).on( "click", function() {
				$('#schedule-student').addClass('hidden');
				$('#schedule-class').addClass('hidden');
			  	var key = $( "input:checked" ).val();
			  	showScheduleByRadio(key);
			});
			$(document).ready(function(){
			  $("#filterInput").on("keyup", function() {
			    var value = $(this).val().toLowerCase();
			    $("#table-schedule-student tr").filter(function() {
			      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			    });
			    $("#table-schedule-class tr").filter(function() {
			      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			    });
			  });
			});
		}
	);

	function showScheduleByRadio(key_radio)
	{
		if(key_radio == 'student')
		{
			$('#schedule-student').removeClass('hidden');
		}
		if(key_radio == 'class')
		{
			$('#schedule-class').removeClass('hidden');
		}
	}

	function ajaxScheduleStudent()
	{
		var schedule_student = $('#input-ID-student').val();
		$.ajax({
			method: "POST",
			url: '<?php echo $ajaxScheduleStudent; ?>', 
			dataType:'json',
			data:{schedule_student:schedule_student}
		}).done(function(data){
			var ketqua = data.ketqua,
				htmlString = '';
			$('#table-schedule-student').removeClass('hidden');
			var i;
			for(i = 0;i < ketqua.length;i++)
			{
				htmlString = '<tr><td id="schedule_class_id"'+ketqua[i].student_id+'>'+ketqua[i].class_name+'</td><td id="schedule_student_id"'+ketqua[i].student_id+'>'+ketqua[i].student_name+'</td><td id="schedule_student_id"'+ketqua[i].student_id+'>'+ketqua[i].time_in+'</td><td id="schedule_student_id"'+ketqua[i].student_id+'>'+ketqua[i].time_out+'</td></tr>';
				$('#table-schedule-student').find('tbody').append(htmlString);
			}
		});
	}
	var frm = $('#formScheduleClass');
	frm.submit(function (e) {
	e.preventDefault();
		var level_id = $('#schedule-class').find('option:selected').attr("class_level"),
			schedule_class = $('#schedule-class').find('option:selected').val(),
			data = {
				level_id:level_id,
				schedule_class:schedule_class
			};
		$.ajax({
			method: "POST",
			url: '<?php echo $ajaxScheduleClass; ?>', 
			dataType:'json',
			data:data
		}).done(function(data){
			var ketqua = data.ketqua,
				htmlString = '';
			$('#table-schedule-class').removeClass('hidden');
			var i;
			for(i = 0;i < ketqua.length;i++)
			{
				htmlString = '<tr><td id="schedule_class_id"'+ketqua[i].student_id+'>'+ketqua[i].class_name+'</td><td id="schedule_student_id"'+ketqua[i].student_id+'>'+ketqua[i].student_name+'</td><td id="schedule_student_id"'+ketqua[i].student_id+'>'+ketqua[i].time_in+'</td><td id="schedule_student_id"'+ketqua[i].student_id+'>'+ketqua[i].time_out+'</td></tr>';
				$('#table-schedule-class').find('tbody').append(htmlString);
			}
		});
	});
	// function ajaxScheduleClass()
	// {
	// 	var level_id = $('#schedule-class').find('option:selected').attr("level_id"),
	// 		schedule_class = $('#schedule-class').find('option:selected').val(),
	// 	$.ajax({
	// 		method: "POST",
	// 		url: '<?php echo $ajaxScheduleClass; ?>', 
	// 		dataType:'json',
	// 		data:{schedule_class:schedule_class}
	// 	}).done(function(data){
	// 		var ketqua = data.ketqua,
	// 			htmlString = '';
	// 		$('#table-schedule-student').removeClass('hidden');
	// 		var i;
	// 		for(i = 0;i < ketqua.length;i++)
	// 		{
	// 			htmlString = '<tr><td id="schedule_class_id"'+ketqua[i].student_id+'>'+ketqua[i].class_name+'</td><td id="schedule_student_id"'+ketqua[i].student_id+'>'+ketqua[i].student_name+'</td><td id="schedule_student_id"'+ketqua[i].student_id+'>'+ketqua[i].teacher_name+'</td><td id="schedule_student_id"'+ketqua[i].student_id+'>'+ketqua[i].time_in+'</td><td id="schedule_student_id"'+ketqua[i].student_id+'>'+ketqua[i].time_out+'</td></tr>';
	// 			$('#table-schedule-student').find('tbody').append(htmlString);
	// 		}
	// 	});
	// }
</script>