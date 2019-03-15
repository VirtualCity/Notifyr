 
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">

            <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                    </div>
                    <h4 class="panel-title">Dashboard</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="statistic widget-stats">
                            <div class="current_page pull-left">
                                <span><i class="fa fa-dashboard"></i> Dashboard</span> <span class="hidden-480 quote">- SMS Portal</span>
                            </div>
                        </div>
                        <br>
                        <div class="report-widgets">
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <div class="widget widget-stats bg-green">
                                        <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                                        <div class="stats-info">
                                            <h4>Total Received Today</h4>
                                            <p id="visitors_count"> <?= $todays_total; ?></p>    
                                        </div>
                                        <div class="stats-link">
                                            <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-sm-6">
                                    <div class="widget widget-stats bg-purple">
                                        <div class="stats-icon"><i class="fa fa-envelope"></i></div>
                                        <div class="stats-info">
                                            <h4>Total Received last 7 days</h4>
                                            <p id="today_reports"> <?= $weeks_total; ?></p>    
                                        </div>
                                        <div class="stats-link">
                                            <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-sm-6">
                                    <div class="widget widget-stats bg-blue">
                                        <div class="stats-icon"><i class="fa fa-envelope"></i></div>
                                        <div class="stats-info">
                                            <h4>Total Received Last 30 days</h4>
                                            <p id="total_reports"> <?= $months_total; ?></p>    
                                        </div>
                                        <div class="stats-link">
                                            <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="report-widgets">
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <div class="widget widget-stats bg-green">
                                        <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                                        <div class="stats-info">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <h4>Total Sent Today</h4>
                                                    <p id="visitors_count"> <?= $today_sent_totals; ?></p>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <h4> Delivered :  <?= $today_success; ?></h4>
                                                    <h4> Failed    : <?= $today_failed; ?></h4>
                                                    <h4> Pending   : <?= $today_pending; ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="stats-link">
                                            <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-sm-6">
                                    <div class="widget widget-stats bg-purple">
                                        <div class="stats-icon"><i class="fa fa-envelope"></i></div>
                                        <div class="stats-info">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <h4>Total Sent last 7 days</h4>
                                                    <p id="today_reports"> <?= $weeks_sent_total; ?></p>   
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <h4> Delivered :  <?= $week_success; ?></h4>
                                                    <h4> Failed    : <?= $week_failed; ?></h4>
                                                    <h4> Pending   : <?= $week_pending; ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="stats-link">
                                            <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-sm-6">
                                    <div class="widget widget-stats bg-blue">
                                        <div class="stats-icon"><i class="fa fa-envelope"></i></div>
                                        <div class="stats-info">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6">
                                                    <h4>Total Sent Last 30 days</h4>
                                                    <p id="total_reports"> <?= $months_sent_total; ?></p>
                                                </div>
                                                <div class="col-md-6 col-sm-6">
                                                    <h4> Delivered :  <?= $month_success; ?></h4>
                                                    <h4> Failed    : <?= $month_failed; ?></h4>
                                                    <h4> Pending   : <?= $month_pending; ?></h4>
                                                </div>
                                            </div>
                                                
                                        </div>
                                        <div class="stats-link">
                                            <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <?php //if($user_role !== 'STOCKIST') {?>
                        <div class="status-widgets">
                            <div class="row">

                             <div class="col-md-4 col-sm-6">
                                    <div class="widget widget-stats bg-green">
                                        <div class="stats-icon"><i class="fa fa-group"></i></div>
                                        <div class="stats-info">
                                            <h4>Contacts</h4>
                                            <p id="surveys_count"> <?= $contacts_total; ?></p>    
                                        </div>
                                        <div class="stats-link">
                                            <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <div class="widget widget-stats bg-purple">
                                        <div class="stats-icon"><i class="fa fa-group"></i></div>
                                        <div class="stats-info">
                                            <h4>Groups</h4>
                                            <p id="active_survey"> <?= $groups_total; ?></p>    
                                        </div>
                                        <div class="stats-link">
                                            <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <div class="widget widget-stats bg-blue">
                                        <div class="stats-icon"><i class="fa fa-group"></i></div>
                                        <div class="stats-info">
                                            <h4>Blacklisted</h4>
                                            <p id="category_count"> <?= $blacklist_total; ?></p>    
                                        </div>
                                        <div class="stats-link">
                                            <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <div class="widget widget-stats bg-green">
                                        <div class="stats-icon"><i class="fa fa-money"></i></div>
                                        <div class="stats-info">
                                            <h4>Available SMS Balance</h4>
                                            <p id="category_count"> <?= $sms_balance; ?></p>    
                                        </div>
                                        <div class="stats-link">
                                            <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <div class="widget widget-stats bg-purple">
                                        <div class="stats-icon"><i class="fa fa-envelope"></i></div>
                                        <div class="stats-info">
                                            <div class="row">
                                                <h4>Total Bulk Messages Pending Approval </h4>
                                                <p id="category_count"> <?= $sms_pending; ?></p> 
                                            </div>
                                              
                                        </div>
                                        <div class="stats-link">
                                            <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
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
<!-- end #content -->

