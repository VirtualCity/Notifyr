
<?php $path=base_url(); ?>
<!doctype html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url() ?>favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Notifyr | </title>

	<!-- Canonical SEO -->
    <link rel="canonical" href="../../../../www.creative-tim.com/product/paper-dashboard-pro.html"/>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


     <!-- Bootstrap core CSS     -->
    <link href="<?php echo $path;?>assets/css/bootstrap.min.css" rel="stylesheet" />

    <!--  Paper Dashboard core CSS    -->
    <link href="<?php echo $path;?>assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo $path;?>assets/css/demo.css" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="../../../../maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='../../../../fonts.googleapis.com/cssbba8.css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="<?php echo $path;?>assets/css/themify-icons.css" rel="stylesheet">

</head>

<body>

	<div class="wrapper">



	    <div class="main-panel">
			<nav class="navbar navbar-default">
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
	                    <a class="navbar-brand" href="#datatable">DataTables.net</a>
	                </div>
	                <div class="collapse navbar-collapse">
						<form class="navbar-form navbar-left navbar-search-form" role="search">
	    					<div class="input-group">
	    						<span class="input-group-addon"><i class="fa fa-search"></i></span>
	    						<input type="text" value="" class="form-control" placeholder="Search...">
	    					</div>
	    				</form>
	                    <ul class="nav navbar-nav navbar-right">
	                        <li>
	                            <a href="#stats" class="dropdown-toggle btn-magnify" data-toggle="dropdown">
	                                <i class="ti-panel"></i>
									<p>Stats</p>
	                            </a>
	                        </li>
	                        <li class="dropdown">
	                            <a href="#notigfications" class="dropdown-toggle" data-toggle="dropdown">
	                                <i class="ti-bell"></i>
	                                <span class="notification">5</span>
									<p class="hidden-md hidden-lg">
										Notifications
										<b class="caret"></b>
									</p>
	                            </a>
	                        	<ul class="dropdown-menu">
	                                <li><a href="#not1">Notification 1</a></li>
	                                <li><a href="#not2">Notification 2</a></li>
	                                <li><a href="#not3">Notification 3</a></li>
	                                <li><a href="#not4">Notification 4</a></li>
	                                <li><a href="#another">Another notification</a></li>
	                            </ul>
	                        </li>
							<li>
	                            <a href="#settings" class="btn-rotate">
									<i class="ti-settings"></i>
									<p class="hidden-md hidden-lg">
										Settings
									</p>
	                            </a>
	                        </li>
	                    </ul>
	                </div>
	            </div>
            </nav>
            
<!-- ===========================================end of header======================================== -->

