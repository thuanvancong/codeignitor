<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">

				<?php
					foreach ($_SESSION as $key => $value) {
						echo '<div class="profile-usertitle-name">'.$value['user_name'].'</div>';
					}
				 ?>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> HỌC VIÊN <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="http://localhost:8888/codeigniter/webthuan/index.php/fontend/Register/index">
						<span class="fa fa-arrow-right">&nbsp;</span> Đăng ký môn học
					</a></li>
					<li><a class="" href="http://localhost:8888/codeigniter/webthuan/index.php/fontend/Schedule/index">
						<span class="fa fa-arrow-right">&nbsp;</span> Thời khóa biểu
					</a></li>
				</ul>
			</li>
			<li><a href="http://localhost:8888/codeigniter/webthuan/index.php/login"><em class="fa fa-power-off">&nbsp;</em>Logout</a></li>
		</ul>
	</div><!--/.sidebar-->