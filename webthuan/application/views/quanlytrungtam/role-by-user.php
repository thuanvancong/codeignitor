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
	<div class="row">
		<div class="" id="userItem">
			<div class="row">
				<div class="col-md-2">
					<label for="userID">User </label>
				</div>
				<div class="col-md-10">
					<select id="userID">
						<?php 
							foreach ($DBUser as $key => $value) {
								echo 
									'<option value="'.$value['user_id'].'" selected>'.$value['user_name'].'</option>';
							}
						?>
					</select>
				</div>
			</div>
		</div>
		<div> DANH MỤC QUYỀN</div>
		<div class="groupRoleByUser" id="groupRoleByUser">
			<?php 
				foreach ($DBRole as $key => $value) {
					echo 
					'<div class="row">
						<div class="col-md-5">
							<label for="'.$value['role_id'].'">'.$value['role_name'].'</label>
						</div>
						<div class="col-md-5">
							<input type="checkbox" id="'.$value['role_id'].'" name="'.$value['role_id'].'" value="'.$value['role_id'].'">
						</div>
					</div>
					';
				}
			?>
		</div>
		<button onclick="ajaxSaveRoleByUser()">Lưu Quyền</button>
		<button role ="btn btn-primary btn-md" onclick="goBack()">Back</button>
	</div>
</div>
<script type="text/javascript">
var role_id = [];
$(document).ready(	
	function(){
		$('#userID').on('change', function(evt) {
	      var $target = $(evt.currentTarget);
	      // $('#groupRoleByUser input').attr('checked', false);
	      var user_id = $('#userID').find('option:selected').val();
	      loadRoleByUser(user_id);
	  });
		$('#groupRoleByUser').click(function(){
	        $(':checkbox:checked').each(function(i){
	          role_id[i] = $(this).val();
	        });
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
		var ketqua=data.ketqua;
		var role_id = ketqua.role_id;
	  	var i;
	  	if(ketqua.user_id==user_id)
	  	{
	  		for(i=0;i < role_id.length;i++)
		  	{
		  		$('#'+role_id[i]+'').attr('checked', true); // Unchecks it

		  	}
	  	}
	});
}

function ajaxSaveRoleByUser()
{
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
		var kq = data.kq;
	});
}
</script>