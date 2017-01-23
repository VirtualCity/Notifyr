<!-- begin #content -->
<div id="content" class="content">
 
    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
        <li><a href="javascript:;"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="javascript:;"><i class="fa fa-file"></i> Products</a></li>
        <li class="active">View Products</li>
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
            <div class="panel panel-no-rounded-corner panel-default">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                         
                    </div>
                    <h4 class="panel-title">View Products</h4>
                </div>
                <div class="panel-body">
                   
                    <table class="table table-striped table-bordered table-hover datatable"  id="example">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Last Modified</th>
                            <th>Date Created</th>
                            <?Php if($user_role!=="USER"){ ?>
                                <th>Action</th>
                            <?Php  } ?>

                        </tr>
                        </thead>

                    </table>
                   
                </div>
                <div class="panel-footer">View Products</div>
            </div>
        </div>
    </div>
</div>
<!-- end #content -->
<!--Header Section-->
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

                { "data": "code"},
                { "data": "name"},
                { "data": "description"},
                { "data": "modified"},
                { "data": "created"}
                <?Php if($user_role!=="USER"){ ?>
                ,
                { "data": "actions","orderable": false,"bSearchable": false }
                <?Php  } ?>
            ],
            "oLanguage": {
                "sProcessing": "<img src='<?= base_url('assets/img/loading.gif'); ?>'>"
            },
            "ajax":{
                "url": "<?php echo base_url('products/datatable')?>",
                "type": "POST"
            }
        });
    });

</script>