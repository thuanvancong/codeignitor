
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
			<form id="formConfigDelete" action="ajaxDeleteConfig()" method="POST">
				<div class="form-group">
					<label>CHỌN ID XÓA</label>
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
					<input type="text" id="configField" class="form-control">
				</div>
				<div class="form-group">
					<label for="configValue">GIÁ TRỊ</label>
					<input type="text" id="configValue" class="form-control">
				</div>
				<button  class ="btn btn-primary btn-md">DELETE</a></button>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(  
	function handleEvents(){
	    $('#formConfigDelete').find('#item-config-id').on('change', function(evt) {
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
  		$('#formConfigDelete').find('#configField').val(ketqua[i].config_name);
  		$('#formConfigDelete').find('#configValue').val(ketqua[i].config_value);
  	}
  });
}

var frm = $('#formConfigDelete');
frm.submit(function (e) {
    e.preventDefault();
    var idConfig = $('#item-config-id').find('option:selected').val()
	var data = {configID: idConfig};
    $.ajax({
      type: "POST",
      url: '<?php echo $ajaxDeleteConfig; ?>', 
      data: data,
      dataType: 'json',
 	}).done(function(data) {
		var ketqua = data.kq;
	  	if(ketqua >= 1)
	  	{
	  		alert("Xóa thành công !");
	  		window.location.href='<?php echo $pageConfig; ?>';
	  	}
 	});
});
</script>