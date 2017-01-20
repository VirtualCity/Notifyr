<body >
<!--Header Section-->
<?Php $this->load->view('templates/app_header');?>

<!--Navigation Section-->
<?Php
if( $user_role === 'ADMIN'){
    $this->load->view('templates/navigation');
}else if($user_role === 'SUPER_USER'){
    $this->load->view('templates/navigation_super_user');
}else{
    $this->load->view('templates/navigation_user');
}
?>

<div id="content" class="no-sidebar"> <!-- Content start -->
    <div class="top_bar">
        <ul class="breadcrumb">
            <li><a href="<?=base_url("dashboard")?>"><i class="icon-home"></i> Home</a> <span class="divider">/</span></li>
            <li class="active"><a>Dashboard</a></li>
        </ul>
    </div>
    <div class="inner_content">
        <div class="statistic clearfix">
            <div class="current_page pull-left">
                <span><i class="icon-dashboard"></i> Dashboard</span> <span class="hidden-480 quote">- SMS Portal</span>
            </div>
        </div>

        <div class="report-widgets">
            <div class="row-fluid">
                <div class="span4">
                    <div class="widget yellow clearfix">
                        <div class="content">
                            <div class="icon">
                                <i class="icon-envelope"></i>
                                Total Received Today
                            </div>
                            <div class="value" id="visitors_count">
                                <?= $todays_total; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span4">
                    <div class="widget dark_turq clearfix">
                        <div class="content">
                            <div class="icon">
                                <i class="icon-envelope"></i>
                                Total Received last 7 days
                            </div>
                            <div class="value" id="today_reports">
                                <?= $weeks_total; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span4">
                    <div class="widget orange clearfix">
                        <div class="content">
                            <div class="icon">
                                <i class="icon-envelope"></i>
                                Total Received Last 30 days
                            </div>
                            <div class="value" id="total_reports">
                                <?= $months_total; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php //if($user_role !== 'STOCKIST') {?>
        <div class="status-widgets">
            <div class="row-fluid">
                <div class="span4">
                    <div class="widget blue clearfix">
                        <div class="options">

                            <i class="icon-group"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="surveys_count">
                                <?= $contacts_total; ?>
                            </div>
                            <div class="description">
                                Contacts
                            </div>
                        </div>
                    </div>
                </div>

                <div class="span4">
                    <div class="widget grey clearfix">
                        <div class="options">
                            <i class="icon-group"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="active_survey">
                                <?= $groups_total; ?>
                            </div>
                            <div class="description">
                                Groups
                            </div>
                        </div>
                    </div>
                </div>

                <div class="span4">
                    <div class="widget red clearfix">
                        <div class="options">
                            <i class="icon-list-alt"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="category_count">
                                <?= $blacklist_total; ?>
                            </div>
                            <div class="description">
                                Blacklisted
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="widgets_area">
            <div class="row-fluid">
                <h5>Cummulative Queries in the Last 7 Days</h5>
                <div class="well blue">

                    <div class="well-content no_search no_padding">
                        <div class="chart-container" >
                            <div id="totals_chart" class="mychart"> </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <h5>Total Group Messages in the Last 7 Days</h5>
                <div class="well blue">

                    <div class="well-content no_search no_padding">
                        <div class="chart-container">
                            <div id="groups_chart" class="mychart"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>




<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo($base); ?>assets/js/jquery-1.11.1.js"></script>
<script src="<?php echo($base); ?>assets/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo($base); ?>assets/js/jquery-ui-1.10.3.js"></script>
<script src="<?php echo($base); ?>assets/js/bootstrap.js"></script>

<script src="<?php echo($base); ?>assets/js/library/jquery.collapsible.min.js"></script>
<script src="<?php echo($base); ?>assets/js/library/jquery.mCustomScrollbar.min.js"></script>
<script src="<?php echo($base); ?>assets/js/library/jquery.mousewheel.min.js"></script>
<script src="<?php echo($base); ?>assets/js/library/jquery.uniform.min.js"></script>
<script src="<?php echo($base); ?>assets/js/library/jquery.sparkline.min.js"></script>
<script src="<?php echo($base); ?>assets/js/library/chosen.jquery.min.js"></script>
<script src="<?php echo($base); ?>assets/js/library/jquery.autosize-min.js"></script>
<script src="<?php echo($base); ?>assets/js/library/footable/footable.js"></script>

<script src="<?php echo($base); ?>assets/js/design_core.js"></script>

<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="<?=base_url('assets/charts/excanvas.js')?>"></script><![endif]-->
<script src="<?=base_url('assets/charts/jquery.flot.js')?>"></script>
<script src="<?=base_url('assets/charts/jquery.flot.time.min.js')?>"></script>
<script src="<?=base_url('assets/charts/jquery.flot.axislabels.js')?>"></script>
<script src="<?=base_url('assets/charts/jquery.flot.orderBars.js')?>"></script>
<script src="<?=base_url('assets/charts/jquery.flot.resize.js')?>"></script>

<script type="text/javascript">
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
</script>
</body>
</html>