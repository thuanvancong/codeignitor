<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" >
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">
				<em class="fa fa-gears"></em>
			</a></li>
			<li class="active">Cấu Hình</li>
		</ol>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Cấu Hình</h1>
		</div>
	</div>
	<div class="alert bg-info hidden" role="alert" id="success"><em class="fa fa-lg fa-warning">&nbsp;</em> Đã thêm cấu hình thành công ! <em class="fa fa-lg fa-close"></em></a></div>
	<div class="alert bg-teal hidden" role="alert" id="fail"><em class="fa fa-lg fa-warning">&nbsp;</em> Thêm cấu hình không thành công ! <em class="fa fa-lg fa-close"></em></a></div>
	<div class="panel-body">
		<div class="col-md-6">
			<form id="formConfigAdd" action="ajaxSaveFormConfig()" method="POST">
				<div class="form-group">
					<label for="configID">ID</label>
					<input type="number" id="configID" class="form-control" >
				</div>
				<div class="form-group">
					<label for="configField">TÊN CẤU HÌNH</label>
					<input type="text" id="configField" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="configValue">GIÁ TRỊ</label>
					<input type="text" id="configValue" class="form-control" required>
				</div>
				<div class="form-group checkbox">
					<label>
						<input type="checkbox" id="configIsactive" name="configIsactive" value="1">Active
					</label>
				</div>
				<button  class ="btn btn-primary btn-md">SAVE</a></button>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(	
	function(){

	}
);
var frm = $('#formConfigAdd');
frm.submit(function (e) {
    e.preventDefault();
    var checked = $('#configIsactive').is(":checked");
	var configIsactive = 0;
	if(checked == true)
	{
		configIsactive = $("#configIsactive").val();
		data= {configField: $("#configField").val(),configValue: $("#configValue").val(),configIsactive :$("#configIsactive").val()};
	}
	else
	{
		data= {configField: $("#configField").val(),configValue: $("#configValue").val(),configIsactive :0};
	}
    $.ajax({
      type: "POST",
      url: '<?php echo $ajaxSaveFormConfig; ?>', 
      data: data,
      dataType: 'json',
 	}).done(function(data) {
 		var kq = data.ketqua;
	  	if(kq == 1)
	  	{
	  		$('#success').removeClass('hidden');
	  		//alert("Đã thêm cấu hình thành công !");
	  		window.location.href='<?php echo $pageConfig; ?>';
	  	}
	  	else
	  	{
	  		// alert("Thêm cấu hình không thành công !");
	  		$('#fail').removeClass('hidden');
	  	}
 	});
});
</script>