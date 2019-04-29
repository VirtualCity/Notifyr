<?php $path=base_url(); ?>
<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url() ?>favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Notifyr | <?php echo $title ?></title>

	<!-- Canonical SEO -->
    <!-- <link rel="canonical" href="../../../../www.creative-tim.com/product/paper-dashboard-pro.html"/> -->

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


     <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" />

    <!--  Paper Dashboard core CSS    -->
    <link href="<?php echo base_url()?>assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo base_url()?>assets/css/demo.css" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="<?php echo base_url()?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link href='<?php echo base_url()?>assets/fonts.googleapis.com/cssbba8.css?family=Muli:400,300' rel='stylesheet' type='text/css'>
	<link href="<?php echo base_url()?>assets/css/themify-icons.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>assets/css/sweetalert.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url() ?>assets/css/multiple-select.css" rel="stylesheet" type="text/css" />

</head>

<body>

	<div class="wrapper">

	    <div class="main-panel">
			<nav class="navbar navbar-default navigation">
	            <div class="container-fluid">
					<div class="navbar-minimize">
						<button id="minimizeSidebar" class="btn btn-fill btn-icon"><i class="ti-more-alt"></i></button>
					</div>
	                <div class="navbar-header">
	                    <button type="button" class="navbar-toggle">
	                        <span class="sr-only">Toggle navigation</span>
	                        <span class="icon-bar bar1"></span>
	                        <span class="icon-bar bar2"></span>
	                        <span class="icon-bar bar3"></span>
	                    </button>
	                    <a class="navbar-brand" href="<?php echo base_url('dashboard')?>"><?php echo $title ?></a>
	                </div>
	                <div class="collapse navbar-collapse">

	                    <ul class="nav navbar-nav navbar-right">
	                        
	                        <li class="dropdown">
	                            <a href="#notigfications" class="dropdown-toggle text-success" data-toggle="dropdown">

									<?Php echo($this->session->userdata('fname').' '.$this->session->userdata('sname')); ?> (<?Php echo($this->session->userdata('role'));?>)
									<span><i class="ti-arrow-circle-down"></i></span>
	                            </a>
	                        	<ul class="dropdown-menu">
	                                <li><a href="<?=base_url('users/profile')?>"><span><i class="ti-user"></i></span> My Profile</a></li>
									<li><a href="<?=base_url('password')?>"><span><i class="ti-lock"></i></span> Change Password</a></li>
	                                <li><a href="<?=base_url('logout')?>"><span><i class="ti-power-off"></i></span>  Logout</a></li>
	                            </ul>
	                        </li>
							
	                    </ul>
	                </div>
	            </div>
            </nav>
            