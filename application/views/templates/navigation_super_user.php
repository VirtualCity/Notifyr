<?php $path=base_url();?>
<div class="sidebar" data-background-color="white" data-active-color="brown">
	    <!--
			Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown"
			Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
		-->
			<div class="logo">
				<a href="<?php echo base_url('dashboard');?>" class="simple-text logo-mini">
					N
				</a>

				<a href="<?php echo base_url('dashboard');?>" class="simple-text logo-normal">
                    Notifyr
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
	                    <a href="<?php echo base_url('dashboard');?>">
						<i class="ti-panel"></i>
						<p>Dashboard</p>
						</a>
					</li>
					<li>
	                    <a href="<?=base_url('contacts')?>">
						<i class="ti-list"></i>
						<p>Contacts</p>
						</a>
	                </li>
					
	                <li>
	                    <a data-toggle="collapse" href="#groups">
	                        <i class="ti-package"></i>
	                        <p>Groups
	                           <b class="caret"></b>
	                        </p>
	                    </a>
	                    <div class="collapse" id="groups">
							<ul class="nav">
	                            <li>
									<a href="<?=base_url('groups')?>">
										<span class="sidebar-mini">G</span>
										<span class="sidebar-normal">View Groups</span>
									</a>
								</li>
	                            <li>
									<a href="<?=base_url('groups/add')?>">
										<span class="sidebar-mini">AG</span>
										<span class="sidebar-normal">Add Group</span>
									</a>
								</li>
	                            <li>
									<a href="<?=base_url('groups/import')?>">
										<span class="sidebar-mini">IG</span>
										<span class="sidebar-normal">Import to Group</span>
									</a>
								</li>
	                        </ul>
	                    </div>
					</li>
					
					<li>
	                    <a data-toggle="collapse" href="#smslogs">
	                        <i class="ti-email"></i>
	                        <p>SMS Logs
	                           <b class="caret"></b>
	                        </p>
	                    </a>
	                    <div class="collapse" id="smslogs">
							<ul class="nav">
	                            <li>
									<a href="<?=base_url('logs/inbox')?>">
										<span class="sidebar-mini">IL</span>
										<span class="sidebar-normal">SMS Inbox log</span>
									</a>
								</li>
	                            <li>
									<a href="<?=base_url('logs/outbox')?>">
										<span class="sidebar-mini">SL</span>
										<span class="sidebar-normal">SMS Sent log</span>
									</a>
								</li>
	                            <li>
									<a href="<?=base_url('logs/autoreplies')?>">
										<span class="sidebar-mini">AL</span>
										<span class="sidebar-normal">Autoreply log</span>
									</a>
								</li>
	                        </ul>
	                    </div>
					</li>
					
					<li>
	                    <a data-toggle="collapse" href="#factories">
	                        <i class="ti-home"></i>
	                        <p>Factories
	                           <b class="caret"></b>
	                        </p>
	                    </a>
	                    <div class="collapse" id="factories">
							<ul class="nav">
	                            <li>
									<a href="<?=base_url('factories')?>">
										<span class="sidebar-mini">VF</span>
										<span class="sidebar-normal">View Factories</span>
									</a>
								</li>
	                            <li>
									<a href="<?=base_url('factories/import')?>">
										<span class="sidebar-mini">IF</span>
										<span class="sidebar-normal">Import Factory</span>
									</a>
								</li>
								<li>
									<a href="<?=base_url('factories/factory_usage_report')?>">
										<span class="sidebar-mini">UR</span>
										<span class="sidebar-normal">Usage Report</span>
									</a>
								</li>
	                        </ul>
	                    </div>
					</li>

					<li>
	                    <a data-toggle="collapse" href="#region">
	                        <i class="ti-layout-column3"></i>
	                        <p>Regions
	                           <b class="caret"></b>
	                        </p>
	                    </a>
	                    <div class="collapse" id="region">
							<ul class="nav">
	                            <li>
									<a href="<?=base_url('regions')?>">
										<span class="sidebar-mini">VR</span>
										<span class="sidebar-normal">View Regions</span>
									</a>
								</li>
	                            <li>
									<a href="<?=base_url('regions/import')?>">
										<span class="sidebar-mini">IR</span>
										<span class="sidebar-normal">Import Regions</span>
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