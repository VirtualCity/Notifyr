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
            <li><a href="<?=base_url("reports/orders")?>">Orders Report</a><span class="divider">/</span></li>
            <li class="active"><a>Products</a></li>
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

            <div class="well green ">
                <div class="well-content no_search">
                    <div class="row-fluid">
                        <table class="span4 margin_b20">
                            <thead><tr><th><h4>Order Information</h4></th></tr></thead>
                            <tbody>
                            <tr>
                                <td>Order Ref</td><td><a class="txt_blue"><?= $invoice;?></a></td>
                            </tr>
                            <tr>
                                <td>Status</td><td><a class="txt_blue"><?= $status;?></a></td>
                            </tr>
                            <tr>
                                <td>Amount</td><td><a class="txt_blue"><?= $amount;?></a></td>
                            </tr>
                            <tr>
                                <td>Paid Via</td><td><a class="txt_blue"><?= $paid_via;?></a></td>
                            </tr>
                            <tr>
                                <td>Ordered</td><td><a class="txt_blue"><?= $report_date;?></a></td>
                            </tr>
                            <tr>
                                <td>Delivered</td><td><a class="txt_blue"><?= $delivery_date;?></a></td>
                            </tr>
                            </tbody>
                        </table>

                        <table class="span4 margin_b20">
                            <thead><tr><th><h4>Retailer Information</h4></th></tr></thead>
                            <tbody>
                            <tr>
                                <td>Name:</td><td><a class="txt_blue"><?= $business_name;?></a></td>
                            </tr>
                            <tr>
                                <td>mobile 1:</td><td><a class="txt_blue"><?= $stockist_mobile1;?></a></td>
                            </tr>
                            <tr>
                                <td>Mobile 2:</td><td><a class="txt_blue"><?= $stockist_mobile2;?></a></td>
                            </tr>
                            <tr>
                                <td>Location:</td><td><a class="txt_blue"><?= $distributor_town;?></a></td>
                            </tr>
                            <tr>
                                <td>Region:</td><td><a class="txt_blue"><?= $distributor_region;?></a></td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="span4 margin_b20">
                            <thead><tr><th><h4>Stockist Information</h4></th></tr></thead>
                            <tbody>
                            <tr>
                                <td>Code:</td><td><a class="txt_blue"><?= $distributor_code;?></a></td>
                            </tr>
                            <tr>
                                <td>Name</td><td><a class="txt_blue"><?= $distributor_name;?></a></td>
                            </tr>
                            <tr>
                                <td>Mobile</td><td><a class="txt_blue"><?= $distributor_mobile;?></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="well blue">
                <div class="well-header">
                    <h5>Ordered Products</h5>
                </div>
                <div class="well-content no_search">

                    <table class="table table-striped table-bordered table-hover datatable" width="100%" cellspacing="0" id="example">
                        <thead>
                        <tr>
                            <th>SKU Code</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Packing</th>
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
        jQuery('#example').dataTable({
            "responsive": true,
            "processing": true,
            "bServerSide": true,
            "sAjaxSource": "<?=base_url('reports/orders/datatable2/'.$id)?>",
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "aLengthMenu": [[10, 20, 50,100], [10, 20, 50,100]],
            "dom": 'T<"clearfix"><"margin-b"lf<"clearfix">>trip',
            "scrollX": true,
            "tableTools": {
                "sSwfPath": "<?= base_url('assets/tabletools/swf/copy_csv_xls_pdf.swf');?>"
            },
            aoColumns: [

                { "mData": "sku_code","bSearchable": true,"bSortable": true },
                { "mData": "item_code","bSearchable": true,"bSortable": true },
                { "mData": "description","bSearchable": true,"bSortable": true },
                { "mData": "quantity","bSearchable": true,"bSortable": true},
                { "mData": "item_um","bSearchable": true,"bSortable": true }

            ],
            "oLanguage": {
                "sProcessing": "<img src='<?= base_url('assets/img/loading.gif'); ?>'>"
            },
            fnInitComplete : function () {
                //oTable.fnAdjustColumnSizing();
            },
            fnServerData : function (sSource, aoData, fnCallback) {
                jQuery.ajax({
                    'dataType': 'json',
                    'type': 'POST',
                    'url': sSource,
                    'data': aoData,
                    'success': fnCallback
                });
            }
        });
    });

</script>
<script src="<?php echo base_url('assets/datatables/js/responsive.js'); ?>"></script>
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
