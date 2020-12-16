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
		<div class="menu" id="menuItem">
			<div class="row">
				<div class="col-md-2">
					<label for="menuID">CHỌN ID CẤU HÌNH</label>
				</div>
				<div class="col-md-10">
					<select id="menuID">
						<?php 
							foreach ($DBMenu as $key => $value) {
								echo 
									'<option value="'.$value['menu_id'].'" selected>'.$value['menu_id'].'</option>';
							}
						?>
					</select>
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
					<!-- <?php
					foreach ($DsDbMenuName as $key => $value) {
						echo '<option value="'.$value['menu_name'].'" selected="selected">'.$value['menu_name'].'</option>';
					}
					?> -->
					</select>
				</div>
			</div>
			<button onclick="ajaxUpdateMenuItem()">Tạo</button>
			<div class ="note">
				<br><SPAN>Lưu ý</SPAN><br>
				<SPAN>Submenu = 0 : không có page cha</SPAN></div><br>
				<SPAN>Submenu = 1 : chọn 1 là page con</SPAN>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(	
	function(){
		$('#menuItem').find('#menuID').on('change', function(evt) {
	      var $target = $(evt.currentTarget);
	      var id = $('#menuID').find('option:selected').val();
	      loadItemMenu(id);
	    });
	    $('#menuItem').find('#menuOrder').on('change', function(evt) {
	      var $target = $(evt.currentTarget);
	      var idMenuOrder = $('#menuOrder').find('option:selected').val();
	      loadSelectSubmenu(idMenuOrder);
	    });
	}
);
function loadSelectSubmenu(idMenuOrder)
{
	/* ---- Trường hợp không có submenu -> không load menu_name --*/
	if(idMenuOrder == 0)
	{
		$('#parentID').html('');
	}
	/* ---- Trường hợp submenu -> load menu_name --*/
	else
	{
		htmlString='<?php foreach ($DsDbMenuName as $key => $value) {echo '<option value="'.$value['menu_name'].'" selected="selected">'.$value['menu_name'].'</option>';}?>';
		$('#parentID').append(htmlString);
	}
}
function loadItemMenu(id)
{	
	$.ajax({
      type: "POST",
      url: '<?php echo $ajaxLoadItemMenu; ?>', 
      data: {menu_id:id},
      dataType: 'json',
	}).done(function(data) {
		var ketqua=data.ketqua;
	  	var i;
	  	for(i=0;i < ketqua.length;i++)
	  	{
	  		$('#menuItem').find('#menuName').val(ketqua[i].menu_name);
	  		$('#menuItem').find('#menuContent').val(ketqua[i].menu_content);
	  		if(ketqua[i].menu_isactive == 1)
	  		{
	  			$('#menuItem').find('#menuIsactive').attr('checked', true); // Checks it
	  		}
	  		else
	  		{	
	  			$('#menuItem').find('#menuIsactive').attr('checked', false); // Unchecks it
	  		}
	  	}
	});
}

function ajaxUpdateMenuItem()
{
	var menu_id = $('#menuItem').find('option:selected').val();
	var menu_order = $('#menuOrder').find('option:selected').val();
	if(menu_order == 0)
	{
		var parent_id = 0;
	}
	else
	{
		var parent_id = $('#parentID').find('option:selected').val();
	}
	var menu_name =$('#menuName').val();
	var menu_content =$('#menuContent').val();
	var menu_isactive = $('#menuIsactive').val();
	var dataget = {
		menu_id: menu_id, 
		menu_name:menu_name, 
		menu_content:menu_content, 
		menu_isactive:menu_isactive, 
		menu_order:menu_order,
		parent_id:parent_id
	};

	$.ajax({
      type: "POST",
      url: '<?php echo $ajaxUpdateItemMenu; ?>', 
      data: dataget,
      dataType: 'json',
	}).done(function(data) {
		var kq = data.ketqua;
	  	if(kq == 1)
	  	{
	  		alert("Sửa thông tin thành công  !");
	  		window.location.href='<?php echo $pageMenu; ?>';
	  	}
	  	else
	  	{
	  		alert("Sửa không thành công ! Có ràng buộc page con");
	  	}
	});
}
</script>
