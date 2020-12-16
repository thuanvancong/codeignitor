<body>
	<div class="check-in">
		<label for="checkinfloor">Chọn Tầng</label>
		<select id="checkfloor">
			<option value="1" selected>Tầng Triệt</option>
			<option value="2">Tầng 1</option>
			<option value="3">Tầng 2</option>
			<option value="4">Tầng 3</option>
		</select>
		<label for="checkinRoom">Chọn Phòng</label>
		<select id="checkRoom">
			<option value="" selected></option>
		</select>
		<button onclick="ajaxCheckInRoom()">Đặt Phòng</button>
	</div>
</body>

<script type="text/javascript">
	$(document).ready(  
  function handleEvents(){
    $('#checkfloor').on('change', function(evt) {
      var $target = $(evt.currentTarget);
      var id= $('#checkfloor').find('option:selected').val();
      var ro_name= $('#checkRoom').find('option:selected').val();
      ajaxSelectOptionRoom(id);
    });
  }
);

function ajaxSelectOptionRoom(id) {
  $.ajax({
      type: "POST",
      url: '<?php echo $ajaxLoadRoomSelect; ?>', 
      data: {IdFlood:id},
      dataType: 'json',
  }).done(function(data) {
  	$('#checkRoom').html('');
  	var i;
  	for(i=0;i < data.length;i++)
  	{
  		var htmlString ='';
  		htmlString = '<option value="'+data[i].RO_ID+'" selected >'+data[i].RO_NAME+'</option>';
  		$('#checkRoom').append(htmlString);
  	}
  });
}

function ajaxCheckInRoom() {
  var ro_id= $('#checkRoom').find('option:selected').val();
  var id= $('#checkfloor').find('option:selected').val();
  $.ajax({
      type: "POST",
      url: '<?php echo $ajaxGetDataCheckIn; ?>', 
      data: {FLID:id,ROID:ro_id},
      dataType: 'json',
  }).done(function(data) {
     var kq = data.kq;
  });
}

</script>