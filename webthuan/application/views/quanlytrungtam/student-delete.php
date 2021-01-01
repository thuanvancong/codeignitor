<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" >
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-folder-o"></em>
			</a></li>
			<li class="active">QUẢN LÝ HỌC VIÊN</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Học viên</h1>
		</div>
	</div>
	<div class="row">
		<?php 
		foreach ($DBStudent as $key => $value)
			{
				$ID=$value['student_id'];
				if(!is_null($ID))
				{
					echo '
						<div class="groupStudent" studentID="'.$ID.'">
							<div class="studentID" id="studentID'.$ID.'">'.$ID.'</div>
							<div class="studentName" id="studentName'.$ID.'">'.$value['student_name'].'</div>
							<div class="studentOld" id="studentOld'.$ID.'">'.$value['student_old'].'</div>
							<div class="studentIdentityCard" id="studentIdentityCard'.$ID.'">'.$value['student_identitycard'].'</div>
							<div class="studentSex" id="studentSex'.$ID.'">'.$value['student_sex'].'</div>
							<div class="studentAddress" id="studentAddress'.$ID.'">'.$value['student_address'].'</div>
							<div class="studentEmail" id="studentEmail'.$ID.'">'.$value['student_email'].'</div>
							<div class="studentPhone" id="studentPhone'.$ID.'">'.$value['student_phone'].'</div>
							<div class="studentLevel" id="studentLevel'.$ID.'">'.$value['student_level'].'</div>
							<div class="studentDelete" id="studentDelete'.$ID.'">
								<a onclick="pustDeleteStudent(event)" href="#delete_student" class="trash">
									<em class="fa fa-trash"></em>
								</a>
							</div>	
						</div>';
					}
				}
		?>
		<div class="btn" >
			<button student ="btn btn-primary btn-md" onclick="goBack()">Back</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(
		function(){
			
		}
	);
	var arrayID=[];
	function pustDeleteStudent(event) {
  		var target=event.target;
  		var id = target.closest('.groupStudent').getAttribute('studentID');
		ajaxDeleteStudentItem(id);
  	}

  	function goBack() {
  		window.location.href='<?php echo $pageStudent; ?>';
  	}

  	function ajaxDeleteStudentItem(id) {
		$.ajax({
			method: "POST",
			url: '<?php echo $ajaxDeleteStudentItem ?>',
			dataType:'json',
			data:{student_id:id}
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