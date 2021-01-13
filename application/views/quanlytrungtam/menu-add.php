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
	<div class="panel-body">
		<div class="col-md-6">
			<form id="formMenuAdd" action="ajaxCreatMenu()" method="POST">
				<div class="form-group">
					<label for="menuID">Id</label>
					<input type="number" id="menuID" class="form-control">
				</div>
				<div class="form-group">
					<label for="menuName">Tên Menu</label>
					<input type="text" id="menuName" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="menuContent">Mô tả trang</label>
					<input type="text" id="menuContent" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="menuURL">URL</label>
					<input type="text" id="menuURL" class="form-control" required>
				</div>
				<div class="form-group checkbox">
					<label>
						<input type="checkbox" id="menuIsactive" name="menuIsactive" value="1">Active
					</label>
				</div>
				<div class="form-group">
					<label for="menuOrder">Submenu</label><br>
					<select  name="menuOrder" id="menuOrder" class="form-control">
						<option value="0" selected="selected">0</option>
						<option value="1">1</option>
					</select>
				</div>
				<div class="form-group">
					<label for="parentID">Submenu</label><br>
					<select  name="parentID" id="parentID" class="form-control">
						<?php
							foreach ($DsDbMenuName as $key => $value) {
								echo '<option value="'.$value['menu_name'].'" selected="selected">'.$value['menu_name'].'</option>';
							}
						?>
					</select>
				</div>
				<button class ="btn btn-primary btn-md">SAVE</a></button>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(	
	function(){
		
	}
);

var frm = $('#formMenuAdd');
frm.submit(function (e) {
    e.preventDefault();
    var checked = $('#menuIsactive').is(":checked");
	var menu_order = $('#menuOrder').find('option:selected').val();
	var parent_id = $('#parentID').find('option:selected').val();
	var menu_url= $('#menuURL').val();
	var menu_isactive = 0;
	if(checked == true)
	{
		var menu_isactive = $('#menuIsactive').val();
		data = {menu_name: $('#menuName').val(), menu_content: $('#menuContent').val(), menu_url:menu_url, menu_isactive:menu_isactive, menu_order:menu_order, parent_id:parent_id};
	}
	else
	{
		data = {menu_name: $('#menuName').val(), menu_content: $('#menuContent').val(), menu_url:menu_url, menu_isactive:0, menu_order:menu_order, parent_id:parent_id};
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
});
</script>