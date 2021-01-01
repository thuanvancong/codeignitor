<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DỰ ÁN QUẢN LÝ TRUNG TÂM TIN HỌC ABC - Dashboard</title>
	<link href="<?php echo base_url()."assets/"; ?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url()."assets/"; ?>css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo base_url()."assets/"; ?>css/datepicker3.css" rel="stylesheet">
	<link href="<?php echo base_url()."assets/"; ?>css/styles.css" rel="stylesheet">
 	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
	<script src="http://malsup.github.com/jquery.form.js"></script>
	<!--Custom Font-->
	
	
	<!--[if lt IE 9]>
	<script src="<?php echo base_url()."assets/"; ?>js/html5shiv.js"></script>
	<script src="<?php echo base_url()."assets/"; ?>js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="row">
	<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">Log in</div>
			<div class="panel-body">
			<?php echo form_open(); ?>
				<?php $error = form_error("username","<p class='text-danger'>") ?>
				<div class="form_group <?php echo $error ? 'has-error':''?>">
					<label for="username"> Username</label>
					<div class="input-group">
						<input id="username" class="form-control" placeholder="Username" name="username" type="text" autofocus="" value="<?php echo set_value("username") ?>">
					</div>
				</div>
				<?php echo $error; ?>
				<?php $error = form_error("username","<p class='text-danger'>") ?>
				<div class="form_group<?php echo $error ? 'has-error':''?>">
					<label for="password"> Password</label>
					<div class="input-group">
						<input id="password" class="form-control" placeholder="Password" name="password" type="Password" value="">
					</div>
				</div>
				<input type="submit" value="Login" class ="btn btn-primary btn-md">
			<?php echo form_close(); ?>
			</div>
		</div>
	</div><!-- /.col-->
</div><!-- /.row -->
	<script src="<?php echo base_url()."assets/"; ?>js/jquery-1.11.1.min.js"></script>
	<script src="<?php echo base_url()."assets/"; ?>js/bootstrap.min.js"></script>
	<script src="<?php echo base_url()."assets/"; ?>js/chart.min.js"></script>
	<script src="<?php echo base_url()."assets/"; ?>js/chart-data.js"></script>
	<script src="<?php echo base_url()."assets/"; ?>js/easypiechart.js"></script>
	<script src="<?php echo base_url()."assets/"; ?>js/easypiechart-data.js"></script>
	<script src="<?php echo base_url()."assets/"; ?>js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url()."assets/"; ?>js/custom.js"></script>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>
		
</body>
</html>