<!-- <script type="text/javascript">
     jQuery(document).ready(function(){
        /*Cummulative Query Chart*/
        var data2 = [<?php echo $last_7days_cummulative; ?>];

        var dataset2 = [
            {
                label: "Cummulative Queries",
                data: data2
            }
        ];

        var options2 = {
            series: {

                lines: {
                    show: true,
                    fill: true,
                    fillColor: { colors: [{opacity: 0.25}, {opacity: 0}] }
                },
                points: {
                    radius: 4,
                    lineWidth: 1,fill: true,

                    show: true
                },
                shadowSize: 5
            },
            tooltip: true,

            grid: {
                hoverable: true,
                borderWidth: {
                    top: 0,
                    right: 0,
                    bottom: 1,
                    left: 1
                },
                mouseActiveRadius: 50,

                labelMargin:10,
                margin: {
                    top: 20,
                    left: 10,
                    bottom: 10,
                    right: 20
                }
            },
            xaxis: {
                // position: "bottom",
                mode: "time",

                /*axisLabel:"Days",*/
                tickSize: [1, "day"],
                tickLength: 1,
                axisLabelFontFamily: 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 11,
                axisLabelPadding: 5
            },
            yaxis: {
                min: 0,
                minTickSize: 1,
                tickDecimals: 0,
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
                axisLabelPadding: 5
                /*axisLabel:"Messages"*/
                //tickFormatter: function(val, axis) { return val < axis.max ? val.toFixed(2) : "Messages";}
            }
        };

        jQuery.plot($("#totals_chart"), dataset2, options2);
            });
</script> -->

<!-- <script type="text/javascript">
    jQuery(document).ready(function(){

        /*Groups Message Chart*/
        var dq1 = [<?php echo $last_7days_received; ?>];
        var dq2 = [<?php echo $last_7days_replied; ?>];

        var ordersData = [
            {
                label: "Received Messages",
                data: dq1,
                bars: {
                    show: true,
                    barWidth: 24 * 60 * 60 * 250,
                    fill: true,
                    lineWidth: 0.5,
                    order: 1,
                    fillColor:  "#4572A7"
                },
                color: "#4572A7"
            },
            {
                label: "Reply Messages",
                data: dq2,
                bars: {
                    show: true,
                    barWidth: 24 * 60 * 60 * 250,
                    fill: true,
                    lineWidth: 0.5,
                    order: 2,
                    fillColor:  "#89A54E"
                },
                color: "#89A54E"
            }
        ];

        var ordersOptions = {
            series: {
                shadowSize: 5
            },
            tooltip: true,

            grid: {
                hoverable: true,
                borderWidth: {
                    top: 0,
                    right: 0,
                    bottom: 1,
                    left: 1
                }

            },
            xaxis: {

                mode: "time",
                tickSize: [1, "day"],
                tickLength: 0,
                // axisLabel:"Days",
                axisLabelFontFamily: 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 11,
                axisLabelPadding: 15
            },
            yaxis: {
                min: 0,
                minTickSize: 1,
                tickDecimals: 0,
                //axisLabel:"No of SMS",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
                axisLabelPadding: 5
                //tickFormatter: function(val, axis) { return val < axis.max ? val.toFixed(2) : "Messages";}
            },
            legend: {
                labelBoxBorderColor: "#777777",
                position: "left"
            }
        };



        jQuery(".mychart").resizable({
            maxWidth: 900,
            maxHeight: 500,
            minWidth: 450,
            minHeight: 250
        });



        jQuery.plot(jQuery("#groups_chart"), ordersData, ordersOptions);
    });
</script> -->



 