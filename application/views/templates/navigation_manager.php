<?php $path=base_url();?>
<div id="sidebar" class="sidebar">
	<div data-scrollbar="true" data-height="100%">
		<ul class="nav">
			<li class="nav-profile">
				<div class="image">
					<a href="javascript:;"><img src="<?php echo $path;?>assets/v2/img/vc-logo.png" alt="" /></a>
				</div>
			</li>
		</ul>

		<ul class="nav">
			<ul class="nav">
				<li class="nav-header">Navigation</li>
				<li><a href="<?=base_url('dashboard')?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

				<li class="has-sub">
					<a href="javascript:;">
						<b class="caret pull-right"></b>
						<i class="fa fa-envelope"></i>
						<span>SMS</span>
					</a>
					<ul class="sub-menu">
						<li><a href="<?=base_url('sms/pendingbulksms')?>">Pending SMS</a></li>
						<li><a href="<?=base_url('sms/newbulksms/uploadexcel')?>">New SMS From Excel</a></li>
						<li><a href="<?=base_url('sms/newsms/smstemplate')?>">New SMS Template</a></li>
						<li><a href="<?=base_url('sms/newsms/templates')?>">Template List</a></li>

					</ul>
				</li>
				
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret pull-right"></b>
                        <i class="fa fa-group"></i>
                        <span>Contacts</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="<?=base_url('contacts')?>">View Contacts</a></li>
                        <li><a href="<?=base_url('contacts/add')?>">Add Contact</a></li>
                    </ul>
                </li>

				<li class="has-sub">
					<a href="javascript:;">
						<b class="caret pull-right"></b>
						<i class="fa fa-puzzle-piece"></i>
						<span>SMS Groups</span>
					</a>
					<ul class="sub-menu">
						<li><a href="<?=base_url('groups')?>">View Groups</a></li>
						<li><a href="<?=base_url('groups/add')?>">Add Group</a></li>
						<li><a href="<?=base_url('groups/import')?>">Import to Group</a></li>
					</ul>
				</li>

				<li class="has-sub">
					<a href="javascript:;">
						<b class="caret pull-right"></b>
						<i class="fa fa-bar-chart"></i>
						<span>SMS Reports</span>
					</a>
					<ul class="sub-menu">
						<li><a href="<?=base_url('reports/cummulative')?>">Cumulative Queries</a></li>
						<li><a href="<?=base_url('reports/purchases')?>">Purchase Report</a></li>
						<li><a href="<?=base_url('reports/received')?>">Group Messages Received</a></li>
						<li><a href="<?=base_url('reports/replied')?>">Group Messages Replied</a></li>
						<li><a href="<?=base_url('reports/pending')?>">Group Messages Pending</a></li>
						<li><a href="<?=base_url('reports/bulksms')?>">Bulk Alerts Sent</a></li>
						<li><a href="<?=base_url('reports/sms')?>">Single Alerts Sent</a></li>
						<li><a href="<?=base_url('reports/subscribed')?>">Subscribed Contacts</a></li>
						<li><a href="<?=base_url('reports/subscriptions')?>">Subscription Messages</a></li>
						<li><a href="<?=base_url('reports/managers')?>">Managers Reports </a></li>
						<li><a href="<?=base_url('reports/supervisors')?>">Clerks Reports</a></li>
					</ul>
				</li>

				<li class="has-sub">
					<a href="javascript:;">
						<b class="caret pull-right"></b>
						<i class="fa fa-comments"></i>
						<span>SMS Logs</span>
					</a>
					<ul class="sub-menu">
						<li><a href="<?=base_url('logs/inbox')?>">SMS Inbox log</a></li>
						<li><a href="<?=base_url('logs/outbox')?>">SMS Sent log</a></li>
						<li><a href="<?=base_url('logs/autoreplies')?>">Autoreply log</a></li>

					</ul>
				</li>

				<li class="has-sub">
					<a href="javascript:;">
						<b class="caret pull-right"></b>
						<i class="fa fa-flag"></i>
						<span>Blacklist</span>
					</a>
					<ul class="sub-menu">
						<li><a href="<?=base_url('blacklist')?>">View Blacklist</a></li>
						<li><a href="<?=base_url('addblacklist')?>">Blacklist Number</a></li>

					</ul>
				</li>

				<li class="has-sub">
					<a href="javascript:;">
						<b class="caret pull-right"></b>
						<i class="fa fa-shopping-cart"></i>
						<span>Services</span>
					</a>
					<ul class="sub-menu">
						<li><a href="<?=base_url('products')?>">View Services</a></li>
						<li><a href="<?=base_url('products/add')?>">Add Service</a></li>
						<li><a href="<?=base_url('products/import')?>">Import Service</a></li>
					</ul>
				</li>

				<li class="has-sub">
					<a href="javascript:;">
						<b class="caret pull-right"></b>
						<i class="fa fa-map-marker"></i>
						<span>Towns</span>
					</a>
					<ul class="sub-menu">
						<li><a href="<?=base_url('towns')?>">View Towns</a></li>
						<li><a href="<?=base_url('towns/add')?>">Add Town</a></li>
						<li><a href="<?=base_url('towns/import')?>">Import Towns</a></li>
					</ul>
				</li>

				<li class="has-sub">
					<a href="javascript:;">
						<b class="caret pull-right"></b>
						<i class="fa fa-globe"></i>
						<span>Regions</span>
					</a>
					<ul class="sub-menu">
						<li><a href="<?=base_url('regions')?>">View Regions</a></li>
					</ul>
				</li>

				<?php if ($this->session->userdata('role')!=="USER"): ?>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-circle-o"></i>
							<span>Clerks</span>
						</a>
						<ul class="sub-menu">
							<li><a href="<?=base_url('supervisors')?>">View Clerks</a></li>
							<li><a href="<?=base_url('supervisors/add')?>">Add Clerk</a></li>
							<li><a href="<?=base_url('supervisors/import')?>">Import Clerk</a></li>
						</ul>
					</li>

					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-circle"></i>
							<span>Managers</span>
						</a>
						<ul class="sub-menu">
							<li><a href="<?=base_url('managers')?>">View Managers</a></li>
							<li><a href="<?=base_url('managers/add')?>">Add Manager</a></li>
							<li><a href="<?=base_url('managers/import')?>">Import Managers</a></li>

						</ul>
					</li>

				<?php endif ?>

				<li><a href="<?=base_url('password')?>"><i class="fa fa-cogs"></i> Settings</a></li>

				<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			</ul>
		</div>
	</div>
	<div class="sidebar-bg"></div>