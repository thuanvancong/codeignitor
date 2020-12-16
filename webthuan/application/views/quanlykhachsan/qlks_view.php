<body>
  <div class="container">
    <div id="menu">
      <ul>
        <li><a href="#">Quản Lý Phòng</a></li>
        <li><a href="#">Dịch Vụ</a></li>
        <li><a href="#">Nhân Viên</a></li>
      </ul>
    </div>
    <div class="content">
      <div class="btn">
        <button><a href="http://localhost:8888/codeigniter/webthuan/index.php/quanlykhachsan/checkinpage">Đặt Phòng</a></button>
        <button>Trả Phòng</button>
        <button>Dịch Vụ Khác</button>
      </div>
      <div class="Block_Floor">
        <ul>
          <?php
            for($i=0;$i < count($dataFloor); $i++)
            {
              echo 
              '
                 <li class="floor-item" id="FL'.$dataFloor[$i]['ID'].'">'.$dataFloor[$i]['FL_NAME'].'</li>
              ';
            }
          ?>
        </ul>
      </div>
      <div id="Block_Room">
        <div id="room_item">
          <span class="RO_ID" id="ROID"></span>
          <span class="RO_NAME" id="RONAME"></span>
        </div>
      </div>
    </div>
  </div>
</body>

<script type="text/javascript">
$(document).ready(  
  function handleEvents(){
    $('.floor-item').on('click', function(evt) {
      var $target = $(evt.currentTarget);
      ajaxGetIDFLOOR($target.attr('id'));
    });
  }
);
function ajaxGetIDFLOOR(id) {
  $.ajax({
      type: "POST",
      url: '<?php echo $ajaxFloor; ?>', 
      data: {FL_NAME: $("#" + id).text()},
      dataType: 'json',
  }).done(function(data) {
      var kq = data;
      var i;
      $('#Block_Room').html('');
      for(i=0;i < kq.length; i++)
      {
        var htmlString ='';
        htmlString = '<div id="room_item"'+kq[i].RO_ID+'><span class="RO_ID" id="ROID"'+kq[i].RO_ID+'>'+kq[i].RO_ID+'</span><span class="RO_NAME" id="RONAME"'+kq[i].RO_ID+'>'+kq[i].RO_NAME+'</span></div>';
        $('#Block_Room').append(htmlString);
      }
  });
}
</script>