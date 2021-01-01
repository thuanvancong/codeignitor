<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" >
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-folder-o"></em>
			</a></li>
			<li class="active">THÊM QUYỀN CHO USER</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">UserRole</h1>
		</div>
	</div>
	<div class="panel-body">
		<div class="col-md-6">
			<form id="formRoleByUser" action="ajaxSaveRoleByUser()" method="POST">
				<div class="form-group">
					<label for="userID">User </label>
					<select id="userID" class="form-control">
						<?php 
							foreach ($DBUser as $key => $value) {
								echo 
									'<option value="'.$value['user_id'].'" selected>'.$value['user_name'].'</option>';
							}
						?>
					</select>
				</div>
				<input type="button" class="check btn btn-lg btn-success" value="check all" />
				<div class="form-group" id="groupRoleByUser">
					<fieldset>
						<legend>ROLE</legend>
						<?php 
							foreach ($DBRole as $key => $value) {
								echo '
								<div class="checkbox">
									<label>
										<input type="checkbox" id="role_'.$value['role_id'].'" name="'.$value['role_id'].'" value="'.$value['role_id'].'">'.$value['role_name'].'
									</label>
								</div>';
							}
						?>
					</fieldset>
				</div>
				<button class ="btn btn-primary btn-md">SAVE</a></button>
				<button class ="btn btn-primary btn-md" onclick="goBack()">Back</button>
			</form>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">

var role_id = [];
$(document).ready(	
	function()
	{
		$('#userID').on('change', function(evt) {
			//$('input:checkbox').removeAttr('checked');
	     	var $target = $(evt.currentTarget);
	      	var user_id = $('#userID').find('option:selected').val();
	      	$('#groupRoleByUser input').prop('checked', false);
	     	loadRoleByUser(user_id);
	  	});

		$('#groupRoleByUser').click(function(){
	        $(':checkbox:checked').each(function(i){
	          role_id[i] = $(this).val();
	        });
      	});

		$('.check:button').click(function(){
			var checked = !$(this).data('checked');
			$('input:checkbox').prop('checked', checked);
			$(this).val(checked ? 'uncheck all' : 'check all' )
			$(this).data('checked', checked);
			console.log(checked);
			if(checked == true)
			{
				$(':checkbox:checked').each(function(i){
		          role_id[i] = $(this).val();
		        });
			}
			else
			{
				role_id = ['array null'];
			}
    	});
	}
);

function loadRoleByUser(user_id)
{
	$.ajax({
      type: "POST",
      url: '<?php echo $ajaxloadRoleByUser; ?>', 
      data: {user_id:user_id},
      dataType: 'json',
	}).done(function(data) {
		var ketqua = data.ketqua[user_id];
	  	var i;
	  	for(i = 0; i < ketqua.length; i++)
		{
			var role_id = ketqua[i];
			$('#role_' + role_id + '').prop('checked', true);
		}
		
	});
}

var frm = $('#formRoleByUser');
frm.submit(function (e) {
e.preventDefault();
	var user_id = $('#userID').val();
	data = {
		user_id:user_id,
		role_id:role_id
	};
	$.ajax({
      type: "POST",
      url: '<?php echo $ajaxSaveRoleByUser; ?>', 
      data: data,
      dataType: 'json',
	}).done(function(data) {
		var kq = data.ketqua;
	  	if(kq > 0)
	  	{
	  		alert("Tạo user role thành công !");
	  		window.location.href='<?php echo $pageUser; ?>';
	  	}
	  	else
	  	{
	  		alert("Tạo không thành công !");
	  	}
	});
});
</script>