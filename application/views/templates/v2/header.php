<?php $path=base_url(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="shortcut icon" href="<?php echo base_url() ?>favicon.ico">

	<title>Notifyr |  <?php echo $title ?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="<?php echo $path;?>assets/v2/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="<?php echo $path;?>assets/v2/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
	<link href="<?php echo $path;?>assets/v2/css/animate.min.css" rel="stylesheet" />
	<link href="<?php echo $path;?>assets/v2/css/style.min.css" rel="stylesheet" />
	<link href="<?php echo $path;?>assets/v2/css/style-responsive.min.css" rel="stylesheet" />
	<link href="<?php echo base_url() ?>assets/css/multiple-select.css" rel="stylesheet">


	<link rel="stylesheet" href="<?=base_url('assets/css/jquery.dataTables.css')?>">



	<link href="<?php echo $path;?>assets/v2/css/custom.css" rel="stylesheet"  />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo $path;?>assets/v2/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	<script src="<?php echo $path;?>assets/v2/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="<?php echo $path;?>assets/js/multiple-select.js"></script>

	<link rel="stylesheet" type="text/css" href="http://40.113.123.6/provisioning/assets/links/links.css">
</head>
<body>

	
	<div id="page-container" class="page-container fade page-sidebar-fixed ">

		<div id="header" class="header navbar navbar-inverse ">

			<div class="container-fluid topbar">
				<div class="navbar-header">
					
					
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<a href="" class="navbar-brand">
					<span class="navbar-logo"> Notifyr</a>

						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a title="All Apps" class="dropdown-toggle" href="#" onclick="getLinks()" data-toggle="dropdown">
									<i class="fa fa-th"></i> All Apps
								</a>
								<div class="dropdown-menu hdropdown bigmenu dropdown-menu-right ">
									<table class="table">
										<tbody id="links-panel"></tbody>
									</table>
								</div>
							</li>

							<li class="dropdown navbar-user">
								<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">

									<i class="fa fa-user"></i><span class="hidden-xs"> <?Php echo($this->session->userdata('fname').' '.$this->session->userdata('sname')); ?></span> <b class="caret"></b>
								</a>
								<ul class="dropdown-menu animated fadeInLeft">
									<li class="arrow"></li>
								
									<li><a href="<?=base_url('password')?>"><i class="fa fa-cogs"></i> Application Settings</a></li>
									<li><a href="<?=base_url('logout')?>"><i class="fa fa-remove"></i> Log Out</a></li>

								</ul>
							</li>
						</ul>
						<!-- end header navigation right -->
					</div>
					<!-- end container-fluid -->
				</div>
				<!-- end #header -->

