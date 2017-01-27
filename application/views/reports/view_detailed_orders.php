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
            <li><a href="<?=base_url('dashboard')?>"><i class="icon-home"></i> Home</a> <span class="divider">/</span></li>
            <li class="active"><a>Detailed Orders Report</a></li>
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
                    <h5>View Detailed Orders</h5>
                </div>
                <div class="well-content no_search">

                    <table class="table table-striped table-bordered table-hover datatable" width="100%" cellspacing="0" id="example">
                        <thead>
                        <tr>
                            <th>Retailer Mobile</th>
                            <th>Order Ref</th>
                            <th>Order Status</th>
                            <th>SKU Code</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Packing</th>
                            <th>Business Name</th>
                            <th>Region</th>
                            <th>Location</th>
                            <th>Distributor Code</th>
                            <th>Distributor Name</th>
                            <th>Receive Date</th>

                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
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
        jQuery('#example').dataTable({

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
                "sSwfPath": "<?= base_url('assets/tabletools/swf/copy_csv_xls_pdf.swf');?>"
            },
            aoColumns: [

                { "data": "msisdn" },
                { "data": "invoice_no" },
                { "data": "order_status"},
                { "data": "sku_code" },
                { "data": "item_code" },
                { "data": "description" },
                { "data": "quantity" },
                { "data": "item_um" },
                { "data": "business_name" },
                { "data": "region" },
                { "data": "town" },
                { "data": "distributor_code" },
                { "data": "distributor_name"},
                { "data": "created"}

            ],
            "order": [[ 13, "desc" ]],
            "oLanguage": {
                "sProcessing": "<img src='<?= base_url('assets/img/loading.gif'); ?>'>"
            },
            "ajax":{
                "url": "<?=base_url('reports/detailed_orders/datatable')?>",
                "type": "POST"
            }
        });
    });

</script>

<script src="<?php echo base_url('assets/js/jquery-ui-1.10.3.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>

<script src="<?php echo  base_url('assets/js/library/jquery.collapsible.min.js'); ?>"></script>
<script src="<?php echo  base_url('assets/js/library/jquery.mCustomScrollbar.min.js'); ?>"></script>
<script src="<?php echo  base_url('assets/js/library/jquery.mousewheel.min.js'); ?>"></script>
<script src="<?php echo  base_url('assets/js/library/jquery.uniform.min.js'); ?>"></script>

<script src="<?php echo  base_url('assets/js/library/jquery.autosize-min.js'); ?>"></script>


<script src="<?php echo base_url('assets/js/design_core.js'); ?>"></script>

</body>
</html>
