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
			<form id="formMenuDelete" action="ajaxDeleteItemMenu()" method="POST">
				<div class="form-group">
					<label for="menuID">CHỌN ID</label>
					<select id="menuID" class="form-control">
						<?php 
							foreach ($DBMenu as $key => $value) {
								echo '<option value="'.$value['menu_id'].'" selected>'.$value['menu_id'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="menuName">Tên Menu</label>
					<input type="text" id="menuName" class="form-control">
				</div>
				<button class ="btn btn-primary btn-md">DELETE</a></button>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(	
	function(){
		$('#formMenuDelete').find('#menuID').on('change', function(evt) {
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
	  		$('#formMenuDelete').find('#menuName').val(ketqua[i].menu_name);
	  	}
	});
}

var frm = $('#formMenuDelete');
frm.submit(function (e) {
    e.preventDefault();
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
});
</script>