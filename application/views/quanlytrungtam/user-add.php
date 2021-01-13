<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" >
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-folder-o"></em>
			</a></li>
			<li class="active">QUẢN LÝ USER</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">User</h1>
		</div>
	</div>
	<div class="panel-body">
		<div class="col-md-6">
			<form id="formUserAdd" action="ajaxCreateUser()" method="POST">
				<div class="form-group">
					<label for="userID">ID</label>
					<input type="number" id="userID" class="form-control">
				</div>
				<div class="form-group">
					<label for="userName">User</label>
					<input type="text" id="userName" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="userPassword">Password</label>
					<input type="password" id="userPassword" name="password" class="form-control" required>
				</div>
				<div class="form-group checkbox">
					<label>
						<input type="checkbox" id="userIsactive" name="userIsactive" value="1">Active
					</label>
				</div>
				<button class ="btn btn-primary btn-md">SAVE</a></button>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
var password = '';
$(document).ready(	
	function pushEvent(){
		$('input[name=password]').keyup(function(){
        	password = $(this).val();
    	});
	}
);
var frm = $('#formUserAdd');
frm.submit(function (e) {
e.preventDefault();
	var checked = $('#userIsactive').is(":checked");
	var user_id = $('#userID').val(),
		user_name = $('#userName').val(),
		user_pass = password,
		user_isactive = $("#userIsactive").val();
	if(checked == true)
	{
		var data = 
		{
			user_id:user_id,
			user_name:user_name,
			user_pass:password,
			user_isactive:user_isactive
		};
	}
	else
	{
		var data = 
		{
			user_id:user_id,
			user_name:user_name,
			user_pass:password,
			user_isactive:0
		};
	}
$.ajax({
  type: "POST",
  url: '<?php echo $ajaxCreateUser; ?>', 
  data: data,
  dataType: 'json',
	}).done(function(data) {
		var kq = data.ketqua;
	  	if(kq > 0)
	  	{
	  		alert("Tạo User thành công !");
	  		window.location.href='<?php echo $pageUser; ?>';
	  	}
	  	else
	  	{
	  		alert("Tạo không thành công !");
	  	}
	});
});
</script>