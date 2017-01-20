<?php $path=base_url();?>
<div id="sidebar" class="sidebar">
	<div data-scrollbar="true" data-height="100%">
		<ul class="nav">
			<li class="nav-profile">
				<div class="image">
					<a href="javascript:;"><img src="<?php echo $path;?>assets/v2/img/gsoko.png" alt="" /></a>
				</div>
			</li>
		</ul>

		<ul class="nav">
			<ul class="nav">
				<li class="nav-header">Navigation</li>



				<li class="has-sub">
					<a href="javascript:;">
						<b class="caret pull-right"></b>
						<i class="fa fa-laptop"></i>
						<span>Auction Management</span>
					</a>
					<ul class="sub-menu">
						<?php if ($this->session->userdata('role')==="CLERK" || $this->session->userdata('role')==="MANAGER"): ?>
							<li>
								<a href="<?= base_url('auction') ?>"><i class="fa fa-tags"></i> Trading Grain Notes</a>
							</li>

						<?php elseif ($this->session->userdata('role')==="ADMIN"): ?>
							<li><a href="<?= base_url('auction/import') ?>"><i class="fa fa-download"></i> Import Grain
								Notes</a></li>

							<?php elseif ($this->session->userdata('role')==="MANAGER"): ?>
								<li><a href="<?=base_url('auction/closed')?>"><i class="fa fa-certificate"></i>Approve Closed Auction</a></li>

							<?php endif ?>

						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-bar-chart"></i>
							<span>Auction Reports</span>
						</a>
						<ul class="sub-menu">
							<li><a href="<?=base_url('reports/closed')?>"><i class="fa fa-flag"></i> Closed Auctions</a></li>
							<li><a href="<?=base_url('reports/winners')?>"><i class="fa fa-trophy"></i> Winning Bids</a></li>				</ul>
						</li>

						<?php if ($this->session->userdata('role')==="ADMIN"): ?>
							<li class="has-sub">
								<a href="javascript:;">
									<b class="caret pull-right"></b>
									<i class="fa fa-user"></i>
									<span>User Management</span>
								</a>
								<ul class="sub-menu">
									<li><a href="<?=base_url('users/active')?>"><i class="fa fa-circle"></i> Active Users</a></li>
									<li><a href="<?=base_url('users/suspended')?>"><i class="fa fa-circle-o"></i> Suspended Users</a></li>
									<li><a href="<?=base_url('users/add')?>"><i class="fa fa-plus"></i> Add User</a></li>								</ul>
								</li>
							<?php endif ?>
							<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="sidebar-bg"></div>
<!-- <?php $path=base_url();?>
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
				
				
				
				<li class="has-sub">
					<a href="javascript:;">
						<b class="caret pull-right"></b>
						<i class="fa fa-laptop"></i>
						<span>Auction Management</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="<?= base_url('auction') ?>"><i class="fa fa-tags"></i> Trading Grain Notes</a>
						</li>

						<li><a href="<?= base_url('auction/import') ?>"><i class="fa fa-download"></i> Import Grain
							Notes</a></li>

							<li><a href="<?=base_url('auction/closed')?>"><i class="fa fa-certificate"></i>Approve Closed Auction</a></li>

						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;">
							<b class="caret pull-right"></b>
							<i class="fa fa-bar-chart"></i>
							<span>Auction Reports</span>
						</a>
						<ul class="sub-menu">
							<li><a href="<?=base_url('reports/closed')?>"><i class="fa fa-flag"></i> Closed Auctions</a></li>
							<li><a href="<?=base_url('reports/winners')?>"><i class="fa fa-trophy"></i> Winning Bids</a></li>				</ul>
						</li>

						<li class="has-sub">
							<a href="javascript:;">
								<b class="caret pull-right"></b>
								<i class="fa fa-user"></i>
								<span>User Management</span>
							</a>
							<ul class="sub-menu">
								<li><a href="<?=base_url('users/active')?>"><i class="fa fa-circle"></i> Active Users</a></li>
								<li><a href="<?=base_url('users/suspended')?>"><i class="fa fa-circle-o"></i> Suspended Users</a></li>
								<li><a href="<?=base_url('users/add')?>"><i class="fa fa-plus"></i> Add User</a></li>								</ul>
							</li>

							<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="sidebar-bg"></div> -->