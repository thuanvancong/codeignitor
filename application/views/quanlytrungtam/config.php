<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" >
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-gears"></em>
			</a></li>
			<li class="active">Cấu Hình</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Cấu Hình</h1>
		</div>
	</div>
	<div class="btn">
		<button class ="btn btn-primary btn-md"><a href="<?php echo $configAdd?>">Thêm</a></button>
        <button class ="btn btn-primary btn-md"><a href="<?php echo $configUpdate ?>">Sửa</a></button>
        <button class ="btn btn-primary btn-md"><a href="<?php echo $configDelete ?>">Xóa</a></button>
	</div>
	<div class="row">
		<?php 
			echo '<table style="width:70%" id="table-config" class="table table-striped">
			  <tr>
			    <th>Id</th>
			    <th>Cấu Hình</th> 
			    <th>Giá Tri</th>
			  </tr>';
			foreach ($DBConfig as $key => $value) {
				echo 
				'
				<tr class="config-item" id="item'.$value['config_id'].'">
					<td id="item_id'.$value['config_id'].'" class="config_id">'.$value['config_id'].'</td>
					<td id="item_name'.$value['config_id'].'" class="config_name">'.$value['config_name'].'</td>
					<td id="item_value'.$value['config_id'].'" class="config_value">'.$value['config_value'].'</td>';
			}
			echo'</tr>';
			echo'</table>';
		?>
	</div>
</div>
<script type="text/javascript">
$(document).ready(	
	function(){

	}
);
</script>