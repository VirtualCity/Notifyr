<!-- begin #content -->
<div id="content" class="content">
 
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
        <li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">View Factories Usage Report</li>
    </ol>
    </div>

     <div id="alert_placeholder">
            <?php
            $appmsg = $this->session->flashdata('appmsg');
            if(!empty($appmsg)){ ?>
                <div id="alertdiv" class="alert <?=$this->session->flashdata('alert_type') ?> "><a class="close" data-dismiss="alert">x</a><span><?= $appmsg ?></span></div>
            <?php } ?>
        </div>
 

<? //print_r($facts) ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover datatable display"  id="example">
                        <thead>
                        <tr>
                            <!-- <th>id</th> -->
                            <th>Factory</th>
                            <th>Factory Code</th>
                            <th>Sender Id</div>
                            <th>Sent</div>
                            <th>Balance</div>
                            <th>Region</th>
                            <th>Date Created</th>

                        </tr>
                        </thead>

                    </table>
                    <br>
                </div>
                <div class="panel-footer">View Factories Usage Report</div>
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
            "lengthMenu": [[50, 100,200,500], [50, 100,200,500]],
            "dom": 'T<"clear">lfrtip',
            "tableTools": {
                "sSwfPath": "<?= base_url('assets/tabletools/swf/copy_csv_xls_pdf.swf');?>",
                "aButtons": [ "copy", "csv","xls","pdf" ]
            },
            columns: [
                // { "data": "id"},
                { "data": "factoryName"},
                { "data": "factoryCode"},
                { "data": "senderid"},
                { "data": "sent"},
                { "data": "balance"},
                { "data": "region"},
                { "data": "created"}
            ],
            "order": [[ 6, "desc" ]],
            "oLanguage": {
                "sProcessing": "<img src='<?php echo base_url('assets/img/loading.gif'); ?>'>"
            },
            "ajax":{
                "url": "<?php echo base_url('factories/usageBalance_period'); //echo ('/30');?>",//usageBalance
                "type": "POST",
                error: function(){  // error handling
                    $(".example-error").html("");
                    $("#example").append('<tbody class="example-error"><tr><th colspan="8">No data found in the server</th></tr></tbody>');
                    $("#example_processing").css("display","none");
 
                }
            }
        });
    });

</script> 