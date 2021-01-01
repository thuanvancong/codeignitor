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
			<form id="formUserUpdatePass" action="ajaxUpdatePassUserItem()" method="POST">
				<div class="form-group">
					<label for="userID">CHỌN ID CẦN SỬA</label>
					<select id="userID" class="form-control">
						<?php 
							foreach ($DBUser as $key => $value) {
								echo 
									'<option value="'.$value['user_id'].'" selected>'.$value['user_id'].'</option>';
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="userName">User</label>
					<input type="text" id="userName" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="userPassword">Nhập mật khẩu cũ</label>
					<input type="Password" id="userPasswordNew" name="password" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="userPasswordNew">Nhập mật khẩu mới</label>
					<input type="Password" id="userPassword" name="passwordNew" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="userPasswordConfirm">Xác nhận lại mật khẩu</label>
					<input type="Password" id="userPasswordConfirm" name="passwordConfirm" class="form-control" required>
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
$(document).ready(	
	function() 
	{
		$('#formUserUpdatePass').find('#userID').on('change', function(evt) {
	      var $target = $(evt.currentTarget);
	      var user_id = $('#userID').find('option:selected').val();
	      loadItemUser(user_id);
	      PushEventPass();
	    });
	}
);
var password ='',
	passwordNew ='',
	passwordConfirm = '';
function PushEventPass()
{
	$('input[name=password]').keyup(function(){
		password = $(this).val();
	});
	$('input[name=passwordNew]').keyup(function(){
		passwordNew = $(this).val();
	});
	$('input[name=passwordConfirm]').keyup(function(){
		passwordConfirm = $(this).val();
	});
}
function loadItemUser(user_id)
{
	$.ajax({
      type: "POST",
      url: '<?php echo $ajaxLoadItemUser; ?>', 
      data: {user_id:user_id},
      dataType: 'json',
	}).done(function(data) {
		var ketqua=data.ketqua;
	  	var i;
	  	for(i=0;i < ketqua.length;i++)
	  	{
	  		$('#userName').val(ketqua[i].user_name);
	  		if(ketqua[i].user_isactive == 1)
	  		{
	  			$('#userItem').find('#userIsactive').attr('checked', true); // Checks it
	  		}
	  		else
	  		{	
	  			$('#userItem').find('#userIsactive').attr('checked', false); // Unchecks it
	  		}
	  	}
	});
}

var frm = $('#formUserUpdatePass');
frm.submit(function (e) {
e.preventDefault();
	var data = {};
	/* Check xem 2 input pass new = confirm */
	if(passwordNew==passwordConfirm)
	{
		data = {
			user_id:$('#userID').val(),
			user_pass:password,
			user_passnew:passwordNew
		};
		$.ajax({
			type: "POST",
		    url: '<?php echo $ajaxUpdatePassUserItem; ?>', 
		    data: data,
		    dataType: 'json',
		}).done(function(data) {
	 		var kq = data.kq;
		  	if(kq == 1)
		  	{
		  		alert("Tạo mật khẩu mới thành công !");
		  		window.location.href='<?php echo $pageUser; ?>';
		  	}
		  	else
		  	{
		  		alert("Tạo không thành công ! Mật Khẩu cũ không chính xác");
		  	}
	  	});
	}
	else
	{
		alert("2 mật khẩu mới nhập không trùng khớp");
	}
});
</script>