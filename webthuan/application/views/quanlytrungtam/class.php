<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" >
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-folder-o"></em>
			</a></li>
			<li class="active">QUẢN LÝ LỚP HỌC</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Lớp Học</h1>
		</div>
	</div>
	<div class="btn">
		<button class ="btn btn-primary btn-md"><a href="<?php echo $pageCreateClass ?>">Thêm</a></button>
        <button class ="btn btn-primary btn-md"><a href="<?php echo $pageUpdateClass ?>">Sửa</a></button>
       <button class ="btn btn-primary btn-md"><a href="<?php echo $pageDeleteClass ?>">Xóa</a></button>
	</div>
	<div class="row">
		<?php 
			echo '<table style="width:70%" id="table-menu" class="table table-striped">
			  <tr>
			    <th>ID</th>
			    <th>Tên khóa học</th> 
			    <th>Mô Tả Lớp</th>
			    <th>Thời gian mở lớp</th>
			    <th>Thời gian kết thúc</th>
			    <th>Cấp độ</th>
			    <th>Khóa học</th>
			  </tr>';
			foreach ($DBClass as $key => $value) {
				echo 
				'
				<tr class="class-item" id="item'.$value['class_id'].'">
					<td id="class_id'.$value['class_id'].'" class="class_id">'.$value['class_id'].'</td>
					<td id="class_name'.$value['class_id'].'" class="class_name">'.$value['class_name'].'</td>
					<td id="class_price'.$value['class_id'].'" class="class_description">'.$value['class_description'].'</td>
					<td id="class_open'.$value['class_id'].'" class="class_open">'.$value['class_open'].'</td>
					<td id="class_finish'.$value['class_id'].'" class="class_finish">'.$value['class_finish'].'</td>
					<td id="level_id'.$value['class_id'].'" class="level_id">'.$value['level_id'].'</td>
					<td id="course_id'.$value['class_id'].'" class="course_id">'.$value['course_id'].'</td>';
			}
			echo'</tr>';
			echo'</table>';
		?>
	</div>
</div>
