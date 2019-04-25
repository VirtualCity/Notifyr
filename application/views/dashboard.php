<div class="content">

	<div class="row">
	<div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
           <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
       </ol>
   </div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6">
				<div class="card">
					<div class="card-content">
						<div class="row">
							<div class="col-xs-5">
								<div class="icon-big icon-success text-center">

									<i class="ti-money"></i>
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
				<hr>
				<div class="stats">
				<i class="ti-clipboard"></i> <?php if ($sms_balance < 500) { ?><span class="text-warning pull-right"><i class="ti ti-alert"></i> low balance</span><?php } ?><div class="my-inline-block" id="campaign-name4"></div>
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
						<hr>
						<div class="stats">
							<i class="ti-calendar"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">SMS Analytics</h4> 
						<span class="">
								<?Php if($user_role==="USER" || $user_role==="SUPER_USER"){ ?>
									<div class="row">
										<div class="col-md-12 col-xs-12 pull-right">
											<div class="dropdown pull-right">
												<button href="#" class="btn btn-success btn-fill btn-block dropdown-toggle" data-toggle="dropdown">
													Add New SMS
													<b class="caret"></b>
												</button>
												<ul class="dropdown-menu">
													<li><a href="<?=base_url('sms/newsms')?>">Single SMS</a></li>
													<li><a href="<?=base_url('sms/newbulksms')?>">Bulk SMS</a></li>
												</ul>
											</div>
										</div>
									</div>
								<?Php  } ?>
						</span>
					</div>
					<div class="card-content">
						<div class="nav-tabs-navigation">
							<div class="nav-tabs-wrapper">
								<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
									<li class="active"><a id="todayh" href="#today" data-toggle="tab">Today</a></li>
									<li><a id="weekh" href="#week" data-toggle="tab">Last 7 Days</a></li>
									<li><a id="monthh" href="#month" data-toggle="tab">Last 30 Days</a></li>
									<li><a id="pendingh" href="#pending" data-toggle="tab">Pending Approval</a></li>
								</ul>
							</div>
						</div>
						<div id="my-tab-content" class="tab-content text-center">
							<div class="tab-pane active" id="today">
								<div class="card ">
									<div class="card-header">
									</div>
									<div class="card-content">
										<div id="containertoday" style="height: auto; width: 100%;" class="ct-chart"></div>
									</div>
									<div class="card-footer">
									</div>
								</div>
							</div>
							<div class="tab-pane" id="week">
								<div class="card">
											<div class="card-header">
													
											</div>

											<div class="content">
													<div id="containerweek" style="height: auto; width: 100%;" class="ct-chart"></div>
											</div>

											<div class="card-footer">
													
											</div>
									</div>
							</div>
							<div class="tab-pane" id="month">
								<div class="card">
											<div class="card-header">
													
											</div>

											<div class="content">
													<div id="containermonth" style="height: auto; width: 100%;" class="ct-chart"></div>
											</div>

											<div class="card-footer">
													
											</div>
									</div>
							</div>

							<div class="tab-pane" id="pending">
								<div class="card">
											<div class="card-header">
													
											</div>

											<div class="content">
													<div id="containerpending" style="height: auto; width: 100%;" class="ct-chart"></div>
											</div>

											<div class="card-footer">
													
											</div>
									</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
<script src="<?php echo base_url()?>assets/js/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/canvasjs.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/highcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/exporting.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/export-data.js" type="text/javascript"></script>