<!-- =============================left nav start=============================================== -->
		<div class="sidebar" data-background-color="brown" data-active-color="danger">
	    <!--
			Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown"
			Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
		-->
			<div class="logo">
				<a href="https://www.creative-tim.com/" class="simple-text logo-mini">
					Notifyr
				</a>

				<a href="https://www.creative-tim.com/" class="simple-text logo-normal">
                    VirtualCity
				</a>
            </div>
            
            
	    	<div class="sidebar-wrapper">
				<div class="user">
	                <div class="photo">
	                    <img src="<?php echo $path;?>assets/img/faces/face-2.jpg" />
	                </div>
	                <div class="info">
						<a data-toggle="collapse" href="#collapseExample" class="collapsed">
	                        <span>
								Chet Faker
		                        <b class="caret"></b>
							</span>
	                    </a>
						<div class="clearfix"></div>

	                    <div class="collapse" id="collapseExample">
	                        <ul class="nav">
	                            <li>
									<a href="#profile">
										<span class="sidebar-mini">Mp</span>
										<span class="sidebar-normal">My Profile</span>
									</a>
								</li>
	                            <li>
									<a href="#edit">
										<span class="sidebar-mini">Ep</span>
										<span class="sidebar-normal">Edit Profile</span>
									</a>
								</li>
	                            <li>
									<a href="#settings">
										<span class="sidebar-mini">S</span>
										<span class="sidebar-normal">Settings</span>
									</a>
								</li>
	                        </ul>
	                    </div>
	                </div>
                </div>
                
                
	            <ul class="nav">
					<li>
	                    <a data-toggle="collapse" href="#dashboardOverview">
	                        <i class="ti-panel"></i>
	                        <p>Dashboard
                                <b class="caret"></b>
                            </p>
	                    </a>
                        <div class="collapse" id="dashboardOverview">
							<ul class="nav">
								<li>
									<a href="../dashboard/overview.html">
										<span class="sidebar-mini">O</span>
										<span class="sidebar-normal">Overview</span>
									</a>
								</li>
								<li>
									<a href="../dashboard/stats.html">
										<span class="sidebar-mini">S</span>
										<span class="sidebar-normal">Stats</span>
									</a>
								</li>
							</ul>
						</div>
	                </li>
	                <li>
	                    <a data-toggle="collapse" href="#componentsExamples">
	                        <i class="ti-package"></i>
	                        <p>Components
	                           <b class="caret"></b>
	                        </p>
	                    </a>
	                    <div class="collapse" id="componentsExamples">
							<ul class="nav">
	                            <li>
									<a href="../components/buttons.html">
										<span class="sidebar-mini">B</span>
										<span class="sidebar-normal">Buttons</span>
									</a>
								</li>
	                            <li>
									<a href="../components/grid.html">
										<span class="sidebar-mini">GS</span>
										<span class="sidebar-normal">Grid System</span>
									</a>
								</li>
	                            <li>
									<a href="../components/panels.html">
										<span class="sidebar-mini">P</span>
										<span class="sidebar-normal">Panels</span>
									</a>
								</li>
	                            <li>
									<a href="../components/sweet-alert.html">
										<span class="sidebar-mini">SA</span>
										<span class="sidebar-normal">Sweet Alert</span>
									</a>
								</li>
	                            <li>
									<a href="../components/notifications.html">
										<span class="sidebar-mini">N</span>
										<span class="sidebar-normal">Notifications</span>
									</a>
								</li>
	                            <li>
									<a href="../components/icons.html">
										<span class="sidebar-mini">I</span>
										<span class="sidebar-normal">Icons</span>
									</a>
								</li>
	                            <li>
									<a href="../components/typography.html">
										<span class="sidebar-mini"><i class="ti-panel"></i></span>
										<span class="sidebar-normal">Typography</span>
									</a>
								</li>
	                        </ul>
	                    </div>
	                </li>
	                <li>
						<a data-toggle="collapse" href="#formsExamples">
	                        <i class="ti-clipboard"></i>
	                        <p>
								Forms
	                           <b class="caret"></b>
	                        </p>
	                    </a>
	                    <div class="collapse" id="formsExamples">
							<ul class="nav">
								<li>
									<a href="../forms/regular.html">
										<span class="sidebar-mini">Rf</span>
										<span class="sidebar-normal">Regular Forms</span>
									</a>
								</li>
								<li>
									<a href="../forms/extended.html">
										<span class="sidebar-mini">Ef</span>
										<span class="sidebar-normal">Extended Forms</span>
									</a>
								</li>
								<li>
									<a href="../forms/validation.html">
										<span class="sidebar-mini">Vf</span>
										<span class="sidebar-normal">Validation Forms</span>
									</a>
								</li>
	                            <li>
									<a href="../forms/wizard.html">
										<span class="sidebar-mini">W</span>
										<span class="sidebar-normal">Wizard</span>
									</a>
								</li>
	                        </ul>
	                    </div>
	                </li>
					<li class="active">
						<a data-toggle="collapse" href="#tablesExamples">
	                        <i class="ti-view-list-alt"></i>
	                        <p>
								Table list
	                           <b class="caret"></b>
	                        </p>
	                    </a>
	                    <div class="collapse in" id="tablesExamples">
							<ul class="nav">
								<li>
									<a href="regular.html">
										<span class="sidebar-mini">RT</span>
										<span class="sidebar-normal">Regular Tables</span>
									</a>
								</li>
								<li>
									<a href="extended.html">
										<span class="sidebar-mini">ET</span>
										<span class="sidebar-normal">Extended Tables</span>
									</a>
								</li>
								<li>
									<a href="bootstrap-table.html">
										<span class="sidebar-mini">BT</span>
										<span class="sidebar-normal">Bootstrap Table</span>
									</a>
								</li>
								<li class="active">
									<a href="datatables.net.html">
										<span class="sidebar-mini">DT</span>
										<span class="sidebar-normal">DataTables.net</span>
									</a>
								</li>
	                        </ul>
	                    </div>
	                </li>
	                <li>
						<a data-toggle="collapse" href="#mapsExamples">
	                        <i class="ti-map"></i>
	                        <p>
								Maps
	                           <b class="caret"></b>
	                        </p>
	                    </a>
	                    <div class="collapse" id="mapsExamples">
							<ul class="nav">
								<li>
									<a href="../maps/google.html">
										<span class="sidebar-mini">GM</span>
										<span class="sidebar-normal">Google Maps</span>
									</a>
								</li>
								<li>
									<a href="../maps/vector.html">
										<span class="sidebar-mini">VM</span>
										<span class="sidebar-normal">Vector maps</span>
									</a>
								</li>
								<li>
									<a href="../maps/fullscreen.html">
										<span class="sidebar-mini">FSM</span>
										<span class="sidebar-normal">Full Screen Map</span>
									</a>
								</li>
	                        </ul>
	                    </div>
	                </li>
	                <li>
	                    <a href="../charts.html">
	                        <i class="ti-bar-chart-alt"></i>
	                        <p>Charts</p>
	                    </a>
	                </li>
	                <li>
	                    <a href="../calendar.html">
	                        <i class="ti-calendar"></i>
	                        <p>Calendar</p>
	                    </a>
	                </li>
	                <li>
						<a data-toggle="collapse" href="#pagesExamples">
	                        <i class="ti-gift"></i>
	                        <p>
								Pages
	                           <b class="caret"></b>
	                        </p>
	                    </a>
	                    <div class="collapse" id="pagesExamples">
							<ul class="nav">
								<li>
									<a href="../pages/timeline.html">
										<span class="sidebar-mini">TP</span>
										<span class="sidebar-normal">Timeline Page</span>
									</a>
								</li>
								<li>
									<a href="../pages/user.html">
										<span class="sidebar-mini">UP</span>
										<span class="sidebar-normal">User Page</span>
									</a>
								</li>
								<li>
									<a href="../pages/login.html">
										<span class="sidebar-mini">LP</span>
										<span class="sidebar-normal">Login Page</span>
									</a>
								</li>
								<li>
									<a href="../pages/register.html">
										<span class="sidebar-mini">RP</span>
										<span class="sidebar-normal">Register Page</span>
									</a>
								</li>
								<li>
									<a href="../pages/lock.html">
										<span class="sidebar-mini">LSP</span>
										<span class="sidebar-normal">Lock Screen Page</span>
									</a>
								</li>
	                        </ul>
	                    </div>
	                </li>
	            </ul>
	    	</div>
        </div>
