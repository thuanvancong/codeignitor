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
		<div class="" id="userItem">
			<div class="row">
				<div class="col-md-2">
					<label for="userID">CHỌN ID CẦN SỬA</label>
				</div>
				<div class="col-md-10">
					<select id="userID">
						<?php 
							foreach ($DBUser as $key => $value) {
								echo 
									'<option value="'.$value['user_id'].'" selected>'.$value['user_id'].'</option>';
							}
						?>
					</select>
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
					<label for="userPassword">Nhập mật khẩu cũ</label>
				</div>
				<div class="col-md-10">
					<input type="Password" id="userPassword" name="password"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="userPasswordNew">Nhập mật khẩu mới</label>
				</div>
				<div class="col-md-10">
					<input type="Password" id="userPasswordNew" name="passwordNew"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="userPasswordConfirm">Xác nhận lại mật khẩu</label>
				</div>
				<div class="col-md-10">
					<input type="Password" id="userPasswordConfirm" name="passwordConfirm"><br>
				</div>
			</div>
			<button onclick="ajaxUpdatePassUserItem()">Cập Nhật Mật Khẩu</button>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(	
	function() 
	{
		$('#userItem').find('#userID').on('change', function(evt) {
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
function ajaxUpdatePassUserItem()
{
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
}
</script>