<script type="text/javascript">

	$(document).ready(function() {
			
		
			var today = Highcharts.chart('containertoday', {
					chart: {
							type: 'column'
					},
					title: {
							text: 'SMS Usage Report'
					},
					subtitle: {
							text: 'Today'
					},
					xAxis: {
							categories: ['SMS'],
							crosshair: true
					},
					yAxis: {
							min: 0,
							title: {
									text: 'Count'
							}
					},
					tooltip: {
							headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
							pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
									'<td style="padding:0"><b>{point.y}</b></td></tr>',
							footerFormat: '</table>',
							shared: true,
							useHTML: true
					},
					plotOptions: {
							column: {
									pointPadding: 0.2,
									borderWidth: 0
							}
					},
					
					series: [{
							name: 'Sent',
							data: [<?php echo $today_sent_totals; ?>]
					}, {
							name: 'Pending',
							data: [<?php echo $today_pending; ?>]
					}, {
							name: 'Delivered',
							data: [<?php echo $today_success; ?>]
					}, {
							name: 'Failed',
							data: [<?php echo $today_failed; ?>]
					}, {
							name: 'Received',
							data: [<?php echo $todays_total; ?>]
					}]
			});

		$('#todayh').click(()=>{
			var today = Highcharts.chart('containertoday', {
					chart: {
							type: 'column'
					},
					title: {
							text: 'SMS Usage Report'
					},
					subtitle: {
							text: 'Today'
					},
					xAxis: {
							categories: ['SMS'],
							crosshair: true
					},
					yAxis: {
							min: 0,
							title: {
									text: 'Count'
							}
					},
					tooltip: {
							headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
							pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
									'<td style="padding:0"><b>{point.y}</b></td></tr>',
							footerFormat: '</table>',
							shared: true,
							useHTML: true
					},
					plotOptions: {
							column: {
									pointPadding: 0.2,
									borderWidth: 0
							}
					},
					
					series: [{
							name: 'Sent',
							data: [<?php echo $today_sent_totals; ?>]
					}, {
							name: 'Pending',
							data: [<?php echo $today_pending; ?>]
					}, {
							name: 'Delivered',
							data: [<?php echo $today_success; ?>]
					}, {
							name: 'Failed',
							data: [<?php echo $today_failed; ?>]
					}, {
							name: 'Received',
							data: [<?php echo $todays_total; ?>]
					}]
			});
		});

		
			console.log( "ready!" );

	$('#weekh').click(()=>{
			var week = Highcharts.chart('containerweek', {
					chart: {
							type: 'column'
					},
					title: {
							text: 'SMS Usage Report'
					},
					subtitle: {
							text: 'Last 7 Days'
					},
					xAxis: {
						categories: ['SMS'],
							crosshair: true
					},
					yAxis: {
							min: 0,
							title: {
									text: 'Count'
							}
					},
					tooltip: {
							headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
							pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
									'<td style="padding:0"><b>{point.y}</b></td></tr>',
							footerFormat: '</table>',
							shared: true,
							useHTML: true
					},
					plotOptions: {
							column: {
									pointPadding: 0.2,
									borderWidth: 0
							}
					},
					series: [{
							name: 'Sent',
							data: [<?php echo $weeks_sent_total; ?>]
					}, {
							name: 'Pending',
							data: [<?php echo $week_pending; ?>]
					}, {
							name: 'Delivered',
							data: [<?php echo $week_success; ?>]
					}, {
							name: 'Failed',
							data: [<?php echo $week_failed; ?>]
					}, {
							name: 'Received',
							data: [<?php echo $weeks_total; ?>]
					}]
			});
		});


		$('#monthh').click(()=>{
			var month = Highcharts.chart('containermonth', {
					chart: {
							type: 'column'
					},
					title: {
							text: 'SMS Usage Report'
					},
					subtitle: {
							text: 'Last 30 Days'
					},
					xAxis: {
						categories: ['SMS'],
							crosshair: true
					},
					yAxis: {
							min: 0,
							title: {
									text: 'Count'
							}
					},
					tooltip: {
							headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
							pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
									'<td style="padding:0"><b>{point.y}</b></td></tr>',
							footerFormat: '</table>',
							shared: true,
							useHTML: true
					},
					plotOptions: {
							column: {
									pointPadding: 0.2,
									borderWidth: 0
							}
					},
					series: [{
							name: 'Sent',
							data: [<?php echo $months_sent_total; ?>]
					}, {
							name: 'Pending',
							data: [<?php echo $month_pending; ?>]
					}, {
							name: 'Delivered',
							data: [<?php echo $month_success; ?>]
					}, {
							name: 'Failed',
							data: [<?php echo $month_failed; ?>]
					}, {
							name: 'Received',
							data: [<?php echo $months_total; ?>]
					}]
			});
		});


		$('#pendingh').click(()=>{
			var month = Highcharts.chart('containerpending', {
					chart: {
							type: 'column'
					},
					title: {
							text: 'SMS Report'
					},
					subtitle: {
							text: 'Pending Approval'
					},
					xAxis: {
						categories: ['SMS'],
							crosshair: true
					},
					yAxis: {
							min: 0,
							title: {
									text: 'Count'
							}
					},
					tooltip: {
							headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
							pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
									'<td style="padding:0"><b>{point.y}</b></td></tr>',
							footerFormat: '</table>',
							shared: true,
							useHTML: true
					},
					plotOptions: {
							column: {
									pointPadding: 0.2,
									borderWidth: 0
							}
					},
					series: [{
							name: 'Sent',
							data: [<?php echo $sms_pending; ?>]
					}]
			});
		});
	
	});

</script>



