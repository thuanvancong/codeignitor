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
	<div class="row">
		<div class="class">
			<div class="row">
				<div class="col-md-2">
					<label for="roleID">ID</label>
				</div>
				<div class="col-md-10">
					<input type="number" id="roleID"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="roleName">Role</label>
				</div>
				<div class="col-md-10">
					<input type="text" id="roleName"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="Router">Router</label>
				</div>
				<div class="col-md-10">
					<input type="text" id="Router"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="roleIsactive">Active</label><br>
				</div>
				<div class="col-md-10">
					<input type="checkbox" id="roleIsactive" name="roleIsactive" value="1">
				</div>
			</div>
			<button onclick="ajaxCreateRole()">Tạo</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(	
		function (){

		}
	);

	function ajaxCreateRole()
	{
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
		  		window.location.href='<?php echo $pageRole; ?>';
		  	}
		  	else
		  	{
		  		alert("Tạo không thành công !");
		  	}
	  	});
	}
</script>