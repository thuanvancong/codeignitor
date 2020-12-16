<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">Username</div>
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
			<li class="active"><a href="http://localhost:8888/codeigniter/webthuan/index.php/quanlytrungtam/index"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="http://localhost:8888/codeigniter/webthuan/index.php/quanlytrungtam/pageconfiguration"><em class="fa fa-gears">&nbsp;</em> Configuration</a></li>
			<li><a href="http://localhost:8888/codeigniter/webthuan/index.php/quanlytrungtam/pagemenu"><em class="fa fa-folder-o">&nbsp;</em> Menu</a></li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Managers <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="http://localhost:8888/codeigniter/webthuan/index.php/quanlytrungtam/pageCourse">
						<span class="fa fa-arrow-right">&nbsp;</span> Course
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Class
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Student
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Teacher
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Role
					</a></li>
				</ul>
			</li>
			<li><a href="<?php echo base_url()."assets/"; ?>widgets.html"><em class="fa fa-calendar">&nbsp;</em> Widgets</a></li>
			<li><a href="<?php echo base_url()."assets/"; ?>charts.html"><em class="fa fa-bar-chart">&nbsp;</em> Charts</a></li>
			<li><a href="<?php echo base_url()."assets/"; ?>elements.html"><em class="fa fa-toggle-off">&nbsp;</em> UI Elements</a></li>
			<li><a href="<?php echo base_url()."assets/"; ?>panels.html"><em class="fa fa-clone">&nbsp;</em> Alerts &amp; Panels</a></li>
			<li><a href="<?php echo base_url()."assets/"; ?>login.html"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->