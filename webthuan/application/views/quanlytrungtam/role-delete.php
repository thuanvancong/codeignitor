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
			<h1 class="page-header">role</h1>
		</div>
	</div>
	<div class="row">
		<?php 
		foreach ($DBRole as $key => $value)
			{
				$ID=$value['role_id'];
				if(!is_null($ID))
				{
					echo '
						<div class="grouprole" roleID="'.$ID.'">
							<div class="roleID" id="roleID'.$ID.'">'.$ID.'</div>
							<div class="roleName" id="roleName'.$ID.'">'.$value['role_name'].'</div>
							<div class="router" id="router'.$ID.'">'.$value['router'].'</div>
							<div class="roleIsactive" id="roleName'.$ID.'">'.$value['role_isactive'].'</div>
							<div class="roleDelete" id="roleDelete'.$ID.'">
								<a onclick="pustDeleteRole(event)" href="#delete_role" class="trash">
									<em class="fa fa-trash"></em>
								</a>
							</div>	
						</div>';
					}
				}
		?>
		<div class="btn" >
			<button role ="btn btn-primary btn-md" onclick="goBack()">Back</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(
		function(){
			
		}
	);
	var arrayID=[];
	function pustDeleteRole(event) {
  		var target=event.target;
  		var id = target.closest('.grouprole').getAttribute('roleID');
		ajaxDeleteRoleItem(id);
  	}

  	function goBack() {
  		window.location.href='<?php echo $pageRole; ?>';
  	}

  	function ajaxDeleteRoleItem(id) {
		$.ajax({
			method: "POST",
			url: '<?php echo $ajaxDeleteRoleItem ?>',
			dataType:'json',
			data:{role_id:id}
			}).done(function( data ) {
				var kq = data.ketqua;
			  	if(kq == 1)
			  	{
			  		alert("Xóa thông tin thành công  !");
			  		location.reload();
			  	}
			  	else
			  	{
			  		alert("Xóa không thành công");
			  	}
			});
		}
</script>