<!-- =============================left nav ends=============================================== -->

	        <div class="content">
	            <div class="container-fluid">
	                <div class="row">
	                    <div class="col-md-12">
							<h4 class="title">DataTables.net</h4>
							<p class="category">A powerful jQuery plugin handcrafted by our friends from <a href="https://datatables.net/" target="_blank">dataTables.net</a>. It is a highly flexible tool, based upon the foundations of progressive enhancement and will add advanced interaction controls to any HTML table. Please check out the <a href="https://datatables.net/manual/index" target="_blank">full documentation.</a></p>

							<br>

	                        <div class="card">
	                            <div class="card-content">
	                                <div class="toolbar">
	                                    <!--Here you can write extra buttons/actions for the toolbar-->
	                                </div>
                                    <div class="fresh-datatables">
										<table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
										<thead>
											<tr>
												<th>Name</th>
												<th>Position</th>
												<th>Office</th>
												<th>Age</th>
												<th>Start date</th>
												<th class="disabled-sorting">Actions</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>Name</th>
												<th>Position</th>
												<th>Office</th>
												<th>Age</th>
												<th>Start date</th>
												<th>Actions</th>
											</tr>
										</tfoot>
										<tbody>
											<tr>
												<td>Tiger Nixon</td>
												<td>System Architect</td>
												<td>Edinburgh</td>
												<td>61</td>
												<td>2011/04/25</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<input type="checkbox" class="switch-plain" checked>
												</td>
											</tr>
											<tr>
												<td>Garrett Winters</td>
												<td>Accountant</td>
												<td>Tokyo</td>
												<td>63</td>
												<td>2011/07/25</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Ashton Cox</td>
												<td>Junior Technical Author</td>
												<td>San Francisco</td>
												<td>66</td>
												<td>2009/01/12</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Cedric Kelly</td>
												<td>Senior Javascript Developer</td>
												<td>Edinburgh</td>
												<td>22</td>
												<td>2012/03/29</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Airi Satou</td>
												<td>Accountant</td>
												<td>Tokyo</td>
												<td>33</td>
												<td>2008/11/28</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Brielle Williamson</td>
												<td>Integration Specialist</td>
												<td>New York</td>
												<td>61</td>
												<td>2012/12/02</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Herrod Chandler</td>
												<td>Sales Assistant</td>
												<td>San Francisco</td>
												<td>59</td>
												<td>2012/08/06</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Rhona Davidson</td>
												<td>Integration Specialist</td>
												<td>Tokyo</td>
												<td>55</td>
												<td>2010/10/14</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Colleen Hurst</td>
												<td>Javascript Developer</td>
												<td>San Francisco</td>
												<td>39</td>
												<td>2009/09/15</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Sonya Frost</td>
												<td>Software Engineer</td>
												<td>Edinburgh</td>
												<td>23</td>
												<td>2008/12/13</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Jena Gaines</td>
												<td>Office Manager</td>
												<td>London</td>
												<td>30</td>
												<td>2008/12/19</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Quinn Flynn</td>
												<td>Support Lead</td>
												<td>Edinburgh</td>
												<td>22</td>
												<td>2013/03/03</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Charde Marshall</td>
												<td>Regional Director</td>
												<td>San Francisco</td>
												<td>36</td>
												<td>2008/10/16</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Haley Kennedy</td>
												<td>Senior Marketing Designer</td>
												<td>London</td>
												<td>43</td>
												<td>2012/12/18</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Tatyana Fitzpatrick</td>
												<td>Regional Director</td>
												<td>London</td>
												<td>19</td>
												<td>2010/03/17</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Michael Silva</td>
												<td>Marketing Designer</td>
												<td>London</td>
												<td>66</td>
												<td>2012/11/27</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Paul Byrd</td>
												<td>Chief Financial Officer (CFO)</td>
												<td>New York</td>
												<td>64</td>
												<td>2010/06/09</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Gloria Little</td>
												<td>Systems Administrator</td>
												<td>New York</td>
												<td>59</td>
												<td>2009/04/10</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Bradley Greer</td>
												<td>Software Engineer</td>
												<td>London</td>
												<td>41</td>
												<td>2012/10/13</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Dai Rios</td>
												<td>Personnel Lead</td>
												<td>Edinburgh</td>
												<td>35</td>
												<td>2012/09/26</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Jenette Caldwell</td>
												<td>Development Lead</td>
												<td>New York</td>
												<td>30</td>
												<td>2011/09/03</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Yuri Berry</td>
												<td>Chief Marketing Officer (CMO)</td>
												<td>New York</td>
												<td>40</td>
												<td>2009/06/25</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Caesar Vance</td>
												<td>Pre-Sales Support</td>
												<td>New York</td>
												<td>21</td>
												<td>2011/12/12</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Doris Wilder</td>
												<td>Sales Assistant</td>
												<td>Sidney</td>
												<td>23</td>
												<td>2010/09/20</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
											<tr>
												<td>Angelica Ramos</td>
												<td>Chief Executive Officer (CEO)</td>
												<td>London</td>
												<td>47</td>
												<td>2009/10/09</td>
												<td>
													<a href="#" class="btn btn-simple btn-info btn-icon like"><i class="ti-heart"></i></a>
													<a href="#" class="btn btn-simple btn-warning btn-icon edit"><i class="ti-pencil-alt"></i></a>
													<a href="#" class="btn btn-simple btn-danger btn-icon remove"><i class="ti-close"></i></a>
												</td>
											</tr>
										   </tbody>
									    </table>
									</div>


	                            </div>
	                        </div><!--  end card  -->
	                    </div> <!-- end col-md-12 -->
	                </div> <!-- end row -->
	            </div>
	        </div>


            <!-- ===================================start of footer======================================== -->
            <?php $path=base_url(); ?>
	        <footer class="footer">
	            <div class="container-fluid">
	                <nav class="pull-left">
	                    <ul>
	                        <li>
	                            <a href="https://www.creative-tim.com/">
	                                Creative Tim
	                            </a>
	                        </li>
	                        <li>
	                            <a href="https://blog.creative-tim.com/">
	                               Blog
	                            </a>
	                        </li>
	                        <li>
	                            <a href="https://www.creative-tim.com/license">
	                                Licenses
	                            </a>
	                        </li>
	                    </ul>
	                </nav>
					<div class="copyright pull-right">
	                    &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="https://www.virtualcity.co.ke/">VirtualCity</a>
	                </div>
	            </div>
	        </footer>
	    </div>
	</div>


    <!-- ===============================right color plugin starts================================= -->
	<div class="fixed-plugin">
        <div class="dropdown">
            <a href="#" data-toggle="dropdown">
            <i class="fa fa-cog fa-2x"> </i>
            </a>
            <ul class="dropdown-menu">
                <li class="header-title">Sidebar Background</li>
                <li class="adjustments-line text-center">
                    <a href="javascript:void(0)" class="switch-trigger background-color">
                        <span class="badge filter badge-brown active" data-color="brown"></span>
                        <span class="badge filter badge-white" data-color="white"></span>
                    </a>
                </li>

    			<li class="header-title">Sidebar Active Color</li>
                <li class="adjustments-line text-center">
                    <a href="javascript:void(0)" class="switch-trigger active-color">
                            <span class="badge filter badge-primary" data-color="primary"></span>
                            <span class="badge filter badge-info" data-color="info"></span>
                            <span class="badge filter badge-success" data-color="success"></span>
                            <span class="badge filter badge-warning" data-color="warning"></span>
                            <span class="badge filter badge-danger active" data-color="danger"></span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <!-- ====================================right color plugin ends============================== -->

