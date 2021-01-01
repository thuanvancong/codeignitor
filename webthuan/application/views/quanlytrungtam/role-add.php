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
			<form id="formRoleAdd" action="ajaxCreateRole()" method="POST">
				<div class="form-group">
					<label for="roleID">ID</label>
					<input type="number" id="roleID" class="form-control">
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
	function (){

	}
);
var frm = $('#formRoleAdd');
frm.submit(function (e) {
e.preventDefault();
	var checked = $('#roleIsactive').is(":checked");
	var role_id = $('#roleID').val(),
		role_name = $('#roleName').val(),
		router = $('#Router').val(),
		role_isactive = $("#roleIsactive").val();
	if(checked == true)
	{
		var data = 
		{
			role_id:role_id,
			role_name:role_name,
			router:router,
			role_isactive:role_isactive
		};
	}
	else
	{
		var data = 
		{
			role_id:role_id,
			role_name:role_name,
			router:router,
			role_isactive:0
		};
	}
	
	$.ajax({
		type: "POST",
	    url: '<?php echo $ajaxCreateRole; ?>', 
	    data: data,
	    dataType: 'json',
	}).done(function(data) {
 		var kq = data.ketqua;
	  	if(kq > 0)
	  	{
	  		alert("Tạo role thành công !");
	  		//window.location.href='<?php echo $pageRole; ?>';
	  	}
	  	else
	  	{
	  		alert("Tạo không thành công !");
	  	}
  	});
});
</script>