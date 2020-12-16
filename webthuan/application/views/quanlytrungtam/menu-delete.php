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
			<button onclick="ajaxDeleteMenu()">Xóa page</button>
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
	}
);
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
	  	}
	});
}
function ajaxDeleteMenu()
{
	var id = $('#menuID').find('option:selected').val();
	$.ajax({
      type: "POST",
      url: '<?php echo $ajaxDeleteItemMenu; ?>', 
      data:{menu_id:id},
      dataType: 'json',
	}).done(function(data) {
		var kq = data.ketqua;
	  	if(kq == 1)
	  	{
	  		alert("Xóa thành công  !");
	  		window.location.href='<?php echo $pageMenu; ?>';
	  	}
	  	else
	  	{
	  		alert("Xóa không thành công ! Có ràng buộc page con");
	  	}
	});
}
</script>