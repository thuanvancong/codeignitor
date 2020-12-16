
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
		<span> CHỌN THÔNG TIN SỬA CẤU HÌNH </span><br>
		<div id="item-config">
			<div class="row">
				<div class="col-md-2">
					<label for="configID">CHỌN ID CẤU HÌNH</label>
				</div>
				<div class="col-md-10">
					<select id="item-config-id">
						<?php 
							foreach ($DBConfig as $key => $value) {
								echo 
									'<option value="'.$value['config_id'].'" selected>'.$value['config_id'].'</option>';
							}
						?>
					</select>
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
			<button onclick="ajaxDeleteItemConfig()">LƯU THAY ĐỔI</button>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(  
	function handleEvents(){
	    $('#item-config').find('#item-config-id').on('change', function(evt) {
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
  		$('#item-config').find('#configField').val(ketqua[i].config_name);
  		$('#item-config').find('#configValue').val(ketqua[i].config_value);
  	}
  });
}

function ajaxDeleteItemConfig() {
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
  		window.location.href='<?php echo $pageConfiguration; ?>';
  	}
  });
}
</script>