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
	<div class="row">
		<div class="config">
			<div class="row">
				<div class="col-md-2">
					<label for="configID">ID</label>
				</div>
				<div class="col-md-10">
					<input type="number" id="configID"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="configField">TÊN CẤU HÌNH</label>
				</div>
				<div class="col-md-10">
					<input type="text" id="configField"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="configValue">GIÁ TRỊ</label>
				</div>
				<div class="col-md-10">
					<input type="text" id="configValue"><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<label for="configIsactive">Active</label><br>
				</div>
				<div class="col-md-10">
					<input type="checkbox" id="configIsactive" name="configIsactive" value="1">
				</div>
			</div>
			<button onclick="ajaxSaveConFig()">SAVE</button>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(	
	function(){

	}
);
function ajaxSaveConFig() {
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
  		alert("Đã thêm cấu hình thành công !");
  		window.location.href='<?php echo $pageConfiguration; ?>';
  	}
  	else
  	{
  		alert("Thêm cấu hình không thành công !");
  	}
  });
}
</script>