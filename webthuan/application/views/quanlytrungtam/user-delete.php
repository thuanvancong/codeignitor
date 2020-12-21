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
		<?php 
		foreach ($DBUser as $key => $value)
			{
				$ID=$value['user_id'];
				if(!is_null($ID))
				{
					echo '
						<div class="groupuser" userID="'.$ID.'">
							<div class="userID" id="userID'.$ID.'">'.$ID.'</div>
							<div class="userName" id="userName'.$ID.'">'.$value['user_name'].'</div>
							<div class="userIsactive" id="userName'.$ID.'">'.$value['user_isactive'].'</div>
							<div class="userDelete" id="userDelete'.$ID.'">
								<a onclick="pustDeleteUser(event)" href="#delete_user" class="trash">
									<em class="fa fa-trash"></em>
								</a>
							</div>	
						</div>';
					}
				}
		?>
		<div class="btn" >
			<button user ="btn btn-primary btn-md" onclick="goBack()">Back</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(
		function(){
			
		}
	);
	var arrayID=[];
	function pustDeleteUser(event) {
  		var target=event.target;
  		var id = target.closest('.groupuser').getAttribute('userID');
		ajaxDeleteUserItem(id);
  	}

  	function goBack() {
  		window.location.href='<?php echo $pageUser; ?>';
  	}

  	function ajaxDeleteUserItem(id) {
		$.ajax({
			method: "POST",
			url: '<?php echo $ajaxDeleteUserItem ?>',
			dataType:'json',
			data:{user_id:id}
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