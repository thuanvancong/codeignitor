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
			<form id="formUserUpdate" action="ajaxUpdateUserItem()" method="POST">
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
	function(){
		$('#formUserUpdate').find('#userID').on('change', function(evt) {
	      var $target = $(evt.currentTarget);
	      var user_id = $('#userID').find('option:selected').val();
	      loadItemUser(user_id);
	  });
	}
);
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
var frm = $('#formUserUpdate');
frm.submit(function (e) {
e.preventDefault();
	var user_id = $('#userID').val(),
		user_name = $('#userName').val(),
		user_isactive = $('#userIsactive').val()
	var data = 
	{
		user_id:user_id,
		user_name:user_name,
		user_isactive:user_isactive
	};
$.ajax({
  type: "POST",
  url: '<?php echo $ajaxUpdateUserItem; ?>', 
  data: data,
  dataType: 'json',
	}).done(function(data) {
		var kq = data.kq;
	  	if(kq > 0)
	  	{
	  		alert("Sửa thông tin thành công  !");
	  		window.location.href='<?php echo $pageUser; ?>';
	  	}
	  	else
	  	{
	  		alert("Sửa không thành công ");
	  	}
	});
});
</script>