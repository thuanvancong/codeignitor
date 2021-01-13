<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" >
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-folder-o"></em>
			</a></li>
			<li class="active">QUẢN LÝ LỚP HỌC</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Lớp học</h1>
		</div>
	</div>
	<div class="row">
		<?php 
		foreach ($DBClass as $key => $value)
			{
				$ID=$value['class_id'];
				if(!is_null($ID))
				{
					echo '
						<div class="groupclass" classID="'.$ID.'">
							<div class="classID" id="classID'.$ID.'">'.$ID.'</div>
							<div class="className" id="className'.$ID.'">'.$value['class_name'].'</div>
							<div class="classDescription" id="classDescription'.$ID.'">'.$value['class_description'].'</div>
							<div class="classOpen" id="classOpen'.$ID.'">'.$value['class_open'].'</div>
							<div class="classFinish" id="classFinish'.$ID.'">'.$value['class_finish'].'</div>
							<div class="levelID" id="levelID'.$ID.'">'.$value['level_id'].'</div>
							<div class="courseID" id="courseID'.$ID.'">'.$value['course_id'].'</div>
							<div class="classDelete" id="classDelete'.$ID.'">
								<a onclick="pustDeleteClass(event)" href="#delete_class" class="trash">
									<em class="fa fa-trash"></em>
								</a>
							</div>	
						</div>';
					}
				}
		?>
		<div class="btn" >
			<button class ="btn btn-primary btn-md" onclick="goBack()">Back</button>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(
		function(){
			
		}
	);
	var arrayID=[];
	function pustDeleteClass(event) {
  		var target=event.target;
  		var id = target.closest('.groupclass').getAttribute('classID');
		ajaxDeleteClassItem(id);
  	}

  	function goBack() {
  		window.location.href='<?php echo $pageClass; ?>';
  	}

  	function ajaxDeleteClassItem(id) {
		$.ajax({
			method: "POST",
			url: '<?php echo $ajaxDeleteClassItem ?>',
			dataType:'json',
			data:{class_id:id}
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