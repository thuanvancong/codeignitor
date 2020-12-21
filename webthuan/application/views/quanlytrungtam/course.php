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
			<h1 class="page-header">Khóa Học</h1>
		</div>
	</div>
	<div class="btn">
		<button class ="btn btn-primary btn-md"><a href="<?php echo $pageCreateCourse ?>">Thêm</a></button>
        <button class ="btn btn-primary btn-md"><a href="<?php echo $pageUpdateCourse ?>">Sửa</a></button>
       <button class ="btn btn-primary btn-md"><a href="<?php echo $pageDeleteCourse ?>">Xóa</a></button>
	</div>
	<div class="row">
		<?php 
			echo '<table style="width:70%" id="table-menu" class="table table-striped">
			  <tr>
			    <th>ID</th>
			    <th>Tên khóa học</th> 
			    <th>Tiền khóa học</th>
			  </tr>';
			foreach ($DBCourse as $key => $value) {
				echo 
				'
				<tr class="course-item" id="item'.$value['course_id'].'">
					<td id="course_id'.$value['course_id'].'" class="course_id">'.$value['course_id'].'</td>
					<td id="course_name'.$value['course_id'].'" class="course_name">'.$value['course_name'].'</td>
					<td id="course_price'.$value['course_id'].'" class="course_price">'.$value['course_price'].'</td>';
			}
			echo'</tr>';
			echo'</table>';
		?>
	</div>
</div>
