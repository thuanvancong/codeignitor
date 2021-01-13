<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" >
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-folder-o"></em>
			</a></li>
			<li class="active">QUẢN LÝ KHÓA HỌC</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Khóa học</h1>
		</div>
	</div>
	<div class="row">
		<?php 
		foreach ($DBCourse as $key => $value)
			{
				$ID=$value['course_id'];
				if(!is_null($ID))
				{
					echo '
						<div class="groupcourse" courseID="'.$ID.'">
							<div class="courseID" id="courseID'.$ID.'">'.$ID.'</div>
							<div class="courseName" id="courseName'.$ID.'">'.$value['course_name'].'</div>
							<div class="courseName" id="courseName'.$ID.'">'.$value['course_price'].'</div>
							<div class="courseDelete" id="courseDelete'.$ID.'">
								<a onclick="pustDeletecourse(event)" href="#delete_course" class="trash">
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
	function pustDeletecourse(event) {
  		var target=event.target;
  		var id = target.closest('.groupcourse').getAttribute('courseID');
		ajaxDeleteCourseItem(id);
  	}

  	function goBack() {
  		window.location.href='<?php echo $pageCourse; ?>';
  	}

  	function ajaxDeleteCourseItem(id) {
		$.ajax({
			method: "POST",
			url: '<?php echo $ajaxDeleteCourseItem ?>',
			dataType:'json',
			data:{course_id:id}
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