<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" >
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-folder-o"></em>
			</a></li>
			<li class="active">QUẢN LÝ GIÁO VIÊN</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Giáo viên</h1>
		</div>
	</div>
	<div class="row">
		<?php 
		foreach ($DBTeacher as $key => $value)
			{
				$ID=$value['teacher_id'];
				if(!is_null($ID))
				{
					echo '
						<div class="groupteacher" teacherID="'.$ID.'">
							<div class="teacherID" id="teacherID'.$ID.'">'.$ID.'</div>
							<div class="teacherName" id="teacherName'.$ID.'">'.$value['teacher_name'].'</div>
							<div class="teacherOld" id="teacherOld'.$ID.'">'.$value['teacher_old'].'</div>
							<div class="teacherSex" id="teacherSex'.$ID.'">'.$value['teacher_sex'].'</div>
							<div class="teacherAddress" id="teacherAddress'.$ID.'">'.$value['teacher_address'].'</div>
							<div class="teacherDelete" id="teacherDelete'.$ID.'">
								<a onclick="pustDeleteTeacher(event)" href="#delete_teacher" class="trash">
									<em class="fa fa-trash"></em>
								</a>
							</div>	
						</div>';
					}
				}
		?>
		<div class="btn" >
			<button teacher ="btn btn-primary btn-md" onclick="goBack()">Back</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(
		function(){
			
		}
	);
	var arrayID=[];
	function pustDeleteTeacher(event) {
  		var target=event.target;
  		var id = target.closest('.groupteacher').getAttribute('teacherID');
		ajaxDeleteTeacherItem(id);
  	}

  	function goBack() {
  		window.location.href='<?php echo $pageTeacher; ?>';
  	}

  	function ajaxDeleteTeacherItem(id) {
		$.ajax({
			method: "POST",
			url: '<?php echo $ajaxDeleteTeacherItem ?>',
			dataType:'json',
			data:{teacher_id:id}
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