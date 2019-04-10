<?php $path=base_url();?>
<!-- <div class="sidebar" data-background-color="brown" data-active-color="danger"> -->
<div class="sidebar" data-background-color="white" data-active-color="brown">
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