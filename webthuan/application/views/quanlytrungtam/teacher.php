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
		<button class ="btn btn-primary btn-md"><a href="<?php echo $pageCreateTeacher ?>">Thêm</a></button>
        <button class ="btn btn-primary btn-md"><a href="<?php echo $pageUpdateTeacher ?>">Sửa</a></button>
       <button class ="btn btn-primary btn-md"><a href="<?php echo $pageDeleteTeacher ?>">Xóa</a></button>
	</div>
	<div class="row">
		<?php 
			echo '<table style="width:90%" id="table-teacher" class="table table-striped">
			  <tr>
			    <th>ID</th>
			    <th>Tên giáo viên</th> 
			    <th>Tuổi</th>
			    <th>Giới tính</th>
			    <th>Địa chỉ</th>
			  </tr>';
			foreach ($DBTeacher as $key => $value) {
				echo 
				'
				<tr class="teacher-item" id="item'.$value['teacher_id'].'">
					<td id="teacher_id'.$value['teacher_id'].'" class="teacher_id">'.$value['teacher_id'].'</td>
					<td id="teacher_name'.$value['teacher_id'].'" class="teacher_name">'.$value['teacher_name'].'</td>
					<td id="teacher_old'.$value['teacher_id'].'" class="teacher_old">'.$value['teacher_old'].'</td>
					<td id="teacher_sex'.$value['teacher_id'].'" class="teacher_sex">'.$value['teacher_sex'].'</td>
					<td id="teacher_address'.$value['teacher_id'].'" class="teacher_address">'.$value['teacher_address'].'</td>';
			}
			echo'</tr>';
			echo'</table>';
		?>
	</div>
</div>