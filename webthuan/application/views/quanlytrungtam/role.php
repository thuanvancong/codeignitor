<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" >
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-folder-o"></em>
			</a></li>
			<li class="active">QUẢN LÝ QUYỀN</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">role</h1>
		</div>
	</div>
	<div class="btn">
		<button class ="btn btn-primary btn-md"><a href="<?php echo $pageCreateRole ?>">Thêm</a></button>
        <button class ="btn btn-primary btn-md"><a href="<?php echo $pageUpdateRole ?>">Sửa</a></button>
       <button class ="btn btn-primary btn-md"><a href="<?php echo $pageDeleteRole ?>">Xóa</a></button>
	</div>
	<div class="row">
		<?php 
			echo '<table style="width:90%" id="table-role" class="table table-striped">
			  <tr>
			    <th>ID</th>
			    <th>role</th> 
			    <th>Active</th>
			    <th>Router</th>
			  </tr>';
			foreach ($DBRole as $key => $value) {
				echo 
				'
				<tr class="role-item" id="item'.$value['role_id'].'">
					<td id="role_id'.$value['role_id'].'" class="role_id">'.$value['role_id'].'</td>
					<td id="role_name'.$value['role_id'].'" class="role_name">'.$value['role_name'].'</td>
					<td id="role_isactive'.$value['role_id'].'" class="role_isactive">'.$value['role_isactive'].'</td>
					<td id="router'.$value['role_id'].'" class="router">'.$value['router'].'</td>';
			}
			echo'</tr>';
			echo'</table>';
		?>
	</div>
</div>