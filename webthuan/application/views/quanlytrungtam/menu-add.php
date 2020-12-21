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
	<div class="row">
		<div class="menu">
			<div class="row">
				<div class="col-md-2">
					<label for="menuID">Id</label>
				</div>
				<div class="col-md-10">
					<input type="number" id="menuID"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="menuName">Tên Menu</label>
				</div>
				<div class="col-md-10">
					<input type="text" id="menuName"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="menuContent">Mô tả trang</label>
				</div>
				<div class="col-md-10">
					<input type="text" id="menuContent"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="menuIsactive">Active</label><br>
				</div>
				<div class="col-md-10">
					<input type="checkbox" id="menuIsactive" name="menuIsactive" value="1">
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="menuOrder">Submenu</label><br>
				</div>
				<div class="col-md-10">
					<select name="menuOrder" id="menuOrder">
						<option value="0" selected="selected">0</option>
						<option value="1">1</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="parentID">Page Cha</label><br>
				</div>
				<div class="col-md-10">
					<select name="parentID" id="parentID">
					<?php
					foreach ($DsDbMenuName as $key => $value) {
						echo '<option value="'.$value['menu_name'].'" selected="selected">'.$value['menu_name'].'</option>';
					}
					?>
					</select>
				</div>
			</div>
			<button onclick="ajaxCreateMenu()">Tạo</button>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(	
	function(){
		
	}
);
function ajaxCreateMenu()
{
	var checked = $('#menuIsactive').is(":checked");
	var menu_order = $('#menuOrder').find('option:selected').val();
	var parent_id = $('#parentID').find('option:selected').val();
	console.log(parent_id);
	var menu_isactive = 0;
	if(checked == true)
	{
		var menu_isactive = $('#menuIsactive').val();
		data = {menu_name: $('#menuName').val(), menu_content: $('#menuContent').val(), menu_isactive:menu_isactive, menu_order:menu_order, parent_id:parent_id};
	}
	else
	{
		data = {menu_name: $('#menuName').val(), menu_content: $('#menuContent').val(), menu_isactive:0, menu_order:menu_order, parent_id:parent_id};
	}
	$.ajax({
      type: "POST",
      url: '<?php echo $ajaxCreatMenu; ?>', 
      data: data,
      dataType: 'json',
 	}).done(function(data) {
 		var kq = data.ketqua;
	  	if(kq == 1)
	  	{
	  		alert("Tạo menu thành công  !");
	  		window.location.href='<?php echo $pageMenu; ?>';
	  	}
	  	else
	  	{
	  		alert("Tạo menu không thành công !");
	  	}
 	});
}
</script>