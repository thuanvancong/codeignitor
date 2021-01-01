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
			<h1 class="page-header">Role</h1>
		</div>
	</div>
	<div class="panel-body">
		<div class="col-md-6">
			<form id="formRoleUpdate" action="ajaxUpdateRoleItem()" method="POST">
				<div class="form-group">
					<label for="roleID">CHỌN ID CẦN SỬA</label>
					<select id="roleID" class="form-control">
						<?php 
							foreach ($DBRole as $key => $value) {
								echo 
									'<option value="'.$value['role_id'].'" selected>'.$value['role_id'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="roleName">Role</label>
					<input type="text" id="roleName" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="Router">Router</label>
					<input type="text" id="Router" class="form-control" required>
				</div>
				<div class="form-group checkbox">
					<label>
						<input type="checkbox" id="roleIsactive" name="roleIsactive" value="1">Active
					</label>
				</div>
				<button class ="btn btn-primary btn-md">SAVE</a></button>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(	
	function(){
		$('#formRoleUpdate').find('#roleID').on('change', function(evt) {
	      var $target = $(evt.currentTarget);
	      var role_id = $('#roleID').find('option:selected').val();
	      loadItemRole(role_id);
	  });
	}
);
function loadItemRole(role_id)
{
	$.ajax({
      type: "POST",
      url: '<?php echo $ajaxLoadItemRole; ?>', 
      data: {role_id:role_id},
      dataType: 'json',
	}).done(function(data) {
		var ketqua=data.ketqua;
	  	var i;
	  	for(i=0;i < ketqua.length;i++)
	  	{
	  		$('#roleName').val(ketqua[i].role_name);
	  		$('#Router').val(ketqua[i].router);
	  		if(ketqua[i].role_isactive == 1)
	  		{
	  			$('#roleItem').find('#roleIsactive').attr('checked', true); // Checks it
	  		}
	  		else
	  		{	
	  			$('#roleItem').find('#roleIsactive').attr('checked', false); // Unchecks it
	  		}
	  	}
	});
}

var frm = $('#formRoleUpdate');
frm.submit(function (e) {
e.preventDefault();
	var role_id = $('#roleID').val(),
		role_name = $('#roleName').val(),
		router = $('#Router').val(),
		role_isactive = $('#roleIsactive').val()
	var data = 
	{
		role_id:role_id,
		role_name:role_name,
		router:router,
		role_isactive:role_isactive
	};
	$.ajax({
      type: "POST",
      url: '<?php echo $ajaxUpdateRoleItem; ?>', 
      data: data,
      dataType: 'json',
	}).done(function(data) {
		var kq = data.kq;
	  	if(kq > 0)
	  	{
	  		alert("Sửa thông tin thành công  !");
	  		window.location.href='<?php echo $pageRole; ?>';
	  	}
	  	else
	  	{
	  		alert("Sửa không thành công ");
	  	}
	});
});
</script>