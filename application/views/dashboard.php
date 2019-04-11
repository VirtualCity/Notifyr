<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<div class="col-xs-5">
								<div class="icon-big icon-warning text-center">

									<i class="ti-wallet"></i>
								</div>
							</div>
							<div class="col-xs-7">
								<div class="numbers">
									<p>Available SMS Balance</p>
									<?= $sms_balance; ?>
								</div>
								
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
							&nbsp;<br>
							</div>
							<div class="col-md-6">
							&nbsp;<br>
							</div>
						</div>
					</div>
					<div class="card-footer">
				<hr />
				<div class="stats">
				<i class="ti-clipboard"></i><div class="my-inline-block" id="campaign-name4"></div>
				</div>
				</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<div class="col-xs-5">
								<div class="icon-big icon-success text-center">
									<i class="ti-user"></i>
								</div>
							</div>
							<div class="col-xs-7">
								<div class="numbers">
									<p>List</p>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
							<span class="pull-left text-primary">Groups : <?= $groups_total; ?></span>
							<span class="pull-right text-primary">Contacts : <?= $contacts_total; ?><span>
							</div>
							<div class="col-md-6">
							<span class="pull-right text-danger">Blacklisted : <?= $blacklist_total; ?></span>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<hr />
						<div class="stats">
							<i class="ti-calendar"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">

		<div class="col-lg-6 col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">SMS Analytics</h4>
					<!-- <p class="category">Plain text tabs</p> -->
				</div>
				<div class="card-content">
					<div class="nav-tabs-navigation">
						<div class="nav-tabs-wrapper">
							<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
								<li class="active"><a href="#home" data-toggle="tab">Sent</a></li>
								<li><a href="#profile" data-toggle="tab">Received</a></li>
								<li><a href="#messages" data-toggle="tab">Messages</a></li>
							</ul>
						</div>
					</div>
					<div id="my-tab-content" class="tab-content text-center">
						<div class="tab-pane active" id="home">
							<div class="card ">
								<div class="card-header">
									<h4 class="card-title">2015 Sales</h4>
									<p class="category">All products including Taxes</p>
								</div>
								<div class="card-content">
									<div id="chartActivity" class="ct-chart"></div>
								</div>
								<div class="card-footer">
									<div class="chart-legend">
										<i class="fa fa-circle text-info"></i> Tesla Model S
										<i class="fa fa-circle text-warning"></i> BMW 5 Series
									</div>
									<hr>
									<div class="stats">
										<i class="ti-check"></i> Data information certified
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="profile">
							<p>Here is your profile.</p>
						</div>
						<div class="tab-pane" id="messages">
							<p>Here are your messages.</p>
						</div>
					</div>
				</div>
			</div>
		</div>

			

		</div>
	</div>
</div>