</body>

	<!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
	<script src="<?php echo $path;?>assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo $path;?>assets/js/jquery-ui.min.js" type="text/javascript"></script>
	<script src="<?php echo $path;?>assets/js/perfect-scrollbar.min.js" type="text/javascript"></script>
	<script src="<?php echo $path;?>assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Forms Validations Plugin -->
	<script src="<?php echo $path;?>assets/js/jquery.validate.min.js"></script>

	<!-- Promise Library for SweetAlert2 working on IE -->
	<script src="<?php echo $path;?>assets/js/es6-promise-auto.min.js"></script>

	<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
	<script src="<?php echo $path;?>assets/js/moment.min.js"></script>

	<!--  Date Time Picker Plugin is included in this js file -->
	<script src="<?php echo $path;?>assets/js/bootstrap-datetimepicker.js"></script>

	<!--  Select Picker Plugin -->
	<script src="<?php echo $path;?>assets/js/bootstrap-selectpicker.js"></script>

	<!--  Switch and Tags Input Plugins -->
	<script src="<?php echo $path;?>assets/js/bootstrap-switch-tags.js"></script>

	<!-- Circle Percentage-chart -->
	<script src="<?php echo $path;?>assets/js/jquery.easypiechart.min.js"></script>

	<!--  Charts Plugin -->
	<script src="<?php echo $path;?>assets/js/chartist.min.js"></script>

	<!--  Notifications Plugin    -->
	<script src="<?php echo $path;?>assets/js/bootstrap-notify.js"></script>

	<!-- Sweet Alert 2 plugin -->
	<script src="<?php echo $path;?>assets/js/sweetalert2.js"></script>

	<!-- Vector Map plugin -->
	<script src="<?php echo $path;?>assets/js/jquery-jvectormap.js"></script>

	<!--  Google Maps Plugin    -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFPQibxeDaLIUHsC6_KqDdFaUdhrbhZ3M"></script>

	<!-- Wizard Plugin    -->
	<script src="<?php echo $path;?>assets/js/jquery.bootstrap.wizard.min.js"></script>

	<!--  Bootstrap Table Plugin    -->
	<script src="<?php echo $path;?>assets/js/bootstrap-table.js"></script>

	<!--  Plugin for DataTables.net  -->
	<script src="<?php echo $path;?>assets/js/jquery.datatables.js"></script>

	<!--  Full Calendar Plugin    -->
	<script src="<?php echo $path;?>assets/js/fullcalendar.min.js"></script>

	<!-- Paper Dashboard PRO Core javascript and methods for Demo purpose -->
	<script src="<?php echo $path;?>assets/js/paper-dashboard.js"></script>

	<!--   Sharrre Library    -->
	<script src="<?php echo $path;?>assets/js/jquery.sharrre.js"></script>

	<!-- Paper Dashboard PRO DEMO methods, don't include it in your project! -->
	<script src="<?php echo $path;?>assets/js/demo.js"></script>

	<script type="text/javascript">
	    $(document).ready(function() {

	        $('#datatables').DataTable({
	            "pagingType": "full_numbers",
	            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
	            responsive: true,
	            language: {
	            search: "_INPUT_",
		            searchPlaceholder: "Search records",
		        }
	        });


	        var table = $('#datatables').DataTable();
	         // Edit record
	         table.on( 'click', '.edit', function () {
	            $tr = $(this).closest('tr');

	            var data = table.row($tr).data();
	            alert( 'You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.' );
	         } );

	         // Delete a record
	         table.on( 'click', '.remove', function (e) {
	            $tr = $(this).closest('tr');
	            table.row($tr).remove().draw();
	            e.preventDefault();
	         } );

	        //Like record
	        table.on( 'click', '.like', function () {
	            alert('You clicked on Like button');
	         });

	    });
	</script>


<!-- Mirrored from demos.creative-tim.com/paper-dashboard-pro/examples/tables/datatables.net.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 08 Apr 2019 15:16:11 GMT -->
</html>
