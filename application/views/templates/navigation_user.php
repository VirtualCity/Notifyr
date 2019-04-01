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
                        <li><a href="<?=base_url('sms/newsms')?>">New SMS</a></li>
                        <li><a href="<?=base_url('sms/newbulksms')?>">New Bulk SMS</a></li>
                        <li><a href="<?=base_url('sms/pendingbulksms')?>">Pending SMS</a></li>
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
					</ul>
				</li>

				<li class="has-sub">
					<a href="javascript:;">
						<b class="caret pull-right"></b>
						<i class="fa fa-shopping-cart"></i>
						<span>Products</span>
					</a>
					<ul class="sub-menu">
						<li><a href="<?=base_url('products')?>">View Products</a></li>
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

				<li><a href="<?=base_url('password')?>"><i class="fa fa-cogs"></i> Settings</a></li>
				<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			</ul>
		</div>
	</div>
	<div class="sidebar-bg"></div>