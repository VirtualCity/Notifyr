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
            <li class="active"><a>Blacklist</a></li>
        </ul>
    </div>
    <div id="alert_placeholder">
        <?php
        $appmsg = $this->session->flashdata('appmsg');
        if(!empty($appmsg)){ ?>
            <div id="alertdiv" class="alert <?=$this->session->flashdata('alert_type') ?> "><a class="close" data-dismiss="alert">x</a><span><?= $appmsg ?></span></div>
        <?php } ?>
    </div>
    <div class="inner_content">
        <div class="widgets_area">

            <div class="well blue">
                <div class="well-header">
                    <h5>Blacklisted Numbers</h5>
                </div>
                <div class="well-content no_search">

                    <table class="table table-striped table-bordered table-hover datatable"  id="example">
                        <thead>
                        <tr>

                            <th>Mobile Number</th>
                            <th>Date Blacklisted</th>
                            <?Php if($user_role!=="USER"){ ?>
                                <th>Action</th>
                            <?Php  } ?>

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
<script type="text/javascript" src="<?php echo($base); ?>assets/tabletools/js/datatables.tableTools.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#example').dataTable({
            "processing": true,
            "bServerSide": true,
            "sAjaxSource": "<?=base_url('blacklist/datatable')?>",
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "iDisplayStart ": 20,
            "aLengthMenu": [[50, 100,200,500], [50, 100,200,500]],
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "<?= base_url('assets/tabletools/swf/copy_csv_xls_pdf.swf');?>"
            },
            aoColumns: [
                { "mData": "msisdn","bSearchable": true,"bSortable": true },
                { "mData": "created","bSearchable": true,"bSortable": true}
                <?Php if($user_role!=="USER"){ ?>
                ,
                { "mData": "actions","bSearchable": false,"bSearchable": false }
                <?Php  } ?>
            ],
            "order": [[ 1, "desc" ]],
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
<script src="<?php echo($base); ?>assets/js/jquery-ui-1.10.3.js"></script>
<script src="<?php echo($base); ?>assets/js/bootstrap.js"></script>

<script src="<?php echo($base); ?>assets/js/library/jquery.collapsible.min.js"></script>
<script src="<?php echo($base); ?>assets/js/library/jquery.mCustomScrollbar.min.js"></script>
<script src="<?php echo($base); ?>assets/js/library/jquery.mousewheel.min.js"></script>
<script src="<?php echo($base); ?>assets/js/library/jquery.uniform.min.js"></script>

<script src="<?php echo($base); ?>assets/js/library/jquery.autosize-min.js"></script>
<script type="text/javascript">


    function showalert(message,alerttype){
        $('#alert_placeholder').append('<div id="alertdiv" class="alert ' + alerttype + '"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
        setTimeout(function() {
            $('#alertdiv').remove();
        },6000);
    }

    function showMessage(message){
        if(message.length>0){
            showalert2(message,"alert-info");
        }
    }

    function showalert2(message,alerttype){
        $('#alert_placeholder').append('<div id="alertdiv" class="alert ' + alerttype + '"><a class="close" data-dismiss="alert">x</a><span>'+message+'</span></div>')
        setTimeout(function() {
            $('#alertdiv').remove();
        },3000);


    }


</script>

<script src="<?php echo($base); ?>assets/js/design_core.js"></script>

</body>
</html>
