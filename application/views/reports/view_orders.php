<body >
<!--Header Section-->
<?Php $this->load->view('templates/app_header');?>

<!--Navigation Section-->
<?Php
if( $user_role === 'ADMIN'){
    $this->load->view('templates/navigation');
}else if($user_role === 'SUPER_USER'){
    $this->load->view('templates/navigation_super_user');
}else if($user_role === 'USER'){
    $this->load->view('templates/navigation_user');
}else if($user_role === 'MANAGER'){
    $this->load->view('templates/navigation_manager');
}else{
    $this->load->view('templates/navigation_consumer');
}
?>

<div id="content" class="no-sidebar"> <!-- Content start -->
    <div class="top_bar">
        <ul class="breadcrumb">
            <li><a href="<?=base_url('dashboard')?>"><i class="icon-home"></i> Home</a> <span class="divider">/</span></li>
            <li class="active"><a>Orders Report</a></li>
        </ul>
    </div>
    <div class="inner_content">
        <div id="alert_placeholder">
            <?php
            $appmsg = $this->session->flashdata('appmsg');
            if(!empty($appmsg)){ ?>
                <div id="alertdiv" class="alert <?=$this->session->flashdata('alert_type') ?> "><a class="close" data-dismiss="alert">x</a><span><?= $appmsg ?></span></div>
            <?php } ?>
        </div>
        <div class="widgets_area">

            <div class="well blue">
                <div class="well-header">
                    <h5>View Orders</h5>
                </div>
                <div class="well-content no_search">
                    <!--<div class="row-fluid margin_b20">

                        <span>From: </span>
                        <div class="input-append date"  data-date="" data-date-format="dd-mm-yyyy">
                            <input size="16" type="text"  readonly id="fini">
                            <span class="add-on"><i class="icon-calendar"></i></span>
                        </div>
                        <span>To: </span>
                        <div class="input-append date"  data-date="" data-date-format="dd-mm-yyyy">
                            <input size="16" type="text" readonly id="ffin">
                            <span class="add-on"><i class="icon-calendar"></i></span>
                        </div>
                    </div>-->

                    <table class="table-bordered table-hover display table-font" width="100%" cellspacing="0" id="example">
                        <thead>

                        <tr>
                            <th>Mobile number</th>
                            <th>Order Ref</th>
                            <th>Order Status</th>
                            <th>Retailer</th>
                            <th>Retailer location</th>
                            <th>Retailer Region</th>
                            <th>Stockist Code</th>
                            <th>Stockist Name</th>
                            <th>Payment Type</th>
                            <th>Amount</th>
                            <th>Delivery Date</th>
                            <th>Order Date</th>
                            <th>Action</th>


                        </tr>
                        </thead>

                    </table>

                </div>
            </div>

        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="<?= base_url('assets/js/jquery-1.11.1.js'); ?>"></script>
<script src="<?= base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/tabletools/js/datatables.tableTools.js'); ?>"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        var table =jQuery('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "scrollCollapse": true,
            "jQueryUI": true,
            "scrollX": true,
            "scrollY": 400,
            "pagingType": "full_numbers",
            "pageLength": 50,
            "lengthMenu": [[50, 100,250,500,-1], [50, 100,250,500,"All"]],
            "dom": 'T<"clearfix"><"margin-b"lf<"clearfix">>trip',

            "tableTools": {
                "sSwfPath": "<?= base_url('assets/tabletools/swf/copy_csv_xls_pdf.swf');?>",
                "aButtons": [ "copy", "csv","xls","pdf" ]
            },

            columns: [

                { "data": "msisdn" },
                { "data": "invoice_no" },
                { "data": "order_status"},
                { "data": "business_name"},
                { "data": "town" },
                { "data": "region"},
                { "data": "distributor_code"},
                { "data": "distributor_name"},
                { "data": "payment_type"},
                { "data": "received_amount"},
                { "data": "delivery_date"},
                { "data": "created"},
                { "data": "actions","orderable": false,"searchable": false }

            ],
            "order": [[ 11, "desc" ]],
            "oLanguage": {
                "sProcessing": "<img src='<?= base_url('assets/img/loading.gif'); ?>'>"
            },
            "ajax":{
                "url": "<?=base_url('reports/orders/datatable')?>",
                "type": "POST"
            }

        });

       /* jQuery( "#fini" ).datepicker();
         jQuery( "#ffin" ).datepicker();

         jQuery('#fini').keyup( function() { table.draw(); } );
         jQuery('#ffin').keyup( function() { table.draw(); } );

        jQuery.fn.dataTableExt.afnFiltering.push(
            function( oSettings, aData, iDataIndex ) {
                var iFini = document.getElementById('fini').value;
                var iFfin = document.getElementById('ffin').value;
                var iStartDateCol = 7;
                var iEndDateCol = 7;
                iFini=iFini.substring(6,10) + iFini.substring(3,5)+ iFini.substring(0,2);
                iFfin=iFfin.substring(6,10) + iFfin.substring(3,5)+ iFfin.substring(0,2);
                var datofini=aData[iStartDateCol].substring(6,10) + aData[iStartDateCol].substring(3,5)+ aData[iStartDateCol].substring(0,2);
                var datoffin=aData[iEndDateCol].substring(6,10) + aData[iEndDateCol].substring(3,5)+ aData[iEndDateCol].substring(0,2);
                if ( iFini === "" && iFfin === "" )
                {
                    return true;
                }
                else if ( iFini <= datofini && iFfin === "")
                {
                    return true;
                }
                else if ( iFfin >= datoffin && iFini === "")
                {
                    return true;
                }
                else if (iFini <= datofini && iFfin >= datoffin)
                {
                    return true;
                }
                return false;
            }
        );*/

    });

</script>
<script src="<?php echo base_url('assets/datatables/js/responsive.js'); ?>"></script>
<script src="<?php echo base_url('assets/datatables/js/range_dates.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery-ui-1.10.3.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>

<script src="<?php echo  base_url('assets/js/library/jquery.collapsible.min.js'); ?>"></script>
<script src="<?php echo  base_url('assets/js/library/jquery.mCustomScrollbar.min.js'); ?>"></script>
<script src="<?php echo  base_url('assets/js/library/jquery.mousewheel.min.js'); ?>"></script>
<script src="<?php echo  base_url('assets/js/library/jquery.uniform.min.js'); ?>"></script>
<script src="<?php echo  base_url('assets/js/library/bootstrap-datetimepicker.js'); ?>"></script>
<script src="<?php echo  base_url('assets/js/library/bootstrap-datepicker.js'); ?>"></script>

<script src="<?php echo  base_url('assets/js/library/jquery.autosize-min.js'); ?>"></script>


<script src="<?php echo base_url('assets/js/design_core.js'); ?>"></script>

</body>
</html>
