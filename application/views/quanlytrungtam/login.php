<div class="row">
	<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">Log in</div>
			<div class="panel-body">
			<form id="formLogin" action="ajaxCheckLogin()" method="POST">
				<fieldset>
					<div id="noti-submit">
					</div>
					<div class="form-group">
						<input id="user_name" class="form-control" placeholder="User name" name="user_name" type="text" autofocus="" required>
					</div>
					<div class="form-group" >
						<input id="user_pass" class="form-control" placeholder="Password" name="password" type="password" value="" required>
					</div>
					<div class="checkbox">
						<label>
							<input name="remember" type="checkbox" value="Remember Me">Remember Me
						</label>
					</div>
					<button  class ="btn btn-primary btn-md">Login</a></button>
				</fieldset>
			</form>
			</div>
		</div>
	</div><!-- /.col-->
</div><!-- /.row -->
<script type="text/javascript">
var password = '';
$(document).ready(	
	function pushEvent(){
		$('input[name=password]').keyup(function(){
        	password = $(this).val();
    	});
	}
);
var frm = $('#formLogin');
frm.submit(function (e) {
    e.preventDefault();
    var data = {
		user_name :$('#user_name').val(),
		user_pass :password,
	}
    $.ajax({
      type: "POST",
      url: '<?php echo $ajaxCheckLogin; ?>', 
      data: data,
      dataType: 'json',
 	}).done(function(data) {
 		var ketqua = data.ketqua;
 		if(ketqua > 0)
 		{
 			if(ketqua == 2)
 			{
 				window.location.href='<?php echo $index; ?>';
 			}
 			else
 			{
 				window.location.href='<?php echo $fontend; ?>';
 			}
 			
 		}
 		else
 		{
 			alert("Sai thông tin hoặc mật khẩu. Vui lòng kiểm tra lại");
 		}
 	});
});
</script>

