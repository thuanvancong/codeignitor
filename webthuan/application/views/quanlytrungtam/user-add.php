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
	<div class="row">
		<div class="class">
			<div class="row">
				<div class="col-md-2">
					<label for="userID">ID</label>
				</div>
				<div class="col-md-10">
					<input type="number" id="userID"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="userName">User</label>
				</div>
				<div class="col-md-10">
					<input type="text" id="userName"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="userPassword">Password</label>
				</div>
				<div class="col-md-10">
					<input type="password" id="userPassword" name="password"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="userIsactive">Active</label><br>
				</div>
				<div class="col-md-10">
					<input type="checkbox" id="userIsactive" name="userIsactive" value="1">
				</div>
			</div>
			<button onclick="ajaxCreateUser()">Tạo</button>
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

	function ajaxCreateUser()
	{
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
	}
</script>