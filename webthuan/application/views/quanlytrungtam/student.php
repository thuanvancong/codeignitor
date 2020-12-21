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
	<div class="btn">
		<button class ="btn btn-primary btn-md"><a href="<?php echo $pageCreateStudent ?>">Thêm</a></button>
        <button class ="btn btn-primary btn-md"><a href="<?php echo $pageUpdateStudent ?>">Sửa</a></button>
       <button class ="btn btn-primary btn-md"><a href="<?php echo $pageDeleteStudent ?>">Xóa</a></button>
       <button class ="btn btn-primary btn-md"><a href="<?php echo $pageUpdateLevelStudent ?>">Update Level Học Viên</a></button>
	</div>
	<div class="row">
		<?php 
			echo '<table style="width:90%" id="table-student" class="table table-striped">
			  <tr>
			    <th>ID</th>
			    <th>Tên học viên</th> 
			    <th>Tuổi</th>
			    <th>Giới tính</th>
			    <th>Địa chỉ</th>
			    <th>Email</th>
			    <th>SDT</th>
			    <th>Cấp độ hiện tại</th>
			  </tr>';
			foreach ($DBStudent as $key => $value) {
				echo 
				'
				<tr class="student-item" id="item'.$value['student_id'].'">
					<td id="student_id'.$value['student_id'].'" class="student_id">'.$value['student_id'].'</td>
					<td id="student_name'.$value['student_id'].'" class="student_name">'.$value['student_name'].'</td>
					<td id="student_old'.$value['student_id'].'" class="student_old">'.$value['student_old'].'</td>
					<td id="student_sex'.$value['student_id'].'" class="student_sex">'.$value['student_sex'].'</td>
					<td id="student_address'.$value['student_id'].'" class="student_address">'.$value['student_address'].'</td>
					<td id="student_email'.$value['student_id'].'" class="student_email">'.$value['student_email'].'</td>
					<td id="student_phone'.$value['student_id'].'" class="student_phone">'.$value['student_phone'].'</td>
					<td id="student_level'.$value['student_id'].'" class="student_level">'.$value['student_level'].'</td>';
			}
			echo'</tr>';
			echo'</table>';
		?>
	</div>
</div>
