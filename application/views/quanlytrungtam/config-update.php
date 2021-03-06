
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
	<div class="panel-body">
		<div class="col-md-6">
			<form id="formConfigUpdate" action="ajaxUpateConfig()" method="POST">
				<div class="form-group">
					<label>CHỌN ID CẦN SỬA THÔNG TIN</label>
					<select class="form-control" id="item-config-id">
						<?php 
							foreach ($DBConfig as $key => $value) {
								echo 
									'<option value="'.$value['config_id'].'" selected>'.$value['config_id'].'</option>';
							}
						?>
					</select>
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
	function handleEvents(){
	    $('#formConfigUpdate').on('change', function(evt) {
	      var $target = $(evt.currentTarget);
	      var id= $('#item-config-id').find('option:selected').val();
	      ajaxSelectItemConfig(id);
	    });
	}
);
function ajaxSelectItemConfig(id) {
  $.ajax({
      type: "POST",
      url: '<?php echo $ajaxSelectItemConfigByID; ?>', 
      data: {idConfig:id},
      dataType: 'json',
  }).done(function(data) {
  	var ketqua=data.kq;
  	var i;
  	for(i=0;i < ketqua.length;i++)
  	{
  		$('#formConfigUpdate').find('#configField').val(ketqua[i].config_name);
  		$('#formConfigUpdate').find('#configValue').val(ketqua[i].config_value);
  		if(ketqua[i].config_isactive == 1)
  		{
  			$('#formConfigUpdate').find('#configIsactive').attr('checked', true); // Checks it
  		}
  		else
  		{
  			$('#formConfigUpdate').find('#configIsactive').attr('checked', false); // Unchecks it
  		}
  	}
  });
}

var frm = $('#formConfigUpdate');
frm.submit(function (e) {
    e.preventDefault();
    var idConfig = $('#item-config-id').find('option:selected').val()
	var data = {configID: idConfig,configField: $('#configField').val(),configValue: $('#configValue').val()};
    $.ajax({
      type: "POST",
      url: '<?php echo $ajaxUpateConfig; ?>', 
      data: data,
      dataType: 'json',
 	}).done(function(data) {
 		var ketqua = data.kq;
	  	if(ketqua >= 1)
	  	{
	  		alert("Sửa nội dung thành công !");
	  		window.location.href='<?php echo $pageConfig; ?>';
	  	}
 	});
});
</script>