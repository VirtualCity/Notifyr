<?php $path=base_url();?>
<div class="sidebar" data-background-color="white" data-active-color="brown">
	    <!--
			Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown"
			Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
		-->
			<div class="logo">
				<!-- <span>
					<a href="<?php echo base_url('dashboard');?>" class="simple-text logo-mini">
						L
					</a>
				</span> -->
				<a href="<?php echo base_url('dashboard');?>" class="simple-text logo-normal">
                    <img src="<?php echo base_url();?>assets/v2/img/vc-logo.png" alt="logo">
				</a>
				
            </div>
            
            
	    	<div class="sidebar-wrapper">
				<div class="user">
	                <div class="photo">
	                    <img src="<?php echo $path;?>assets/img/faces/face-2.png" />
	                </div>
	                <div class="info">
						<a data-toggle="collapse" href="#collapseExample" class="collapsed">
	                        <span>
							<?Php echo($this->session->userdata('fname').' '.$this->session->userdata('sname')); ?>
		                        <b class="caret"></b>
							</span>
	                    </a>
						<div class="clearfix"></div>

	                    <div class="collapse" id="collapseExample">
	                        <ul class="nav">
	                            <li>
									<a href="<?=base_url('users/profile')?>">
										<span class="sidebar-mini">Mp</span>
										<span class="sidebar-normal">My Profile</span>
									</a>
								</li>
	                            <!-- <li>
									<a href="#edit">
										<span class="sidebar-mini">Ep</span>
										<span class="sidebar-normal">Edit Profile</span>
									</a>
								</li>
	                            <li>
									<a href="<?=base_url('password')?>">
										<span class="sidebar-mini">S</span>
										<span class="sidebar-normal">Settings</span>
									</a>
								</li> -->
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
						<a data-toggle="collapse" href="#mapsExamples">
	                        <i class="ti-comment-alt"></i>
	                        <p>
								SMS Campaign
	                           <b class="caret"></b>
	                        </p>
	                    </a>
	                    <div class="collapse" id="mapsExamples">
							<ul class="nav">
								<li>
									<a href="<?=base_url('sms/pendingbulksms')?>">
										<span class="sidebar-mini">PS</span>
										<span class="sidebar-normal">Pending SMS</span>
									</a>
								</li>
								
								<li>
									<a href="<?=base_url('sms/newsms/templates')?>">
										<span class="sidebar-mini">ST</span>
										<span class="sidebar-normal">SMS Templates</span>
									</a>
								</li>
	                        </ul>
	                    </div>
	                </li>
					<li>
	                    <a href="<?=base_url('contacts')?>">
						<i class="ti-list"></i>
						<p>Contacts</p>
						</a>
					</li>
					
					<li>
	                    <a href="<?=base_url('users/active')?>">
						<i class="ti-user"></i>
						<p>Users</p>
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
	                        <p>Enterprises
	                           <b class="caret"></b>
	                        </p>
	                    </a>
	                    <div class="collapse" id="factories">
							<ul class="nav">
	                            <li>
									<a href="<?=base_url('factories')?>">
										<span class="sidebar-mini">VF</span>
										<span class="sidebar-normal">View Enterprises</span>
									</a>
								</li>
	                            <!-- <li>
									<a href="<?=base_url('factories/import')?>">
										<span class="sidebar-mini">IF</span>
										<span class="sidebar-normal">Import Factory</span>
									</a>
								</li> -->
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
	                            <!-- <li>
									<a href="<?=base_url('regions/import')?>">
										<span class="sidebar-mini">IR</span>
										<span class="sidebar-normal">Import Regions</span>
									</a>
								</li> -->
	                        </ul>
	                    </div>
					</li>

					<!-- <li>
	                    <a href="<?php echo base_url('settings/configuration');?>">
						<i class="ti-settings"></i>
						<p>Settings</p>
						</a>
					</li> -->

	                <!-- <li>
						<a data-toggle="collapse" href="#formsExamples">
	                        <i class="ti-bar-chart-alt"></i>
	                        <p>
							SMS Reports
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
	                </li> -->
	            </ul>
	    	</div>
        </div>