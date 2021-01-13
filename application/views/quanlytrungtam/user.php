<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" >
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-folder-o"></em>
			</a></li>
			<li class="active">QUẢN LÝ USER</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">User</h1>
		</div>
	</div>
	<div class="btn">
		<button class ="btn btn-primary btn-md"><a href="<?php echo $pageCreateUser ?>">Thêm</a></button>
        <button class ="btn btn-primary btn-md"><a href="<?php echo $pageUpdateUser ?>">Sửa</a></button>
       <button class ="btn btn-primary btn-md"><a href="<?php echo $pageDeleteUser ?>">Xóa</a></button>
       <button class ="btn btn-primary btn-md"><a href="<?php echo $pageUpdatePassUser ?>">Đổi Mật Khẩu</a></button>
       <button class ="btn btn-primary btn-md"><a href="<?php echo $pageRoleByUser ?>">Cập nhật quyền User</a></button>

	</div>
	<div class="row">
		<?php 
			echo '<table style="width:90%" id="table-user" class="table table-striped">
			  <tr>
			    <th>ID</th>
			    <th>User</th> 
			    <th>Active</th>
			    <th>Ngày tạo</th>
			    <th>Ngày Update</th>
			  </tr>';
			foreach ($DBUser as $key => $value) {
				echo 
				'
				<tr class="user-item" id="item'.$value['user_id'].'">
					<td id="user_id'.$value['user_id'].'" class="user_id">'.$value['user_id'].'</td>
					<td id="user_name'.$value['user_id'].'" class="user_name">'.$value['user_name'].'</td>
					<td id="user_isactive'.$value['user_id'].'" class="user_isactive">'.$value['user_isactive'].'</td>
					<td id="time_create'.$value['user_id'].'" class="time_create">'.$value['time_create'].'</td>
					<td id="time_update'.$value['user_id'].'" class="time_update">'.$value['time_update'].'</td>';
			}
			echo'</tr>';
			echo'</table>';
		?>
	</div>
</div>