<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" >
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-folder-o"></em>
			</a></li>
			<li class="active">QUẢN LÝ MENU</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Menu</h1>
		</div>
	</div>
	<div class="btn">
		<button class ="btn btn-primary btn-md"><a href="<?php echo $pageMenuCreate; ?>">Thêm</a></button>
        <button class ="btn btn-primary btn-md"><a href="<?php echo $pageMenuUpdate; ?>">Sửa</a></button>
       <button class ="btn btn-primary btn-md"><a href="<?php echo $pageMenuDelete ?>">Xóa</a></button>
	</div>
	<div class="row">
		<?php 
			echo '<table style="width:70%" id="table-menu" class="table table-striped">
			  <tr>
			    <th>ID</th>
			    <th>Tên Menu</th> 
			    <th>Mô tả</th>
			    <th>Trạng thái</th>
			    <th>ParentID</th>
			    <th>MenuOrder</th>
			    <th>URL</th>
			  </tr>';
			foreach ($DBMenu as $key => $value) {
				echo 
				'
				<tr class="menu-item" id="item'.$value['menu_id'].'">
					<td id="menu_id'.$value['menu_id'].'" class="menu_id">'.$value['menu_id'].'</td>
					<td id="menu_name'.$value['menu_id'].'" class="menu_name">'.$value['menu_name'].'</td>
					<td id="menu_content'.$value['menu_id'].'" class="menu_content">'.$value['menu_content'].'</td>
					<td id="menu_isactive'.$value['menu_id'].'" class="menu_isactive">'.$value['menu_isactive'].'</td>
					<td id="parent_id'.$value['menu_id'].'" class="parent_id">'.$value['parent_id'].'</td>
					<td id="menu_order'.$value['menu_id'].'" class="menu_order">'.$value['menu_order'].'</td>
					<td id="menu_url'.$value['menu_id'].'" class="menu_url">'.$value['menu_url'].'</td>';
			}
			echo'</tr>';
			echo'</table>';
		?>
	</div>
</div>