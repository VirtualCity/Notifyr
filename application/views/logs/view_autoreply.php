<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="javascript:;"><i class="fa fa-comments"></i> SMS Logs</a></li>
            <li class="active">Auto-Reply SMS Log</li>
        </ol>
    </div>


    <div id="alert_placeholder">
        <?php
        $appmsg = $this->session->flashdata('appmsg');
        if(!empty($appmsg)){ ?>
        <div id="alertdiv" class="alert <?=$this->session->flashdata('alert_type') ?> "><a class="close" data-dismiss="alert">x</a><span><?= $appmsg ?></span></div>
        <?php } ?>
    </div>



    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                       <table class="table table-striped table-bordered table-hover datatable" width="100%" cellspacing="0" id="example">
                        <thead>
                        <tr>
                            <th>Mobile</th>
                            <th>Recipient</th>
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <div class="panel-footer">Auto-Reply SMS</div>
            </div>
        </div>
    </div>
</div>
<!-- end #content -->

 
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
                "sSwfPath": "<?= base_url('assets/tabletools/swf/copy_csv_xls_pdf.swf');?>",
                "aButtons": [ "copy", "csv","xls","pdf" ]
            },

            columns: [

                { "data": "sent_to" },
                { "data": "recipient" },
                { "data": "message" },
                { "data": "created"}

            ],
            "order": [[ 3, "desc" ]],
            "oLanguage": {
                "sProcessing": "<img src='<?= base_url('assets/img/loading.gif'); ?>'>"
            },
            "ajax":{
                "url": "<?=base_url('logs/autoreplies/datatable')?>",
                "type": "POST"
            }
        });
    });

</script> 