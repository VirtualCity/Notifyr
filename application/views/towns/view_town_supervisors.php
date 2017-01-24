<!-- begin #content -->
<div id="content" class="content">

    <div class="breadcrumb-container ">
        <ol class="breadcrumb pull-left ">
            <li><a href="<?php echo site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="<?php echo site_url('towns') ?>"><i class="fa fa-map-marker"></i> Towns</a></li>
            <li class="active">Supervisors</li>
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
                <div class="panel-heading">
                    <h4 class="panel-title">Region & Town</h4>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr><td><strong>Region:</strong></td><td> <?= $region_name;?> </td></tr>
                            <tr><td><strong>Town:</strong></td><td> <?= $town_name;?> </td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-primary" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                    </div>
                    <h4 class="panel-title">Town Supervisors</h4>
                </div>
                <div class="panel-body">
                 <table class="table table-bordered table-hover display responsive nowrap" width="100%" cellspacing="0" id="example">
                    <thead>
                        <tr>
                            <th>Supervisor</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Division</th>
                            <th>Last Modified</th>
                            <th>Date Created</th>
                            <?Php if($user_role!=="USER"){ ?>
                            <th>Action</th>
                            <?Php  } ?>
                        </tr>
                    </thead>

                </table>
            </div>
            <div class="panel-footer">Town Supervisors</div>
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
            { "data": "name"},
            { "data": "mobile" },
            { "data": "email"},
            { "data": "division"},
            { "data": "modified"},
            { "data": "created"}
            <?Php if($user_role!=="USER"){ ?>
                ,
                { "data": "actions","orderable": false,"searchable": false }
                <?Php  } ?>

                ],
                "oLanguage": {
                    "sProcessing": "<img src='<?php echo base_url('assets/img/loading.gif'); ?>'>"
                },
                "ajax":{
                    "url": "<?php echo base_url('towns/town_supervisors/'.$id)?>",
                    "type": "POST"
                }
            });
    });

</script> 